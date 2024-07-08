<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Exhibition;	      // Eloquent ORM


class ExhibitionController extends Controller
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
		
        $data['exhibitions'] = Exhibition::
				   where('title', 'like', '%'. $text1. '%')
				   ->orderby('title', 'asc')
				   ->paginate(6)->appends(['text1' => $text1]);
		
		return view('exhibition.index', $data);	// 자료 표시(view/artwork폴더의 index.blade.php)
    }
	
	/*private function getList() {
		// return Exhibition::leftjoin('')  // 실제로는 조인해서 구현
		return Exhibition::get
	}*/
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
		$row = new Exhibition; 		// exhibition 모델변수 row 선언
		$this->save_row($request, $row);
		
		return redirect('exhibition' . $tmp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id	
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = Exhibition::find($id);                      // Eloquent ORM
		return view('exhibition.show', $data);
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
        $data['exhibition'] = Exhibition::find($id);  // 자료 찾기
		return view('exhibition.edit', $data);  // 수정화면 호출
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
		$row = Exhibition::find($id);
		$this->save_row($request, $row);

		return redirect('exhibition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exhibition::find($id)->delete();
		
		return redirect('exhibition' . $tmp);
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
		$row->exhibition_id = $request->input("exhibition_id");	// 값 입력 
		$row->password = $request->input("password");
		$row->email = $request->input("email");
		$row->phone = $request->input("phone");
		
		$row->save();			// 저장
	}
	
	public function qstring() {
		$text1 = request("text1") ? request('text1') : "";
		$page = request('page') ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
	}
	
}
