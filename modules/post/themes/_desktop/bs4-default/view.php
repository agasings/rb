<?php
$format_array = array('','doc','video','photo','card');  // 문서형,비디오형,포토갤러리형,카드형
include $g['dir_module_skin'].'_header.php';
include $g['dir_module_skin'].'view_'.$format_array[$R['format']].'.php';
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
