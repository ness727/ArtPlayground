<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\User;
use App\Models\Status;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');
		$data['text1'] = $text1;
        $data['users'] = $this->getlist($text1);		// 자료 읽기
		
		return view('user.index', $data);	// 자료 표시(view/user폴더의 index.blade.php)
    }
	
	public function getlist($text1)
	{
		$result = User::where('users.name', 'like', '%'. $text1. '%')
			->select('users.*', 'statuses.name as status')
            ->leftJoin('statuses', 'users.status_id', '=', 'statuses.id')
            ->orderBy('users.name','asc')
            ->paginate(5)
            ->appends(['text1' => $text1]);
		
		return $result;
	}

	public function get_status()
	{
		$result=Status::orderby('id')->get();
		return $result;
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['tmp'] = $this->qstring();
		$data['statuses'] = $this->get_status();
		
        return view('user.create', $data);
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
		
		$tmp = $this->qstring();
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
		$data['tmp'] = $this->qstring();
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
		$data['tmp'] = $this->qstring();
        $data['user'] = User::find($id);  // 자료 찾기
		$data['statuses'] = $this->get_status();
		
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
		
		$tmp = $this->qstring();
		return redirect('user' . $tmp);
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
		
		$tmp = $this->qstring();
		return redirect('user' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		$request->validate([
			'user_id' => 'required|max:20',
			'password' => 'required',
			'name' => 'required|max:20',
			'status_id' => 'required',
		],
		[
			'user_id.required'  => '아이디는 필수입력입니다.',
			'password.required' => '암호는 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'status_id.required' => '상태는 필수입력입니다.',
			'user_id.max'  => '20자 이내입니다.',
			'name.max' => '20자 이내입니다.',
		]);
		
		
		$row->user_id = $request->input("user_id");	// 값 입력 
		$row->password = $request->input("password");
		$row->name = $request->input("name");
		$row->address = $request->input("address");
		$row->status_id = $request->input("status_id");
		
		$row->save();			// 저장
	}
	
	public function qstring() {
		$text1 = request("text1") ? request('text1') : "";
		$page = request('page') ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
	}
}
