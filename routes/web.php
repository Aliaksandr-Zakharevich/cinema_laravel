<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/session/{session}', [SessionController::class, 'seance'])->name('seance');

Route::group(['prefix' => '/movies', 'controller' => MovieController::class], function () {
    Route::get('/', 'afisha')->name('movies.afisha');
    Route::get('/{movie}', 'movie')->name('movies.show');
});

Route::group(['controller' => AuthController::class], function () {
    Route::get('/login', 'getLoginPage')->name('auth.loginPage');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/register', 'getRegisterPage')->name('auth.registerPage');
    Route::post('/register', 'register')->name('auth.register');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::group(['prefix' => '/account', 'controller' => AccountController::class, 'middleware' => 'auth'], function () {
    Route::get('/', 'account')->name('account.show');
    Route::post('/', 'updateAccount')->name('account.update');
    Route::post('/changePassword', 'changePassword')->name('account.changePassword');
});

Route::group(['prefix' => '/admin', 'middleware' => ['admin', 'verified'], 'as' => 'admin.'], function () {
    Route::group(['prefix' => '/movies', 'as' => 'movies.', 'controller' => \App\Http\Controllers\Admin\MovieController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'createView')->name('create.view');
        Route::post('/create', 'create')->name('create');
        Route::get('/update/{movie}', 'edit')->name('update.view');
        Route::post('/update/{movie}', 'update')->name('update');
        Route::get('/delete/{movie}', 'destroy')->name('delete');
    });
    Route::group(['prefix' => '/halls', 'as' => 'halls.', 'controller' => \App\Http\Controllers\Admin\HallController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'createView')->name('create.view');
        Route::post('/create', 'create')->name('create');
        Route::get('/update/{hall}', 'edit')->name('update.view');
        Route::get('/update/{hall}/seats', 'editSeats')->name('update.seats.view');
        Route::post('/update/{hall}', 'update')->name('update');
        Route::get('/delete/{hall}', 'destroy')->name('delete');
    });
    Route::group(['prefix' => '/seances', 'as' => 'seances.', 'controller' => \App\Http\Controllers\Admin\SeanceController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'createView')->name('create.view');
        Route::post('/create', 'create')->name('create');
        Route::get('/update/{seance}', 'edit')->name('update.view');
        Route::post('/update/{seance}', 'update')->name('update');
        Route::get('/delete/{seance}', 'destroy')->name('delete');
    });
    Route::group(['prefix' => '/seat', 'as' => 'seat.', 'controller' => SeatController::class], function () {
        Route::post('/{seat}/add', 'add')->name('add');
        Route::post('/update', 'update')->name('update');
        Route::post('/remove', 'remove')->name('remove');
    });
    Route::group(['prefix' => '/types', 'as' => 'types.', 'controller' => \App\Http\Controllers\Admin\SeatTypeController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'createView')->name('create.view');
        Route::post('/create', 'create')->name('create');
        Route::get('/update/{type}', 'edit')->name('update.view');
        Route::post('/update/{type}', 'update')->name('update');
        Route::get('/delete/{type}', 'destroy')->name('delete');
    });
});

Route::group(['prefix' => '/cart', 'controller' => CartController::class], function () {
    Route::get('/{session}', 'getCart')->name('cart.get');
    Route::post('/{seat}/add', 'add')->name('cart.add');
    Route::post('/{seat}/remove', 'remove')->name('cart.remove');
});

Route::group(['prefix' => '/tickets', 'middleware' => 'auth'], function () {
    Route::get('/', [TicketController::class, 'allTickets'])->name('tickets.all');
    Route::post('/{seance}/create', [TicketController::class, 'createTicket'])->name('tickets.create');
    Route::get('/{ticket}/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/{hash}', [PaymentController::class, 'callback'])->name('payment.callback');
});


