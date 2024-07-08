<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ArtPlayground🏛</title>
	
	<link rel="shortcut icon" href="" type="image/x-icon" />
	<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
	<script src="https://cdn.tailwindcss.com"></script>
	<!-- ==== WOW JS ==== -->
	<script src="{{ asset('js/wow.min.js') }}"></script>
	
	<script>
    (function() {
        var style = document.documentElement.style;
        style.lineHeight = '1.5';
        style.webkitTextSizeAdjust = '100%';
        style.MozTabSize = '4';
        style.OtabSize = '4';
        style.tabSize = '4';
        style.fontFamily = 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"';
        style.fontFeatureSettings = 'normal';
        style.fontVariationSettings = 'normal';
    })();
</script>

	<script>
		new WOW().init();
	</script>
	
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	
	
	<script>
		function find_text() {
			form1.action = "{{ route('artwork.index') }}";
			form1.submit();
		}
		
		function showModalAndSetImage(img, title, description) {
			var imgElement = document.querySelector("#myModal img");
			imgElement.src = img;
			
			var titleElement = document.querySelector("#myModal #title");
			titleElement.innerText = title;

			var descriptionElement = document.querySelector("#myModal #description");
			descriptionElement.innerText = description;			
			
			document.getElementById('myModal').showModal();
		}
		
		function showGptModalAndSetImage(img, title, artist) {
			var imgElement = document.querySelector("#gptModal img");
			imgElement.src = img;
			
			var titleElement = document.querySelector("#gptModal #bt1");
			titleElement.value = artist + "의 그림 \"" + title + "\"에 대해서 그림의 설명만 간단히 해줘";
			titleElement.innerText = artist + "의 그림 \"" + title + "\"에 대해서 설명해줘";
			
			titleElement = document.querySelector("#gptModal #bt2");
			titleElement.value = "화가 \"" + artist + "\"에 대해서 간단히 설명해줘";
			titleElement.innerText = "화가 \"" + artist + "\"에 대해서 간단히 설명해줘";
			
			titleElement = document.querySelector("#gptModal #bt3");
			titleElement.value = "화가 " + artist + "가 그린 \"" + title + "\"과 다른 그림을 추천해줘";
			titleElement.innerText = artist + "의 다른 그림을 추천해줘";
			
			document.getElementById('gptModal').showModal();
		}
		
		// AI 답변 받기
		$(document).ready(function() {
			$('#bt1').click(function() {
				$('#my').val($(this).val());
				$('#confirmButton').click();
			});
			
			$('#bt2').click(function() {
				$('#my').val($(this).val());
				$('#confirmButton').click();
			});
			
			$('#bt3').click(function() {
				$('#my').val($(this).val());
				$('#confirmButton').click();
			});
			
			$('#confirmButton').click(function(e) {
				e.preventDefault();

				var contentText = $('#my').val();
				
				// 버튼 잠시 비활성화
				$('#confirmButton').prop('disabled', true).removeClass('bg-blue-500 hover:bg-blue-700').addClass('bg-blue-800');;
				$('#bt1').prop('disabled', true).removeClass('bg-blue-500 hover:bg-blue-700').addClass('bg-blue-800');;
				$('#bt2').prop('disabled', true).removeClass('bg-blue-500 hover:bg-blue-700').addClass('bg-blue-800');;
				$('#bt3').prop('disabled', true).removeClass('bg-blue-500 hover:bg-blue-700').addClass('bg-blue-800');;
				
				if(contentText !== "") {
					$.ajax({
						method: 'POST',
						url: 'api/chat',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data: {
							content: contentText
						},
						success: function(response) {
							$('#gpt').val(response['choices'][0]['message']['content']);
							
							// Ajax 요청 성공 후 버튼 다시 활성화
							$('#confirmButton').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt1').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt2').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt3').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
						},
						error: function(xhr, status, error) {
							$('#gpt').val("데이터 요청에 실패했습니다.");
							console.log(error);
							
							// Ajax 요청 실패 후 버튼 다시 활성화
							$('#confirmButton').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt1').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt2').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
							$('#bt3').prop('disabled', false).removeClass('bg-blue-800').addClass('bg-blue-500 hover:bg-blue-700');;
						}
					});
				}
			});
			
		});
	</script>
	
	<!-- modal -->
	<style>
		dialog[open] {
		  animation: appear .15s cubic-bezier(0.25, 0.46, 0.45, 0.94);
		}

		dialog::backdrop {
			background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
			backdrop-filter: blur(3px);
		}
		  
		 
		@keyframes appear {
		  from {
			opacity: 0;
			transform: scale(0.9);
		  }

		  to {
			opacity: 1;
			transform: scale(1);
		  }
		} 
	</style>
	
	<style>
    .custom-shape-divider-top-1702120323 {
    
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-top-1702120323 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 122px;
}

.custom-shape-divider-top-1702120323 .shape-fill {
    fill: #090E34;
}

/** For mobile devices **/
@media (max-width: 767px) {
    .custom-shape-divider-top-1702120323 svg {
        width: calc(100% + 1.3px);
        height: 76px;
    }
}
  </style>
	
</head>

<body class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-cover+" style="background-image:url({{asset('storage/bg_image.png')}});">

	<!--Nav-->
	@include('nav')
	<section class="relative z-10 overflow-hidden py-20 lg:py-[115px]" style="background-color: #090E34;">
    <div class="container mx-auto">
      <div class="relative overflow-hidden">
        <div class="flex flex-wrap items-stretch -mx-4">
          <div class="w-full px-4">
            <div class="mx-auto max-w-[700px] text-center">
              <h2 class="mb-12 text-3xl font-bold md:leading-[1.44] text-white md:text-[38px] ">
                <span class="dark:text-dark">AI Docent | 생성형 도슨트</span>
              </h2>
			  <h2 class=" text-2xl font-bold md:leading-[1.44] text-white md:text-[24px] ">
                <span class="dark:text-dark">그림과 작가에 대하여 궁금한 것은 무엇이든지 물어보세요!</span>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>

	</section>
	
	<!-- 물결 -->
  <div class="custom-shape-divider-top-1702120323 dark:bg-dark">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
          <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
          <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
      </svg>
  </div>
  <!-- 물결 -->
  
    <div class="container  my-28 mx-auto  max-w-screen-lg py-5 lg:py-8">
		<div class="flex justify-between">
			<div class="text-white text-4xl font-bold">
				
			</div>
			<div class="flex items-end">
				<form name="form1" method="get" action="" class="flex items-center mr-4">
					<div class="md:w-1/3">
					  <label class="text-white block text-stone-950 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
						Title
					  </label>
					</div>
					<div class="md:w-2/3">
					  <input name="text1" class="bg-gray-200 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" value="{{ $text1 }}" onKeydown="if (event.keyCode == 13) { find_text(); }">
					</div>
				</form>	
				<button class="bg-white hover:bg-gray-700 opacity-75 text-black hover:text-white font-bold py-2 px-4 rounded-full" type="button" onClick="find_text();">검색</button>
			</div>
		</div>
		
        <div class="mt-10 grid gap-10 md:grid-cols-2 lg:gap-10 xl:grid-cols-3 ">
			@foreach($artworks as $artwork)
				<div class="group cursor-pointer" onclick="showModalAndSetImage('{{ asset('../../admin/public/storage/artwork_imgs/' . $artwork->img) }}', '{{ $artwork->title }}', '{{ $artwork->description }}');">
					<div class=" overflow-hidden rounded-md bg-gray-100 transition-all hover:scale-105   dark:bg-gray-800">
						<div class="relative block aspect-square">
							<img alt="Thumbnail" loading="lazy" decoding="async" data-nimg="fill" class="object-cover transition-all" sizes="(max-width: 768px) 30vw, 33vw" srcset="{{ asset('../../admin/public/storage/artwork_imgs/' . $artwork->img) }}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
						</div>
					</div>
					<div>
						<div>
							<div class="flex gap-3">
								<span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-blue-200">
									전시회
								</span>
							</div>
							<h2 class="flex justify-between text-lg font-semibold leading-snug tracking-tight mt-2 dark:text-white">
								<span class="text-white bg-gradient-to-r from-green-200 to-green-100 bg-[length:0px_10px] bg-left-bottom bg-no-repeat transition-[background-size] duration-500 hover:bg-[length:100%_3px] group-hover:bg-[length:100%_10px] dark:from-purple-800 dark:to-purple-900 text-stone-950">
									{{ $artwork->title }}
								</span>
								<div onclick="
									showGptModalAndSetImage('{{ asset('../../admin/public/storage/artwork_imgs/' . $artwork->img) }}', '{{ $artwork->title }}', '{{ $artwork->artist }}');
									event.stopPropagation();
								">
									<img src="{{ asset('/storage/gpt.png') }}" class="hover:opacity-75" />
								</div>
							</h2>
							<div class="mt-3 flex items-center space-x-3 text-stone-950 font-bold">
								<div class="flex items-center gap-3">
									<span class="text-white truncate text-sm">
										{{ $artwork->artist }}
									</span>
								</div>
								<span class="text-xl text-stone-950">
									
								</span>
								<time class="text-white truncate text-sm" datetime="2022-10-21T06:05:00.000Z">
									{{ $artwork->year }} 年
								</time>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		
        <div class="flex justify-center mt-16 opacity-75">
				{{ $artworks->appends(['text1' => $text1])->links('mypagination') }}
		</div>
		<div class="flex justify-end py-12">
		<!--
	<a href="#"
              class=" inline-block rounded-md bg-primary py-3 px-7 text-center text-base font-medium text-white transition hover:bg-blue-dark">
            그림 그리기 →
            </a>
			-->
			</div>
    </div>

	<!--  그림 상세 보기 Modal   -->
	<dialog id="myModal" class="h-6/7 w-11/12 md:w-11/12 p-5 bg-gray-700 rounded-md">
	  <!-- Modal Content-->
		<div>
			<div class="flex p-4 h-auto text-white text-2xl justify-end">
				<div class="p-4 cursor-pointer " onclick="document.getElementById('myModal').close();">X</div>
			</div>
			<div class="flex w-full h-auto py-4 px-2 justify-center items-center text-center text-gray-200">
				<img class="w-1/2" src="" />
				<div class="flex flex-col p-5">
					<div id="title" class="m-8 text-3xl font-bold"></div>
					<div id="description"></div>
				</div>
			</div>
		</div>
	  <!-- End of Modal Content-->	
	</dialog>
	
	
	<!--    Gpt Modal   -->
	<dialog id="gptModal" class="h-6/7 w-11/12 md:w-3/4 p-5 bg-gray-700 rounded-md ">
	  <!-- Modal Content-->
		<div class="">
			<div class="flex p-4 h-auto text-white text-2xl justify-between items-center">
				<div class="ml-12 font-bold">궁금한 것을 물어보세요</div>
				<div class="p-4 cursor-pointer" onclick="document.getElementById('gptModal').close();">X</div>
			</div>
			<div class="flex flex-col w-full h-auto py-4 px-2 justify-center items-center text-center">
				<div class="flex items-center w-full p-5">
					<img class="w-1/3 h-1/2" src=""  />
					
					<div class="w-2/3 h-1/2 mx-8">
						<button id="bt1" class="m-2 bg-blue-500 hover:bg-blue-700 text-white p-4 rounded-full pointer-cursor" value=""></button>
						<button id="bt2" class="m-2 bg-blue-500 hover:bg-blue-700 text-white p-4 rounded-full pointer-cursor" value=""></button>
						<button id="bt3" class="m-2 bg-blue-500 hover:bg-blue-700 text-white p-4 rounded-full pointer-cursor" value=""></button>
						<div class="m-4">
							<textarea id="my" rows="6" style="resize: none;" class="bg-gray-100 flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="여기에 직접 궁금한 것을 입력할 수 있습니다."></textarea>
						</div>
						
						<div class="mx-4">
							<textarea id="gpt" rows="6" style="resize: none;" class="bg-gray-100 flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="여기에 답변이 표시됩니다. 답변이 표시되기까지 시간이 조금 걸릴 수 있습니다." readonly></textarea>
						</div>
						
						<div class="mt-12">
							<button id="confirmButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full">직접 질문하기</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	  <!-- End of Modal Content-->	
	</dialog>
	
</div>
	<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}" />
	<!--Footer-->
	@include('footer')
	
</body>
	
</html>