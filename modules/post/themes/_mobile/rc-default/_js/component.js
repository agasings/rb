var page_post_allpost =  $('#page-post-allpost'); //전체 포스트
var page_post_alllist =  $('#page-post-alllist'); //전체 리스트
var page_post_listview =  $('#page-post-listview'); //특정 리스트 보기
var page_post_keyword =  $('#page-post-keyword'); //키워드 보기
var page_post_category_view =  $('#page-post-category-view'); //카테고리 보기
var page_post_mypost =  $('#page-post-mypost'); //내 포스트 관리
var page_post_mylist =  $('#page-post-mylist'); //내 리스트 관리
var page_post_saved=  $('#page-post-saved'); // 내 포스트 저장내역(나중에 볼 동영상)
var page_post_liked=  $('#page-post-liked'); // 좋아요한 포스트
var page_post_view =  $('#page-post-view'); //포스트 보기

var modal_post_allpost =  $('#modal-post-allpost'); //전체 포스트
var modal_post_alllist =  $('#modal-post-alllist'); //전체 리스트
var modal_post_listview =  $('#modal-post-listview'); //리스트 보기
var modal_post_write = $('#modal-post-write'); //포스트 작성
var modal_post_view =  $('#modal-post-view'); //포스트 보기
var modal_post_photo =  $('#modal-post-photo'); //포스트 사진 보기
var modal_post_opinion =  $('#modal-post-opinion'); //포스트 좋아요 보기
var modal_post_analytics =  $('#modal-post-analytics'); //포스트 통계분석

var popup_post_postMore = $('#popup-post-postMore'); // 포스트 옵션 더보기
var popup_post_report = $('#popup-post-report'); // 포스트 신고
var popup_post_sort = $('#popup-post-sort'); // 정열방식 변경
var popup_post_newList = $('#popup-post-newList'); // 새 재생목록
var popup_post_newPost = $('#popup-post-newPost'); // 새 포스트작성을 위한 작업선택
var popup_post_delConfirm = $('#popup-post-delConfirm'); // 포스트 삭제 확인

var sheet_post_listadd = $('#sheet-post-listadd'); // 포스트 리스트에 저장
var sheet_post_linkadd = $('#sheet-post-linkadd'); // 새 포스트작성을 위한 링크추가
var sheet_post_photoadd = $('#sheet-post-photoadd'); // 새 포스트작성을 위한 사진 추가

// 전체 포스트 보기
page_post_allpost.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  getPostAll({
    wrapper : wrapper,
    markup    : 'post-row',  // 테마 > _html > post-row.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  });
})

// 전체 리스트 보기
page_post_alllist.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  getPostListAll({
    wrapper : wrapper,
    start : '#page-post-alllist',
    markup    : 'list-row',  // 테마 > _html > list-row.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  });
})

//포스트 : 특정 리스트 보기
page_post_listview.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var wrapper = page.find('[data-role="box"]');
  var listid = button.attr('data-id');
  wrapper.html('');

  getPostListview({
    listid : listid,
    wrapper : wrapper,
    markup    : 'listview-box',  // 테마 > _html > listview-box.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : '',
    orderby   : '',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  });
})

page_post_keyword.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var keyword = button.attr('data-keyword')?button.attr('data-keyword'):page.attr('data-keyword');
  var wrapper = page.find('[data-role="list"]');
  page.find('[data-role="title"]').text('# '+keyword);
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#page-post-keyword',
    markup    : 'keyword-row',  // 테마 > _html > post-card-full.html
    keyword : keyword,
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
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
    recnum    : 10,
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }
  getMyPost(settings);
})

page_post_mypost.on('hidden.rc.page', function(event) {
  var page = $(this);
  page.find('.content [data-role="list"]').empty();
  page.find('.infinitescroll-end').remove();
  var markup = page.find('.content').clone().wrapAll("<div/>").parent().html();
  page.find('.content').infinitescroll('destroy');
  page.append(markup);
})

page_post_mylist.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var id = page.attr('id');
  var num = page.attr('data-num');
  var tpg = page.attr('data-tpg');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');
  var settings={
    wrapper : wrapper,
    start : '#'+id,
    markup    : 'list-mediaList',  // 테마 > _html > list-mediaList.html
    recnum    : 10,
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 리스트가 없습니다.</div>'
  }
  getMyList(settings);
})

page_post_mylist.on('hidden.rc.page', function(event) {
  var page = $(this);
  page.find('.content [data-role="list"]').empty();
  page.find('.infinitescroll-end').remove();
  var markup = page.find('.content').clone().wrapAll("<div/>").parent().html();
  page.find('.content').infinitescroll('destroy');
  page.append(markup);
})

page_post_saved.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var id = page.attr('id');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#'+id,
    markup    : 'post-mediaList',  // 테마 > _html > list-mediaList.html
    recnum    : 10,
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostSaved(settings);

})

page_post_saved.on('hidden.rc.page', function(event) {
  var page = $(this);
  page.find('.content [data-role="list"]').empty();
  page.find('.infinitescroll-end').remove();
  var markup = page.find('.content').clone().wrapAll("<div/>").parent().html();
  page.find('.content').infinitescroll('destroy');
  page.append(markup);
})

page_post_liked.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var id = page.attr('id');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');
  var settings={
    wrapper : wrapper,
    start : '#'+id,
    markup    : 'post-mediaList',  // 테마 > _html > list-mediaList.html
    recnum    : 10,
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }
  getPostLiked(settings);
})

page_post_liked.on('hidden.rc.page', function(event) {
  var page = $(this);
  page.find('.content [data-role="list"]').empty();
  page.find('.infinitescroll-end').remove();
  var markup = page.find('.content').clone().wrapAll("<div/>").parent().html();
  page.find('.content').infinitescroll('destroy');
  page.append(markup);
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
  var url = button.attr('data-url');

  switch(format) {
    case '1':
      format = 'doc';
      break;
    case '2':
      format = 'video';
      break;
    case '3':
      format = 'adv';
      break;
  }

  getPostView({
    format : format,
    uid : uid,
    list : list,
    featured : featured,
    provider : provider,
    videoId : videoId,
    wrapper : page,
    url : url
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
  var _uid = modal.attr('data-uid');
  var list = button.attr('data-list');
  var featured = button.attr('data-featured');
  var provider = button.attr('data-provider');
  var videoId = button.attr('data-videoId');
  var url = button.attr('data-url');

  switch(format) {
    case '1':
      format = 'doc';
      break;
    case '2':
      format = 'video';
      break;
    case '3':
      format = 'adv';
      break;
  }

  modal.attr('data-format',format).attr('data-uid',uid);

  if (uid!=_uid) {
    modal.removeClass('miniplayer');
    modal.empty();
  }

  if(modal.hasClass("miniplayer") === true ) {
    modal.removeClass('miniplayer');
  } else {
    getPostView({
      format : format,
      uid : uid,
      list : list,
      featured : featured,
      provider : provider,
      videoId : videoId,
      wrapper : modal,
      url : url
    });
  }

})

modal_post_view.on('hide.rc.modal', function(event) {
  var modal = $(this);
  var format = modal.attr('data-format');
  var profile_num = $('[data-role="profile-wapper"]').find('.modal.active').length;

  if (format=='video') {
    modal.addClass('miniplayer');
    if (profile_num) modal.addClass('no-bartab');
  } else {
    modal.empty()
  }
})

// modal_post_photo.on('show.rc.modal', function(event) {
//
// })

modal_post_opinion.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var uid = button.attr('data-uid');
  var modal = $(this);
  if (!uid) uid = modal.attr('data-uid');
  var wrapper = modal.find('[data-role="list"]');
  modal_post_view.find('[data-act="pauseVideo"]').click();  //유튜브 비디오 일시정지
  getPostOpinion({
    uid : uid,
    wrapper : wrapper,
    opinion : 'like',
    markup : '_opinionList',
    none : '<div class="p-5 text-xs-center text-muted">자료가 없습니다.</div>'
  });
})

//포스트 작성
modal_post_write.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var uid = button.attr('data-uid');
  var url = button.attr('data-url');

  if (!uid) {
    var uid = modal.attr('data-uid');
  } else {
    modal.attr('data-uid',uid);
  }

  modal.find('[data-act="submit"]').attr('disabled', false);
  modal.find('[data-role="loader"]').removeClass('d-none') //로더 초기화
  modal.find('form').addClass('d-none')

  setPostWrite({
    uid : uid,
    wrapper : modal,
  });

})

modal_post_write.on('hidden.rc.modal', function(event) {
  var modal = $(this);
  // 입력사항 초기화
  modal.removeAttr('data-uid');
  modal.find('[data-role="subject"]').val('');
  modal.find('[data-role="featured"]').attr('src','')
  modal.find('[data-role="time"]').text('');
  modal.find('.form-list.floating .input-row').removeClass('active');

  if(modal.find('[data-act="submit"]').is(":disabled")) var submitting = true;
  modal.find('[name="uid"]').val(''); // uid 초기화
  modal.find('[name="pcode"]').val(''); // pcode 초기화

  // var content = editor_post.getData();

  editor_post.destroy();  //에디터 제거
  console.log('editor_post.destroy');
  setTimeout(function(){ modal.find('[data-role="editor-body"]').empty(); }, 100);

  // if (!submitting && (content || subject)) {
  //   setTimeout(function(){
  //     popup_post_cancelCheck.popup({
  //       backdrop: 'static'
  //     });  // 글쓰기 취소확인 팝업 호출
  //   }, 200);
  // }

})

modal_post_write.find('[data-act="submit"]').click(function(){
  var button = $(this)
  button.attr('disabled',true );

  setTimeout(function(){
    savePost(document.writeForm)
  }, 600);

});

modal_post_analytics.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var uid = button.attr('data-uid');
})

popup_post_postMore.on('show.rc.popup', function(event) {
  var button = $(event.relatedTarget);
  var popup = $(this);
  var uid = button.attr('data-uid');
  popup.attr('data-uid',uid);
  getPostMore(uid);
})

popup_post_postMore.on('hidden.rc.popup', function(event) {
  var popup = $(this);
  popup.find('[data-role="list"]').empty();
})

popup_post_report.on('show.rc.popup', function(event) {
  var button = $(event.relatedTarget);
  var popup = $(this);
  var uid = button.attr('data-uid');
  popup.attr('data-uid',uid);
})

popup_post_report.find('[data-act="submit"]').click(function(){
  var popup = popup_post_report;
  var uid = popup.attr('data-uid');
  $(this).attr('disabled',true );
  history.back();

  $.notify({message: '신고 되었습니다'},{type: 'default'});
  return false;

  setTimeout(function(){
    $.post(rooturl+'/?r='+raccount+'&m=post&a=report',{
      uid : uid,
      subject : subject,
      content : content
      },function(response,status){
        if(status=='success'){
          $.notify({message: '신고 되었습니다'},{type: 'default'});
        } else {
          alert(status);
        }
    });
  }, 100);
});

popup_post_delConfirm.find('[data-act="submit"]').click(function(){
  var button = $(this)
  var popup = popup_post_delConfirm
  var uid = popup.attr('data-uid');
  button.attr('disabled',true );

  setTimeout(function(){
    button.attr('disabled',false );
    history.back();

    $.post(rooturl+'/?r='+raccount+'&m=post&a=delete',{
      uid : uid,
      send_mod : 'ajax'
      },function(response,status){
        if(status=='success'){
          $(document).find('[data-role="item"][data-uid="'+uid+'"]').slideUp();
          setTimeout(function(){
            $.notify({message: '삭제 되었습니다.'},{type: 'default'});
          }, 700);
        } else {
          alert(status);
        }
    });

  }, 400);
});

sheet_post_listadd.on('show.rc.sheet', function(event) {
  var sheet = $(this);
  var uid = sheet.attr('data-uid');
  sheet.find('[data-role="list-selector"]').loader({ position: 'inside' });
  $.post(rooturl+'/?r='+raccount+'&m=post&a=get_listMy',{
    uid : uid,
    markup_file : 'radio-stacked'
  },function(response){
    var result = $.parseJSON(response);
    var list=result.list;
    var is_saved=result.is_saved;

    sheet.find('[data-role="list-selector"]').html(list);
    if (is_saved) sheet.find('[name="saved"]').prop("checked", true);
    else sheet.find('[name="saved"]').prop("checked", false);
  });
})

sheet_post_linkadd.on('show.rc.sheet', function(event) {
  var sheet = $(this);
  sheet.find('textarea').val('');
  setTimeout(function(){ sheet.find('textarea').focus(); }, 10);
  sheet.find('[data-act="submit"]').attr('disabled',false );
})

// 링크저장
sheet_post_linkadd.find('[data-act="submit"]').click(function(){
  var button = $(this)
  var textarea = sheet_post_linkadd.find('textarea');
  var url = textarea.val();
  var link_url_parse = $('<a>', {href: url});
  if (!url) {
    textarea.focus();
    $.notify({message: '복사한 링크를 붙여넣기 하세요.'},{type: 'default'});
    return false
  }
  button.attr('disabled',true);

  //네이버 블로그 URL의 실제 URL 변환
  if ((link_url_parse.prop('hostname')=='blog.naver.com' || link_url_parse.prop('hostname')=='m.blog.naver.com' ) && link_url_parse.prop('pathname')) {
    var nblog_path_arr = link_url_parse.prop('pathname').split("/");
    var nblog_id = nblog_path_arr[1];
    var nblog_pid = nblog_path_arr[2];
    if (nblog_pid) {
      var url =  'https://blog.naver.com/PostView.nhn?blogId='+nblog_id+'&logNo='+nblog_pid;
    } else {
      var url = 'https://blog.naver.com/PostList.nhn?blogId='+nblog_id;
    }
  }

  savePostByLink(url);
});

sheet_post_listadd.find('[data-act="submit"]').click(function(){
  var sheet = sheet_post_listadd;
  var uid = sheet.attr('data-uid');
  var saved = sheet.find('input[name="saved"]').is(":checked") == true?1:0;
  var list_sel=sheet.find('input[name="postlist_members[]"]');
  var list_arr=sheet.find('input[name="postlist_members[]"]:checked').map(function(){return $(this).val();}).get();
  var list_n=list_arr.length;
  var list_members='';
  for (var i=0;i <list_n;i++) {
    if(list_arr[i]!='')  list_members += '['+list_arr[i]+']';
  }
  $(this).attr('disabled',true );
  history.back();
  setTimeout(function(){
    $.post(rooturl+'/?r='+raccount+'&m=post&a=update_listindex',{
      uid : uid,
      saved : saved,
      list_members : list_members
      },function(response,status){
        if(status=='success'){
          $.notify({message: '저장 되었습니다'},{type: 'default'});
        } else {
          alert(status);
        }
    });
  }, 100);
});


sheet_post_listadd.find('[data-toggle="newList"]').click(function(){
  var sheet = sheet_post_listadd;
  var uid = sheet.attr('data-uid');
  popup_post_newList.attr('data-uid',uid);
  history.back();
  setTimeout(function(){
    popup_post_newList.popup();
  }, 100);
});

popup_post_newList.on('shown.rc.popup', function(event) {
  var popup = $(this);
  setTimeout(function(){
    popup.find('[name="name"]').focus()
  }, 400);
})

popup_post_newList.on('hidden.rc.popup', function(event) {
  var popup = $(this);
  // 상태 초기화
  popup.find('[name="name"]').val('');
  popup.find('[name="display"]').val("1").prop("selected", true);
  popup.find('[data-act="submit"]').attr('disabled',false );
})

popup_post_newList.find('[data-act="submit"]').click(function(){
  var popup = popup_post_newList;
  var uid = popup.attr('data-uid');
  var name = popup.find('[name="name"]').val();
  var display = popup.find('[name="display"]').val();

  if (!name) {
    popup.find('[name="name"]').focus();
    return false
  }

  $(this).attr('disabled',true );

  setTimeout(function(){
    history.back();

    $.post(rooturl+'/?r='+raccount+'&m=post&a=regis_list',{
      name : name,
      display : display,
      send_mod: 'ajax'
      },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var list_members=result.uid;

          $.post(rooturl+'/?r='+raccount+'&m=post&a=update_listindex',{
            uid : uid,
            saved : 0,
            list_members : list_members
            },function(response,status){
              if(status=='success'){
                $.notify({message: name+' 에 저장 되었습니다'},{type: 'default'});
              } else {
                alert(status);
              }
          });

        } else {
          alert(status);
        }

    });
  }, 800);

});

// popup_post_newPost
popup_post_newPost.on('show.rc.popup', function(event) {
  modal_post_view.find('[data-act="pauseVideo"]').click();  //유튜브 비디오 일시정지
})

popup_post_newPost.find('[data-toggle="newpost"]').click(function(){
  var popup = popup_post_newPost;
  var button = $(this);
  var type =  button.attr('data-type');

  history.back();

  setTimeout(function(){

    if (type=='link') {
      sheet_post_linkadd.sheet('show');
    } else if (type=='photo') {
      sheet_post_photoadd.sheet('show');
    } else {
      modal_post_write.modal({title: '새 포스트',url: '/post/write'})
    }

  }, 200);

});

sheet_post_photoadd.on('hidden.rc.sheet', function(event) {
  var sheet = $(this);
  sheet.find('[data-act="submit"]').attr('disabled',false );
  sheet.find('[data-role="guide"]').removeClass('d-none');
  sheet.find('[data-role="attach-preview-photo"]').empty();
  sheet.find('[data-role="attach-preview-file"]').empty();
  sheet.find('[data-role="attach-preview-audio"]').empty();
  sheet.find('[data-role="attach-preview-video"]').empty();
})

sheet_post_photoadd.find('[data-act="submit"]').click(function(){
  var button = $(this)
  var sheet = sheet_post_photoadd;
  button.attr('disabled',true);

  // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
  var featured_img_input = modal_post_write.find('input[name="featured_img"]'); // 대표이미지 input
  var featured_img_src = modal_post_write.find('[data-role="featured"]'); // 대표이미지 src
  var first_attach_img_li = sheet.find('.rb-attach li:first'); // 첫번째 첨부된 이미지 리스트 li
  var first_attach_img_uid = $(first_attach_img_li).attr('data-id');

  featured_img_input.val(first_attach_img_uid);
  featured_img_src.attr('src','http://placehold.it/206x116')

  // 첨부파일 uid 를 upfiles 값에 추가하기
  var attachfiles=sheet.find('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
  var new_upfiles='';
  if(attachfiles){
    for(var i=0;i<attachfiles.length;i++) {
      new_upfiles+=attachfiles[i];
    }
    modal_post_write.find('input[name="upload"]').val(new_upfiles);
    modal_post_write.find('[data-role="attachNum"]').text(attachfiles.length)
  } else {

    button.attr('disabled',false);
    return false;
  }

  setTimeout(function(){ history.back(); }, 100);
  setTimeout(function(){
    modal_post_write.modal({
      title : '새 포스트'
    })

  }, 300);
});

$(document).on('click','.modal.miniplayer .miniplayer-control .js-close',function(){
  modal_post_view.removeClass('miniplayer no-bartab active').css('display','none').empty();
});
