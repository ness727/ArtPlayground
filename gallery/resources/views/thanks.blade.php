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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
  <section class="relative z-10 overflow-hidden py-20 lg:py-[115px]" style="background-color: #090E34;>
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
	<div class="flex flex-wrap justify-center bg-white dark:bg-dark py-12">
		<div
            class=" wow fadeInUp rounded-lg w-full lg:w-1/3 mx-4 bg-white dark:bg-dark-2 py-10 px-8 shadow-testimonial dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px]"
            data-wow-delay=".2s
              ">
            <h3 class="mb-8 text-2xl font-semibold md:text-[28px] md:leading-[1.42] text-dark dark:text-white">
              구매해주셔서 감사합니다!
            </h3>
            
              <div class="mb-[22px]">
                <label for="name" class="block text-sm text-body-color dark:text-dark-6 mb-4">구매 물품</label>
                <input type="text" name="fullName" value="3D 전시회 + AI 도슨트 + 그림 생성" disabled
                  class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" />
              </div>
			  <div class="mb-[22px]">
                <label for="name" class="block text-sm text-body-color dark:text-dark-6 mb-4">가격</label>
                <input type="text" name="fullName" value="5,000 원" disabled
                  class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" />
              </div>
			<a href="{{ route('unity.index') }}"
              class="mt-5 inline-block rounded-md bg-primary py-3 px-7 text-center text-base font-medium text-white transition hover:bg-blue-dark">
				입장하기 →
            </a>
          </div>
</div>

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
  <script>

    </script>
</body>

</html>