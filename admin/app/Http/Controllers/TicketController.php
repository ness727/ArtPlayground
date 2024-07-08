<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Ticket;	      // Eloquent ORM
use App\Models\User;

class TicketController extends Controller
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
        $data['tickets'] = $this->getlist($text1);		// 자료 읽기
		
		return view('ticket.index', $data);	// 자료 표시(view/ticket폴더의 index.blade.php)
    }
	
	public function getlist($text1)
	{
		$result = Ticket::where('tickets.user_id', 'like', '%'. $text1. '%')
			->select('tickets.*', 'users.name as user_name')
            ->leftJoin('users', 'tickets.user_id', '=', 'users.id')
            ->orderby('tickets.created_at','desc')
            ->paginate(5)
            ->appends(['text1' => $text1]);
		
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
        return view('ticket.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$row = new Ticket; 		// ticket 모델변수 row 선언
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('ticket' . $tmp);
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
        $data['row'] = Ticket::find($id);                      // Eloquent ORM
		return view('ticket.show', $data);
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
        $data['ticket'] = Ticket::find($id);  // 자료 찾기
		return view('ticket.edit', $data);  // 수정화면 호출
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
		$row = Ticket::find($id);
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('ticket' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::find($id)->delete();
		
		$tmp = $this->qstring();
		return redirect('ticket' . $tmp);
    }
	
	public function save_row(Request $request, $row) {
		$request->validate([
			'user_id' => 'required|numeric',
		],
		[
			'user_id.required' => '유저 ID는 필수입력입니다.',
			'user_id.numeric' => '숫자로 입력해주세요.',
		]);
		
		$row->user_id = $request->input("user_id");
		
		$row->save();			// 저장
	}
	
	public function qstring() {
		$text1 = request("text1") ? request('text1') : "";
		$page = request('page') ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
	}
}
