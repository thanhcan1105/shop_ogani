<?php

use App\Http\Controllers\Admin\Blogs\BlogCateController;
use App\Http\Controllers\Admin\Blogs\BlogController;
use App\Http\Controllers\Admin\Products\CategoriesController;
use App\Http\Controllers\Admin\Products\ProductsController;
use App\Http\Controllers\BlogHomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopGridController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//******************    Trang khach hang    ******************//
//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/demo', function () {
    return view('front_end.mail_send');
});

Route::get('/login', function () {
    return response()->json(['auth' => false]);
})->name('login');


//Cart
Route::get('/shopping-cart', [CartController::class, 'index'])->name('shopping-cart');
Route::get('/shopping-cart/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/shopping-cart/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
Route::get('/shopping-cart/delete-cart', [CartController::class, 'deleteCart'])->name('deleteCart');

//Shop
Route::get('/shop-grid/{slug}', [ShopGridController::class, 'index']);


//Blog
Route::get('/blog', [BlogHomeController::class, 'index'])->name('blog');
Route::get('/blog/blog-detail/{slug}', [BlogHomeController::class, 'detail'])->name('blog-detail');

//Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout/district', [CheckoutController::class, 'select_district'])->name('select_district');
Route::get('/checkout/ward', [CheckoutController::class, 'select_ward'])->name('select_ward');

//Order
// Route::get('/order', [OrderController::class, 'index'])->name('index');
Route::post('/order', [OrderController::class, 'order'])->name('order');

//Product detail
Route::get('/shop-details/{slug}', [DetailController::class, 'index'])->name('detail');

//Thank
Route::get('/thanks', function () {
    return view('front_end.thanks');
});

//******************    Trang quan ly    ******************//

Route::prefix('ogani-admin')->group(function () {
    Route::get('/', function () {
        return view('admin.admin');
    });
    Route::prefix('/categories')->name('categories.')->group(function () {
        //Hi???n th??? danh m???c s???n ph???m
        Route::get('/', [CategoriesController::class, 'index'])->name('categories');

        //Th??m danh m???c s???n ph???m
        Route::get('/add', [CategoriesController::class, 'addCategory'])->name('add');
        Route::post('/add', [CategoriesController::class, 'postAddCategory'])->name('post-add');

        //X??a danh m???c s???n ph???m
        Route::delete('/delete/{slug}', [CategoriesController::class, 'deleteCategory'])->name('delete');

        //S???a danh m???c s???n ph???m
        Route::get('/edit/{slug}', [CategoriesController::class, 'editCategory'])->name('edit');
        Route::post('/edit/{slug}', [CategoriesController::class, 'postEditCategory'])->name('post-edit');

        //Chi ti???t danh m???c s???n ph???m
        Route::get('/detail/{slug}', [CategoriesController::class, 'detailCategory'])->name('detail');
    });

    Route::prefix('products')->name('products.')->group(function () {

        //Hi???n th??? s???n ph???m
        Route::get('/', [ProductsController::class, 'index'])->name('products');

        //Th??m s???n ph???m
        Route::get('/add', [ProductsController::class, 'addProduct'])->name('add');
        Route::post('/add', [ProductsController::class, 'postAddProduct'])->name('post-add');

        //X??a s???n ph???m
        Route::delete('/delete/{id}', [ProductsController::class, 'deleteProduct'])->name('delete');

        //S???a s???n ph???m
        Route::get('/edit/{slug}', [ProductsController::class, 'editProduct'])->name('edit');
        Route::post('/edit/{slug}', [ProductsController::class, 'postEditProduct'])->name('post-edit');

        //Chi ti???t s???n ph???m
        Route::get('/detail/{slug}', [ProductsController::class, 'detailProduct'])->name('detail');
    });

    Route::prefix('blog')->name('blog.')->group(function () {

        //Hi???n th??? b??i vi???t
        Route::get('/', [BlogController::class, 'index'])->name('index');

        //Th??m b??i vi???t
        Route::get('/add', [BlogController::class, 'addBlog'])->name('add');
        Route::post('/add', [BlogController::class, 'postAddBlog'])->name('post-add');

        //X??a b??i vi???t
        Route::delete('/delete/{id}', [BlogController::class, 'deleteBlog'])->name('delete');

        //S???a b??i vi???t
        Route::get('/edit/{slug}', [BlogController::class, 'editBlog'])->name('edit');
        Route::post('/edit/{slug}', [BlogController::class, 'postEditBlog'])->name('post-edit');

        //Chi ti???t b??i vi???t
        Route::get('/detail/{slug}', [BlogController::class, 'detailBlog'])->name('detail');
    });

    Route::prefix('blog_cate')->name('blog_cate.')->group(function () {

        //Hi???n th??? b??i vi???t
        Route::get('/', [BlogCateController::class, 'index'])->name('index');

        //Th??m b??i vi???t
        Route::get('/add', [BlogCateController::class, 'addBlogCate'])->name('add');
        Route::post('/add', [BlogCateController::class, 'postAddBlogCate'])->name('post-add');

        //X??a b??i vi???t
        Route::delete('/delete/{id}', [BlogCateController::class, 'deleteBlogCate'])->name('delete');

        //S???a b??i vi???t
        Route::get('/edit/{slug}', [BlogCateController::class, 'editBlogCate'])->name('edit');
        Route::post('/edit/{slug}', [BlogCateController::class, 'postEditBlogCate'])->name('post-edit');

        //Chi ti???t b??i vi???t
        Route::get('/detail/{slug}', [BlogCateController::class, 'detailBlogCate'])->name('detail');
    });

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/detail/order-{id}', [OrderController::class, 'detailOrder']);
});
