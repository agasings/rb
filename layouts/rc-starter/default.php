<!DOCTYPE html>
<html lang="ko">
<head>

<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>

<!-- snap 서랍형 사이드메뉴 -->
<?php getImport('snap','rc-snap','1.9.3','css')?>
<?php getImport('snap','rc-snap','1.9.3','js')?>

</head>
<body class="rb-layout-default">

	<div class="page center" id="page-main">
		<div class="snap-drawers">
			<div class="snap-drawer snap-drawer-left" id="drawer-left">
				<?php include $g['dir_layout'].'/_includes/drawer-left.php' ?>
			</div>
			<div class="snap-drawer snap-drawer-right bg-faded" id="drawer-right" data-role="page_cart">
				<?php include $g['dir_layout'].'/_includes/drawer-right.php' ?>
			</div>
		</div>

		<div class="snap-content" data-extension="drawer">

			<?php include $g['dir_layout'].'/_includes/header.php' ?>

			<main role="main" class="content bg-faded swiper-no-swiping-main" data-snap-ignore="true">

				<article class="animated fadeIn delay-1 ck-content" style="min-height:250px" role="article">
					<?php include __KIMS_CONTENT__ ?>
				</article>
				<?php include $g['dir_layout'].'/_includes/footer.php' ?>
			</main>

		</div><!-- /.snap-content -->
	</div><!-- /.page -->

	<?php include $g['dir_layout'].'/_includes/component.php' ?>
	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

	<script src="<?php echo $g['url_layout']?>/_js/component.js"></script>

	<script>
		$(function() {
			RC_initDrawer();  // 드로어 플러그인 초기화
		});
	</script>

</body>
</html>
