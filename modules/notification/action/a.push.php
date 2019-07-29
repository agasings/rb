<?php
include $g['path_module'].'notification/var/var.php';
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>PUSH</title>
<?php getImport('jquery','jquery.min','3.3.1','js')?>
</head>
<body>

	<script>
	function loadNotification() {

		<?php if($my['num_notice']):?>
			parent.$('[data-role="noti-status"]').text(<?php echo $my['num_notice']?>)
			<?php if ($browtitle): ?>
			parent.document.title = '(<?php echo $my['num_notice']?>) <?php echo $browtitle?>'
			<?php endif?>
		<?php else: ?>
			parent.document.title = '<?php echo $browtitle?>'
			parent.$('[data-role="noti-status"]').text('')
		<?php endif?>
		setTimeout("location.reload();",<?php echo $d['ntfc']['sec']?>000);
	}
	loadNotification();
	</script>

</body>
</html>
<?php
exit;
?>
