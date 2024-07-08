<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class TicketController extends Controller
{
    public function buyConfirm(Request $request)
    {
        // 사용자 정보 가져오기
        $user = Auth::user();

        // 사용자 ID를 변수에 저장
        $user_id = $user->id;

        // 기타 필요한 로직 수행...

        // 데이터베이스에 insert
        Ticket::create([
            'user_id' => $user_id,
            // 다른 필드들도 추가할 수 있음
        ]);
		
		// 유저의 상태를 프리미엄(4) - 티켓 구매 상태로 변경
		User::where('id', $user_id)
		->update(['status_id' => 3]);
		
		$secret = 'your_secret_key';
        $token = JWTAuth::fromUser($user, $secret);

        // Create a standard token cookie
         $cookie = cookie('token', $token, 60, null, null, false, true);
		$premium_cookie = cookie('premium', $token, 60, null, null, false, true);
		
        //return view('pay.success');
        return redirect()->route('thanks')->withCookies([$cookie, $premium_cookie]);;
    }
}
