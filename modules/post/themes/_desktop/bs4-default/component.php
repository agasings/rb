<div class="modal" id="modal-post-share" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">공유하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
        <?php include $g['dir_module_skin'].'_linkshare.php'?>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-post-listadd" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">저장하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <?php include $g['dir_module_skin'].'_listadd.php'?>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modal-post-report" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">신고하기</h5>
      </div>
      <div class="modal-body text-center">
        <?php include $g['dir_module_skin'].'_report.php'?>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-link text-muted" data-dismiss="modal">취소</button>
        <button type="button" class="btn btn-link">접수하기</button>
      </div>
    </div>
  </div>
</div>






<script>

$( document ).ready(function() {


  $('#modal-post-listadd').on('show.bs.modal', function (e) {

  })

  $('#modal-post-report').on('show.bs.modal', function (e) {
    if (!memberid) {
      alert('로그인 해주세요.');
      return false;
    }
  })



});

</script>
