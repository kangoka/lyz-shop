<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CheckController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductPageController;


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

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('about-us', [HomeController::class, 'about'])->name('home.about');
Route::get('terms', [HomeController::class, 'terms'])->name('home.terms');

Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{post:slug}', [BlogController::class, 'blog_page'])->name('blog.page');
Route::get('blog/category/{BlogCategory:name}', [BlogController::class, 'blog_category'])->name('blog.category');

Route::get('/shop/product/{product:slug}', [ProductPageController::class, 'page'])->name('product.page');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.all');
Route::get('/shop/sort/{sort}', [ShopController::class, 'sort'])->name('shop.sort');
Route::get('/shop/{category:name}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/promo/check/{code}/{user:id}', [PromoController::class, 'checkCode'])->name('promo.check');

Route::get('sign-in-google', [UserController::class, 'google'])->name('login');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

// Midtrans routes
Route::get('payment', [CheckoutController::class, 'midtransCallback']);
Route::post('payment', [CheckoutController::class, 'midtransCallback']);

Route::middleware(['auth'])->group(function() {
    // Checkout routes
    Route::post('checkout/{product}', [CheckoutController::class, 'store'])->name('shop.checkout');

    // User dashboard route
    Route::prefix('user/dashboard')->namespace('User')->name('user.')->middleware('ensureUserRole:user')->group(function(){
        Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
        Route::get('/review/{checkout:midtrans_booking_code}', [ReviewController::class, 'get'])->name('review.get');
        Route::post('/review/{checkout:midtrans_booking_code}', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/waiting_payment', [UserDashboard::class, 'waiting_payment'])->name('transaction.waiting');
        Route::get('/order_success', [UserDashboard::class, 'success'])->name('transaction.success');
        Route::get('/order_complete', [UserDashboard::class, 'complete'])->name('transaction.complete');
        Route::get('/order_failed', [UserDashboard::class, 'failed'])->name('transaction.failed');
    });

    // Admin dashboard route
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->middleware('ensureUserRole:admin')->group(function(){
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/order', [AdminDashboard::class, 'order'])->name('order');
        Route::get('/order/all', [AdminDashboard::class, 'orderAll'])->name('order.all');

        Route::get('/send/{id}', [CheckoutController::class, 'deliverGet'])->name('send.get');
        Route::post('/send/{id}', [CheckoutController::class, 'deliverStore'])->name('send.deliver');

        // Product
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/create', [ProductController::class, 'insert'])->name('product.insert');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

        // Category
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'insert'])->name('category.insert');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        // Promo
        Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
        Route::get('/promo/create', [PromoController::class, 'create'])->name('promo.create');
        Route::post('/promo/create', [PromoController::class, 'insert'])->name('promo.insert');
        Route::get('/promo/edit/{id}', [PromoController::class, 'edit'])->name('promo.edit');
        Route::post('/promo/edit/{id}', [PromoController::class, 'update'])->name('promo.update');
        
        //Blog Post
        Route::get('/blog/post', [BlogController::class, 'index_post'])->name('blog.post.index');
        Route::get('/blog/post/create', [BlogController::class, 'create_post'])->name('blog.post.create');
        Route::post('/blog/post/create', [BlogController::class, 'insert_post'])->name('blog.post.insert');
        Route::get('/blog/post/edit/{id}', [BlogController::class, 'edit_post'])->name('blog.post.edit');
        Route::post('/blog/post/edit/{id}', [BlogController::class, 'update_post'])->name('blog.post.update');
        Route::get('/blog/post/delete/{id}', [BlogController::class, 'delete_post'])->name('blog.post.delete');
        
        //Blog Category
        Route::get('/blog/category', [BlogController::class, 'index_category'])->name('blog.category.index');
        Route::get('/blog/category/create', [BlogController::class, 'create_category'])->name('blog.category.create');
        Route::post('/blog/category/create', [BlogController::class, 'insert_category'])->name('blog.category.insert');
        Route::get('/blog/category/edit/{id}', [BlogController::class, 'edit_category'])->name('blog.category.edit');
        Route::post('/blog/category/edit/{id}', [BlogController::class, 'update_category'])->name('blog.category.update');
        Route::get('/blog/category/delete/{id}', [BlogController::class, 'delete_category'])->name('blog.category.delete');

        //Check
        Route::get('/check/order', [CheckController::class, 'orderPage'])->name('check.order');
        Route::get('/check/orderf/{code}', [CheckController::class, 'order'])->name('check.order.fetch');
        Route::get('/check/user', [CheckController::class, 'user'])->name('check.user');
    });
});

require __DIR__.'/auth.php';
