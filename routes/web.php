<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsMediaController;

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