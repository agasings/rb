var page_post_keyword =  $('#page-post-keyword'); //키워드 보기
var page_post_category_view =  $('#page-post-category-view'); //카테고리 보기
var page_post_mypost =  $('#page-post-mypost'); //내 포스트 관리
var page_post_mylist =  $('#page-post-mylist'); //내 리스트 관리
var page_post_view =  $('#page-post-view'); //포스트 보기

var modal_post_allpost =  $('#modal-post-allpost'); //전체 포스트
var modal_post_alllist =  $('#modal-post-alllist'); //전체 리스트
var modal_post_listview =  $('#modal-post-listview'); //리스트 보기
var modal_post_view =  $('#modal-post-view'); //포스트 보기


page_post_keyword.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var keyword = button.attr('data-keyword');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#page-post-keyword',
    markup    : 'keyword-row',  // 테마 > _html > post-card-full.html
    keyword : keyword,
    totalNUM  : '<?php echo $NUM?>',
    recnum    : '',
    totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostKeyword(settings);

})

page_post_category_view.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var category = button.attr('data-category');
  var wrapper = page.find('[data-role="list"]');





  var swiper_shop_category_thumbs = document.querySelector('#page-post-category-view .bar-standard .swiper-container-thumbs').swiper;
  var swiper_shop_category_body = document.querySelector('#page-post-category-view .content .swiper-container').swiper;

  if (swiper_shop_category_thumbs) swiper_shop_category_thumbs.destroy(true,true);
  if (swiper_shop_category_body) swiper_shop_category_body.destroy(true,true);

  var button = $(event.relatedTarget)
  var intial_index = button.data('index')
  var category_parent = button.data('parent')
  var category = button.data('category')

  // 초기화
  page.find('.bar-standard').removeClass('d-none')
  page.find('.bar-standard .swiper-wrapper').html('')
  page.find('.content .swiper-wrapper').html('');

  $.post(rooturl+'/?r='+raccount+'&m=post&a=set_swiperCategory',{
       parent : category_parent,
       markup_file : 'category'
    },function(response){

     var result = $.parseJSON(response);
     var nav_links=result.nav_links;
     var num=result.num;
     var swiper_slides=result.swiper_slides;
     page.find('.bar-standard .swiper-wrapper').html(nav_links)
     page.find('.content .swiper-wrapper').html(swiper_slides)

     if (!num) page.find('.bar-standard').addClass('d-none')

     page.find('.content').loader({
      text:       "불러오는중...",
      position:   "overlay",
    });

    var item = page.find('.bar-standard .nav-link')

    var slidesPerView = num>3?4:3

    var swiper_shop_category_thumbs = new Swiper('#page-post-category-view .bar-standard .swiper-container-thumbs', {
      slidesPerView: slidesPerView,
      freeMode: true,
      freeModeSticky : true,
      watchSlidesVisibility: true,
      // watchSlidesProgress: true,
      slidesOffsetAfter	: 0,
      initialSlide: intial_index,
      navigation: {
        nextEl: '.shadow_after',
        prevEl: '.shadow_before',
      },
      slidesOffsetBefore: 0,
      slidesOffsetAfter : 0
    });

    var swiper_shop_category_body = new Swiper('#page-post-category-view .content .swiper-container', {
      spaceBetween: 10,
      autoHeight: true,
      initialSlide: intial_index,
      navigation: {
        nextEl: '.shadow_after',
        prevEl: '.shadow_before',
      },
      thumbs: {
        swiper: swiper_shop_category_thumbs,
        slideThumbActiveClass: 'active',
        slidesPerView: slidesPerView,
        freeMode: true,
        freeModeSticky : true,
        watchSlidesVisibility: true,
        // watchSlidesProgress: true,
        slidesOffsetBefore: 0,
        slidesOffsetAfter : 0
      },
      on: {
        init: function () {
          console.log('swiper 초기화 완료');
          var intial_slide = page.find('.content .swiper-slide:eq('+intial_index+')')

          $.post(rooturl+'/?r='+raccount+'&m=shop&a=get_goodsList',{
               cat : category,
               markup_file : 'category_cols'
            },function(response){

             var result = $.parseJSON(response);
             var list=result.list;

             setTimeout(function(){
               page.find('.content').loader("hide");
               intial_slide.html(list);
             }, 100);
          });
        },
      },
    });

    swiper_shop_category_body.on('slideChange', function () {
      console.log('slide changed');

      var active_index = swiper_shop_category_body.activeIndex
      var active_slide = page.find('.content .swiper-slide:eq('+active_index+')')
      var category = active_slide.data('category')
      var title = active_slide.data('title')

      console.log('category:'+category)

      active_slide.html('');
      page.find('.content').loader({
        text:       "불러오는중...",
        position:   "overlay",
      });

      $.post(rooturl+'/?r='+raccount+'&m=shop&a=get_goodsList',{
           cat : category,
           markup_file : 'category_cols'
        },function(response){

         var result = $.parseJSON(response);
         var list=result.list;

         active_slide.html(list);
         page.find('.content').scrollTop(0);
         page.find('.content').loader("hide");
         setTimeout(function(){
           swiper_shop_category_body.updateAutoHeight();
         }, 100);

      })
    })
  })



  var settings={
    wrapper : wrapper,
    start : '#page-post-category-view',
    markup    : 'category-row',  // 테마 > _html > post-card-full.html
    category : category,
    totalNUM  : '',
    recnum    : 10,
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostCategory(settings);

})

page_post_mypost.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var id = page.attr('id');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#'+id,
    markup    : 'post-mediaList',  // 테마 > _html > post-mediaList.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getMyPost(settings);

})

page_post_mylist.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var id = page.attr('id');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#'+id,
    markup    : 'list-mediaList',  // 테마 > _html > list-mediaList.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 리스트가 없습니다.</div>'
  }

  getMyList(settings);

})

page_post_view.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var format = button.attr('data-format');
  var uid = button.attr('data-uid');
  var list = button.attr('data-list');
  var featured = button.attr('data-featured');
  var provider = button.attr('data-provider');
  var videoId = button.attr('data-videoId');

  getPostView({
    format : format,
    uid : uid,
    list : list,
    featured : featured,
    provider : provider,
    videoId : videoId,
    wrapper : page
  });
})

page_post_view.on('hidden.rc.page', function(event) {
  var page = $(this);
  page.empty()
})

modal_post_allpost.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    markup    : 'post-row',  // 테마 > _html > post-card-full.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostAll(settings);

})

modal_post_alllist.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    markup    : 'list-row',  // 테마 > _html > list-row.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostListAll(settings);

})

modal_post_listview.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="box"]');
  var listid = button.attr('data-id');
  wrapper.html('');

  getPostListview({
    listid : listid,
    wrapper : wrapper,
    markup    : 'listview-box',  // 테마 > _html > list-tableview.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : '',
    orderby   : '',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  });

})

modal_post_view.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var format = button.attr('data-format');
  var uid = button.attr('data-uid');
  var list = button.attr('data-list');
  var featured = button.attr('data-featured');
  var provider = button.attr('data-provider');
  var videoId = button.attr('data-videoId');

  getPostView({
    format : format,
    uid : uid,
    list : list,
    featured : featured,
    provider : provider,
    videoId : videoId,
    wrapper : modal
  });
})

modal_post_view.on('hidden.rc.modal', function(event) {
  var modal = $(this);
  modal.empty()
})
