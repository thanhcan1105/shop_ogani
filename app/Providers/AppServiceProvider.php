<?php

namespace App\Providers;

use App\Models\BlogCate;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

        $image_list = Products::with('images')->get();
        view()->share('image_list', $image_list);

        $categories = Categories::with('subCategories')->get();
        view()->share('categories', $categories);

        $cate_child = Categories::with('parentCategory')->get();
        view()->share('cate_child', $cate_child);

        $products = Products::with('categories')->get();
        view()->share('products', $products);

        $categories_parent = Categories::where('parent_id', 0)->get();
        view()->share('categories_parent', $categories_parent);

        // $carts = session()->get('cart');
        // $total = 0;
        // $qty = 0;
        // if ($carts) {
        //     foreach ($carts as $key => $cart) {
        //         $total += $cart['price'] * $cart['quantity'];
        //         $qty += $cart['quantity'];
        //     }
        // };
        // view()->share('total', $total);
        // view()->share('qty', $qty);

        $blog_cate = BlogCate::get();
        view()->share('blog_cate', $blog_cate);
    }
}
