<?php

use App\Http\Controllers\Api\ShopApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/product/list', [ShopApiController::class, 'product_list']);
Route::get('/province/list', [ShopApiController::class, 'province_list']);
Route::get('/district/list/{id}', [ShopApiController::class, 'district_list']);
Route::get('/ward/list/{id}', [ShopApiController::class, 'ward_list']);
Route::get('/order/list/{status}', [ShopApiController::class, 'order_list']);
Route::get('/detail-order/list/', [ShopApiController::class, 'detail_order_list']);
Route::post('/order/create/', [ShopApiController::class, 'createOrder']);
Route::get('/user/list', [ShopApiController::class,'get_user']);
Route::post('/user/register', [ShopApiController::class, 'register']);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::get('/user', [AuthController::class, 'user_info']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);
});
