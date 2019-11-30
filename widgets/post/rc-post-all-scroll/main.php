
<div data-role="list"></div>

<script>

$( document ).ready(function() {

    getPostAll({
      wrapper : $('<?php echo $wdgvar['wrapper'] ?> [data-role="list"]'),
      start : '<?php echo $wdgvar['start'] ?>',
      markup    : 'post-row',  // 테마 > _html > post-row-***.html
      recnum    : <?php echo $wdgvar['recnum'] ?>,
      sort      : 'gid',
      none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>',
      paging : 'infinit'
    })

});

</script>
