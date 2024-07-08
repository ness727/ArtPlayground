@include('top')

<form name="form1" method="post" action="{{ route('goods.update', $goods->id) }}{{ $tmp }}" class="flex flex-col items-center justify-center py-4" enctype="multipart/form-data">
@csrf
@method('PUT')
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">굿즈 수정</div>
	</div>
    <table class="bg-white w-2/3">
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
			<td class="text-left py-3 px-4">
				{{ $goods->id }}
			</td>
		</tr>
		
		<!--
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Artist_id</th>
			<td class="text-left py-3 px-4">
				<select name="artist_id" class="form-control form-control-sm w-full h-8 bg-gray-100">
					<option value="">선택하세요.</option>
					@foreach ($artists as $artist)
						@if ($goods->artist_id == $artist->id)
							<option value="{{ $artist->id }}" selected>{{ $artist->name }}</option>
						@else
							<option value="{{ $artist->id }}">{{ $artist->name }}</option>
						@endif
					@endforeach
				</select>
				<font color="red">@error('artist_id') {{ $message }} @enderror</font>
			</td>
		</tr> 
		-->
		
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">name</th>
			<td class="text-left py-3 px-4">
				<input name="name" value="{{ $goods->name }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('name') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">img</th>
			<td class="text-left py-3 px-4">
				이전 파일: {{ $goods->img }}
				<img src="{{ asset('/storage/goods_imgs/' . $goods->img) }}" class="w-1/6 h-1/6 py-2" />
				<input name="img" type="file" value="" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('img') {{ $message }} @enderror</font>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">price</th>
			<td class="text-left py-3 px-4">
				<input name="price" value="{{ $goods->price }}" class="h-8 w-full bg-gray-100" />
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">description</th>
			<td class="text-left py-3 px-4">
				<textarea name="description"class="p-4 h-40 w-full bg-gray-100">{{ $goods->description }}</textarea>
			</td>
		</tr>
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm"></th>
			<td class="text-center py-3 px-4">
				<input type="submit" class="bg-blue-500 hover:bg-blue-800 text-white px-12 py-2 m-2 leading-tight cursor-pointer" value="저장"/>
				<a href="{{ route('goods.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')