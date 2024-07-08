<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Exhibition;	      // Eloquent ORM
use Image;

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
        $data['exhibitions'] = $this->getlist($text1);		// 자료 읽기
		
		return view('exhibition.index', $data);	// 자료 표시(view/exhibition폴더의 index.blade.php)
    }
	
	public function getlist($text1)
	{

		$result = Exhibition::where('title', 'like', '%'. $text1. '%')
			->orderby('title','asc')->paginate(5)->appends(['text1' => $text1]);
		
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
        return view('exhibition.create', $data);
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
		
		$tmp = $this->qstring();
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
		$data['tmp'] = $this->qstring();
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
		$data['tmp'] = $this->qstring();
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
		
		$tmp = $this->qstring();
		return redirect('exhibition' . $tmp);
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
		
		$tmp = $this->qstring();
		return redirect('exhibition' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		$request->validate([
			'title' => 'required',
			'img' => 'required',
			'price' => 'required',
		],
		[
			'title.required' => '제목은 필수입력입니다.',
			'img.required' => '그림은 필수입력입니다.',
			'price.required'  => '가격은 필수입력입니다.',
		]);
		
		
		$row->title = $request->input("title");
		$row->start_date = $request->input("start_date");
		$row->end_date = $request->input("end_date");
		$row->description = $request->input("description");
		$row->price = $request->input("price");
		
		if ($request->hasFile('img'))	         // upload할 파일이 있는 경우
		{
			$pic = $request->file('img');
			$pic_name = $pic->getClientOriginalName();             // 파일이름
			$pic->storeAs('public/exhibition_imgs/', $pic_name);        // 파일저장
			
			$img = Image::make($pic)
					->resize(null, 200, function($constraint) { $constraint->aspectRatio(); })
					->save('storage/exhibition_imgs/thumb/' . $pic_name);
			
			$row->img = $pic_name;
		}
		
		$row->save();			// 저장
	}
	
	public function qstring() {
		$text1 = request("text1") ? request('text1') : "";
		$page = request('page') ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
	}
}
