<style>
.rb-attach .table-view:empty {
  display: none !important
}
</style>

  <?php
  include $g['dir_attach_theme'].'/header.php';
  ?>

  <div id="attach-files" class="files"><!-- 파일폼 출력 --></div>

  <div class="rb-attach" data-role="list"><!-- 포토/이미지  리스트  -->

    <ul class="table-view bg-white" data-role="attach-preview-photo">
    </ul>

    <!-- 일반파일 리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-file">
    </ul>

    <!-- 오디오 리스트  -->
    <ul class="table-view bg-white" data-role="attach-preview-audio">
    </ul>

    <!-- 비디오 리스트  -->
    <div class="table-view bg-white" data-role="attach-preview-video">
    </div>

  </div>

  <div class="content-padded text-muted guide text-center" data-role="guide">
    <div data-role="attach-handler-file" data-type="file" title="파일첨부" role="button" data-loading-text="업로드 중...">
      <div class="display-3">
        <i class="fa fa-paperclip" aria-hidden="true"></i>
      </div>
      <small>사진,비디오,오디오,문서,파일을<br>첨부할 수 있습니다.</small>
    </div>
  </div>


  <script src="<?php echo $g['url_attach_theme']?>/main.js"></script>

  <?php
    include $g['dir_attach_theme'].'/footer.php';
  ?>
