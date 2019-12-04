<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/foot.engine.php'?>

<!-- 포토모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','default-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','rc-photoswipe','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>

<!-- youtube iframe_api -->
<script src="https://www.youtube.com/player_api"></script>

<!-- 입력 textarea 자동확장 -->
<?php getImport('autosize','autosize.min','3.0.14','js')?>

<!-- pulltorefresh : https://github.com/BoxFactura/pulltorefresh.js-->
<?php getImport('pulltorefresh','index.umd.min','0.1.19','js')?>

<!-- jQuery-Autocomplete : https://github.com/devbridge/jQuery-Autocomplete -->
<?php getImport('jQuery-Autocomplete','jquery.autocomplete.min','1.3.0','js') ?>

<!-- jquery.shorten : https://github.com/viralpatel/jquery.shorten -->
<?php getImport('jquery.shorten','jquery.shorten.min','1.0','js')?>

<!-- moment -->
<?php getImport('moment','moment','2.22.2','js');?>
<?php getImport('moment-duration-format','moment-duration-format','2.2.2','js');?>

<!-- Chart.js : https://github.com/chartjs/Chart.js/  -->
<?php getImport('Chart.js','Chart','2.8.0','css') ?>
<?php getImport('Chart.js','Chart.bundle.min','2.8.0','js') ?>

<!-- 댓글출력시 필요 -->
<?php if ($mod!='write'): ?>
<?php getImport('ckeditor5','decoupled-document/build/ckeditor','12.2.0','js');  ?>
<?php getImport('ckeditor5','decoupled-document/build/translations/ko','12.2.0','js');  ?>
<?php endif; ?>
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>

<!-- 레이아웃 공용 스크립트 -->
<script src="<?php echo $g['url_layout']?>/_js/main.js<?php echo $g['wcache']?>"></script>

<?php if($_SERVER['HTTPS'] == 'on' && ($g['mobile']!='ipad' || $g['mobile']!='iphone') ):?>
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
