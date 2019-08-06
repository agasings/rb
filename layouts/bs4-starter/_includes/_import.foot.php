<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/foot.engine.php'?>

<!-- 포토모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','default-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','photoswipe.min','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>
<script src="<?php echo $g['url_layout']?>/_js/photoswipe.js"></script>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>

<!-- 소셜공유시 URL 클립보드저장 : clipboard.js  : https://github.com/zenorocha/clipboard.js-->
<?php getImport('clipboard','clipboard.min','2.0.4','js') ?>

<!-- 입력 textarea 자동확장 -->
<?php getImport('autosize','autosize.min','3.0.14','js')?>

<!-- timeago : 상대시간 표기 -->
<?php getImport('jquery-timeago','jquery.timeago',false,'js')?>
<?php getImport('jquery-timeago','locales/jquery.timeago.ko',false,'js')?>

<!-- 댓글출력시 필요 -->
<?php if ($g['broswer']!='MSIE 11' && $g['broswer']!='MSIE 10' && $g['broswer']!='MSIE 9'): ?>
  <?php if ($mod!='write'): ?>
  <?php getImport('ckeditor5','mobile-comment/build/ckeditor','12.2.0','js');  ?>
  <?php getImport('ckeditor5','mobile-comment/build/translations/ko','12.2.0','js');  ?>
  <script src="<?php echo $g['s'] ?>/plugins/ckeditor5/_main.js" ></script>
  <?php endif; ?>
  <script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>
<?php else: ?>
  <script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.old.js"></script>
<?php endif; ?>


<!-- 레이아웃 공용 스크립트 -->
<script src="<?php echo $g['url_layout']?>/_js/main.js<?php echo $g['wcache']?>"></script>

<?php if($_SERVER['HTTPS'] == 'on'):?>
<script>
if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('서비스워커와 푸시가 지원되는 브라우저 입니다.');
  window.addEventListener('load', () => {
   navigator.serviceWorker.register('<?php echo $g['s']?>/sw.js');
 });
} else {
  console.warn('푸시 메시징이 지원되지 않는 브라우저 입니다.');
}
</script>
<?php endif?>
