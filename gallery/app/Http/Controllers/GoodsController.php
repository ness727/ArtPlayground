<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Goods;	      // Eloquent ORM
use Image;

class GoodsController extends Controller
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
        $data['goods'] = $this->getlist($text1);		// 자료 읽기
		
		return view('goods.index', $data);	// 자료 표시(view/artwork폴더의 index.blade.php)
    }
	
	public function getlist($text1)
	{
		 $result = Goods::where('name', 'like', '%' . $text1 . '%')->orderby('name','asc')->paginate(5);   
		
		return $result;
	}

	public function get_goods()
	{
		$result=Goods::orderby('name')->get();
		return $result;
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
		$row = new Goods; 		// goods 모델변수 row 선언
		$this->save_row($request, $row);
		
	
		return redirect('goods' . $tmp);
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
        $data['row'] = Goods::find($id);                      // Eloquent ORM
		return view('goods.show', $data);
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
        $data['goods'] = Goods::find($id);  // 자료 찾기
		
		return view('goods.edit', $data);  // 수정화면 호출
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
		$row = Goods::find($id);
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('goods' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Goods::find($id)->delete();
		
		$tmp = $this->qstring();
		return redirect('goods' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		$request->validate([
			'price' => 'required',
			'name' => 'required',
		],
		[
			'price.required'  => '값은 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
		]);
		
		$row->name = $request->input("name");
		$row->price = $request->input("price");
		$row->description = $request->input("description");
		
		if ($request->hasFile('img'))	         // upload할 파일이 있는 경우
		{
			$pic = $request->file('img');
			$pic_name = $pic->getClientOriginalName();             // 파일이름
			$pic->storeAs('public/goods_imgs/', $pic_name);        // 파일저장
			
			$img = Image::make($pic)
					->resize(null, 200, function($constraint) { $constraint->aspectRatio(); })
					->save('storage/goods_imgs/thumb/' . $pic_name);
			
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
