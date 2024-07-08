@include('top')

<form name="form1" method="post" action="{{ route('goods.store') }}{{ $tmp }}" class="flex flex-col items-center justify-center py-24" enctype="multipart/form-data">
@csrf
	<div class="w-2/3">
		<div class="font-bold text-2xl py-4">굿즈 추가</div>
	</div>
    <table class="bg-white w-2/3">
		<!--
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">Artist_id</th>
			<td class="text-left py-3 px-4">
				<select name="goods_id" class="form-control form-control-sm w-full h-8 bg-gray-100">
					<option value="" selected>선택하세요.</option>
					@foreach ($goods as $goods)
						<option value="{{ $goods->id }}">{{ $goods->name }}</option>
					@endforeach
				</select>
				<font color="red">@error('goods_id') {{ $message }} @enderror</font>
			</td>
		</tr>
		-->
		
		<tr>
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">name</th>
			<td class="text-left py-3 px-4">
				<input name="name" value="{{ old('name') }}" class="h-8 w-full bg-gray-100" />
				<font color="red">@error('name') {{ $message }} @enderror</font>
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
			<th class="bg-gray-800 text-white text-left py-3 px-4 uppercase font-semibold text-sm">price</th>
			<td class="text-left py-3 px-4">
				<input name="price" value="{{ old('price') }}" class="h-8 w-full bg-gray-100" />
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
				<a href="{{ route('goods.index') }}{{ $tmp }}" class="bg-gray-500 hover:bg-gray-800 text-white px-8 py-2 m-2">뒤로가기</a>
			</td>
		</tr>
    </table>
</form>

@include('bottom')