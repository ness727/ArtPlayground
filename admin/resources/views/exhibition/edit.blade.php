@include('top')

<form name="form1" method="post" action="{{ route('exhibition.update', $exhibition->id) }}{{ $tmp }}" class="flex flex-col items-center justify-center py-4" enctype="multipart/form-data">
@csrf
@method('PUT')
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">전시회 수정</div>
	</div>
    <table class="bg-white w-2/3">
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">title</th>
			<td class="text-left py-3 px-4">
				<input name="title" value="{{ $exhibition->title }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('title') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">img</th>
			<td class="text-left py-3 px-4">
				이전 파일: {{ $exhibition->img }}
				<img src="{{ asset('/storage/exhibition_imgs/' . $exhibition->img) }}" class="w-1/6 h-1/6 py-2" />
				<input name="img" type="file" value="" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('img') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">start_date</th>
			<td class="text-left py-3 px-4">
				<input name="start_date" value="{{ $exhibition->start_date }}" class="h-8 w-full bg-gray-100" />
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">end_date</th>
			<td class="text-left py-3 px-4">
				<input name="end_date" value="{{ $exhibition->end_date }}" class="h-8 w-full bg-gray-100" />
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">description</th>
			<td class="text-left py-3 px-4">
				<textarea name="description"class="p-4 h-40 w-full bg-gray-100">{{ $exhibition->description }}</textarea>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">price</th>
			<td class="text-left py-3 px-4">
				<input name="price" value="{{ $exhibition->price }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('price') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
			<td class="text-center py-3 px-4">
				<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="저장"/>
				<a href="{{ route('exhibition.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')