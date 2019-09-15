/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 모바일 기본형 게시판 테마 스크립트 (rc-default): _main.js
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */


$(document).ready(function() {

  var kakao_link_btn = $('#kakao-link-btn')  //카카오톡 링크공유 버튼

  var page_bbs_write_main = $('#page-bbs-write-main');
  var page_bbs_list = $('#page-bbs-list');
  var page_bbs_view = $('#page-bbs-view');
  var page_bbs_write_attach = $('#page-bbs-write-attach');

  var modal_bbs_write = $('#modal-bbs-write');
  var sheet_comment_write = $('#sheet-comment-write');

  var popup_bbs_cancelCheck = $('#popup-bbs-cancelCheck');
  var popup_comment_mypost = $('#popup-comment-mypost');
  var popup_linkshare = $('#popup-link-share')  //링크공유 팝업

  var popover_bbs_listMarkup = $('#popover-bbs-listMarkup');
  var popover_bbs_view = $('#popover-bbs-view');

  var editor_bbs;
  var attach_file_saveDir = './files/bbs/';// 파일 업로드 폴더
  var attach_module_theme = '_mobile/rc-default';// attach 모듈 테마

  putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

  $('[data-act="opinion"]').click(function() {
    getIframeForAction('');
    frames.__iframe_for_action__.location.href = $(this).attr("data-url");
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

   //파일 첨부 페이지가 숨겨질때
   page_bbs_write_attach.on('hide.rc.page', function () {
     page =  page_bbs_write_attach;
     length = page.find('[data-role="attach-item"]').length;
     modal_bbs_write.find('[data-role="tap-attach"] .badge').text(length==0?'':length)  // 첨부파일 수량 업데이트
   })

  // Popover : 리스트 마크업 목록
  popover_bbs_listMarkup.on('show.rc.popover', function (e) {
    var button = $(e.relatedTarget)
    var bid =  button.attr('data-bid')
    $(this).find('.table-view-cell').attr('data-bid',bid)
    var popover = $(this)
    var local_listMarkup = localStorage.getItem('bbs-'+bid+'-listMarkup');
    popover.find('[data-toggle="listMarkup"]').removeClass('table-view-info');
    popover.find('[data-toggle="listMarkup"][data-markup="'+local_listMarkup+'"]').addClass('table-view-info');
  })

  // Popover : 게시물 관리
  popover_bbs_view.on('show.rc.popover', function (e) {
    var button = $(e.relatedTarget)
    var uid =  button.attr('data-uid')
    $(this).find('.table-view-cell').attr('data-uid',uid)
    var subject = button.attr('data-subject')
    var popover = $(this)

    var origin = $(location).attr('origin');
    var path = button.attr('data-url')?button.attr('data-url'):'';

    popover.find('[data-toggle="linkCopy"]').attr('data-clipboard-text',origin+path)
    popover.find('[data-toggle="linkShare"]').attr('data-subject',subject).attr('data-url',origin+path)

  })

  //글쓰기 모달이 열릴때
  modal_bbs_write.on('shown.rc.modal', function (e) {
    var button = $(e.relatedTarget)
    var modal = modal_bbs_write;
    var bid = modal.find('[name="bid"]').val();
    var uid = modal.find('[name="uid"]').val();
    var subject =  page_bbs_view.find('[data-role="subject"]').text();

    modal.find('[data-act="submit"]').attr('disabled', false);
    modal.find('[data-role="loader"]').removeClass('d-none') //로더 제거
    modal.find('form').addClass('d-none')

    setTimeout(function(){
      // 글쓰기 권한 체크
      $.post(rooturl+'/?r='+raccount+'&m=bbs&a=check_permWrite',{
           bid : bid
        },function(response){
         var result = $.parseJSON(response);
         var main=result.main;
         var pcode=result.pcode;
         var isperm =result.isperm;
         if (!isperm) {
           console.log('권한없음');
           modal.find('.page .content').html(main);
           modal.find('.bar-tab').remove();
         } else {
           modal.find('[name="pcode"]').val(pcode)

           DecoupledEditor
               .create( document.querySelector( '#modal-bbs-write [data-role="editor-body"]' ),{
                 placeholder: '내용',
                 toolbar: [ 'alignment:left','alignment:center','bulletedList','blockQuote','imageUpload','insertTable','undo'],
                 removePlugins: [ 'ImageToolbar', 'ImageCaption', 'ImageStyle',,'WordCount' ],
                 image: {},
                 language: 'ko',
                 extraPlugins: [rbUploadAdapterPlugin],
                 table: {
                   contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                 },
                 mediaEmbed: {
                   extraProviders: [
                     {
                       name: 'other',
                       url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
                     },
                     {
                       name: 'another',
                       url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
                     }
                   ]
                 },
                 typing: {
                   transformations: {
                     include: [
                     'quotes',
                     'typography',
                     ],
                     extra: [
                       // Add some custom transformations – e.g. for emojis.
                       { from: ':)', to: '🙂' },
                       { from: ':+1:', to: '👍' },
                       { from: ':tada:', to: '🎉' }
                     ],
                   }
                 }
               } )
               .then( newEditor => {
                 console.log('editor_bbs init');
                 modal.find('[data-role="loader"]').addClass('d-none') //로더 제거
                 modal.find('form').removeClass('d-none')
                 editor_bbs = newEditor;
                 modal.find('.toolbar-container').html(editor_bbs.ui.view.toolbar.element)
                 editor_bbs.editing.view.document.on( 'change:isFocused', ( evt, name, value ) => {
                   if (value) {
                     console.log('editor_bbs focus');
                     modal.addClass('editor-focused');
                   } else {
                     console.log('editor_bbs blur');
                     modal.removeClass('editor-focused');
                   }
                 } );

                 if (uid) {
                   modal.find('[data-act="submit"] .not-loading').text('수정');
                   modal.find('[name="subject"]').val(subject);
                   $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
                        bid : bid,
                        uid : uid,
                        mod : 'edit'
                     },function(response){
                      var result = $.parseJSON(response);
                      var content=result.content;
                      var adddata=result.adddata;
                      var featured_img=result.featured_img;
                      var attachNum=result.attachNum;
                      var photo=result.photo;
                      var video=result.video;
                      var audio=result.audio;
                      var file=result.file;
                      editor_bbs.setData(content);
                      modal.find('[name="featured_img"]').val(featured_img); // 대표이미지 셋팅
                      page_bbs_write_attach.find('[data-role="attach-preview-photo"]').html(photo);
                      page_bbs_write_attach.find('[data-role="attach-preview-video"]').html(video)
                      page_bbs_write_attach.find('[data-role="attach-preview-audio"]').html(audio)
                      page_bbs_write_attach.find('[data-role="attach-preview-file"]').html(file)
                      modal.find('[data-role="tap-attach"] .badge').text(attachNum)

                   });
                 } else {
                   setTimeout(function(){ modal.find('[name="subject"]').focus(); }, 1000);
                   modal.find('[data-act="submit"] .not-loading').text('등록');
                 }

               })
               .catch( error => {
                   console.error( error );
               } );

         }
      });
    }, 300);

  })

  //글쓰기 모달이 닫힐때
  modal_bbs_write.on('hidden.rc.modal', function (e) {
    var submitting = false;
    var modal = modal_bbs_write;

    if(modal.find('[data-act="submit"]').is(":disabled")) var submitting = true;
    modal.find('[name="uid"]').val(''); // uid 초기화
    modal.find('[name="pcode"]').val(''); // pcode 초기화

    if (editor_bbs) {
      var subject = modal.find('[name="subject"]').val();
      var content = editor_bbs.getData();
      editor_bbs.destroy();  //에디터 제거
      console.log('editor_bbs.destroy');
      if (!submitting && (content || subject)) {
        setTimeout(function(){
          popup_bbs_cancelCheck.popup({
            backdrop: 'static'
          });  // 글쓰기 취소확인 팝업 호출
        }, 200);
      }
    }
  })

  // 글 등록
  modal_bbs_write.find('[data-act="submit"]').click(function(event){
    var modal = modal_bbs_write;
    var bid = modal.find('[name="bid"]').val();
    var uid = modal.find('[name="uid"]').val();
    var theme = modal.find('[name="theme"]').val();
    var notice = modal.find('[name="notice"]').val();
    var hidden = modal.find('[name="hidden"]').val();
    var category = modal.find('[name="category"]').val();
    var backtype = modal.find('[name="backtype"]').val();
    var nlist = modal.find('[name="nlist"]').val();
    var pcode = modal.find('[name="pcode"]').val();
    var upfiles = modal.find('[name="upfiles"]').val('');
    var bbs_tab_swiper = document.querySelector('#page-bbs-list .swiper-container').swiper;
    var markup = localStorage.getItem('bbs-'+bid+'-listMarkup');

    if (!memberid) {
      var name_el = modal.find('[name="name"]');
      var name = name_el.val();
      var pw_el = modal.find('[name="pw"]');
      var pw = pw_el.val();
    }

    var subject_el = modal.find('[name="subject"]');
    var subject = subject_el.val();

    var editorData = editor_bbs.getData();

    if (!subject_el.val()) {
  		alert('제목을 입력해 주세요.       ');
  		setTimeout(function(){subject_el.focus()}, 100);
  		return false;
  	}

    if (editorData == '') {
      alert('내용을 입력해 주세요.       ');
      setTimeout(function(){editor_bbs.editing.view.focus();}, 100);
      return false;
    }

    if (notice && hidden) {
      if (notice == 1 && hidden == 1)
      {
        alert('공지글은 비밀글로 등록할 수 없습니다.  ');
        $('#page-bbs-write-option').page({ start: '#page-bbs-write-main' });
        return false;
      }
    }


  	if (category && category == '')
  	{
  		alert('카테고리를 선택해 주세요. ');
  		$('#page-bbs-write-category').page({ start: '#page-bbs-write-main' });
  		return false;
  	}


    // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
    var featured_img_input = $('#modal-bbs-write').find('input[name="featured_img"]'); // 대표이미지 input
    var featured_img_uid = featured_img_input.val();
    if(!featured_img_uid){ // 대표이미지로 지정된 값이 없는 경우
      var first_attach_img_li = $('#page-bbs-write-attach').find('[data-role="attach-preview-photo"] li:first'); // 첫번째 첨부된 이미지 리스트 li
      var first_attach_img_uid = first_attach_img_li.attr('data-id');
      featured_img_input.val(first_attach_img_uid);
    }

    // 첨부파일 uid 를 upfiles 값에 추가하기
    var attachfiles=$('#page-bbs-write-attach').find('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
    var new_upfiles='';
    if(attachfiles){
      for(var i=0;i<attachfiles.length;i++) {
        new_upfiles+=attachfiles[i];
      }
      $('#modal-bbs-write').find('input[name="upfiles"]').val(new_upfiles);
    }

    var upfiles = modal.find('[name="upfiles"]').val();
    var featured_img = modal.find('[name="featured_img"]').val();

    $(this).attr("disabled",true);

    if($('[data-role="bbs-list"] [data-role="post"] [data-role="list-wrapper"]').length > 0) var list_wrapper = 1;
    else var list_wrapper = 0;

    setTimeout(function(){
      $.post(rooturl+'/?r='+raccount+'&m=bbs&a=write',{
          bid : bid,
          uid : uid,
          theme : theme,
          name : name,
          subject : subject,
          content : editorData,
          hidden : hidden,
          category : category,
          upfiles : upfiles,
          featured_img : featured_img,
          backtype : backtype,
          pcode : pcode,
          markup : markup,
          list_wrapper: list_wrapper
       },function(response){
          var result = $.parseJSON(response);
          var error = result.error;
          var item = result.item;
          var notice = result.notice;
          var _uid = result.uid;
          var subject = result.subject;
          var content = result.content;

          if (!error) {
            history.back(); // 게시판 글쓰기 모달 닫기

            setTimeout(function(){

              if (!uid) {
                $('[data-role="bbs-list"]').find('[data-role="empty"]').addClass('d-none');
                $('[data-role="bbs-list"]').find('.content').animate({scrollTop : 0}, 100);

                if (list_wrapper) {
                  if (notice==1) $('[data-role="bbs-list"] [data-role="notice"] [data-role="list-wrapper"]').prepend(item);
                  else $('[data-role="bbs-list"] [data-role="post"] [data-role="list-wrapper"]').prepend(item);
                } else {
                  if (notice==1) $('[data-role="bbs-list"] [data-role="notice"]').prepend(item);
                  else $('[data-role="bbs-list"] [data-role="post"]').prepend(item);
                }

                $('[data-role="bbs-list"]').find('#item-'+_uid).addClass('animated fadeInDown').attr('tabindex','-1').focus();
              } else {

                // 게시물 수정일 경우
                $('[data-role="bbs-view"]').find('[data-role="subject"]').text(subject);
                $('[data-role="bbs-view"]').find('[data-role="article-body"]').html(content);
                $('[data-role="bbs-list"]').find('#item-'+uid+' a').removeAttr('data-subject').attr('data-subject',subject);
                $('[data-role="bbs-list"]').find('#item-'+uid+' [data-role="subject"]').text(subject);
                $('[data-role="bbs-list"]').find('#item-'+uid).attr('tabindex','-1').focus();

                $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
                     bid : bid,
                     uid : uid,
                     mod : 'edit'
                  },function(response){
                   var result = $.parseJSON(response);
                   var featured_img=result.featured_img;
                   var adddata=result.adddata;
                   var photo=result.photo;
                   var video=result.video;
                   var audio=result.audio;
                   var file=result.file;
                   var hidden=result.hidden;

                   $('[data-role="bbs-list"]').find('#item-'+uid+' [data-role="featured_img"]').attr('src',featured_img); //대표이미지 갱신

                   if (photo) {  // 첨부 이미지가 있을 경우
                     $('[data-role="bbs-view"]').find('[data-role="attach-photo"]').removeClass('hidden').html(photo)
                   }

                   if (video) {  // 첨부 비디오가 있을 경우
                     $('[data-role="bbs-view"]').find('[data-role="attach-video"]').removeClass('hidden').html(video)
                     $('[data-role="bbs-view"]').find('.mejs__overlay-button').css('margin','0') //mejs-player 플레이버튼 위치재조정
                   }

                   if (audio) {  // 첨부 오디오가 있을 경우
                     $('[data-role="bbs-view"]').find('[data-role="attach-audio"]').removeClass('hidden').html(audio)
                   }

                   if (file) {  // 첨부 기타파일이 있을 경우
                     $('[data-role="bbs-view"]').find('[data-role="attach-file"]').removeClass('hidden').html(file)
                   }

                 });

              }
              setTimeout(function(){bbs_tab_swiper.updateAutoHeight(300);}, 300); //item 추가 후, swiper 높이 업데이트

              //글쓰기 모달 상태 초기화
              $(this).attr('disabled', false); //글쓰기 전성버튼 상태 초기화
              modal_bbs_write.find('[name="subject"]').val('') //제목 입력내용 초기화
              modal_bbs_write.find('[name="featured_img"]').val('') //대표이미지 입력내용 초기화
              modal_bbs_write.find('[name="upfiles"]').val('') //첨부파일 입력내용 초기화
              modal_bbs_write.find('[data-role="editor-body"]').empty() //본문내용 초기화
              modal_bbs_write.find('[data-role="tap-attach"] .badge').text('')  //첨부수량 초기화
              modal_bbs_write.find('[data-role="attach-preview-photo"]').html('');  //첨부사진 영역 초기화
              modal_bbs_write.find('[data-role="attach-preview-video"]').html('')
              modal_bbs_write.find('[data-role="attach-preview-audio"]').html('')
              modal_bbs_write.find('[data-role="attach-preview-file"]').html('')
            }, 600);
          }

      });
    }, 300);

  });

  //댓글 저장버튼 클릭
  sheet_comment_write.find('[data-kcact="regis"]').click(function(event) {

    if (!$(this).hasClass("active")) {
      $.notify({message: '내용을 입력해주세요.'},{type: 'default'});
      editor_sheet.editing.view.focus();
      return false
    }

    sheet_comment_write.find('fieldset').prop('disabled', true);
    $(this).addClass('fa-spin');

    var type = $(this).attr('data-type');
    var parent = $(this).attr('data-parent');
    var uid = $(this).attr('data-uid');
    var act = $(this).attr('data-act');
    var hidden = $(this).attr('data-hidden');
    var content = editor_sheet.getData();

    setTimeout(function(){

      if (type=='comment' && act=='regis') {
        const commentRegisEditor = document.querySelector( '[data-role="bbs-comment"] .ck-editor__editable' );
        const commentRegisEditorInstance = commentRegisEditor.ckeditorInstance;
        commentRegisEditorInstance.setData(content);
        $('[data-role="bbs-comment"] [data-role="comment-input-wrapper"]').find('[data-kcact="regis"]').attr('data-hidden',hidden).click();
      }

      if (type=='oneline' && act=='regis') {
        const onelineRegisEditor = document.querySelector( '[data-role="oneline-input-wrapper-'+parent+'"] .ck-editor__editable' );
        const onelineRegisEditorInstance = onelineRegisEditor.ckeditorInstance;
        onelineRegisEditorInstance.setData(content);
        $('[data-role="oneline-input-wrapper-'+parent+'"]').find('[data-kcact="regis"]').attr('data-hidden',hidden).click();
      }

      if (type=='comment' && act=='edit') {

        console.log('comment 수정 실행')
        const commentRegisEditor = document.querySelector( '[data-role="bbs-comment"] [data-role="comment-item"] .ck-editor__editable' );
        const commentRegisEditorInstance = commentRegisEditor.ckeditorInstance;
        commentRegisEditorInstance.setData(content);
        $('[data-role="bbs-comment"]').find('[data-kcact="edit"][data-uid="'+uid+'"]').attr('data-hidden',hidden).click();
      }

      if (type=='oneline' && act=='edit') {

        console.log('oneline 수정 실행')
        const commentRegisEditor = document.querySelector( '[data-role="bbs-comment"] [data-role="oneline-item"][data-uid="'+uid+'"] .ck-editor__editable' );
        const commentRegisEditorInstance = commentRegisEditor.ckeditorInstance;
        commentRegisEditorInstance.setData(content);
        $('[data-role="bbs-comment"]').find('[data-kcact="edit"][data-type="oneline"][data-uid="'+uid+'"]').attr('data-hidden',hidden).click();
      }
    }, 600);

  });

  //댓글쓰기 컴포넌트가 호출될때
  sheet_comment_write.on('shown.rc.sheet', function (e) {

    DecoupledEditor
    .create( document.querySelector('#sheet-comment-write [data-role="comment-input"]'),{
      placeholder: '댓글을 남겨보세요..',
      toolbar: [ 'bold','italic','bulletedList','numberedList','blockQuote','imageUpload','|','undo','redo'],
      language: 'ko',
      extraPlugins: [rbUploadAdapterPlugin],
      mediaEmbed: {
          extraProviders: [
              {
                  name: 'other',
                  url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
              },
              {
                  name: 'another',
                  url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
              }
          ]
      },
      typing: {
          transformations: {
              include: [
                  // Use only the 'quotes' and 'typography' groups.
                  'quotes',
                  'typography',

                  // Plus, some custom transformation.
                  { from: '->', to: '→' },
                  { from: ':)', to: '🙂' },
                  { from: ':+1:', to: '👍' },
                  { from: ':tada:', to: '🎉' },
              ],
          }
      },
      removePlugins: [ 'WordCount' ],
      image: {}
    } )
    .then( newEditor => {
      editor_sheet = newEditor;
      console.log('editor_sheet init');
      editor_sheet.editing.view.focus();
      console.log('editor_comment focus');
      sheet_comment_write.find('.toolbar-container').html(editor_sheet.ui.view.toolbar.element)
      $('[data-role="commentWrite-container"]').removeClass('active');

      editor_sheet.editing.view.document.on( 'change:isFocused', ( evt, name, value ) => {
        if (value) {
          console.log('editor_comment focus');
          $('[data-role="commentWrite-container"]').addClass('active');
        } else {
          console.log('editor_comment blur');
        }
      } );

      editor_sheet.model.document.on( 'change:data', () => {
        var content = editor_sheet.getData();
        if (content) sheet_comment_write.find('[data-kcact="regis"]').addClass('active');
        else sheet_comment_write.find('[data-kcact="regis"]').removeClass('active');
      } );

    })
    .catch( error => {
        console.error( error );
    } );

    $('[data-role="comment-box"] [data-role="commentWrite-container"]').css('opacity','.2');

    sheet_comment_write.find('[data-role="comment-hidden"]').off('changed.rc.switch').on('changed.rc.switch', function () {
      if ($(this).hasClass("active")) {
        console.log('비밀글 ON')
        sheet_comment_write.find('[data-kcact="regis"]').attr('data-hidden','true');
      } else {
        console.log('비밀글 OFF')
        sheet_comment_write.find('[data-kcact="regis"]').attr('data-hidden','false');
      }
    })
  })

  sheet_comment_write.on('hidden.rc.sheet', function (e) {

    editor_sheet.setData('');
    console.log('editor_sheet empty')
    editor_sheet.destroy();
    console.log('editor_sheet destroy')
    sheet_comment_write.find('[data-kcact="regis"]').removeClass('active');
    sheet_comment_write.find('fieldset').prop('disabled', false);
    sheet_comment_write.find('[data-kcact="regis"]').removeClass('fa-spin').attr('data-type','').attr('data-parent','').attr('data-act','').attr('data-hidden','');
    $('[data-role="comment-box"] [data-role="commentWrite-container"]').css('opacity','1')
    $('#sheet-comment-write-toolbar').collapse('hide');

    // 비밀글 옵션 초기화
    sheet_comment_write.find('[data-role="comment-hidden"]').removeClass('active');
    sheet_comment_write.find('[data-role="comment-hidden"] .switch-handle').removeAttr('style');

    var uid = sheet_comment_write.attr('data-uid');
    var type = sheet_comment_write.attr('data-type');

    sheet_comment_write.removeAttr('data-uid').removeAttr('data-type')

    if (uid && type) {
      $('body').removeClass('comment-editmod');
      console.log(type+' 수정모드 해제')
    }

    const onelineRegisEditor = document.querySelector( '[data-role="comment-item"] .ck-editor__editable' );
    if (onelineRegisEditor) {
      const onelineRegisEditorInstance = onelineRegisEditor.ckeditorInstance;
      onelineRegisEditorInstance.destroy();
    }
  })

  // 글쓰기 취소확인 처리
  popup_bbs_cancelCheck.find('[data-toggle="cancelCheck"]').tap(function(event) {
    event.preventDefault();
    event.stopPropagation();
    var value = $(this).attr('data-value');
    if (value=='no') {
      history.back();
      setTimeout(function(){ modal_bbs_write.modal('show'); }, 10);
    } else {
      history.back();
      modal_bbs_write.find('[name="subject"]').val('') //제목 입력내용 초기화
      modal_bbs_write.find('[name="featured_img"]').val('') //대표이미지 입력내용 초기화
      modal_bbs_write.find('[name="upfiles"]').val('') //첨부파일 입력내용 초기화
      modal_bbs_write.find('[data-role="editor-body"]').empty() //본문내용 초기화
      modal_bbs_write.find('[data-role="tap-attach"] .badge').text('')  //첨부수량 초기화
      modal_bbs_write.find('[data-role="attach-preview-photo"]').html('');  //첨부사진 영역 초기화
      modal_bbs_write.find('[data-role="attach-preview-video"]').html('')
      modal_bbs_write.find('[data-role="attach-preview-audio"]').html('')
      modal_bbs_write.find('[data-role="attach-preview-file"]').html('')
      console.log('editor_bbs 제목,본문입력 초기화');
    }
  });

  popup_comment_mypost.on('show.rc.popup', function (e) {
    var button = $(e.relatedTarget);
    var uid = button.attr('data-uid');
    var type = button.attr('data-type');
    var parent = button.attr('data-parent');
    var notice = button.closest('[data-role="'+type+'-item"]').attr('data-notice');
    var hidden = button.closest('[data-role="'+type+'-item"]').attr('data-hidden');
    var popup = $(this);

    popup.find('[data-role="comment"]').removeClass('d-none');
    if (type=='oneline') popup.find('[data-role="comment"]').addClass('d-none');

    if (notice=="true") popup.find('[data-kcact="notice"] span').text('해제')
    else popup.find('[data-kcact="notice"] span').text('')

    if (hidden=="true") popup.find('[data-act="edit"]').attr('data-hidden','true');
    else popup.find('[data-act="edit"]').attr('data-hidden','false');

    popup.find('.table-view-cell a').attr('data-uid',uid);
    popup.find('.table-view-cell a').attr('data-type',type)
  })

  // 카테고리 항목 클릭에 글쓰기폼의 name="category" 에 값 적용하기
  $("#page-bbs-write-category").find('[type="radio"]').click(function() {
     var radio_val = $(this).val()
  	 modal_bbs_write.find('[name="category"]').val(radio_val)
  	 modal_bbs_write.find('[data-role="tab-category"] .icon').removeClass('text-muted')
  	 modal_bbs_write.find('[data-role="tab-category"]').removeClass('text-muted').addClass('active')
  });

  // 태그 페이지가 닫힐때 태그폼의 내용을 추출하여 글쓰기폼의 name="tag" 에 값 적용하기
  $('#page-bbs-write-tag').on('hidden.rc.page', function () {
  	var tag = $('#page-bbs-write-tag').find('[name="tag"]').val()
  	modal_bbs_write.find('[name="tag"]').val(tag)
  })

  // 옵션 페이지의 항목 비밀글 항목에 클릭시에 글쓰기폼의 name="hidden" 에 값 적용하기
  $("#page-bbs-write-option").find('[name="hidden"]').click(function() {
  	if ($(this).is(":checked")) {
  		var check_val = 1
  	} else {
  		var check_val = 0
  	}
  	 modal_bbs_write.find('[name="hidden"]').val(check_val)
  	 modal_bbs_write.find('[data-role="tap-option"] .icon').removeClass('text-muted')
  	 modal_bbs_write.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
  });

  // 옵션 페이지의 항목 공지글 항목에 클릭시에 글쓰기폼의 name="notice" 에 값 적용하기
  $("#page-bbs-write-option").find('[name="notice"]').click(function() {
  	if ($(this).is(":checked")) {
  		var check_val = 1
  	} else {
  		var check_val = 0
  	}
  	 page_bbs_write_main.find('[name="notice"]').val(check_val)
  	 page_bbs_write_main.find('[data-role="tap-option"] .icon').removeClass('text-muted')
  	 page_bbs_write_main.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
  });

  //댓글쓰기 컴포넌트가 호출
  $(document).on('click','[data-role="bbs-comment"] [data-toggle="commentWrite"]',function(){
    if (memberid) {
      var type = $(this).attr('data-type');
      var parent = $(this).attr('data-parent');
      var uid = $(this).attr('data-uid');
      var act = $(this).attr('data-act');

      sheet_comment_write.find('[data-kcact="regis"]').attr('data-type',type).attr('data-parent',parent).attr('data-act',act);
      setTimeout(function(){sheet_comment_write.sheet();}, 10);

    } else {
      $('#modal-login').modal();
    }
    return false;
  });

  $(document).on('click','#popup-comment-mypost .table-view-cell a',function(event){
    event.preventDefault();
    event.stopPropagation();
    var button = $(this);
    var uid = button.attr('data-uid');
    var type = button.attr('data-type');
    var parent = button.attr('data-parent');
    var toggle = button.attr('data-toggle');
    var kcact = button.attr('data-kcact');
    var act = button.attr('data-act');
    var hidden =  button.attr('data-hidden');

    history.back() // popup 닫기

    // console.log(toggle)
    setTimeout(function() {
      if (toggle) {
        if (act=='edit') {
          console.log('댓글 수정모드');
          var content = $('[data-role="bbs-comment"]').find('[data-role="'+type+'-origin-content-'+uid+'"]').html();
          $('[data-role="bbs-comment"]').find('[data-toggle="edit"][data-type="'+type+'"][data-uid="'+uid+'"]').click();
          sheet_comment_write.sheet();
          setTimeout(function(){
            sheet_comment_write.attr('data-uid',uid).attr('data-type',type);
            InserHTMLtoEditor(editor_sheet,content);
            sheet_comment_write.find('[data-kcact="regis"]').attr('data-type',type).attr('data-uid',uid).attr('data-act',act).attr('data-hidden',hidden);;
            if(hidden=='true') {
              sheet_comment_write.find('[data-role="comment-hidden"]').addClass('active');
            }
          }, 10);

        } else {
          $('[data-role="bbs-comment"]').find('[data-role="'+type+'-item"][data-uid="'+uid+'"] [data-toggle="'+toggle+'"]').click()
        }

      } else {
        $('[data-role="bbs-comment"]').find('[data-role="menu-container-'+type+'"] [data-uid="'+uid+'"][data-kcact="'+kcact+'"]').click()
      }
    }, 100);
	});

});
