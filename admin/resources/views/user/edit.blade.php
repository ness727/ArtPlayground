@include('top')


<form name="form1" method="post" action="{{ route('user.update', $user->id) }}{{ $tmp }}" class="flex flex-col items-center justify-center py-24">
@csrf
@method('PUT')
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">사용자 수정</div>
	</div>
    <table class="bg-white w-2/3">
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
			<td class="text-left py-3 px-4">
				{{ $user->user_id }}
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">User_id</th>
			<td class="text-left py-3 px-4">
				<input name="user_id" value="{{ $user->user_id }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('user_id') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Password</th>
			<td class="text-left py-3 px-4">
				<input name="password" value="{{ $user->password }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('password') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
			<td class="text-left py-3 px-4">
				<input name="name" value="{{ $user->name }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('name') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">address</th>
			<td class="text-left py-3 px-4">
				<input name="address" value="{{ $user->address }}" class="h-8 w-full bg-gray-100" />
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">status</th>
			<td class="text-left py-3 px-4">
				<select name="status_id" class="form-control form-control-sm w-full h-8 bg-gray-100">
					<option value="">선택하세요.</option>
					@foreach ($statuses as $status)
						@if ($user->status_id == $status->id)
							<option value="{{ $status->id }}" selected>{{ $status->name }}</option>
						@else
							<option value="{{ $status->id }}">{{ $status->name }}</option>
						@endif
					@endforeach
				</select>
				<font color="red">@error('status') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
			<td class="text-center py-3 px-4">
				<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="저장"/>
				<a href="{{ route('user.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')