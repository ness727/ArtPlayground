<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <button onclick="sendPaymentRequest();">123</button>

    <script>
        // Kakao API의 서비스 앱 어드민 키
        const SERVICE_APP_ADMIN_KEY = '1c9e866c3ba3a3861759b8bfaa4a8306';

        // 가맹점 정보
        const cid = 'TC0ONETIME';

        // 주문 정보
        const partner_order_id = '1'; // 주문번호
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