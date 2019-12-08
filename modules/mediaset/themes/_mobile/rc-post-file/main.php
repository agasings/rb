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

    <ul class="table-view mb-0" data-role="attach-preview-photo" data-plugin="sortable"></ul>

    <!-- 일반파일 리스트  -->
    <ul class="table-view mb-0 border-0" data-role="attach-preview-file">
    </ul>

    <!-- 오디오 리스트  -->
    <ul class="table-view mb-0 border-0" data-role="attach-preview-audio">
    </ul>

    <!-- 비디오 리스트  -->
    <div class="table-view mb-0 border-0" data-role="attach-preview-video">
    </div>

    <ul class="table-view my-0">
      <li class="table-view-cell text-muted">
        &nbsp;
        <button class="btn btn-link" data-role="attach-handler-photo" data-type="file">
          <span class="not-loading">
            추가
          </span>
          <span class="is-loading">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="sr-only">업로드중...</span>
            </div>
          </span>
        </button>
      </li>
    </ul>

  </div>

  <script src="<?php echo $g['url_attach_theme']?>/main.js"></script>

  <?php
    include $g['dir_attach_theme'].'/footer.php';
  ?>
