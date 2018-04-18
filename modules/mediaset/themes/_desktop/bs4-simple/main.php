<?php
include $g['dir_attach_theme'].'/header.php';
?>
<button type="button" class="btn btn-light mb-3" title="파일첨부" role="button"
  data-role="attach-handler-file"
  data-type="file"
  data-loading-text="업로드 중...">
  <i class="fa fa-upload"></i> 파일첨부
</button>

<div id="attach-files" class="files"><!-- 파일폼 출력 -->
</div>

<div class="rb-attach mb-3 dd" id="nestable-photo">
  <ol class="list-group rb-attach-photo mb-2 bg-faded dd-list" data-role="attach-preview-photo"><!-- 포토/이미지  리스트  -->
    <?php if($parent_data['uid']):?>
    <?php echo getAttachFileList($parent_data,'upload','photo',$editor_type)?>
    <?php endif?>
  </ol>
</div>

<div class="rb-attach mb-3 dd" id="nestable-file">
  <ol class="list-group rb-attach-file bg-faded dd-list" data-role="attach-preview-file"> <!-- 일반파일 리스트  -->
    <?php if($parent_data['uid']):?>
      <?php echo getAttachFileList($parent_data,'upload','file',$editor_type)?>
      <?php echo getAttachFileList($parent_data,'upload','doc',$editor_type)?>
      <?php echo getAttachFileList($parent_data,'upload','zip',$editor_type)?>
    <?php endif?>
  </ol>
</div>

<div class="rb-attach mb-3 dd" id="nestable-video">
  <ol class="list-group rb-attach-file bg-faded dd-list" data-role="attach-preview-video"> <!-- 비디오 파일 리스트  -->
    <?php if($parent_data['uid']):?>
    <?php echo getAttachFileList($parent_data,'upload','video',$editor_type)?>
    <?php endif?>
  </ol>
</div>

<div class="rb-attach mb-3 dd" id="nestable-audio">
  <ol class="list-group rb-attach-file bg-faded dd-list" data-role="attach-preview-audio"> <!-- 오디오 파일 리스트  -->
    <?php if($parent_data['uid']):?>
    <?php echo getAttachFileList($parent_data,'upload','audio',$editor_type)?>
    <?php endif?>
  </ol>
</div>

<!-- 첨부 사진 메타정보 수정 -->
<div class="modal fade rb-modal-attach-meta" id="modal-attach-youtube-meta" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id=""><i class="fa fa-youtube fa-lg"></i> 유튜브 비디오 정보수정</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- data-role="img-preview" src="_s 이미지" data-origin="원본 이미지" 넣는다. -->
                    <div class="col-md-7 video-col">
                      <video class="mejs-player img-responsive"  style="max-width:100%;" preload="none">
                          <source data-role="src" type="video/youtube">
                      </video>
                    </div>
                    <div class="col-md-5">
                            <div class="form-group">
                                <label for="link-title" class="control-label">제목:</label>
                                <input type="text" class="form-control" data-role="caption" name="title" value="" placeholder="제목을 입력해주세요.">
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">내용:</label>
                                <textarea class="form-control" data-role="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link-caption" class="control-label">시간:</label>
                                <input type="text" class="form-control" data-role="time">
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" data-attach-act="cancel" data-role="eventHandler" data-id="" role="button">취소하기</button>
                <button type="button" class="btn btn-primary" data-attach-act="editYoutube" data-target="#modal-attach-youtube-meta" data-role="eventHandler" data-id=""  role="button">저장하기</button>
            </div>
        </div>
    </div>
</div>


<?php
  include $g['dir_attach_theme'].'/footer.php';
?>


<script>

  $('#modal-attach-youtube-meta').appendTo('body');
  $('#modal-attach-youtube').appendTo('body');

  function getYoutubePreview() {

  	var gx1 = $('#_youtube_url_').val();
    if(gx1.indexOf('watch?v=') > 0){
         gx2 = gx1.split('watch?v=')[1];
    } else if(gx1.indexOf('youtu.be/') > 0) {
         gx2 = gx1.split('youtu.be/')[1];
    }
    else  {
       alert('규격에 맞지 않습니다.');
       $('#_youtube_url_').val('').focus();
       $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
   		 return false;
  }
    var gx3 = '<video class="mejs-player"  style="max-width:100%;" preload="none"><source src="https://www.youtube.com/embed/'+gx2+'" type="video/youtube"></video>'
  	$('#_youtube_play_layer_').html(gx3);
    $('[data-attach-act="saveYoutube"]').removeAttr('disabled').removeClass('btn-light').addClass('btn-primary')
  	isGetVod = true;



    var dataArray = { "title":gx2, "src":gx2, "thumb":gx2};
    var youtubeArray = JSON.stringify(dataArray);
    $('[data-role="btn-addYoutube"]').attr('data-linkdata',youtubeArray);

  }

  function getYoutubeReset() {
    $('#_youtube_play_layer_').html('');
    $('#_youtube_url_').val('').focus();
    $('[data-attach-act="saveYoutube"]').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
    $('.rb-preview').attr('disabled','disabled').removeClass('btn-primary').addClass('btn-light');
  }

  $('[data-attach-act="saveYoutube"]').click(function(){  // 저장시 모달 닫음
    $('#modal-attach-youtube').modal('hide')
  });

  var link_settings={
    module : 'mediaset',
    theme : '<?php echo $g['dir_attach_theme']?>',
  };


  $('.rb-preview').on('click', function() {
    $(this).removeClass('btn-primary').addClass('btn-light')
  });

  $(document).ready(function(){

    // 첨부사진 순서변경
    $('#nestable-photo').nestable({
      group: 1,
      maxDepth: 1
    });

    // 첨부파일 순서변경
    $('#nestable-file').nestable({
      group: 2,
      maxDepth: 1
    });

    // 첨부 비디오 순서변경
    $('#nestable-video').nestable({
      group: 3,
      maxDepth: 1
    });

    // 첨부 오디오 순서변경
    $('#nestable-audio').nestable({
      group: 4,
      maxDepth: 1
    });

    // 순서변경 내역 저장
    $('.dd').on('change', function() {
      var attachfiles=$('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
      var new_upfiles='';
      if(attachfiles){
        for(var i=0;i<attachfiles.length;i++) {
          new_upfiles+=attachfiles[i];
        }
      }
      $.post(rooturl+'/?r='+raccount+'&m=mediaset&a=modifygid',{
         attachfiles : new_upfiles
       });
    });
});
</script>