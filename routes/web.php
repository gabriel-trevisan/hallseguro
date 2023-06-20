<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ConsentLGPD\ConsentLGPDController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\EntranceInspection\EntranceInspectionController;
use App\Http\Controllers\ShorterURL\ShorterURLController;
use App\Http\Controllers\Consult\EntranceInspectionController as Consult;

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

// ======== MAIN ======== //

Route::get('/', function(){
    return redirect('/login');      
})->name('main');

// ======== DASHBOARD ======== //

Route::group(['prefix' => 'dashboard'], function(){
    Route::get('/', [
        DashboardController::class, 'index'   
    ])->middleware(['auth'])->name('dashboard');
});

// ======== USUÁRIOS ======== //

Route::group(['prefix' => 'users'], function(){
    Route::get('/', [
        RegisteredUserController::class, 'index'
    ])->middleware(['auth', 'admin'])->name('users.index');

    Route::get('/create', [
        RegisteredUserController::class, 'create'
    ])->middleware(['auth', 'admin'])->name('users.create');

    Route::post('/create', [
        RegisteredUserController::class, 'store'
    ])->middleware(['auth', 'admin']);

    Route::get('/{id}/edit', [
        RegisteredUserController::class, 'edit'
    ])->middleware(['auth', 'admin'])->name('users.edit');

    Route::put('/{id}/update', [
        RegisteredUserController::class, 'update'
    ])->middleware(['auth', 'admin'])->name('users.update');

    Route::delete('/{id}/destroy', [
        RegisteredUserController::class, 'destroy'
    ])->middleware(['auth', 'admin'])->name('users.destroy');
});

// ======== PORTARIA ======== //

Route::group(['prefix' => 'lobby'], function(){
    Route::get('/inspection', [
        EntranceInspectionController::class, 'index'
    ])->middleware(['auth'])->name('lobby.index');
    
    Route::post('/inspection/result', [
        EntranceInspectionController::class, 'info'
    ])->middleware(['auth'])->name('lobby.info');
});

// ======== CONFIGURAÇÃO ======== //

Route::group(['prefix' => 'config'], function(){
    Route::get('/consentlgpd', [
        ConsentLGPDController::class, 'index'
    ])->middleware(['auth'])->name('consentlgpd.index');

    Route::get('/consentlgpd/create', [
        ConsentLGPDController::class, 'create'
    ])->middleware(['auth'])->name('consentlgpd.create');

    Route::post('/consentlgpd/create', [
        ConsentLGPDController::class, 'store'
    ])->middleware(['auth']);
});

// ======== CLIENTES ======== //

Route::group(['prefix' => 'customers'], function(){
    Route::get('/', [
        CustomerController::class, 'index'
    ])->middleware(['auth', 'admin'])->name('customers.index');

    Route::get('/{id}/info', [
        CustomerController::class, 'method'
    ])->middleware(['auth'])->name('customers.method');
    
    Route::get('/create', [
        CustomerController::class, 'create'
    ])->middleware(['auth'])->name('customers.create');
    
    Route::post('/create', [
        CustomerController::class, 'store'
    ])->middleware(['auth']);

    Route::get('/{id}/edit', [
        CustomerController::class, 'edit'
    ])->middleware(['auth', 'admin'])->name('customers.edit');

    Route::put('/{id}/update', [
        CustomerController::class, 'update'
    ])->middleware(['auth', 'admin'])->name('customers.update');

    Route::delete('/{id}/destroy', [
        CustomerController::class, 'destroy'
    ])->middleware(['auth', 'admin'])->name('customers.destroy');
});

// Public route to show image profile customer
Route::get('storage/{companyID}/{customerID}/{image}', [
    CustomerController::class, 'showImageProfile'
])->middleware(['auth'])->name('customers.profile.image');

// ======== DOCUMENTOS PUBLICOS ======== //

Route::group(['prefix' => 'public'], function(){
    Route::get('document/consentlgpd', [
        ConsentLGPDController::class, 'showDocumentPublic'
    ])->name('publicconsentlgpd.index');

    Route::get('document/{documentID}/accept/{customerID}', [
        ConsentLGPDController::class, 'showDocumentCustomer'
    ])->name('publicconsentlgpd.accept');

    Route::post('document/{documentID}/accept/{customerID}', [
        ConsentLGPDController::class, 'accept'
    ]);
});

// ======== SHORT URL ======== //

Route::get('s/{id}', [
    ShorterURLController::class, 'index'
]);

// ======== PORTARIA ======== //

Route::group(['prefix' => 'consult'], function(){
    Route::get('/inspection', [
        Consult::class, 'index'
    ])->middleware(['auth', 'admin'])->name('consult.index');
    
    Route::get('/inspection/result', [
        Consult::class, 'info'
    ])->middleware(['auth', 'admin'])->name('consult.info');
});

// ======== SCHEDULE ======== //

Route::get('schedule', function() {
    $exitCode = Artisan::call('queue:work --stop-when-empty', []);
    
    echo $exitCode;
});

require __DIR__ . '/auth.php';
