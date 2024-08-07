<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CaborController;

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