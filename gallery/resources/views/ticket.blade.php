<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
  ArtPlayground🏛
  </title>
  <link rel="shortcut icon" href="" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}" />

  <!-- ==== WOW JS ==== -->
  <script src="{{ asset('js/wow.min.js') }}"></script>
  <script>
    new WOW().init();
  </script>
</head>

<body>
  <!-- ====== Navbar Section Start -->
  @include('nav')
  <!-- ====== Navbar Section End -->

  <!-- ====== Hero Section Start -->
  <section class="relative z-10 overflow-hidden py-20 lg:py-[115px]"style="background-color: #090E34;>
    <div class="container mx-auto">
      <div class="relative overflow-hidden">
        <div class="flex flex-wrap items-stretch -mx-4">
          <div class="w-full px-4">
            <div class="mx-auto max-w-[570px] text-center">
              <h2 class="mb-2.5 text-3xl font-bold md:leading-[1.44] text-white md:text-[38px] ">
                <span class="dark:text-dark"></span>
                
              </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  <!-- ====== Hero Section End -->
  
<section id="pricing"
    class="relative z-20 overflow-hidden bg-white dark:bg-dark pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
    <div class="container mx-auto">
      <div class="-mx-4 flex flex-wrap">
        <div class="w-full px-4">
          <div class="mx-auto mb-[60px] max-w-[510px] text-center">
            <span class="mb-2 block text-lg font-semibold text-primary">
              티켓 사는 곳
            </span>
            <h2 class="mb-3 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:leading-[1.2] md:text-[40px]">
              입장권 구매하기
            </h2>
            <p class="text-base text-body-color dark:text-dark-6">
              당신의 예술 감각을 AI와 함께 일깨워보세요.
            </p>
          </div>
        </div>
      </div>
      <div class="-mx-4 flex flex-wrap justify-center">
        
        <div class="w-full px-4 md:w-1/2 lg:w-1/3">
          <div
            class="relative z-10 mb-10 overflow-hidden rounded-xl bg-white dark:bg-dark-2 py-10 px-8 shadow-pricing sm:p-12 lg:py-10 lg:px-6 xl:p-14">
            <p
              class="absolute right-[-50px] top-[60px] inline-block -rotate-90 rounded-tl-md rounded-bl-md bg-primary py-2 px-5 text-base font-medium text-white">
              Recommended
            </p>
            <span class="mb-5 block text-xl font-medium text-dark dark:text-white">
              
            </span>
            <h2 class="mb-11 text-4xl font-semibold text-dark dark:text-white xl:leading-[1.21] xl:text-[42px]">
              
              <span class="-ml-1 -tracking-[2px]">5000</span>
              <span class="text-base font-normal text-body-color dark:text-dark-6">
                원 / 1회 입장
              </span>
            </h2>
            <div class="mb-[50px]">
              <h5 class="mb-5 text-lg font-medium text-dark dark:text-white">구성</h5>
              <div class="flex flex-col gap-[14px]">
                <p class="text-base text-body-color dark:text-dark-6 ">
                  1. 유니티로 체험하는 3D 감상회
                </p>
                <p class="text-base text-body-color dark:text-dark-6">
                  2. 무엇이든 알려주는 AI 도슨트
                </p>
				<p class="text-base text-body-color dark:text-dark-6">
                  3. 당신의 상상을 시각화 해주는 AI 화가
                </p>
                
                
              </div>
            </div>
            
			@if (!Cookie::get('token'))
				<h5 class="mb-5 text-lg font-medium text-dark dark:text-white">로그인 후 이용하실 수 있습니다</h5>
            <div class="hidden sm:flex">
              <a href="{{ url('login') }}" class="inline-block rounded-md py-3 px-7 text-center  font-medium text-white transition hover:bg-blue-dark">
                <p class="text-dark dark:text-white">Log In</p>
              </a>
              <a href="{{ url('register') }}"
                class="inline-block rounded-md bg-primary py-3 px-7 text-center text-base font-medium text-white transition hover:bg-blue-dark">
                Sign Up
              </a>
			  @endif
			  @if (Cookie::get('token'))
			 <a href="{{ url('ticketbuy') }}"
              class="inline-block rounded-md bg-primary py-3 px-7 text-center text-base font-medium text-white transition hover:bg-blue-dark">
              구매하기 
            </a>
			  
			 @endif
          </div>
        </div>
        
      </div>
    </div>
  </section>


  <!-- ====== Footer Section Start -->
  @include('footer')
  <!-- ====== Footer Section End -->

  <!-- ====== Back To Top Start -->
  <a href="javascript:void(0)"
    class="back-to-top fixed bottom-8 right-8 left-auto z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark">
    <span class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white"></span>
  </a>
  <!-- ====== Back To Top End -->

  

  <!-- ====== All Scripts -->

  <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    // ==== for menu scroll
    const pageLink = document.querySelectorAll(".ud-menu-scroll");

    pageLink.forEach((elem) => {
      elem.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(elem.getAttribute("href")).scrollIntoView({
          behavior: "smooth",
          offsetTop: 1 - 60,
        });
      });
    });

    // section menu active
    function onScroll(event) {
      const sections = document.querySelectorAll(".ud-menu-scroll");
      const scrollPos =
        window.pageYOffset ||
        document.documentElement.scrollTop ||
        document.body.scrollTop;

      for (let i = 0; i < sections.length; i++) {
        const currLink = sections[i];
        const val = currLink.getAttribute("href");
        const refElement = document.querySelector(val);
        const scrollTopMinus = scrollPos + 73;
        if (
          refElement.offsetTop <= scrollTopMinus &&
          refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
        ) {
          document
            .querySelector(".ud-menu-scroll")
            .classList.remove("active");
          currLink.classList.add("active");
        } else {
          currLink.classList.remove("active");
        }
      }
    }

    window.document.addEventListener("scroll", onScroll);

    // Testimonial
    const testimonialSwiper = new Swiper('.testimonial-carousel', {
      slidesPerView: 1,
      spaceBetween: 30,

      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        1280: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  </script>
</body>

</html>