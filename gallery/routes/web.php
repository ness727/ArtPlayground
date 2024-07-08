<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\UnityController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\TicketController;
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
    return view('landing');
});

Route::resource('user', UserController::class);
Route::resource('artwork', ArtworkController::class);

Route::resource('exhibition', ExhibitionController::class);

Route::get('api/artworks', [UnityController::class, 'sendArtworks']);

Route::resource('goods', GoodsController::class);

Route::post('api/chat', [AIController::class, 'generate']);
// 다음 주소 api 예제 경로
Route::get('/address', function () {
    return view('address');
});

// 카카오페이 예제
Route::get('/pay', function () {
    return view('pay.pay');
});

// 회원 기능
Route::get('/register', function () { return view('register'); });
Route::get('/login', function () { return view('login'); });
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dalle', function () { return view('dalle.dalle'); });

// 로그인 인증이 필요한 경로
Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
	// 티켓 구매
	Route::get('/ticketbuy', function () { return view('ticketbuy'); });
    Route::get('/pay/success', [TicketController::class, 'buyConfirm'])->name('buyConfirm');
	
	// 카카오페이 결제 : 성공, 취소, 실패 시 리다이렉트 경로
	Route::get('/pay/cancel', function () { return view('pay.cancel'); });
	Route::get('/pay/fail', function () { return view('pay.fail'); });
    Route::get('/thanks', function () { return view('thanks'); })->name('thanks');

    Route::get('/changeaddress', function () { return view('changeaddress'); })->name('changeaddress');
    Route::get('/changepassword', function () { return view('changepassword'); })->name('changepassword');
    Route::post('/updateaddress', [AuthController::class, 'updateaddress'])->name('updateaddress');
    Route::post('/updatepassword', [AuthController::class, 'updatepassword'])->name('updatepassword');
	
	Route::resource('unity', UnityController::class);
});

// 티켓
Route::get('/ticket', function () { return view('ticket'); });