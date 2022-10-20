<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogHomeController extends Controller
{
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
        $blogs = Blog::get();
        return view('front_end.blog', compact('blogs', 'qty', 'total'));
    }

    public function detail($slug){
        $blog = Blog::where('slug', $slug)->first();
        return view('front_end.blog_detail',compact('blog'));
    }
}
