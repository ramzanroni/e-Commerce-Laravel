<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\UserOrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// FontEnd
Route::get('/', [ContentController::class, 'index']);
Route::get('/product-details/{product_id}', [ContentController::class, 'product_details']);

// Admin
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/home', [AdminController::class, 'index']);
Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('login.admin');
Route::post('/admin', [LoginController::class, 'login']);
Route::get('/admin_logout', [AdminController::class, 'logout']);

// Category

Route::get('admin/category', [CategoryController::class, 'index']);
Route::post('admin/add_category', [CategoryController::class, 'add_category']);
Route::get('/admin/category/edit/{cat_up_id}', [CategoryController::class, 'edit_category']);
Route::post('/admin/update_category', [CategoryController::class, 'update_category']);
Route::get('/admin/category/delete/{del_id}', [CategoryController::class, 'delete_category']);
Route::get('/admin/category/deactive/{id}', [CategoryController::class, 'deactive']);
Route::get('admin/category/active/{id}', [CategoryController::class, 'active']);

// Brand
Route::get('/admin/brand', [BrandController::class, 'index']);
Route::post('/admin/add_brand', [BrandController::class, 'add_brand']);
Route::get('/admin/brand/delete/{del_id}', [BrandController::class, 'delete_brand']);
Route::get('/admin/brand/deactive/{deactive_id}', [BrandController::class, 'deactive_brand']);
Route::get('/admin/brand/active/{active_id}', [BrandController::class, 'active_brand']);
Route::get('/admin/brand/edit/{edit_id}', [BrandController::class, 'find_update']);
Route::post('/admin/brand_category', [BrandController::class, 'update_brand']);

// product
Route::get('/admin/add_product', [ProductController::class, 'add_product']);
Route::post('/admin/store_product', [ProductController::class, 'store_product']);
Route::get('/admin/manage_product', [ProductController::class, 'manage_product']);
Route::get('/admin/product/delete/{up_id}', [ProductController::class, 'delete_product']);
Route::get('/admin/product/deactive/{deactive_id}', [ProductController::class, 'deactive_product']);
Route::get('/admin/product/active/{active_id}', [ProductController::class, 'active_product']);
Route::get('/admin/product/edit/{edit_id}', [ProductController::class, 'edit_product']);
Route::post('/admin/update_product', [ProductController::class, 'update_product']);
Route::post('/admin/update_image', [ProductController::class, 'product_image_update']);

// Coupon
Route::get('/admin/coupon', [CouponController::class, 'coupon']);
Route::post('/admin/add_coupon', [CouponController::class, 'add_coupon']);
Route::get('/admin/coupon/delete/{id}', [CouponController::class, 'delete_coupon']);
Route::get('/admin/coupon/deactive/{id}', [CouponController::class, 'deactive_coupon']);
Route::get('/admin/coupon/active/{id}', [CouponController::class, 'active_coupon']);
Route::get('/admin/coupon/edit/{id}', [CouponController::class, 'edit_coupon']);
Route::post('/admin/update_coupon', [CouponController::class, 'update_coupon']);

// orders
Route::get('/admin/orders', [UserOrderController::class, 'orders']);
Route::get('/admin/order/view/{id}', [UserOrderController::class, 'order_view']);

// Cart
Route::post('/add_to_cart/{product_id}', [CartController::class, 'add_to_cart']);
Route::get('/cart', [CartController::class, 'cart_page']);
Route::get('/cart_item_delete/{item_id}', [CartController::class, 'remove_to_cart']);
Route::post('/update_product_quantity/{item_id}', [CartController::class, 'quantity_update']);
Route::post('/coupon-apply', [CartController::class, 'coupon_apply']);
Route::get('/cart/remove-coupon', [CartController::class, 'remove_coupon']);

// Wishlist
Route::get('/add-wishlist/{priduct_id}', [WishlistController::class, 'add_wishlist']);
Route::get('/wishlist', [WishlistController::class, 'wish_page']);
Route::get('/wishlist_remove/{wishlist_id}', [WishlistController::class, 'remove_wistlist_item']);

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index']);

//orderplace
Route::post('place-order', [OrderController::class, 'store_order']);
Route::get('order-success', [OrderController::class, 'order_complete']);

// User
Route::get('/user_order', [UserController::class, 'user_order']);
Route::get('user/order-view/{id}', [UserController::class, 'order_view']);

// Shop 
Route::get('/shop', [ContentController::class, 'shop']);