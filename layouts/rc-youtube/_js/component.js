//사이트
var page_site_page = $('#page-site-page');  // 사이트 모듈 페이지

//게시판
var page_bbs_list = $('#page-bbs-list');  // 게시판 목록
var page_bbs_view = $('#page-bbs-view');  // 게시물 보기
var page_bbs_write = $('#page-bbs-write');  // 게시물 작성
var page_bbs_write_category = $('#page-bbs-write-category');  // 게시물 작성 > 카테고리 선택
var page_bbs_write_attach = $('#page-bbs-write-attach');  // 게시물 작성 > 카테고리 선택
var page_bbs_qnalist = $('#page-bbs-qnalist');  // 1:1 상담 게시판 목록
var page_bbs_qnaview = $('#page-bbs-qnaview');  // 1:1 상담 게시판 보기
var page_bbs_qnawrite = $('#page-bbs-qnawrite');  // 1:1 상담 게시판 쓰기

var popup_link_share =  $('#popup-link-share'); //링크 공유
var kakao_link_btn = $('#kakao-link-btn')  //카카오톡 링크공유 버튼


function getBbsList(bid,cat,page,collapse) {

  $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_bbsList',{
     bid : bid,
     cat : cat,
     collapse : collapse
  },function(response){
     var result = $.parseJSON(response);
     var error=result.error;
     var list=result.list;
     var category=result.category;
     if (error) {
       setTimeout(function(){
         history.back();
         page.find('.content').loader('hide');
         setTimeout(function(){ $.notify({message: error},{type: 'default'}); }, 400);
         return false
       }, 300);
     } else {
       var list=result.list;
       page.find('[data-role="main"]').html(list);
       page.find('.content').loader('hide');
       if (category) {
         page.find('.bar-header-secondary').removeClass('d-none');
         page.find('[data-role="category"]').html(category);
       }
     }
  });
}

$( document ).ready(function() {

  // 일반 페이지 보기
  page_site_page.on('show.rc.page', function (event) {
    var button = $(event.relatedTarget);
    var id = button.attr('data-id');
    var type = button.attr('data-type');

    page_site_page.find('[data-role="main"]').loader({  //  로더 출력
      position:   "inside"
    });
    $.post(rooturl+'/?r='+raccount+'&m=site&a=get_postData',{
       id : id,
       _mtype : type
    },function(response){
       var result = $.parseJSON(response);
       var error=result.error;
       var article=result.article;
       if (error) {
         setTimeout(function(){
           history.back();
           page_site_page.find('[data-role="main"]').loader('hide');
           setTimeout(function(){ $.notify({message: error},{type: 'default'}); }, 400);
           return false
         }, 300);
       } else {
         page_site_page.find('[data-role="main"]').loader("hide");
         page_site_page.find('[data-role="main"]').html(article);
         Iframely('oembed[url]') // oembed 미디어 변환
       }
    });
  })

  page_site_page.on('hidden.rc.page', function (event) {
    page_site_page.find('[data-role="main"]').html('');
  })

  // 게시판 목록 가져오기
  page_bbs_list.on('show.rc.page', function (event) {
    var button = $(event.relatedTarget);
    var bid = button.attr('data-id');
    var cat= button.attr('data-category');
    var collapse = button.attr('data-collapse');
    page_bbs_list.find('.content').loader({
      position: "inside"
    });
    getBbsList(bid,cat,page_bbs_list,collapse)
  })

  page_bbs_list.on('hidden.rc.page', function (event) {
    page_bbs_list.find('.bar-header-secondary').addClass('d-none');
  })

  page_bbs_list.find('[data-role="category"]').on('change', function () {
    var option = $(this).find(':selected');
    var bid = option.attr('data-bid');
    var collapse = option.attr('data-collapse');
    var cat = option.val();
    getBbsList(bid,cat,page_bbs_list,collapse)
  });

  // 게시물 보기
  page_bbs_view.on('show.rc.page', function (event) {
    var button = $(event.relatedTarget);
    var uid = button.attr('data-uid');

    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
       uid : uid,
       markup_file : 'view_simple'
    },function(response){
       var result = $.parseJSON(response);
       var error=result.error;
       var article=result.article;
       var mypost = result.mypost;
       if (error) {
         setTimeout(function(){
           history.back();
           page_bbs_view.find('.content').loader('hide');
           setTimeout(function(){ $.notify({message: error},{type: 'default'}); }, 400);
           return false
         }, 300);
       } else {
         // page_bbs_view.find('.content').loader('hide');
         page_bbs_view.find('[data-role="main"]').html(article);

         if (!mypost) page_bbs_view.find('[data-role="toolbar"]').remove()

       }
    });
  })

  // 게시판(1:1상담) 목록 가져오기
  page_bbs_qnalist.on('show.rc.page', function (event) {
    var button = $(event.relatedTarget);
    var bid = button.attr('data-id');
    var cat= button.attr('data-category');
    var collapse = button.attr('data-collapse');
    page_bbs_qnalist.find('.content').loader({
      position: "inside"
    });
    getBbsList(bid,cat,page_bbs_qnalist,collapse)
  })

  page_bbs_qnalist.on('hidden.rc.page', function (event) {
    page_bbs_qnalist.find('.bar-header-secondary').addClass('d-none');
  })

  //링크 공유 팝업이 열릴때
  popup_link_share.on('shown.rc.popup', function (event) {
    var ele = $(event.relatedTarget)
    var path = ele.attr('data-url')?ele.attr('data-url'):''
    var host = $(location).attr('origin');
    var sbj = ele.attr('data-subject')?ele.attr('data-subject'):'' // 버튼에서 제목 추출
    var email = ele.attr('data-email')?ele.attr('data-email'):'' // 버튼에서 이메일 추출
    var desc = ele.attr('data-desc')?ele.attr('data-desc'):'' // 버튼에서 요약설명 추출
    var image = ele.attr('data-image')?ele.attr('data-image'):'' // 버튼에서 대표이미지 경로 추출
    var likes = ele.attr('data-likes')?ele.attr('data-likes'):'' // 버튼에서 좋아요 수 추출
    var comment = ele.attr('data-comment')?ele.attr('data-comment'):'' // 버튼에서 댓글수 추출
    var popup = $(this)


    var link = host+path // 게시물 보기 URL
    var imageUrl = host+image // 대표이미지 URL
    var enc_link = encodeURIComponent(host+path) // URL 인코딩
    var enc_sbj = encodeURIComponent(sbj) // 제목 인코딩
    var facebook = 'http://www.facebook.com/sharer.php?u=' + enc_link;
    var twitter = 'https://twitter.com/intent/tweet?url=' + enc_link + '&text=' + sbj;
    var naver = 'http://share.naver.com/web/shareView.nhn?url=' + enc_link + '&title=' + sbj;
    var kakaostory = 'https://story.kakao.com/share?url=' + enc_link + '&title=' + enc_sbj;
    var email = 'mailto:' + email + '?subject=링크공유-' + enc_sbj+'&body='+ enc_link;

    popup.find('[data-role="share"]').focus(function(){
      $(this).on("mouseup.a keyup.a", function(e){
        $(this).off("mouseup.a keyup.a").select();
      });
    });

    popup.find('[data-role="facebook"]').attr('href',facebook)
    popup.find('[data-role="twitter"]').attr('href',twitter)
    popup.find('[data-role="naver"]').attr('href',naver)
    popup.find('[data-role="kakaostory"]').attr('href',kakaostory)
    popup.find('[data-role="email"]').attr('href',email)

    //카카오 링크
    function sendLink() {
      Kakao.Link.sendDefault({
        objectType: 'feed',
        content: {
          title: sbj,
          description: desc,
          imageUrl: imageUrl,
          link: {
            mobileWebUrl: link,
            webUrl: link
          }
        },
        buttons: [
          {
            title: '바로가기',
            link: {
              mobileWebUrl: link,
              webUrl: link
            }
          },
        ]
      });
    }

    //카카오톡 링크공유
    kakao_link_btn.click(function() {
       sendLink()
     });

  })

});
