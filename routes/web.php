<?php

use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
    use App\Http\Controllers\DistrictsController;
    use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
    use App\Http\Controllers\SubDistrictsController;
    use App\Http\Controllers\PaymentMethodController;

//use App\Http\Controllers\WishlistsController;

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


Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')
     ->middleware('admin')
     ->group(function () {
         Route::get('server-down', [HomeController::class, 'serverDown'])->name('server.down');
         Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('home');

         Route::view('settings', 'app.settings')->name('settings.page');
         Route::post('settings', [HomeController::class, 'settings'])->name('settings');

         Route::view('send-incentive-bonus', 'app.send-incentive')->name('send.incentive');
         Route::post('send-incentive-bonus', [TransactionController::class, 'sendIncentiveBonus'])->name('save.incentive');

         Route::view('send-position-bonus', 'app.send-position')->name('send.position');
         Route::post('send-position-bonus', [TransactionController::class, 'sendPositionBonus'])->name('save.position');

         Route::get('wallet', [WalletController::class, 'index'])->name('wallet');
         Route::get('confirm-withdraw', [WalletController::class, 'confirm_withdraw'])->name('confirm.withdraw');

         Route::get('pending-upgrade-requests', [UserController::class, 'pending_upgrade'])->name('upgrade.list');
         Route::get('pending-upgrade-requests/show/{user}', [UserController::class, 'show_upgrade'])->name('upgrade.show');
         Route::get('pending-upgrade-requests/approve/{user}', [UserController::class, 'approve_upgrade'])->name('upgrade.approve');
         Route::get('pending-upgrade-requests/cancel/{user}', [UserController::class, 'cancel_upgrade'])->name('upgrade.cancel');
     });


/*
 * All CRUDs for admin
 */
Route::prefix('admin')
     ->middleware('admin')
     ->group(function () {
         Route::resource('payment-methods', PaymentMethodController::class);
         Route::resource('roles', RoleController::class);
         Route::resource('permissions', PermissionController::class);
         Route::resource('users', UserController::class);
         Route::resource('categories', CategoryController::class);
         Route::get('all-products', [ProductsController::class, 'index'])->name(
             'all-products.index'
         );
         Route::post('all-products', [ProductsController::class, 'store'])->name(
             'all-products.store'
         );
         Route::get('all-products/create', [
             ProductsController::class,
             'create',
         ])->name('all-products.create');
         Route::get('all-products/{products}', [
             ProductsController::class,
             'show',
         ])->name('all-products.show');
         Route::get('all-products/{products}/edit', [
             ProductsController::class,
             'edit',
         ])->name('all-products.edit');
         Route::put('all-products/{products}', [
             ProductsController::class,
             'update',
         ])->name('all-products.update');
         Route::delete('all-products/{products}', [
             ProductsController::class,
             'destroy',
         ])->name('all-products.destroy');

         Route::get('all-reviews', [ReviewsController::class, 'index'])->name(
             'all-reviews.index'
         );
         Route::post('all-reviews', [ReviewsController::class, 'store'])->name(
             'all-reviews.store'
         );
         Route::get('all-reviews/create', [
             ReviewsController::class,
             'create',
         ])->name('all-reviews.create');
         Route::get('all-reviews/{reviews}', [
             ReviewsController::class,
             'show',
         ])->name('all-reviews.show');
         Route::get('all-reviews/{reviews}/edit', [
             ReviewsController::class,
             'edit',
         ])->name('all-reviews.edit');
         Route::put('all-reviews/{reviews}', [
             ReviewsController::class,
             'update',
         ])->name('all-reviews.update');
         Route::delete('all-reviews/{reviews}', [
             ReviewsController::class,
             'destroy',
         ])->name('all-reviews.destroy');

         Route::resource('sliders', SliderController::class);
         Route::get('all-orders', [OrdersController::class, 'index'])->name(
             'all-orders.index'
         );
         Route::post('all-orders', [OrdersController::class, 'store'])->name(
             'all-orders.store'
         );
         Route::get('all-orders/create', [
             OrdersController::class,
             'create',
         ])->name('all-orders.create');
         Route::get('all-orders/{orders}', [
             OrdersController::class,
             'show',
         ])->name('all-orders.show');
         Route::get('all-orders/{orders}/edit', [
             OrdersController::class,
             'edit',
         ])->name('all-orders.edit');
         Route::put('all-orders/{orders}', [
             OrdersController::class,
             'update',
         ])->name('all-orders.update');
         Route::delete('all-orders/{orders}', [
             OrdersController::class,
             'destroy',
         ])->name('all-orders.destroy');


         Route::get('all-banners', [BannersController::class, 'index'])->name(
             'all-banners.index'
         );
         Route::post('all-banners', [BannersController::class, 'store'])->name(
             'all-banners.store'
         );
         Route::get('all-banners/create', [
             BannersController::class,
             'create',
         ])->name('all-banners.create');
         Route::get('all-banners/{banners}', [
             BannersController::class,
             'show',
         ])->name('all-banners.show');
         Route::get('all-banners/{banners}/edit', [
             BannersController::class,
             'edit',
         ])->name('all-banners.edit');
         Route::put('all-banners/{banners}', [
             BannersController::class,
             'update',
         ])->name('all-banners.update');
         Route::delete('all-banners/{banners}', [
             BannersController::class,
             'destroy',
         ])->name('all-banners.destroy');

         Route::get('all-coupons', [CouponsController::class, 'index'])->name(
             'all-coupons.index'
         );
         Route::post('all-coupons', [CouponsController::class, 'store'])->name(
             'all-coupons.store'
         );
         Route::get('all-coupons/create', [
             CouponsController::class,
             'create',
         ])->name('all-coupons.create');
         Route::get('all-coupons/{coupons}', [
             CouponsController::class,
             'show',
         ])->name('all-coupons.show');
         Route::get('all-coupons/{coupons}/edit', [
             CouponsController::class,
             'edit',
         ])->name('all-coupons.edit');
         Route::put('all-coupons/{coupons}', [
             CouponsController::class,
             'update',
         ])->name('all-coupons.update');
         Route::delete('all-coupons/{coupons}', [
             CouponsController::class,
             'destroy',
         ])->name('all-coupons.destroy');

         Route::resource('sliders', SliderController::class);
         Route::resource('brands', BrandController::class);
         Route::resource('works', WorkController::class);
         Route::resource('transactions', TransactionController::class);

         Route::get('all-districts', [
             DistrictsController::class,
             'index',
         ])->name('all-districts.index');
         Route::post('all-districts', [
             DistrictsController::class,
             'store',
         ])->name('all-districts.store');
         Route::get('all-districts/create', [
             DistrictsController::class,
             'create',
         ])->name('all-districts.create');
         Route::get('all-districts/{districts}', [
             DistrictsController::class,
             'show',
         ])->name('all-districts.show');
         Route::get('all-districts/{districts}/edit', [
             DistrictsController::class,
             'edit',
         ])->name('all-districts.edit');
         Route::put('all-districts/{districts}', [
             DistrictsController::class,
             'update',
         ])->name('all-districts.update');
         Route::delete('all-districts/{districts}', [
             DistrictsController::class,
             'destroy',
         ])->name('all-districts.destroy');

         Route::get('all-sub-districts', [
             SubDistrictsController::class,
             'index',
         ])->name('all-sub-districts.index');
         Route::post('all-sub-districts', [
             SubDistrictsController::class,
             'store',
         ])->name('all-sub-districts.store');
         Route::get('all-sub-districts/create', [
             SubDistrictsController::class,
             'create',
         ])->name('all-sub-districts.create');
         Route::get('all-sub-districts/{subDistricts}', [
             SubDistrictsController::class,
             'show',
         ])->name('all-sub-districts.show');
         Route::get('all-sub-districts/{subDistricts}/edit', [
             SubDistrictsController::class,
             'edit',
         ])->name('all-sub-districts.edit');
         Route::put('all-sub-districts/{subDistricts}', [
             SubDistrictsController::class,
             'update',
         ])->name('all-sub-districts.update');
         Route::delete('all-sub-districts/{subDistricts}', [
             SubDistrictsController::class,
             'destroy',
         ])->name('all-sub-districts.destroy');

         // Required pages for sslcommerz
         Route::get('terms-conditions',\App\Http\Livewire\Admin\TermsConditionsComponent::class)->name('admin.terms-conditions');
         Route::get('terms-service',\App\Http\Livewire\Admin\TermsServiceComponent::class)->name('admin.terms-service');
         Route::get('refund-policy',\App\Http\Livewire\Admin\RefundPolicyComponent::class)->name('admin.refund-policy');
         Route::get('privacy-policy',\App\Http\Livewire\Admin\PrivacyPolicyComponent::class)->name('admin.privacy-policy');
         Route::get('about-us',\App\Http\Livewire\Admin\AboutUsComponent::class)->name('admin.about-us');
     });
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
