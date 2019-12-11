<div data-role="list"></div>

<div data-role="none" hidden>
  <div class="d-flex justify-content-center align-items-center" style="height: 70vh">
    <div class="text-xs-center" data-toggle="popup" data-target="#popup-post-newPost" data-title="새 포스트">
      <div class="material-icons mb-4" style="font-size: 100px;color:#ccc">
        subscriptions
      </div>
      <h5>나만의 유튜브를 시작합니다.</h5>
      <small class="text-muted">당신이 쉽게 선택해 볼 수 있는 나만의 마케팅 베이스캠프</small>
    </div>
  </div>
</div>

<script>

$( document ).ready(function() {

    getPostAll({
      wrapper : $('<?php echo $wdgvar['wrapper'] ?> [data-role="list"]'),
      start : '<?php echo $wdgvar['start'] ?>',
      markup    : 'post-row',  // 테마 > _html > post-row-***.html
      recnum    : <?php echo $wdgvar['recnum'] ?>,
      sort      : 'gid',
      none : $('<?php echo $wdgvar['wrapper'] ?>').find('[data-role="none"]').html(),
      paging : 'infinit'
    })

});

</script>
