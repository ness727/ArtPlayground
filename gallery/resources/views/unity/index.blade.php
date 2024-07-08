<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ArtPlayground🏛</title>
	
	<link rel="shortcut icon" href="" type="image/x-icon" />
	<link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}" />

	<!-- ==== WOW JS ==== -->
	<script src="{{ asset('js/wow.min.js') }}"></script>
	<script>
		new WOW().init();
	</script>
	
	
	<script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-cover+" style="background-image:url({{asset('storage/bg_image.png')}});">
  	@include('nav')
    <section class="relative z-10 overflow-hidden py-20 lg:py-[115px]" style="background-color: #090E34;>
    <div class="container mx-auto">
      <div class="relative overflow-hidden">
        <div class="flex flex-wrap items-stretch -mx-4">
          <div class="w-full px-4">
            <div class="mx-auto max-w-[700px] text-center">
              <h2 class=" text-3xl font-bold md:leading-[1.44] text-white md:text-[38px] ">
                <span class="dark:text-dark">유니티를 이용한 3D Virtual Gallery</span>
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>

	<div class="flex justify-center ">
		<iframe title="Virtual Gallery" Width="960" Height="800" src="unityBuild/index.html" class="w-3/4"></iframe>
	</div>
	<div class="flex justify-end py-12">
	<!--
	<a href="#"
              class="mr-40 inline-block rounded-md bg-primary py-3 px-7 text-center text-base font-medium text-white transition hover:bg-blue-dark">
            AI 도슨트 →
            </a>
			-->
			</div>
	@include('footer')
	<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}" />
  </body>
</html>
