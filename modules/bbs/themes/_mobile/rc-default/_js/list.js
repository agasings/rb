// list.php 전용

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
        var tab_notice = '<span class="icon icon-sound"></span><span class="tab-label">공지 '+num_notice+'</span>';
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
  var p = $('#page-bbs-list [data-role="list-wrapper"]').attr('data-page');

  bbs_tab_swiper.on('slideChange', function () {
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

  $('#page-bbs-list').find('.content').on( 'scroll', function(){
    var page =  $(this);
    var pos =$(this).scrollTop();
    if (pos!=0) page.find('[data-pullToRefresh]').attr('data-pullToRefresh','false');
    else page.find('[data-pullToRefresh]').attr('data-pullToRefresh','true');
  });

  // 당겨서 새로고침 pull To Refresh
  var ptr = PullToRefresh.init({
     mainElement: '[data-pullToRefresh]',
     instructionsPullToRefresh : '당겨서 새로고침',
     instructionsReleaseToRefresh : '당겨서 새로고침',
     instructionsRefreshing : '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>',
     distReload: 60,
     getMarkup: function(){
       return '<div class="__PREFIX__box"><div class="__PREFIX__content"><div class="__PREFIX__text"></div></div></div>';
     },
     shouldPullToRefresh: function(){
       return document.querySelector('.swiper-slide-active [data-pullToRefresh="true"]');
     },
     onRefresh() {
       location.reload();
       //$('#page-bbs-list').find('[data-role="post"]').html('');
       //getBbsList(settings_list,category,keyword);
     }
   });

});
