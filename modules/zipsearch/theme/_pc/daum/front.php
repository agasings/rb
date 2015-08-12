<?php
  $_SESSION['zipsearch_info']=='';  
  $_SESSION['zipsearch_info']=$zip1.'^'.$zip2.'^'.$addr1.'^'.$focusfield; // get 으로 넘어온 값들을 세션에 저장
?>

<div id="wrap" style="overflow:hidden;">
</div>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
//<![CDATA[
    // 우편번호 찾기 찾기 화면을 넣을 element
    var element_wrap = document.getElementById('wrap');
    

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }

    function openDaumPostcode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }

                 // 주소검색 세션값 추출
                var zipsearch_info='<?php echo $_SESSION['zipsearch_info']?>';
                var zipsearch_info_arr=zipsearch_info.split('^');
                var zip1_input=zipsearch_info_arr[0];
                var zip2_input=zipsearch_info_arr[1];
                var addr1_input=zipsearch_info_arr[2];
                var addr2_input=zipsearch_info_arr[3];
               
                 // 우편번호와 주소 정보를 해당 필드에 넣는다.
                var post_code=data.zonecode;
                var zip1=post_code.substring(0,3); // 앞에서 3자리 자르기 
                var zip2=post_code.substring(4,2); // 나머지 2자리 
            
                // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
                parent.opener.document.getElementById(zip1_input).value = zip1;
                parent.opener.document.getElementById(zip2_input).value = zip2;
                parent.opener.document.getElementById(addr1_input).value = fullAddr;
                
                // 커서를 상세주소 필드로 이동한다.
                parent.opener.document.getElementById(addr2_input).focus();
                
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;

                top.close(); // 킴스큐 창 닫기
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = '520px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
  top.resizeTo(440,590);
  window.onload=openDaumPostcode(); 
//]]>
</script>
