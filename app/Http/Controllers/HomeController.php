<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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

        // $categoryId = Categories::has('subCategories.products')->orWhereHas('products')->with(['products', 'subCategories' => function ($q) {
        //     $q->with('products');
        // }])->where('parent_id', 0)->get();

        $categoryId = Categories::has('subCategories.products')->orWhereHas('products')->with(['subCategories' => function ($q) {
            $q->with(['products' => function ($q2) {
            }]);
        }])->where('parent_id', 0)->get();

        // dd($categoryId->count());

            $cate = Categories::get();
        // $prod = Products::get();

        // dd($cate);   
        // $list = [];

        // foreach ($cate as $key => $value) {
        //     $prodd = Products::where('category_id', $value->id)->get();
        // }

        // $prod = Products::where('category_id', 5)->get();
        // print($prod->id);
        // return response()->json($prod);


        $latest = Products::orderBy('created_at', 'DESC')->take(3)->get();

        $blogs = Blog::orderBy('created_at', 'DESC')->take(3)->get();
        // dd($latest);

        // return response()->json([$categoryId]);

        return view('front_end.home', compact('qty', 'total', 'categoryId', 'latest', 'blogs'));
    }
}
