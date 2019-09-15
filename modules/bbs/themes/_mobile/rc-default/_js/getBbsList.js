/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.4 모바일 기본형 게시판 테마 스크립트 (rc-default): getBbsList.js
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2019 redblock inc
 * --------------------------------------------------------------------------
 */

function getBbsList(settings,cat,search){
  var bid=settings.bid; // 게시판 아이디
  var sort=settings.sort; // sort
  var orderby=settings.orderby; // orderby
  var recnum=settings.recnum; // recnum
  var totalPage = settings.totalPage;
  var totalNUM = settings.totalNUM;
  var markup_list=settings.markup+'-list'; // 목록 마크업
  var markup_item=settings.markup+'-item'; // 아이템 마크업
  var page = $('#page-bbs-list');
  var container = page.find('[data-role="bbs-list"]');
  var bbs_tab_swiper = document.querySelector('#page-bbs-list .swiper-container').swiper;
  var search = search.split(";");
  var keyword = search[0];
  var where = search[1] ;
  var currentPage =1; // 처음엔 무조건 1, 아래 더보기 진행되면서 +1 증가
  var prevNUM = currentPage * recnum;
  var moreNUM = totalNUM - prevNUM ;

  $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postList',{
     bid : bid,
     sort: sort,
     orderby: orderby,
     recnum: recnum,
     markup_list : markup_list,
     markup_item : markup_item,
     keyword : keyword,
     where : where,
     cat : cat,
     p : 1
  },function(response){
     var result = $.parseJSON(response);
     var error=result.error;
     var list=result.list;
     if (error) {
       alert('다시 시도해 주세요.')
     } else {
       var num=result.num;
       var num_notice=result.num_notice;
       var list_post=result.list_post;
       var list_notice=result.list_notice;

       // 상태 초기화
       container.find('[data-role="post"]').html('');
       container.find('[data-role="notice"]').html('');

       $.loader('hide');
       container.find('[data-role="post"]').html(list_post);
       bbs_tab_swiper.updateAutoHeight(10);
       container.find('[data-role="notice"]').html(list_notice);
       container.find('[data-plugin="timeago"]').timeago();
       container.find('[data-plugin="markjs"]').mark(keyword); // marks.js

       if (cat || keyword) {
         container.find('[data-role="post"] [data-role="toolbar"]').removeClass('d-none');
         setTimeout(function(){ bbs_tab_swiper.slideTo(0, 300, ''); }, 200);

         if (!num) {
           container.find('[data-role="empty"] [type="button"]').removeClass('d-none');
         }
       }

       //무한 스크롤
       page.find('.content').infinitescroll({
         dataSource: function(helpers, callback){
           var nextPage = parseInt(currentPage)+1;
           if (totalPage>currentPage) {
             $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postList',{
                 bid : bid,
                 sort: sort,
                 orderby: orderby,
                 recnum: recnum,
                 markup_list : markup_list,
                 markup_item : markup_item,
                 keyword : keyword,
                 where : where,
                 cat : cat,
                 p : nextPage
             },function(response) {
                 var result = $.parseJSON(response);
                 var error = result.error;
                 var list=result.list_post;
                 var page=result.page;
                 if(error) alert(result.error_comment);
                 callback({ content: list });
                 bbs_tab_swiper.updateAutoHeight(10); // 높이재조정
                 currentPage++; // 현재 페이지 +1
                 console.log(currentPage+'페이지 불러옴')
                 container.find('[data-role="list-wrapper"]').attr('data-page',page);
                 container.find('[data-plugin="timeago"]').timeago();
                 container.find('[data-plugin="markjs"]').mark(keyword); // marks.js
             });
           } else {
             callback({ end: true });
             console.log('더이상 불러올 페이지가 없습니다.')
           }
         },
         appendToEle : $(document).find('[data-role="post"] [data-role="list-wrapper"]'),
         percentage : 95,  // 95% 아래로 스크롤할때 다움페이지 호출
         hybrid : false  // true: 버튼형, false: 자동
       });
     }
  });
};
