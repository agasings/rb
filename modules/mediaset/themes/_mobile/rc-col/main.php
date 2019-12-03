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

    <ul class="row list-unstyled rb-attach" data-role="attach-preview-photo">
    </ul>

    <!-- 일반파일 리스트  -->
    <ul class="row list-unstyled rb-attach" data-role="attach-preview-file">
    </ul>

    <!-- 오디오 리스트  -->
    <ul class="row list-unstyled rb-attach" data-role="attach-preview-audio">
    </ul>

    <!-- 비디오 리스트  -->
    <div class="row list-unstyled rb-attach" data-role="attach-preview-video">
    </div>

  </div>

  <section data-role="guide">
    <div class="d-flex justify-content-center align-items-center" style="height: 40vh">
      <div class="text-xs-center">
        <div class="material-icons mb-2" style="font-size: 100px;color:#ccc">
          add_photo_alternate
        </div>
        <small class="d-block text-muted">저장된 사진 또는 촬영 후 업로드 할수 있습니다.</small>
        <div class="mt-3">
          <button type="button" class="btn btn-outline-primary btn-block" data-role="attach-handler-file" data-type="file" title="파일첨부" role="button">
            <span class="not-loading">
              추가하기
            </span>
            <span class="is-loading">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">업로드 중...</span>
              </div>
            </span>
          </button>
        </div>
      </div>
    </div>
  </section>

  <script src="<?php echo $g['url_attach_theme']?>/main.js"></script>

  <?php
    include $g['dir_attach_theme'].'/footer.php';
  ?>
