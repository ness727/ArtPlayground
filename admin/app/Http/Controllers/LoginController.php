<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function check() {
		$uid = request('user_id');
		$pwd = request('password');
		
		//입력한 아이디, 암호의 직원 정보 조사
		$row = User::where('user_id', '=', $uid)->first();
		$hashed_password = hash('sha256', $pwd);

		if ($row && $hashed_password === $row->password) {
			if ($row->status_id == 99) {
				session()->put('user_id', $row->user_id);  //세션으로 저장
				session()->put('status_id', $row->status_id);
				
				$allSessionData = Session::all();
			}
		}
		
		return view('main');
	}
	
	public function logout() {
		session()->forget('user_id');
		session()->forget('status_id');
		
		$allSessionData = Session::all();
		Log::info('로그아웃 세션 정보:', $allSessionData);
		
		return view('main');
	}
}
