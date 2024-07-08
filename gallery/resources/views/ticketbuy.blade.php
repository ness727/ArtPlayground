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
            class="wow fadeInUp rounded-lg w-full lg:w-1/3 mx-4 bg-white dark:bg-dark-2 py-10 px-8 shadow-testimonial dark:shadow-none sm:py-12 sm:px-10 md:p-[60px] lg:p-10 lg:py-12 lg:px-10 2xl:p-[60px]"
            data-wow-delay=".2s
              ">
            <h3 class="mb-8 text-2xl font-semibold md:text-[28px] md:leading-[1.42] text-dark dark:text-white">
              결제 정보 
            </h3>
            
              <div class="mb-[22px]">
                <label for="name" class="block text-sm text-body-color dark:text-dark-6 mb-4">구매 물품</label>
                <input type="text" name="fullName" value="3D 미술관 + AI 도슨트 + AI 그림 생성 " disabled
                  class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" />
              </div>
			  <div class="mb-[22px]">
                <label for="name" class="block text-sm text-body-color dark:text-dark-6 mb-4">가격</label>
                <input type="text" name="fullName" value="5,000 원" disabled
                  class="bg-transparent w-full text-body-color dark:text-dark-6 placeholder:text-body-color/60 border-0 border-b border-[#f1f1f1] dark:border-dark-3 pb-3 focus:border-primary focus:outline-none" />
              </div>
                <input type="hidden" name="name" value="1"/>
              
              <div class="mb-0">
                <button 
				  onclick="sendPaymentRequest();"
                  class="inline-flex items-center justify-center rounded-md bg-primary py-3 px-10 text-base font-medium text-white transition duration-300 ease-in-out hover:bg-blue-dark">
                  구매하기
                </button>
              </div>
           
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
		const inputElement = document.querySelector('input[name="name"]');
		const name = inputElement.value;
        // Kakao API의 서비스 앱 어드민 키
        const SERVICE_APP_ADMIN_KEY = '1c9e866c3ba3a3861759b8bfaa4a8306';

        // 가맹점 정보
        const cid = 'TC0ONETIME';

        // 주문 정보
        const partner_order_id = new Date().getTime() + name;
        const partner_user_id = 'admin'; // 어드민 디폴트
        const item_name = 'ticket'; // ticket, goods(상품 여러 개 살 때도 이름은 똑같고 가격만 다르게.)
        const quantity = 1; // 수량 디폴트 1
        const total_amount = 5000; // 예시로 5,000원으로 설정  | 제품 가격 + 세금
        const tax_free_amount = 4000; // 제품 가격. total_amount, tax_free_amount 필수 입력 사항

        // Redirect URLs
        const approval_url = 'http://gamejigix.induk.ac.kr/~team1/gallery/public/pay/success'; 
        // 결제 준비 요청 성공 시 리다이렉트 경로
        const cancel_url = 'http://gamejigix.induk.ac.kr/~team1/gallery/public/pay/cancel';    
        // 결제 준비 요청 취소 시 리다이렉트 경로
        const fail_url = 'http://gamejigix.induk.ac.kr/~team1/gallery/public/pay/fail';        
        // 결제 준비 요청 실패 시 리다이렉트 경로

        // POST 요청을 보내는 함수
        function sendPaymentRequest() {
            // 요청 헤더 설정
            const headers = {
                'Authorization': `KakaoAK ${SERVICE_APP_ADMIN_KEY}`,
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
            };

            // 요청 본문 설정
            const data = new URLSearchParams();
            data.append('cid', cid);
            data.append('partner_order_id', partner_order_id);
            data.append('partner_user_id', partner_user_id);
            data.append('item_name', item_name);
            data.append('quantity', quantity);
            data.append('total_amount', total_amount);
            data.append('tax_free_amount', tax_free_amount);
            data.append('approval_url', approval_url);
            data.append('cancel_url', cancel_url);
            data.append('fail_url', fail_url);

            // POST 요청 보내기
            axios.post('https://kapi.kakao.com/v1/payment/ready', data, { headers })
                .then(function (response) {
                    // 성공적으로 응답을 받았을 때의 동작
                    console.log('Payment 요청 성공:', response.data);
					console.log(response.data.next_redirect_pc_url)
					// User-Agent 문자열 가져오기
					var userAgentString = navigator.userAgent;

					// 사용자 에이전트 문자열을 출력
					console.log("User Agent: " + userAgentString);

					// 특정 문자열을 사용하여 기기 및 운영 체제 감지
					if (/android/i.test(userAgentString)) {
						console.log("Android 기기");
					} else if (/iPad|iPhone|iPod/i.test(userAgentString)) {
						console.log("iOS 기기");
					} else if (/Windows|Win64|Win32/i.test(userAgentString)) {
						console.log("Windows PC");
						window.open(response.data.next_redirect_pc_url);
					} else if (/Macintosh/i.test(userAgentString)) {
						console.log("Macintosh PC");
					} else {
						console.log("기타 기기 또는 운영 체제");
					}
                })
                .catch(function (error) {
                    // 에러가 발생했을 때의 동작
                    console.error('Payment 요청 실패:', error);
                });
        }

        // 호출 예제
        // sendPaymentRequest();
    </script>
</body>

</html>