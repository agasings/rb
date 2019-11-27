/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.4 모바일 시작하기 레이아웃 스크립트 (rc-starter)
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2019 redblock inc
 * --------------------------------------------------------------------------
 */

var bar = $('.bar')
var drawer_left = $('#drawer-left')
var drawer_right = $('#drawer-right')

var noti_sort = 'uid';
var noti_orderby = 'desc';
var noti_recnum = '10';

var page_main = $('#page-main');

var tab_main = $('#tab-main');
var tab_best = $('#tab-best');
var tab_feed = $('#tab-feed');
var tab_noti = $('#tab-noti');
var tab_libary = $('#tab-libary');

function moreNOTI(container,totalPage){
  var noti_currentPage =1; // 처음엔 무조건 1, 아래 더보기 진행되면서 +1 증가
  container.infinitescroll({
    dataSource: function(helpers, callback){
      var noti_nextPage = parseInt(noti_currentPage)+1;
      console.log('noti_totalpage: '+totalPage)
      console.log('noti_currentPage: '+noti_currentPage)
      console.log('noti_sort: '+noti_sort)
      $.get(rooturl+'/?r='+raccount+'&m=notification&a=get_notiList',{
          page : noti_nextPage,
          sort: noti_sort,
          orderby: noti_orderby,
          recnum: noti_recnum,
          callMod: 'unread'
      },function(response) {
          var result = $.parseJSON(response);
          var error = result.error;
          var content = result.content;
          if(error) alert(result.error_comment);
          callback({ content: content });
          noti_currentPage++; // 현재 페이지 +1
          console.log(noti_currentPage+'페이지 불러옴')
          $('[data-plugin="timeago"]').timeago();
          if (totalPage<=noti_currentPage) {
            container.infinitescroll('end')
            console.log('더이상 불러올 알림이 없습니다.')
          }
      });
    },
    appendToEle : container.find('.table-view'),
    percentage : 95,  // 95% 아래로 스크롤할때 다음 페이지 호출
    hybrid : false  // true: 버튼형, false: 자동
  });

}

// Textarea 또는 Input의 끝으로 커서 이동
jQuery.fn.putCursorAtEnd = function() {
  return this.each(function() {
    var $el = $(this),
        el = this;
    if (!$el.is(":focus")) {
     $el.focus();
    }
    if (el.setSelectionRange) {
      var len = $el.val().length * 2;
      setTimeout(function() {
        el.setSelectionRange(len, len);
      }, 1);
    } else {
      $el.val($el.val());
    }
    this.scrollTop = 999999;
  });
};

$(document).ready(function() {

  // tab메뉴
  page_main.find('.bar-tab [data-tab]').tap(function(){
    var tab_id = $(this).attr('data-tab');
    if (tab_id =='tab-category' || tab_id =='tab-mypage' || tab_id =='tab-noti') {
      page_main.find('.bar-header-secondary').addClass('d-none')
    } else {
      page_main.find('.bar-header-secondary').removeClass('d-none')
    }

    if (tab_id =='tab-best') {

      var d_start = $(this).attr('data-d_start');
      var sort = $(this).attr('data-sort');
      var wrapper = tab_best.find('[data-role="list-best"]')
      getPostBest({
        wrapper : wrapper,
        start : '#page-main',
        d_start : d_start,
        markup    : 'post-row',  // 테마 > _html > post-row.html
        totalNUM  : 10,
        recnum    : 10,
        totalPage : '',
        sort      : 'hit',
        none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
      })

    }

    if (tab_id =='tab-feed' && memberid) {

      getPostFeed({
        wrapper : tab_feed,
        start : '#page-main',
        markup    : 'post-row',  // 테마 > _html > post-row.html
        none : '<div class="d-flex justify-content-center align-items-center" style="height: 80vh"><div class="text-xs-center text-muted">표시할 포스트가 없습니다.</div<</div>'
      })

    }

    if (tab_id =='tab-noti' && memberid) {

      $.get(rooturl+'/?r='+raccount+'&m=notification&a=get_notiList',{
          sort: noti_sort,
          orderby: noti_orderby,
          recnum: noti_recnum,
          callMod: 'unread'
        },function(response){
         var result = $.parseJSON(response);
         var num=result.num;
         var tpg=result.tpg;
         var content=result.content;

         tab_noti.find('[data-role="noti-list"]').html(content);
         tab_noti.find('[data-plugin="timeago"]').timeago();
  			 bar.find('[data-role="noti-status"]').text(num);
         // drawer_right.find('[data-role="noti-status"]').text(num);
         // drawer_right.find('[data-role="noti-list"]').attr('data-totalPage',tpg);
         // moreNOTI(drawer_right_content,tpg)
      });


    }

    page_main.find('.tab-content').removeClass('active');
    page_main.find('.bar-tab .tab-item').removeClass('active');
    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
    page_main.find('.content').scrollTop(0);
  })

  // youtube API
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  if(navigator.userAgent.indexOf("Mac") > 0) {
    $("body").addClass("mac-os");
  }

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력

  RC_initPhotoSwipe(); // 포토갤러리 초기화 (모바일 전용)

	$('[data-plugin="timeago"]').timeago();  // 상대시간 플러그인 초기화

  $(document).on('tap','[data-toggle="changeModal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var type    = $this.attr('data-type')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, '')))
    var $start = $($this.closest('.modal'))
    if ($this.is('a')) e.preventDefault()
    $start.modal('hide').removeClass('active')
    setTimeout(function(){ $target.modal('show'); }, 10);
	});

	//modal 로그인 - 실행
	$('#modal-login').find('form').submit( function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		siteLogin(form)
	});

	// modal 로그인이 닫혔을대
	$('#modal-login').on('hidden.rc.modal', function () {
	  $(this).find('input').removeClass('is-invalid') // 에러흔적 초기화
	})

	$("#modal-login").find('input').keyup(function() {
 	 $(this).removeClass('is-invalid') //에러 발생후 다시 입력 시도시에 에러 흔적 초기화
  });

  // 로그아웃
  $('[data-act="logout"]').tap(function(){
    history.back(); // 팝업닫기
    $.loader({ text: "잠시만 기다리세요..." });
    getIframeForAction('');
    setTimeout(function(){
      frames.__iframe_for_action__.location.href = '/?r=home&m=site&a=logout';
    }, 300);
  });

	// 드로어(사이드메뉴영역) 닫기
  $('body').on('tap click','[data-toggle="drawer-close"]',function(){
		drawer_left.drawer('hide')
    drawer_right.drawer('hide')
	});

  //내알림 드로어(사이드메뉴영역)가 열렸을때
  drawer_right.on('show.rc.drawer', function () {
    if (memberid) {
      var drawer_right_content = drawer_right.find('.content')
      $.get(rooturl+'/?r='+raccount+'&m=notification&a=get_notiList',{
          sort: noti_sort,
          orderby: noti_orderby,
          recnum: noti_recnum,
          callMod: 'unread'
        },function(response){
         var result = $.parseJSON(response);
         var num=result.num;
         var tpg=result.tpg;
         var content=result.content;

         drawer_right.find('[data-role="noti-list"]').html(content);
         drawer_right.find('[data-plugin="timeago"]').timeago();
  			 bar.find('[data-role="noti-status"]').text(num);
         drawer_right.find('[data-role="noti-status"]').text(num);
         drawer_right.find('[data-role="noti-list"]').attr('data-totalPage',tpg);
         moreNOTI(drawer_right_content,tpg)
      });
    }

  })

  //내알림 드로어(사이드메뉴영역)가 닫혔을때
  drawer_right.on('hidden.rc.drawer', function () {
    if (memberid) {
      drawer_right.find('.content').infinitescroll('destroy') //무한스크롤 리셋
      drawer_right.append('<div class="content bg-faded"><ul class="table-view table-view-full my-0 bg-white" data-role="noti-list"></ul></div>');
    }
  })

  // 바로가기
  $(document).on('tap','[data-toggle="move"]',function(event){
    var button =  $(this);
    var target =  button.attr('data-target');
    var page = button.closest('[data-role="view"]');
    var top = $(target).offset().top;  // 타켓의 위치값
    var bar_height = $(page).find('.bar-nav').height();  // bar-nav의 높이값
    $(page).find('.content').animate({ scrollTop: (top-bar_height)-15 }, 300);
  });

	//외부서비스 사용자 인증요청
  $('body').on('tap click','[data-connect]',function(){
    var provider = $(this).data('connect')

		// /core/engine/cssjs.engine.php 참고
		if (provider=='naver') var target = connect_naver
		if (provider=='kakao') var target = connect_kakao
		if (provider=='google') var target = connect_google
		if (provider=='facebook') var target = connect_facebook
		if (provider=='instagram') var target = connect_instagram
    var referer = window.location.href  // 연결후, 원래 페이지 복귀를 위해

    $(".content").loader({
      text:       "연결 중...",
      position:   "overlay"
    });

    $.post(rooturl+'/?r='+raccount+'&m=connect&a=save_referer',{
    	referer : referer
  		},function(response,status){

        if(status=='success'){
          setTimeout(function() {
  					$(".content").loader("hide");
  		      document.location = target;
  		    }, 500);
        }else{
          alert(status);
        }
    });
	});

  // 페이지 이동
  $(document).on('tap','[data-href]',function(){
    var text = $(this).attr("data-text")?$(this).attr("data-text"):'이동중..';
    var url = $(this).attr("data-href");
    if ($(this).attr("data-toggle")=='drawer-close') {
      drawer_left.drawer('hide')
      drawer_right.drawer('hide')
      setTimeout(function(){
        $.loader({ text: text });
        location.href = url;
      }, 200);
    } else {
      $.loader({ text: text });
      location.href = url;
    }
  });

  //링크복사
  var clipboard = new ClipboardJS('[data-toggle="linkCopy"]');
  $(document).on('tap','[data-toggle="linkCopy"]',function(){
    setTimeout(function(){
      $.notify({message: '링크가 복사 되었습니다.'},{type: 'default'});
    }, 300);
  });

  $(document).on('click','[data-toggle="linkShare"]',function(){
    var ele = $(this)
    var sbj = ele.attr('data-subject'); // 버튼에서 제목 추출
    var desc = ele.attr('data-desc'); // 버튼에서 요약설명 추출
    var host = $(location).attr('origin');
    var path = ele.attr('data-url');
    var title = ele.attr('data-title');
    var hback = ele.attr('data-hback');
    var delay = 10;

    if (hback) {
      history.back();
      delay = 100;
    }
    setTimeout(function(){
      if (ios_Token) {  // iOS 네이티브앱 일 경우
        shareNative(sbj,link)
     } else if (navigator.share === undefined) {  //webshare.api가 지원되지 않는 환경
       console.log(host+path)
       popup_link_share.find('[data-role="share"]').val(host+path)
       setTimeout(function(){
         popup_link_share.popup({
            title : title
         })
       }, 300);

      } else {
        navigator.share({
            title: sbj,
            text: desc,
            url: link,
        })
        .then(() => console.log('성공적으로 공유되었습니다.'))
        .catch((error) => console.log('공유에러', error));
      }
    }, delay);
  });

});
