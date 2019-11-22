<script>

$( document ).ready(function() {

    getPostAll({
      wrapper : $('<?php echo $wdgvar['wrapper'] ?>'),
      start : '<?php echo $wdgvar['start'] ?>',
      markup    : 'post-row',  // 테마 > _html > post-row-***.html
      totalNUM  : '<?php echo $NUM?>',
      recnum    : <?php echo $wdgvar['recnum'] ?>,
      totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
      sort      : 'gid',
      none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
    })

});

</script>
