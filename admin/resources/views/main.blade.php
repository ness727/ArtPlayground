@include('top')

@if (!session()->exists('user_id'))
    <form name="form1" method="post" action="{{ url('login/check') }}" class="flex flex-col items-center justify-center py-24">
	@csrf
		<div class="w-2/3">
			<div class="font-bold text-2xl py-4">관리자 페이지</div>
		</div>
		<table class="bg-white w-2/3">
			<tr>
				<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
				<td class="text-left py-3 px-4">
					<input name="user_id" value="{{ old('user_id') }}" class="h-8 w-full bg-gray-100" />
				</td>
			</tr>
			<tr>
				<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">PASSWORD</th>
				<td class="text-left py-3 px-4">
					<input name="password" type="password" value="{{ old('password') }}" class="h-8 w-full bg-gray-100" />
				</td>
			</tr>
			<tr>
				<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
				<td class="text-center py-3 px-4">
					<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="로그인"/>
				</td>
			</tr>
		</table>
	</form>
@else
	<div class="flex justify-center w-full mt-24 font-bold text-4xl">
		환영합니다!
	</div>
@endif
	
@include('bottom')