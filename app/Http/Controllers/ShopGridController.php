<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class ShopGridController extends Controller
{
    //
    public function index($slug)
    {

        $carts = session()->get('cart');
        $total = 0;
        $qty = 0;
        if ($carts) {
            foreach ($carts as $key => $cart) {
                $total += $cart['price'] * $cart['quantity'];
                $qty += $cart['quantity'];
            }
        };
        $categoryId = Categories::has('subCategories.products')->orWhereHas('products')->with(['subCategories' => function ($q) {
            $q->with(['products' => function ($q2) {
            }]);
        }])->where('parent_id', 0)->get();

        $cate = Categories::with(['products', 'subCategories' => function ($q) {
            $q->with(['products' => function ($q2) {
            }]);
        }])->where('slug', $slug)->get();
        // return response()->json($cate);
        return view('front_end.shop_grid', compact('qty', 'total', 'cate'));
    }
}
