<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = session()->get('cart');
        // dd($carts);
        return view('front_end.cart', compact('carts'));
    }

    /**
     *
     */
    public function addToCart($id)
    {
        // session()->flush('cart');

        $product = Products::find($id);

        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        session()->put('cart', $cart);
        $total = 0;
        $qty = 0;
        foreach ($cart as $key => $c) {
            $total += $c['price'] * $c['quantity'];
            $qty += $c['quantity'];
        }

        return response()->json([
            'code' => 200,
            'message' => 'Thêm sản phẩm thành công',
            'total' => number_format($total) . ' đ',
            'qty' => $qty,
            'code' => 200
        ]);
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $carts);
            $carts_update = session()->get('cart');
            $cartUpdate = [];
            $total = 0;
            $qty = 0;
            foreach ($carts_update as $key => $cart_update) {
                $item['quantity'] = $cart_update['quantity'];
                $item['cart_id'] = $key;
                $item['total_price'] = number_format($cart_update['price'] * $cart_update['quantity']) . ' đ';
                $total += $cart_update['price'] * $cart_update['quantity'];
                $qty += $cart_update['quantity'];

                array_push($cartUpdate, $item);
            }
            // $tt =
            return response()->json([
                'cart_update' => $cartUpdate,
                'total' => number_format($total) . ' đ',
                'qty' => $qty,
                'code' => 200,
                'message' => 'Cập nhật sản phẩm thành công',
            ]);
        }
    }

    public function deleteCart(Request $request)
    {
        if ($request->id) {
            $carts = session()->get('cart');
            unset($carts[$request->id]);
            session()->put('cart', $carts);
            $carts_delete = session()->get('cart');
            $total = 0;
            $qty = 0;
            foreach ($carts_delete as $key => $cart_delete) {
                $total += $cart_delete['price'] * $cart_delete['quantity'];
                $qty += $cart_delete['quantity'];
            }
            // $tt =
            return response()->json([
                'total' => number_format($total) . ' đ',
                'qty' => $qty,
                'code' => 200,
                'message' => 'Cập nhật sản phẩm thành công',
            ]);
        }
    }
}
