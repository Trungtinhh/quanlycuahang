<?php

use App\Http\Controllers\StatisticalController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Management\AddProduct;
use App\Http\Livewire\Management\Import;
use App\Http\Livewire\Management\ListHuman;
use App\Http\Livewire\Management\Provider;
use App\Http\Livewire\Management\Storehouse;
use App\Http\Livewire\Management\Category;
use App\Http\Livewire\Management\CreateInvoice;
use App\Http\Livewire\Management\ImportToStoreHouse;
use App\Http\Livewire\Management\Invoice;
use App\Http\Livewire\Management\Promotion;
use App\Http\Livewire\Management\ListCustomer;
use App\Http\Livewire\Management\ListInvoice;
use App\Http\Livewire\Management\ListProduct;
use App\Http\Livewire\Management\Order;
use App\Http\Livewire\Management\Personel;
use App\Http\Livewire\Management\PrintInvoice;
use App\Http\Livewire\Management\Statistical;
use App\Http\Livewire\Management\Wage;
use App\Http\Livewire\Profile\ProfileInfo;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Livewire\User\ConfirmUser;
use App\Http\Livewire\User\GrantPermissionIndex;
use App\Http\Livewire\User\GrantPermission;

use App\Http\Livewire\Role\RoleIndex;
use App\Http\Livewire\Role\CreateRole;
use GuzzleHttp\Handler\Proxy;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', Home::class)->name('dashboard');

//verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Confirm user and grant permission
Route::name('user.')->group(function () {
    Route::prefix('user')->group(function () {

        Route::get('/confirm_user', ConfirmUser::class)->name('confirm_user');

        Route::prefix('grant_permisison')->group(function () {
            Route::get('/', GrantPermissionIndex::class)->name('grant_permission_index');
            Route::get('/{user_id}', GrantPermission::class)->name('grant_permission');
        });

        Route::prefix('role')->group(function () {
            Route::get('/', RoleIndex::class)->name('role_index');
            Route::get('/create_role', CreateRole::class)->name('create_role');
        });
    });
});
//human resource management
Route::name('management.')->group(function () {
    Route::prefix('management')->group(function () {
        Route::get('/wage', Wage::class)->name('wage');
        Route::get('/provider', Provider::class)->name('provider');
        Route::prefix('store_house')->group(function () {
            Route::get('/', Storehouse::class)->name('store_house');
            Route::get('/import_to_store_house', ImportToStoreHouse::class)->name('import_to_store_house');
            Route::get('/import_goods/import', Import::class)->name('import');
        });
        Route::get('/statistical', Statistical::class)->name('statistical');
        Route::get('/invoice', Invoice::class)->name('invoice');
        Route::prefix('product')->group(function () {
            Route::get('/list_product', ListProduct::class)->name('list_product');
            Route::get('/add_product', AddProduct::class)->name('add_product');
            Route::get('/category', Category::class)->name('category');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/create_invoice', CreateInvoice::class)->name('create_invoice');
            Route::get('/print_invoice', PrintInvoice::class)->name('print_invoice');
            Route::get('/list_invoice', ListInvoice::class)->name('list_invoice');
        });
        Route::get('/promotion', Promotion::class)->name('promotion');
        Route::get('/list_customer', ListCustomer::class)->name('list_customer');
        Route::prefix('staff')->group(function () {
            Route::get('/personel', Personel::class)->name('personel');
        });
    });
});
Route::get('/dashboard-filter', [StatisticalController::class, 'dashboard_filter'])->name('dashboard-filter');


//edit profile
Route::get('/user/profile', ProfileInfo::class)->name('profile_info');
