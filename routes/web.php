<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CaborController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'dashboard']);
Route::get('/', [LandingController::class, 'index'])->name('landing'); 


Route::group(['prefix' => 'news', 'controller' => NewsController::class], function () {
    Route::get('/', 'index')->name('news.index');
    Route::post('/list', 'list')->name('news.list');
    Route::get('/create', 'create')->name('news.create');
    Route::post('/', 'store')->name('news.store');
    Route::get('/{id}', 'show')->name('news.show');
    Route::get('/{id}/edit', 'edit')->name('news.edit');
    Route::put('/{id}', 'update')->name('news.update');
    Route::delete('/delete/{id}', 'destroy')->name('news.destroy');
    Route::delete('/delete/media/{id}', 'destroyMedia')->name('news_media.destroy');
});

Route::group(['prefix' => 'user', 'controller' => UserController::class], function () {
    Route::get('/', 'index')->name('user.index');
    Route::post('/list', 'list')->name('user.list');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/', 'store')->name('user.store');
    Route::get('/{id}', 'show')->name('user.show');
    Route::get('/{id}/edit', 'edit')->name('user.edit');
    Route::put('/{id}', 'update')->name('user.update');
    Route::delete('/delete/{id}', 'destroy')->name('user.destroy');
    Route::delete('/edit/{id}', 'destroy')->name('user.destroy-avatar');
    Route::delete('/delete/media/{id}', 'destroyMedia')->name('news_media.destroy');
});

Route::group(['prefix' => 'level', 'controller' => LevelController::class], function () {
    Route::get('/', 'index')->name('level.index');
    Route::post('/list', 'list')->name('level.list');
    Route::get('/create', 'create')->name('level.create');
    Route::post('/', 'store')->name('level.store');
    Route::get('/{id}', 'show')->name('level.show');
    Route::get('/{id}/edit', 'edit')->name('level.edit');
    Route::put('/{id}', 'update')->name('level.update');
    Route::delete('/delete/{id}', 'destroy')->name('level.destroy');
});

Route::group(['prefix' => 'cabor', 'controller' => CaborController::class], function () {
    Route::get('/', 'index')->name('cabor.index');
    Route::post('/list', 'list')->name('cabor.list');
    Route::get('/create', 'create')->name('cabor.create');
    Route::post('/', 'store')->name('cabor.store');
    Route::get('/{id}', 'show')->name('cabor.show');
    Route::get('/{id}/edit', 'edit')->name('cabor.edit');
    Route::put('/{id}', 'update')->name('cabor.update');
    Route::delete('/delete/{id}', 'destroy')->name('cabor.destroy');
});

Route::group(['prefix' => 'atlet', 'controller' => AtletController::class], function () {
    Route::get('/', 'index')->name('atlet.index');
    Route::post('/list', 'list')->name('atlet.list');
    Route::get('/create', 'create')->name('atlet.create');
    Route::post('/', 'store')->name('atlet.store');
    Route::get('/{id}', 'show')->name('atlet.show');
    Route::get('/{id}/edit', 'edit')->name('atlet.edit');
    Route::put('/{id}', 'update')->name('atlet.update');
    Route::delete('/delete/{id}', 'destroy')->name('atlet.destroy');
});

Route::get('/', [LandingController::class, 'index'])->name('landing.index');


// Landing Pages
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/events', [LandingController::class, 'events'])->name('events');
Route::get('/events/{id}', [LandingController::class, 'event'])->name('event.show'); 
Route::get('/news', [LandingController::class, 'news'])->name('news');
Route::get('/news/{id}', [LandingController::class, 'news'])->name('news.show');
Route::get('/cabor/{kode}', [LandingController::class, 'cabor'])->name('cabor.show');

// Auth Routes
Route::middleware(['auth'])->group(function () {
    // Event Booking
    Route::get('/booking/{category}', [BookingController::class, 'create'])->name('ticket.book');
    Route::post('/booking', [BookingController::class, 'store'])->name('ticket.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/{booking}/payment', [BookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/{booking}/pay', [BookingController::class, 'processPayment'])->name('booking.process-payment');

});
