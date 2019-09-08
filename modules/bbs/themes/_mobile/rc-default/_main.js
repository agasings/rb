/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 모바일 기본형 게시판 테마 스크립트 (rc-default): _main.js
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */

function setBbsTab(bid,num_notice,category,search){

  var bbs_tab_swiper = new Swiper('#page-bbs-list .swiper-container', {
    autoHeight: true,
    pagination: {
      el: '#page-bbs-list .bar-tab',
      dynamicBullets: false,
      type: 'bullets',
      className : 'tab-swiper',
      bulletClass: 'tab-swiper',
      bulletActiveClass : 'active' ,
      clickable: true,
      renderBullet: function (index, className) {
        var title;
        var tab_allpost = '<span class="icon icon-list"></span><span class="tab-label">전체글</span>';
        var tab_category ='<span class="icon fa fa-folder-o"></span><span class="tab-label">분류</span>';
        var tab_notice = '<span class="icon icon-sound"></span><span class="tab-label">공지 <?php echo $NUM_NOTICE ?></span>';
        var tab_search = '<span class="icon icon-search"></span><span class="tab-label">검색</span>';

        if (!num_notice && category && search ) {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_category

        } else if (!num_notice && !category && search) {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_search

        } else if (!num_notice && category && search) {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_category
          if (index === 2) title = tab_search

        } else if (num_notice && category && !search) {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_notice
          if (index === 2) title = tab_category

        } else if (num_notice && !category && search) {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_notice
          if (index === 2) title = tab_search

        } else {

          if (index === 0) title = tab_allpost
          if (index === 1) title = tab_notice
          if (index === 2) title = tab_category
          if (index === 3) title = tab_search
        }

        return '<a class="tab-item tab-swiper ' + className + '">'+title+'</a>';
      }
    },
    on: {
      init: function () {
        console.log('bbs_tab_swiper init');

        if (bid) {
          var btn_write = '<a class="tab-item" role="button" tabindex="0" href="#modal-bbs-write" data-toggle="modal" data-mod="new"><span class="icon icon-compose"></span><span class="tab-label">글쓰기</span></a>';
        }
        setTimeout(function(){ $('#page-bbs-list .bar-tab').append(btn_write); }, 300);
      },
    }
  });
};

$(document).ready(function() {

  var bbs_tab_swiper = document.querySelector('#page-bbs-list .swiper-container').swiper
  var popup_linkshare = $('#popup-link-share')  //링크공유 팝업
  var kakao_link_btn = $('#kakao-link-btn')  //카카오톡 링크공유 버튼

  putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

  //리스트 타입 변경
  $('[data-toggle="listMarkup"]').tap(function() {
    var button = $(this)
    var markup = button.attr('data-markup');
    var bid = button.attr('data-bid');
    history.back() // popover 닫기
    setTimeout(function(){ $.loader({ text: "처리중..." }); }, 100);
    localStorage.setItem('bbs-'+bid+'-listMarkup', markup);
    location.reload();  // 목록 다시 호출
  });

  $('[data-act="opinion"]').click(function() {
    getIframeForAction('');
    frames.__iframe_for_action__.location.href = $(this).attr("data-url");
  });

  $('[data-act="write"]').tap(function() {
    $.loader({ text: $(this).attr("data-text") });
    location.href = $(this).attr("data-href");
  });

  $('[data-act="category"]').click(function() {
    $.loader({ text: $(this).attr("data-text") });
    var category =  $(this).attr("data-cat");
    getBbsList(settings_list,category,'');
    $('#page-bbs-list .infinitescroll-end').remove();
  });

  $('#page-bbs-list [data-role="search"]').submit(function(e){
    e.preventDefault();
    var form =  $(this);
    var keyword = form.find('[name="keyword"]').val();
    var where   = form.find('[name="where"]').val();
    var search = keyword+';'+where;

    form.find('[name="keyword"]').blur(); //가상 키보드 내리기
    $.loader({ text: '검색중..' });

    setTimeout(function(){
      getBbsList(settings_list,'',search);
      $('#page-bbs-list .infinitescroll-end').remove();
    }, 300);

  });

  $(document).on('tap','[data-act="reset"]',function() {
    $.loader({ text: $(this).attr("data-text") });
    // getBbsList(settings_list,'','');
    location.reload();
  });

  bbs_tab_swiper.on('slideChange', function () {

    var p = $('#page-bbs-list [data-role="list-wrapper"]').attr('data-page');

    setTimeout(function(){
      var activeSlide = $('.swiper-slide-active').data('hash');
      if (activeSlide=='search') $('[name="keyword"]').focus();
    }, 300);

    if (bbs_tab_swiper.activeIndex == 0 ) {
      $('#page-bbs-list .infinitescroll-end').removeClass("d-none");
      $('#page-bbs-list .infinitescroll-load').removeClass("d-none");
    } else {
      $('#page-bbs-list .infinitescroll-end').addClass("d-none");
      $('#page-bbs-list  .infinitescroll-load').addClass("d-none");
    }

  });

  // 게시물 보기 페이지에서 댓글이 등록된 이후에 댓글 수량 업데이트
  $('#page-bbs-view').find('#commentting-container').on('saved.rb.comment',function(){
    var page = $('#page-bbs-view')
    var bid = page.data('bid')
    var uid = page.data('uid')


    var showComment_Ele = page.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element

    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         bid : bid,
         uid : uid
      },function(response){
         var result = $.parseJSON(response);
         var total_comment=result.total_comment;
         $.notify({message: '댓글이 등록 되었습니다.'},{type: 'default'});
         showComment_Ele.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
    });
  });

  // 게시물 보기 페이지에서 한줄의견이 등록된 이후에 댓글 수량 업데이트
  $('#page-bbs-view').find('#commentting-container').on('saved.rb.oneline',function(){
    var page = $('#page-bbs-view')
    var uid = page.data('uid')
    var showComment_Ele = page.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         uid : uid
      },function(response){
         var result = $.parseJSON(response);
         var total_comment=result.total_comment;
         $.notify({message: '한줄의견이 등록 되었습니다.'},{type: 'default'});
         showComment_Ele.text(total_comment); // 최종 댓글수량 합계 업데이트
    });
  });


});
