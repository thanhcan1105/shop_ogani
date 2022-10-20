<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Categories as ModelsCategories;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        //
    }

    public function index()
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

        // $categoryId = Categories::with(['products', 'parentCategory', 'subCategories' => function ($q) {
        //     $q->with('products');
        // }])->get();

        $categoryId = Categories::has('subCategories.products')->orWhereHas('products')->with(['products', 'subCategories' => function ($q) {
            $q->with('products');
        }])->where('parent_id', 0)->get();


        return view('front_end.home', compact('qty', 'total', 'categoryId'));
    }
}
