<?php

use App\Http\Controllers\ExtraPage;
use App\Http\Controllers\ExtraPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


/*
 * Home
 *
 */
Route::get('/', [ShopController::class, 'index'])->name('shop');
/*
 * Default Shop Feature
 */
Route::get('all-category', [ShopController::class, 'all_category'])->name('all.categories');
Route::get('category/{category}', [ShopController::class, 'single_category'])->name('shop.category');
Route::get('all-products', [ShopController::class, 'all_products'])->name('all.products');
Route::view('featured-product', 'web.pages.shop.featured-product');
Route::get('product/{product}', [ShopController::class, 'single_product'])->name('shop.product');
/*
 * Cart Feature
 */
Route::get('cart', [CartController::class, 'index'])->name('shop.cart');
Route::get('cart/add-to-cart', [CartController::class, 'addToCart'])->name('shop.cart.add');
Route::get('cart/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('shop.cart.remove');
Route::get('cart/increment', [CartController::class, 'incrementQuantity'])->name('cart.incrementQuantity');
Route::get('cart/decrement', [CartController::class, 'decrementQuantity'])->name('cart.decrementQuantity');
Route::post('cart/apply-coupon', [CouponsController::class, 'apply'])->name('cart.applyCoupon');
/*
 * Login Feature
 */
Route::view('login', 'web.pages.login')->name('b2e.login');
Route::post('login', [ShopController::class, 'customer_login'])->name('shop.login');
Route::view('sign-up', 'web.pages.register')->name('b2e.signup');
Route::post('sign-up', [ShopController::class, 'customer_register'])->name('b2e.save.user');
Route::view('forget-password', 'web.pages.forget-password')->name('shop.forget-password');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('shop.password.email');
Route::view('password/reset/{token}', 'web.pages.change-password')->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Checkout
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('get-all-sub-district', [CheckoutController::class, 'getSubDistrict'])->name('get.subDistrict');
Route::post('checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');

// Privacy Policy
//Route::view('privacy-policy', 'web.pages.privacy-policy');
// Required pages for sslcommerz
Route::get('terms-conditions', [ExtraPageController::class, 'TermsConditions'])->name('terms-conditions');
Route::get('terms-service', [ExtraPageController::class, 'TermsService'])->name('terms-service');
Route::get('refund-policy', [ExtraPageController::class, 'RefundPolicy'])->name('refund-policy');
Route::get('privacy-policy', [ExtraPageController::class, 'PrivacyPolicy'])->name('privacy-policy');
Route::get('about-us', [ExtraPageController::class, 'AboutUs'])->name('about-us');
// Notification Details
Route::view('notification-details', 'web.pages.notification-details')->name('shop.notification');
//support
Route::view('support', 'web.pages.support');

Route::view('settings', 'web.pages.user.setting')->name('shop.setting');

Route::middleware('auth')->prefix('customer')->group(function () {
    /*
     * User Profile
     */
    Route::view('profile', 'web.pages.user.profile')->name('profile');
    Route::view('edit-profile', 'web.pages.user.edit-profile')->name('b2e.profile');
    Route::post('edit-profile/{id}', [UserController::class, 'updateUser'])->name('b2e.profile.update');
    Route::view('my-order', 'web.pages.user.my-order')->name('b2e.my-orders');
    Route::get('my-order/{id}', [CustomerController::class, 'showOrderDetails'])->name('b2e.my-orders.details');
    Route::view('my-accounts', 'web.pages.user.my-accounts')->name('b2e.my-accounts');
    Route::get('my-teams', [CustomerController::class, 'customerTeams'])->name('b2e.my-teams');
    Route::view('create-child-account', 'web.pages.user.create-child-account')->name('b2e.child.account.form');
    Route::post('save-child-account', [CustomerController::class, 'save_child'])->name('b2e.child.save');
    Route::get('login-child-account/{user}', [UserController::class, 'login_child'])->name('b2e.child.login');
    /*
     * User Upgrade
     */
    Route::view('upgrade-form', 'web.pages.user.upgrade-form')->name('b2e.upgradeToPro');
    Route::post('upgrade/{id}', [CustomerController::class, 'customerUpgrade'])->name('upgrade');
    /*
     * User Wishlist
     */
    Route::get('add-to-wishlist/{id}', [ShopController::class, 'addToWishlist'])->name('shop.add.wish');
    Route::get('wishlist', [ShopController::class, 'getWishlist'])->name('b2e.wishlist');
    Route::get('remove-from-wishlist/{id}', [ShopController::class, 'removeFromWishlist'])->name('b2e.remove.wish');
    /*
     * User Wallet
     */
    Route::get('wallet', [CustomerController::class, 'customerWallet'])->name('b2e.wallet');
    Route::get('income-balance-statement', [CustomerController::class, 'customerIncome'])->name('statement.income.balance');
    Route::get('shop-balance-statement', [CustomerController::class, 'customerPoint'])->name('statement.shop.balance');
    Route::view('withdraw', 'web.pages.user.withdraw')->name('b2e.withdraw.form');
    Route::post('withdraw', [CustomerController::class, 'customerWithdraw'])->name('b2e.withdraw');
    Route::view('send-money', 'web.pages.user.send-money')->name('b2e.send.money.form');
    Route::post('send-money', [CustomerController::class, 'customerSendMoney'])->name('b2e.send.money');
    Route::view('exchange-money', 'web.pages.user.exchange')->name('b2e.exchange.form');
    Route::post('exchange-money', [CustomerController::class, 'customerExchangeMoney'])->name('b2e.exchange.money');
    /*
     * User Work
     */
    Route::get('works', [CustomerController::class, 'customerWorks'])->name('b2e.works')->middleware(['premium']);
    Route::post('submit-work', [CustomerController::class, 'submitCustomerWork'])->name('b2e.submit.work')->middleware('premium');
    /*
     * User Review
     */
    Route::post('submit/review', [ReviewsController::class, 'submitReview'])->name('submit.review');
});


