<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'user_id' => 'required|unique:users|string',
            'password' => 'required|string',
            'zipcode' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'required|string',
            'address3' => 'required|string',
        ]);

        // Combine address fields with spaces
        $address = $request->zipcode . ' ' . $request->address1 . ' ' . $request->address2 . ' ' . $request->address3;
		
		$status_id = 2;
	
        $user = User::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'password' => $request->password,
            'address' => $address,
			'status_id' => $status_id,
        ]);

        // Redirect to login page after successful registration
        return redirect('/login')->with(['user' => $user, 'message' => 'User registered successfully']);
    }

    public function login(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'password' => 'required',
    ]);

    // Retrieve the user account from the database
    $account = User::where('user_id', $request->user_id)->first();

    if ($account) {
        // Hash the provided password
        $hashed_password = hash('sha256', $request->password);

        // Check if the hashed password matches the stored password
        if ($hashed_password === $account->password) {
            // Login successful
            $secret = 'your_secret_key';
            $token = JWTAuth::fromUser($account, $secret);

            // Create a standard token cookie
            $cookie = cookie('token', $token, 60, null, null, false, true);

            // Check if the user has status_id 3 and create a premium cookie
            if ($account->status_id == 3) {
                $premium_cookie = cookie('premium', $token, 60, null, null, false, true);
                return redirect('/')->withCookies([$cookie, $premium_cookie]);
            }

            // Redirect with standard token cookie
            return redirect('/')->withCookie($cookie);
        } else {
            // Password mismatch
            return redirect()->back()->withErrors(['error' => '비밀번호가 일치하지 않습니다.']);
        }
    } else {
        // No matching user ID found
        return redirect()->back()->with('customError', '해당 아이디를 찾을 수 없습니다.');


    }
}




    public function logout()
    {
        // Delete the token cookie
        Cookie::queue(Cookie::forget('token'));
		Cookie::queue(Cookie::forget('premium'));

        // 리다이렉트
        return redirect('/');
    }

    public function me()
    {
        $userData = auth()->user();

        return view('mypage')->with('userData', $userData);
    }

    public function updateaddress(Request $request)
    {
        // 현재 인증된 사용자의 정보를 가져옴
        $user = auth()->user();

        // POST 요청으로부터 받은 address 값
        $zipcode = $request->input('zipcode');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $address3 = $request->input('address3');

        $address = $zipcode . ' ' . $address1 . ' ' . $address2 . ' ' . $address3;

        // 사용자의 테이블에 있는 address 컬럼 업데이트
        $user->update(['address' => $address]);
        return redirect('/');
    }

    public function updatepassword(Request $request)
    {
        // 현재 인증된 사용자를 가져옵니다.
        $user = auth()->user();

        $password = $request->input('password'); 
        $newpassword = $request->input('newpassword'); 
        $newpasswordconfirm = $request->input('newpasswordconfirm'); 

        $hashed_password = hash('sha256', $password);

        // user 테이블의 password 컬럼과 $hashed_password이 같고, $newpassword와 $newpasswordconfirm이 일치할 때
        if ($user->password === $hashed_password) {
            if ($newpassword === $newpasswordconfirm) {
                $user->update([
                    'password' => $newpassword,
                ]);
                return redirect('/');
            } else {
                return redirect()->back()->with('error', '새로운 비밀번호와 확인이 일치하지 않습니다.');
            }
        } else {
            return redirect()->back()->with('error', '기존 비밀번호가 일치하지 않습니다.');
        }
        
    }

}
