<?php
include $g['dir_module_skin'].'_header.php';
$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');
include $g['dir_module_skin'].'view_'.$formats[$R['format']].'.php';
include $g['dir_module_skin'].'_footer.php'
?>

<script>

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

$( document ).ready(function() {

	$('[data-toggle="print"]').click(function() {
	  window.print()
	});

	$('[data-toggle="actionIframe"]').click(function() {
	  getIframeForAction('');
	  frames.__iframe_for_action__.location.href = $(this).attr("data-url");
	});

});

</script>
