@include('top')


<form name="form1" method="post" action="{{ route('ticket.store') }}{{ $tmp }}" class="flex flex-col items-center justify-center py-24">
@csrf
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">티켓 추가</div>
	</div>
    <table class="bg-white w-2/3">
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">User_id</th>
			<td class="text-left py-3 px-4">
				<input name="user_id" value="{{ old('user_id') }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('user_id') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
			<td class="text-center py-3 px-4">
				<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="저장"/>
				<a href="{{ route('ticket.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')