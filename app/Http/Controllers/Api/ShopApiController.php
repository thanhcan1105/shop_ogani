<?php

namespace App\Http\Controllers\Api;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Province;
use App\Models\Register;
use App\Models\User;
use App\Models\Ward;
use GrahamCampbell\ResultType\Success;
use Validator;

class ShopApiController extends Controller
{
    public function product_list()
    {
        // $user_id = auth()->user()->id;
        $products = Products::get();
        return response()->json($products);
    }

    public function province_list()
    {
        $provinces = Province::get();
        return response()->json($provinces);
    }

    public function district_list($id)
    {
        $district = District::where('_province_id', $id)->get();
        return response()->json($district);
    }


    public function ward_list($id)
    {
        $wards = Ward::where('_district_id', $id)->get();
        return response()->json($wards);
    }

    public function order_list($status)
    {
        $order_list = Order::where('status', $status ?? 0)->with('province', 'district', 'ward')->with(['order_detail' => function ($q) {
            $q->with('product');
        }])->get();

        return response()->json($order_list);
    }

    public function detail_order_list()
    {
        // $order_list = Order::where('id', $id)->with(['order_detail' => function ($q) {
        //     $q->with('product');
        // }])->get();
        $detail_order = ProductOrder::get();

        return response()->json($detail_order);
    }

    public function createOrder(Request $request)
    {
        $data = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'ward_id' => $request->ward_id,
            'address' => $request->address,
            'note' => $request->note
        ];

        $order_id = Order::create($data)->id;
        // $carts = session()->get('cart');
        foreach ($request->product as $product) {
            $c = [
                'product_id' => $product['product_id'],
                'order_id' => $order_id,
                'quantity' => $product['quantity'],
            ];
            ProductOrder::create($c);
        }

        if ($order_id) {
            return response()->json(['message' => 'success']);
        }
        return response()->json(['message' => 'error']);
    }

    public function get_user(){
        $users = Register::get();
        return response()->json($users);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:registers',
            'password' => 'required|min:6',
            // 'verify_code' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $password = md5($request->password);

        $data = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $password,
        ];

        User::create($data);

        if ($data) {
            return response()->json(['message' => 'Success']);
        }
        return response()->json(['message' => 'error']);
    }
}
