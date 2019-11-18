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
  var ctheme = '_mobile/rc-default';
  var template = '/modules/post/themes/'+post_skin_mobile+'/_html/view_'+format+'.html';
  var list_collapse = settings.list_collapse;

  wrapper.load(template, function() {

    var header_height = wrapper.find('.bar-nav').outerHeight();
    var embed_height = wrapper.find('.embed-responsive').outerHeight();
    var height = header_height + embed_height;
    var window_height = $(window).height();
    var content_height = window_height - height;

    wrapper.find('.embed-responsive').css('background-image','url('+featured+')')
    wrapper.find('.content').css('padding-top',height+'px')

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
          var isperm=result.isperm;
          var article=result.article;
          var linkurl=result.linkurl;
          var listCollapse=result.listCollapse;

          wrapper.find('oembed').attr('url',linkurl);

          if (provider!='YouTube') {
            Iframely('oembed[url]') // oembed 미디어 변환
            setTimeout(function(){
              wrapper.find('.bar-media [data-role="featured"]').addClass('d-none')
              wrapper.find('.embed-responsive').removeClass('d-none');
              wrapper.find('.modia-loader').loader('hide');
            }, 500);
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

          wrapper.find('#collapseContent').on('show.rc.collapse', function () {
            $('[data-role="title"]').removeClass('line-clamp-2')
          })
          wrapper.find('#collapseContent').on('hide.rc.collapse', function () {
            $('[data-role="title"]').addClass('line-clamp-2')
          })


          // 댓글 출력 함수 정의
          var get_Rb_Comment = function(p_module,p_table,p_uid,theme){
            wrapper.find('[data-role="comment"]').Rb_comment({
             moduleName : 'comment', // 댓글 모듈명 지정 (수정금지)
             parent : p_module+'-'+p_uid, // rb_s_comment parent 필드에 저장되는 형태가 p_modulep_uid 형태임 참조.(- 는 저장시 제거됨)
             parent_table : p_table, // 부모 uid 가 저장된 테이블 (게시판인 경우 rb_bbs_data : 댓글, 한줄의견 추가/삭제시 전체 합계 업데이트용)
             theme_name : theme, // 댓글 테마
             containerClass :'', // 본 엘리먼트(#commentting-container)에 추가되는 class
             recnum: 5, // 출력갯수
             commentPlaceHolder : '댓글을 입력해주세요.',
             noMoreCommentMsg : '댓글 없음 ',
             commentLength : 200, // 댓글 입력 글자 수 제한
             toolbar : ['imageUpload'] // 툴바 항목
            });
          }
          // 댓글 출력 함수 실행
          var p_module = 'post';
          var p_table = 'rb_post_data';

          get_Rb_Comment(p_module,p_table,uid,ctheme);

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
}

$(document).on('click','[data-toggle="opinion"]',function(){
  var button = $(this);
  var popup = $('#popup-login-guide');

  if (memberid) {

  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup.find('[data-role="title"]').text(title);
    popup.find('[data-role="subtext"]').text(subtext);
    popup.popup('show');

  }

});


$(document).on('click','[data-toggle="report"]',function(){
  var button = $(this);
  var popup = $('#popup-login-guide');

  if (memberid) {

  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup.find('[data-role="title"]').text(title);
    popup.find('[data-role="subtext"]').text(subtext);
    popup.popup('show');

  }

});

$(document).on('click','[data-toggle="listadd"]',function(){
  var button = $(this);
  var popup = $('#popup-login-guide');

  if (memberid) {

  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup.find('[data-role="title"]').text(title);
    popup.find('[data-role="subtext"]').text(subtext);
    popup.popup('show');

  }

});
