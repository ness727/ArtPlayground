<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\GoodsController;
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
    return view('main');
});

Route::resource('user', UserController::class);
Route::resource('artwork', ArtworkController::class);
Route::resource('artist', ArtistController::class);
Route::resource('exhibition', ExhibitionController::class);
Route::resource('ticket', TicketController::class);
Route::resource('status', StatusController::class);
Route::post('login/check', [LoginController::class, 'check']);
Route::get('login/logout', [LoginController::class, 'logout']);

Route::resource('goods', GoodsController::class);