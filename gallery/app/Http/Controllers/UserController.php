<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\User;	      // Eloquent ORM


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::find(1);		// 자료 읽기
		
		return view('user.index', $data);	// 자료 표시(view/user폴더의 index.blade.php)
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$row = new User; 		// user 모델변수 row 선언
		$this->save_row($request, $row);
		
		return redirect('user' . $tmp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id	
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = User::find($id);                      // Eloquent ORM
		return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//$data['tmp'] = $this->qstring();
        $data['user'] = User::find($id);  // 자료 찾기
		return view('user.edit', $data);  // 수정화면 호출
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$row = User::find($id);
		$this->save_row($request, $row);

		return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
		
		return redirect('user' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		/*$request->validate([
			'uid' => 'required|max:20',
			'pwd' => 'required|max:20',
			'name' => 'required|max:20',
		],
		[
			'uid.required'  => '아이디는 필수입력입니다.',
			'pwd.required' => '암호는 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'uid.max'  => '20자 이내입니다.',
			'pwd.max' => '20자 이내입니다.',
			'name.max' => '20자 이내입니다.',
		]);*/
		
		/*$tel1= $request->input("tel1");
		$tel2= $request->input("tel2");
		$tel3= $request->input("tel3");
		$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);	// 전화번호 합치기
		*/
		
		$row->name = $request->input("name");
		$row->user_id = $request->input("user_id");	// 값 입력 
		$row->password = $request->input("password");
		$row->email = $request->input("email");
		$row->phone = $request->input("phone");
		
		$row->save();			// 저장
	}
	
}
