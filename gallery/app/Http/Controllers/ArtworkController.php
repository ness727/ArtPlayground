<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Artwork;	      // Eloquent ORM


class ArtworkController extends Controller
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
		
        $data['artworks'] = Artwork::select('artworks.*', 'artists.name as artist')
                   ->leftJoin('artists', 'artworks.artist_id', '=', 'artists.id')
				   ->where('title', 'like', '%'. $text1. '%')
				   ->orderby('title', 'asc')
				   ->paginate(6)->appends(['text1' => $text1]);
		
		return view('artwork.index', $data);	// 자료 표시(view/artwork폴더의 index.blade.php)
    }
	
	/*private function getList() {
		// return Artwork::leftjoin('')  // 실제로는 조인해서 구현
		return Artwork::get
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
		$row = new Artwork; 		// artwork 모델변수 row 선언
		$this->save_row($request, $row);
		
		return redirect('artwork' . $tmp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id	
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['row'] = Artwork::find($id);                      // Eloquent ORM
		return view('artwork.show', $data);
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
        $data['artwork'] = Artwork::find($id);  // 자료 찾기
		return view('artwork.edit', $data);  // 수정화면 호출
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
		$row = Artwork::find($id);
		$this->save_row($request, $row);

		return redirect('artwork');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artwork::find($id)->delete();
		
		return redirect('artwork' . $tmp);
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
		$row->artwork_id = $request->input("artwork_id");	// 값 입력 
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
