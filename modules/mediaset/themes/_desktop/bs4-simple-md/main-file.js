/**
 * Copyright (c) 2015 redblock inc.
 * Author kiere@kismq.com
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
(function ($) {
    $.fn.RbAttachFile= function (settings) {

        var defaults = {};
        var opts = jQuery.extend(defaults, settings);

        var module=opts.module; // 모듈명
        var theme=opts.theme; // 테마 패스
        var handler_photo=opts.handler_photo; // 사진첨부 실행 엘리먼트
        var handler_file=opts.handler_file; // 파일첨부 실행 엘리먼트
        var handler_getModalList=opts.handler_getModalList; // 첨부리스트 모달로 호출하는 엘리먼트
        var listModal=opts.listModal;
        var container=$('body');
        var loaderbox='<div style="height:50%;margin-top:40%;" id="modal-loader-default"><div class="spinner-wrap"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>';

        // 부모 페이지 마크다운 에디터 toolbar 의 첨부파일 리스트 호출버튼 class 클릭시 첨부파일 리스트 모달 호출
        $('body').on('click',handler_getModalList,function(){
              if(handler_getModalList!='') $(listModal).modal('show');
        });

        // 업로드 리스트 showhide 값 reset 함수
        var updateShowHide=function(uid,showhide){
              if(showhide=='show'){
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').attr('data-content','hide'); // data-content 값 수정
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').text('숨기기'); // 메뉴명 변경
                    $('[data-role="attachList-label-hidden-'+uid+'"]').addClass('hidden'); // 숨김 라벨 숨기기
              }else{
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').attr('data-content','show'); // data-content 값 수정
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').text('보이기'); // 메뉴명 변경
                    $('[data-role="attachList-label-hidden-'+uid+'"]').removeClass('hidden'); // 숨김 라벨 노출
              }
        }

        // 이벤트 바인딩 및 세팅
        $(container).on('click','[data-attach-act]',function(e){
              e.preventDefault();
              var act=$(this).data('attach-act');
              var uid=$(this).attr('data-id');
              var type=$(this).attr('data-type'); // file or photo

              //액션 실행
              if(act=='delete'){
                   $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=delete',{
                      uid : uid
                    },function(response){
                         var previewUl_default=$('[data-role="attach-preview-'+type+'"]'); // 파일 리스트 엘리먼트 class
                         var previewUl_modal=$('[data-role="modal-attach-preview-'+type+'"]'); // 파일 리스트 엘리먼트 class
                         var delEl_default=$(previewUl_default).find('[data-id="'+uid+'"]'); // 삭제 이벤트 진행된 엘리먼트
                         var delEl_modal=$(previewUl_modal).find('[data-id="'+uid+'"]'); // 삭제 이벤트 진행된 엘리먼트
                         delEl_default.remove();// 삭제 이벤트 진행시 해당 li 엘리먼트 remove
                         delEl_modal.remove();// 삭제 이벤트 진행시 해당 li 엘리먼트 remove
                   });
              }else if(act=='showhide'){
                   var showhide=$(this).attr('data-content'); // data('content') 로 할 경우, ajax 로 변경된 값이 인식되지 않는다.
                   $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit',{
                      act : act,
                      uid : uid,
                      showhide : showhide
                    },function(response){
                         var result=$.parseJSON(response);
                         if(!result.error){
                               updateShowHide(uid,showhide);
                         }
                   });
              }else if(act=='save-file'){ // 정보수정 저장
                    var modal=$(this).data('target');
                    var filename=$(modal).find('[data-role="filename"]').val(); // 입력된 파일명
                    var filetype=$(modal).find('[data-role="eventHandler"]').attr('data-type'); // photo or file
                    var fileext=$(modal).find('[data-role="fileext"]').text(); // 입력된 파일 확장자명
                    var filecaption=$(modal).find('[data-role="filecaption"]').val(); // 입력된 캡션명
                    var filesrc=$(modal).find('[data-role="img-preview"]').attr('data-origin'); // 원본 이미지 소스

                    $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit',{
                      act : act,
                      uid : uid,
                      filename : filename,
                      filetype : filetype,
                      fileext : fileext,
                      filecaption : filecaption,
                      filesrc : filesrc
                    },function(response){
                         var result=$.parseJSON(response);
                         if(!result.error){
                               var new_filename=result.filename;
                               var new_filecaption=result.filecaption;
                               var new_fileext=result.fileext;
                               var new_filetype=result.filetype;
                               var new_filesrc=result.filesrc;
                               var insertTexts;
                               if(new_filetype=='photo') insertTexts='!['+new_filecaption+']('+rooturl+new_filesrc+')';
                               else insertTexts='['+new_filecaption+']('+rooturl+'/?r='+raccount+'&m='+module+'&a=download&uid='+uid+')';
                               console.log(new_filetype+insertTexts);

                               // 리스트 값 수정
                               $('[data-role="attachList-menu-edit-'+uid+'"]').attr('data-filename',new_filename); // 파일명 수정
                               $('[data-role="attachList-menu-edit-'+uid+'"]').attr('data-caption',new_filecaption); // 'edit' 메뉴 캡션 업데이트
                               $('[data-role="attachList-menu-insert-'+uid+'"]').attr('data-caption',new_filecaption); // 'insert' 메뉴 캡션내용 수정
                               $('[data-role="attachList-menu-copy-'+uid+'"]').attr('data-clipboard-text',insertTexts); // copy 내용 수정
                               $('[data-role="attachList-list-name-'+uid+'"]').text(new_filename+'.'+new_fileext); // 리스트 name 수정
                               $('[data-role="attachList-list-name-'+uid+'"]').attr('data-caption',new_filecaption); // 리스트에도 캡션 업데이트

                               // 모달 닫기
                               $(modal).modal('hide');
                         }
                   });
               }else if(act=='insert-file'){
                      var src=$(this).data('origin');
                      var caption=$(this).attr('data-caption');
                      if(type=='photo')  simplemde.drawImage(src,caption);
                      else if(type=='file') simplemde.drawLink(src,caption);
               }
        });

    };
})(jQuery);
