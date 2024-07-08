@include('top')

<form name="form1" method="post" action="{{ route('artwork.store') }}{{ $tmp }}" class="flex flex-col items-center justify-center py-24" enctype="multipart/form-data">
@csrf
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">그림 추가</div>
	</div>
    <table class="bg-white w-2/3">
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Artist_id</th>
			<td class="text-left py-3 px-4">
				<select name="artist_id" class="form-control form-control-sm w-full h-8 bg-gray-100">
					<option value="" selected>선택하세요.</option>
					@foreach ($artists as $artist)
						<option value="{{ $artist->id }}">{{ $artist->name }}</option>
					@endforeach
				</select>
				<font color="red">@error('artist_id') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">title</th>
			<td class="text-left py-3 px-4">
				<input name="title" value="{{ old('title') }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('title') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">img</th>
			<td class="text-left py-3 px-4">
				<input name="img" type="file" value="{{ old('img') }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('img') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">year</th>
			<td class="text-left py-3 px-4">
				<input name="year" value="{{ old('year') }}" class="h-8 w-full bg-gray-100" />
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">description</th>
			<td class="text-left py-3 px-4">
				<textarea name="description"class="p-4 h-40 w-full bg-gray-100">{{ old('description') }}</textarea>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
			<td class="text-center py-3 px-4">
				<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="저장"/>
				<a href="{{ route('artwork.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')