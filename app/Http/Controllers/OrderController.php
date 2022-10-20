<?php

namespace App\Http\Controllers;

use App\Mail\Gmail;
use App\Models\District;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmail;
use App\Models\Products;
use Illuminate\Queue\Queue;

class OrderController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(){
        $orders = Order::with('province')->with('district')->with('ward')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function detailOrder($id){
        $order = Order::where('id', $id)->with('province')->with('district')->with('ward')->get();
        $product_list = ProductOrder::where('order_id', $id)->with('order')->with('product')->get();
        return view('admin.order.detail', compact('order', 'product_list'));
    }

    public function order(Request $request)
    {
        $data = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'province_id' => $request->provinces,
            'district_id' => $request->districts,
            'ward_id' => $request->wards,
            'address' => $request->address,
            'note' => $request->note
        ];

        $order_id = Order::create($data)->id;



        $table = '';
        $carts = session()->get('cart');

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['quantity'] * $cart['price'];
            $c = [
                'product_id' => $cart['id'],
                'order_id' => $order_id,
                'quantity' => $cart['quantity'],
            ];

            $table .= '<tr> <td>'. $cart['name'] .'</td><td>'. $cart['quantity'] .'</td><td>'. number_format($cart['price'] * $cart['quantity']) .'đ</td><td>'. $request->note .'</td></tr>';
            ProductOrder::create($c);
        }

        // \Queue::push(new SendEmail($request, $table, $order_id));

        $order['full_name'] = $request->full_name;
        $order['phone'] = $request->phone;
        $order['email'] = $request->email;
        $order['address'] = $request->address;
        $order['provinces'] = $request->provinces;
        $order['districts'] = $request->districts;
        $order['wards'] = $request->wards;


        \Queue::push(new SendEmail($order, $table, $order_id, $total));

        // $emailJob = new  SendEmail($order, $table, $order_id, $table);
        // dispatch($emailJob);

        session()->flush('cart');
        return redirect()->route('home');
    }
}
