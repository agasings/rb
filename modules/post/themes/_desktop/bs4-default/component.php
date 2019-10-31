<div class="modal" id="modal-post-share" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
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
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">저장하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-2" style="min-height: 200px">
        <?php if ($my['uid']) include $g['dir_module_skin'].'_listadd.php'?>
      </div>
      <div class="modal-footer py-2 f13">
        <button type="button" class="btn btn-link mr-auto text-reset text-decoration-none">
          <i class="material-icons text-muted align-bottom mr-1">add</i>
          새 리스트 만들기
        </button>
        <button type="button" class="btn btn-link" data-act="submit">
          <span class="not-loading">
            저장하기
          </span>
          <span class="is-loading">
            <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
            저장중...
          </span>
        </button>

      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal-post-report" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">신고하기</h5>
      </div>
      <div class="modal-body" style="min-height: 200px">
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
    var modal = $(this);
    var button = $(e.relatedTarget);
    var uid =  button.attr('data-uid');
    var submit = modal.find('[data-act="submit"]')
    modal.attr('data-uid',uid);
    submit.attr('disabled',false );

  })

  $('#modal-post-listadd').find('[data-act="submit"]').click(function(){
    var modal = $('#modal-post-listadd');
    var uid = modal.attr('data-uid');

    // 리스트 체크
    var list_sel=$('input[name="postlist_members[]"]');
    var list_arr=$('input[name="postlist_members[]"]:checked').map(function(){return $(this).val();}).get();
    var list_n=list_arr.length;
    var list_members='';
    for (var i=0;i <list_n;i++) {
      if(list_arr[i]!='')  list_members += '['+list_arr[i]+']';
    }

    $(this).attr('disabled',true );

    setTimeout(function(){
      $.post(rooturl+'/?r='+raccount+'&m=post&a=update_listindex',{
        uid : uid,
        list_members : list_members
        },function(response,status){
          if(status=='success'){
            modal.modal('hide');
            $.notify({message: '리스트에 저장되었습니다.'},{type: 'default'});
          } else {
            alert(status);
          }
      });
    }, 500);

  });

  $('#modal-post-report').on('show.bs.modal', function (e) {
    if (!memberid) {
      alert('로그인 해주세요.');
      return false;
    }
  })

});

</script>
