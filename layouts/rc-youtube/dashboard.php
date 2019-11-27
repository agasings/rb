<?php
if (!$my['uid']) getLink('/','','','');
?>

<!DOCTYPE html>
<html lang="ko">
<head>

<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>

<!-- snap 서랍형 사이드메뉴 -->
<?php getImport('snap','rc-snap','1.9.3','css')?>
<?php getImport('snap','rc-snap','1.9.3','js')?>

</head>
<body class="rb-layout-dashboard">

	<?php include __KIMS_CONTENT__ ?>

	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>
	<?php include $g['dir_layout'].'/_includes/component.php' ?>

	<script src="<?php echo $g['url_layout']?>/_js/dashboard.js<?php echo $g['wcache']?>"></script>

</body>
</html>
