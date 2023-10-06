<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);


//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);


//Backend
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);

//Category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);

Route::get('/get-all-category-product', [CategoryProduct::class, 'get_all_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::post('/search-cate', [CategoryProduct::class, 'search_cate']);
Route::get('/filter-category', [CategoryProduct::class, 'filter_category']);






//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/get-all-product', [ProductController::class, 'get_all_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::post('/search-product', [ProductController::class, 'search_product']);


Route::get('/filter', [ProductController::class, 'filter']);
Route::get('/filter-product', [ProductController::class, 'filter_product']);




//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);


//order
Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
Route::get('/view-order/{order_id}', [CheckoutController::class, 'view_order']);


//Authentication roles
Route::get('/register', [AuthController::class, 'register']);
Route::post('/login-auth', [AuthController::class, 'login_auth']);
Route::get('/logout-auth', [AuthController::class, 'logout_auth']);
Route::post('/actived/{user_id}', [AuthController::class, 'actived']);
Route::get('/active-email/{user_id}', [AuthController::class, 'active_email']);
Route::post('/register-auth', [AuthController::class, 'register_auth']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/forgot', [AuthController::class, 'forgot']);
Route::get('/show-forgot/{user_id}', [AuthController::class, 'show_forgot']);
Route::get('/show-change-password/{user_id}', [AuthController::class, 'show_change_password']);
Route::post('/forgot-email', [AuthController::class, 'forgot_email']);
Route::post('/forgot-actived/{user_id}', [AuthController::class, 'forgot_actived']);
Route::post('/change-password/{user_id}', [AuthController::class, 'change_password']);


///specifications
Route::get('/add-specifications', [ProductController::class, 'add_specifications']);
Route::get('/get-view-specifications', [ProductController::class, 'get_view_specifications']);
Route::post('/save-specifications-product', [ProductController::class, 'save_specifications_product']);

//Payment
Route::get('/show-add-payment', [PaymentController::class, 'show_add_payment']);
Route::post('/add-payment', [PaymentController::class, 'add_payment']);
Route::get('/get-all-payment', [PaymentController::class, 'get_all_payment']);
Route::get('/unactive-payment/{payment_id}', [PaymentController::class, 'unactive_payment']);
Route::get('/active-payment/{payment_id}', [PaymentController::class, 'active_payment']);
Route::post('/search-payment', [PaymentController::class, 'search_payment']);
Route::get('/show-edit-payment/{payment_id}', [PaymentController::class, 'show_edit_payment']);
Route::post('/edit-payment/{payment_id}', [PaymentController::class, 'edit_payment']);
Route::get('/delete-payment/{payment_id}', [PaymentController::class, 'delete_payment']);



//User admin
Route::get('/show-add-user', [UserController::class, 'show_add_user']);
Route::get('/edit-user/{user_id}', [UserController::class, 'edit_user']);
Route::get('/delete-user/{user_id}', [UserController::class, 'delete_user']);
Route::get('/get-all-user', [UserController::class, 'get_all_user']);
Route::get('/unactive-user/{user_id}', [UserController::class, 'unactive_user']);
Route::get('/active-user/{user_id}', [UserController::class, 'active_user']);
Route::post('/add-user', [UserController::class, 'add_user']);
Route::post('/update-user/{user_id}', [UserController::class, 'update_user']);
Route::post('/search-users', [UserController::class, 'search_users']);


//user profile
Route::post('/add-avatar/{user_id}', [UserController::class, 'add_avatar']);
Route::get('/show-user-profile/{user_id}', [UserController::class, 'show_user_profile']);
Route::get('/show-change-password-user/{user_id}', [UserController::class, 'show_change_password_user']);
Route::post('/update-profile/{user_id}', [UserController::class, 'update_profile']);
Route::post('/change-password-user/{user_id}', [UserController::class, 'change_password_user']);
Route::post('/select-delivery', [UserController::class, 'select_delivery']);
Route::get('/show-order-history/{user_id}', [UserController::class, 'show_order_history']);


//Cart
Route::get('/add-cart/{product_id}/{user_id}', [CartController::class, 'add_cart']);
Route::get('/add-cart-detail/{product_id}/{user_id}/{detail_quantity}', [CartController::class, 'add_cart_detail']);
Route::get('/delete-item-cart/{product_id}/{user_id}/{cart_id}/{cart_detail_id}', [CartController::class, 'delete_item_cart']);
Route::get('/update-cart-detail/{cart_detail_id}/{quantity}', [CartController::class, 'update_cart_detail']);
Route::get('/show-cart/{user_id}', [CartController::class, 'show_cart']);

//order
Route::get('/show-order/{user_id}', [OrderController::class, 'show_order']);
Route::get('/show-verify-email-order/{user_id}', [OrderController::class, 'show_verify_email_order']);
Route::get('/verify-email-order/{user_id}', [OrderController::class, 'verify_email_order']);
Route::post('/verify-order/{user_id}', [OrderController::class, 'verify_order']);
