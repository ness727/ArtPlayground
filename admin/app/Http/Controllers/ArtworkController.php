<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Artwork;	      // Eloquent ORM
use App\Models\Artist;
use Image;

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
        $data['artworks'] = $this->getlist($text1);		// 자료 읽기
		
		return view('artwork.index', $data);	// 자료 표시(view/artwork폴더의 index.blade.php)
    }
	
	public function getlist($text1)
	{
		$result = Artwork::where('title', 'like', '%'. $text1. '%')
			->select('artworks.*', 'artists.name as artist')
            ->leftJoin('artists', 'artworks.artist_id', '=', 'artists.id')
            ->orderBy('title','asc')
            ->paginate(5)
            ->appends(['text1' => $text1]);
		
		return $result;
	}

	public function get_artists()
	{
		$result=Artist::orderby('name')->get();
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
		$data['artists'] = $this->get_artists();
		
        return view('artwork.create', $data);
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
		
		$tmp = $this->qstring();
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
		$data['tmp'] = $this->qstring();
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
		$data['tmp'] = $this->qstring();
        $data['artwork'] = Artwork::find($id);  // 자료 찾기
		$data['artists'] = $this->get_artists();
		
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
		
		$tmp = $this->qstring();
		return redirect('artwork' . $tmp);
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
		
		$tmp = $this->qstring();
		return redirect('artwork' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		$request->validate([
			'artist_id' => 'required',
			'title' => 'required',
		],
		[
			'artist_id.required'  => '화가는 필수입력입니다.',
			'title.required' => '제목은 필수입력입니다.',
		]);
		
		
		$row->artist_id = $request->input("artist_id");	// 값 입력 
		$row->title = $request->input("title");
		$row->year = $request->input("year");
		$row->description = $request->input("description");
		
		if ($request->hasFile('img'))	         // upload할 파일이 있는 경우
		{
			$pic = $request->file('img');
			$pic_name = $pic->getClientOriginalName();             // 파일이름
			$pic->storeAs('public/artwork_imgs/', $pic_name);        // 파일저장
			
			$img = Image::make($pic)
					->resize(null, 200, function($constraint) { $constraint->aspectRatio(); })
					->save('storage/artwork_imgs/thumb/' . $pic_name);
			
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
