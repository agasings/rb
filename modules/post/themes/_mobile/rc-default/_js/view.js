function getPostView(settings) {
  var mod = settings.mod;
  var wrapper = settings.wrapper;
  var start = settings.start;
  var format=settings.format;
  var uid=settings.uid;
  var list=settings.list;
  var featured=settings.featured;
  var provider = settings.provider;
  var videoId = settings.videoId;
  var url = settings.url;
  var ctheme = '_mobile/rc-default';
  var template = '/modules/post/themes/'+post_skin_mobile+'/_html/view_'+format+'.html';
  var list_collapse = settings.list_collapse;

  wrapper.load(template, function() {

    var header_height = wrapper.find('.bar-nav').outerHeight();
    var embed_height = wrapper.find('.embed-responsive').outerHeight();
    var height = header_height + embed_height;
    var window_height = $(window).height();
    var content_height = window_height - height;

    wrapper.find('[data-toggle="linkShare"]').attr('data-url',url);
    wrapper.find('.embed-responsive').css('background-image','url('+featured+')')
    wrapper.find('.content').css('padding-top',height+'px')
    wrapper.find('[data-role="goodsLink"]').addClass('d-none');
    wrapper.find('[data-uid]').attr('data-uid',uid);

    if (format=='video') {
      wrapper.find('.bar-standard').css('height',embed_height+'px')
      wrapper.find('.bar-standard .embed-responsive').css('height',embed_height+'px')
      wrapper.find('.modia-loader').loader();

      if (provider=='YouTube') {

        var player;
        player = new YT.Player('player', {
          height: '360',
          width: '640',
          videoId: videoId,
          events: {
            'onReady': onPlayerReady
          }
        });

        function onPlayerReady(event) {
          event.target.playVideo();
        }

        setTimeout(function(){
          wrapper.find('.modia-loader').loader('hide');
        }, 1000);

        wrapper.on('click','[data-toggle="play"]',function(){
          if ($(this).hasClass('active')) {
            player.pauseVideo();
            $(this).find('.material-icons').text('play_arrow');
          } else {
            player.playVideo();
            $(this).find('.material-icons').text('pause');
          }
          $(this).button('toggle')
        })

      }
    } else {
      setTimeout(function(){
        wrapper.find('[data-role="box"]').loader({ position: 'inside' });
      }, 50);
    }

    $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postView',{
      uid : uid,
      list : list,
      markup_file : 'view_'+format+'_content'
     },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var subject=result.subject;
          var nic=result.nic;
          var isperm=result.isperm;
          var article=result.article;
          var linkurl=result.linkurl;
          var listCollapse=result.listCollapse;
          var is_post_liked=result.is_post_liked;
          var is_post_disliked=result.is_post_disliked;
          var dis_like = result.dis_like;
          var dis_rating = result.dis_rating;
          var dis_comment = result.dis_comment;
          var dis_listadd = result.dis_listadd;
          var goods = result.goods;

          wrapper.find('oembed').attr('url',linkurl);
          wrapper.find('[data-role="subject"]').text(subject);
          wrapper.find('[data-role="nic"]').text(nic);

          if (provider!='YouTube') {
            Iframely('oembed[url]') // oembed 미디어 변환
            setTimeout(function(){
              wrapper.find('.bar-media [data-role="featured"]').addClass('d-none')
              wrapper.find('.embed-responsive').removeClass('d-none');
              wrapper.find('.modia-loader').loader('hide');
            }, 500);
          }

          if (goods) {
            wrapper.find('[data-role="goodsLink"]').removeClass('d-none');
          }

          wrapper.find('[data-role="box"]').html(article);

          if (format!='video') Iframely('oembed[url]') // oembed 미디어 변환

          if (listCollapse) {
            wrapper.find('[data-role="listCollapse"]').html(listCollapse);

            if (format=='doc') {
              if (!list) wrapper.find('.bar-header-secondary').addClass('d-none');
              else wrapper.find('.bar-header-secondary').removeClass('d-none');
            }
            if (format=='video' && list_collapse ) setTimeout(function(){wrapper.find('#listCollapse').collapse('show');}, 3000);

            var _window_height = $(window).height();
            var list_height = wrapper.find('[data-role="listCollapse"]').outerHeight();
            var _height = height + list_height - 1;
            var content_height = _window_height - _height;
            wrapper.find('.content').css('padding-top',_height+'px')
            wrapper.find('#listCollapse > div').css('height',content_height+'px');
          }

          wrapper.find('[data-plugin="shorten"]').shorten({
            moreText: '더보기',
            lessText: ''
          });

          if (is_post_liked) wrapper.find('[data-role="btn_post_like_'+uid+'"]').addClass('active');
          if (is_post_disliked) wrapper.find('[data-role="btn_post_dislike_'+uid+'"]').addClass('active');

          wrapper.find('#collapseContent').on('show.rc.collapse', function () {
            $('[data-role="title"]').removeClass('line-clamp-2')
          })
          wrapper.find('#collapseContent').on('hide.rc.collapse', function () {
            $('[data-role="title"]').addClass('line-clamp-2')
          })

          if (dis_like) wrapper.find('[data-role="opinion"]').hide();
          if (dis_listadd) wrapper.find('[data-role="listadd"]').hide();

          if (!dis_comment) {

            // 댓글 출력 함수 정의
            var get_Rb_Comment = function(p_module,p_table,p_uid,theme){
              wrapper.find('[data-role="comment"]').Rb_comment({
               moduleName : 'comment', // 댓글 모듈명 지정 (수정금지)
               parent : p_module+'-'+p_uid, // rb_s_comment parent 필드에 저장되는 형태가 p_modulep_uid 형태임 참조.(- 는 저장시 제거됨)
               parent_table : p_table, // 부모 uid 가 저장된 테이블 (게시판인 경우 rb_bbs_data : 댓글, 한줄의견 추가/삭제시 전체 합계 업데이트용)
               theme_name : theme, // 댓글 테마
               containerClass :'', // 본 엘리먼트(#commentting-container)에 추가되는 class
               recnum: 5, // 출력갯수
               commentPlaceHolder : '공개 댓글 추가...',
               noMoreCommentMsg : '댓글 없음 ',
               commentLength : 200, // 댓글 입력 글자 수 제한
               toolbar : ['imageUpload'] // 툴바 항목
              });
            }
            // 댓글 출력 함수 실행
            var p_module = 'post';
            var p_table = 'rb_post_data';

            get_Rb_Comment(p_module,p_table,uid,ctheme);

            // 보기 에서 댓글이 등록된 이후에 ..
            wrapper.find('[data-role="comment"]').on('saved.rb.comment',function(){
              window.history.back(); //댓글작성 sheet 내림
              var list_item = $(document).find('[data-role="item"] [data-uid="'+uid+'"]')
              //var showComment_Ele_1 = page_allcomment.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
              var showComment_Ele_2 = wrapper.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
              var showComment_ListEle = list_item.find('[data-role="comment_'+uid+'"]'); // 댓글 숫자 출력 element

              $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postData',{
                   uid : uid
                },function(response){
                   var result = $.parseJSON(response);
                   var total_comment=result.comment;
                   //$.notify({message: '댓글이 등록 되었습니다.'},{type: 'default'});
                   //showComment_Ele_1.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
                   showComment_Ele_2.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
                   showComment_ListEle.text(total_comment); // 포스트 목록 해당 항목의 최종 댓글수량 합계 업데이트
              });
            });

            // 포스트 보기 모달에서 한줄의견이 등록된 이후에..
            wrapper.find('[data-role="comment"]').on('saved.rb.oneline',function(){
              window.history.back(); //댓글작성 sheet 내림
              var uid = wrapper.find('[name="uid"]').val()
              var list_item = $('[data-role="list"]').find('#item-'+uid)
              //var showComment_Ele_1 = page_allcomment.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
              var showComment_Ele_2 = wrapper.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
              var showComment_ListEle = list_item.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
              $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postData',{
                   uid : uid
                },function(response){
                   var result = $.parseJSON(response);
                   var total_comment=result.total_comment;
                   $.notify({message: '답글이 등록 되었습니다.'},{type: 'default'});
                   //showComment_Ele_1.text(total_comment); // 최종 댓글수량 합계 업데이트
                   showComment_Ele_2.text(total_comment); // 최종 댓글수량 합계 업데이트
                   showComment_ListEle.text(total_comment); // 포스트 목록 해당 항목의 최종 댓글수량 합계 업데이트
              });
            });

            // 댓글이 수정된 후에..
            wrapper.find('[data-role="comment"]').on('edited.rb.comment',function(){
              setTimeout(function(){
                history.back()
                $.notify({message: '댓글이 수정 되었습니다.'},{type: 'default'});
              }, 300);
            })

            // 한줄의견이 수정 후에
            wrapper.find('[data-role="comment"]').on('edited.rb.oneline',function(){
              setTimeout(function(){
                history.back()
                $.notify({message: '답글이 수정 되었습니다.'},{type: 'default'});
              }, 300);
            })

          } else {
            wrapper.find('[data-role="btn_comment"]').hide();  //댓글 바로가기 버튼 숨김
            wrapper.find('[data-role="comment"]').html('<div class="text-muted pb-3 text-xs-center">댓글이 사용 중지되었습니다.</div>')
          }

        } else {
          alert(status);
        }

        if (!isperm) wrapper.find('.bar-standard .embed-responsive').empty().removeAttr('style')

    });

  });

  wrapper.off('click').on('click','[data-toggle="view"]',function(){

    var button = $(this);
    var _uid = button.attr('data-uid');
    var _featured = button.attr('data-featured');
    var _provider = button.attr('data-provider');
    var _videoId = button.attr('data-videoId');
    var _list = button.attr('data-list');
    var _format = button.attr('data-format');
    var list_collapse = button.attr('data-collapse');
    var template = template?template:'/modules/post/themes/'+post_skin_mobile+'/_html/view_'+_format+'.html';

    //wrapper.empty(); //초기화
    wrapper.load('/modules/post/themes/'+post_skin_mobile+'/_html/view_'+_format+'.html', function() {

    wrapper.attr('data-format',_format).attr('data-uid',_uid);

      setTimeout(function(){
        wrapper.find('[data-role="box"]').loader({ position: 'inside' });
      }, 150);

      getPostView({
        uid : _uid,
        format : _format,
        list : _list,
        featured : _featured,
        provider : _provider,
        videoId : _videoId,
        wrapper : wrapper,
        list_collapse : list_collapse
      });
    });

  });

} // getPostView


$(document).on('click','[data-toggle="view_listadd"]',function(){
  var button = $(this);
  var popup = $('#popup-login-guide');
  var sheet = $('#sheet-post-listadd');
  var uid = button.attr('data-uid');
  var height = button.closest('.content').css('padding-top');
  if (memberid) {
    sheet.attr('data-uid',uid).css('top',height);
    sheet.sheet();
  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup.find('[data-role="title"]').text(title);
    popup.find('[data-role="subtext"]').text(subtext);
    popup.popup('show');
  }
});

$(document).on('click','[data-toggle="view_tag"]',function(){
  var button = $(this);
  var keyword = button.attr('data-tag');
  var page = $('#page-post-keyword');
  page.attr('data-keyword',keyword);
  page.find('[data-role="title"]').text(keyword);
  window.history.back();
  setTimeout(function(){ page.page({
    start: '#page-main',
    title : keyword
   }); }, 300);
});

$(document).on('click','[data-toggle="view_opinion"]',function(){
  var button = $(this);
  var popup = $('#popup-login-guide');
  var uid = button.attr('data-uid');
  var opinion = button.attr('data-opinion');
  var url = rooturl+'/?r='+raccount+'&m=post&a=opinion&opinion='+opinion+'&uid='+uid;

  if (memberid) {
    button.button('toggle');
    getIframeForAction('');
    frames.__iframe_for_action__.location.href = url;
  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup.find('[data-role="title"]').text(title);
    popup.find('[data-role="subtext"]').text(subtext);
    popup.popup('show');
  }
});

$(document).on('click','[data-toggle="view_report"]',function(){
  var button = $(this);
  var uid = button.attr('data-uid');
  if (memberid) {
    popup_post_report.attr('data-uid',uid);
    popup_post_report.popup();
  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup_login_guide.find('[data-role="title"]').text(title);
    popup_login_guide.find('[data-role="subtext"]').text(subtext);
    popup_login_guide.popup('show');
  }
});

$(document).on('tap','[data-toggle="tag"]',function(){
  var keyword= $(this).attr('data-tag');
  page_post_keyword.attr('data-keyword',keyword)
  history.back();
  setTimeout(function(){
    page_post_keyword.page({ start: '#page-main' });
  }, 300);
})
