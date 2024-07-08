@include('top')

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script>
	function find_text() {
		form1.action = "{{ route('ticket.index') }}";
		form1.submit();
	}
</script>

<div class="w-full overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-12">
	<div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-black">티켓 관리</h1>
		<form name="form1" method="get" action="" class="flex items-center">
			<div>
			  <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
				유저 ID
			  </label>
			</div>
			<div class="">
			  <input name="text1" class="bg-gray-200 appearance-none border-1 border-gray-200 w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{ $text1 }}" onKeydown="if (event.keyCode == 13) { find_text(); }">
			</div>
			<button class="bg-gray-200 hover:bg-gray-700 text-black hover:text-white leading-tight font-bold py-2 px-4" type="button" onClick="find_text();">검색</button>
		</form>	
	</div>
        <div class="mt-4">
			<div class="flex justify-end">
				<a class="my-4 bg-transparent leading-tight hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent" href="{{ route('ticket.create') }}">추가</a>
			</div>
			
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
							<th class="text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">User Id</th>
							<th class="text-left py-3 px-4 uppercase font-semibold text-sm">User Name</th>
							<th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
						@foreach ($tickets as $ticket)
							<tr>
								<td class="text-left py-3 px-4">{{ $ticket->id }}</td>
								<td class="text-left py-3 px-4">{{ $ticket->user_id }}</td>
								<td class="text-left py-3 px-4">{{ $ticket->user_name }}</td>
								<td class="py-3 flex justify-center">
									<form id="deleteForm" action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
										@csrf
										@method('DELETE')
										<input type="submit" class="bg-white font-bold hover:text-red-800 px-4 text-red-500 cursor-pointer"
												onClick="confirm('삭제할까요?')" value="삭제" />
									</form>
								</td>
								<!-- <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
								<td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
								-->
							</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
		
		<div class="m-4 flex justify-center">
			{{ $tickets->appends(['text1' => $text1])->links('mypagination') }}
		</div>
    </main>
</div>

@include('bottom')