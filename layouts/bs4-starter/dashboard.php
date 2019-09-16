<?php
if (!$my['uid']) getLink('/','','','');
?>

<!DOCTYPE html>
<html lang="<?php echo $lang['xlayout']['lang']?>" class="h-100">
<head>
<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>
</head>
<body class="rb-layout-dashboard d-flex flex-column h-100 bg-light">

	<header style="z-index: 110;">
		<?php include $g['dir_layout'].'/_includes/header.php' ?>
	</header>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block sidebar bg-white d-print-none">

				<?php include $g['dir_layout'].'/_includes/sidebar.php' ?>

			</nav>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-0" style="padding-top: 56px">

				<!-- 알림수신을 위한 권한요청 (권한이 설정되지 않은 경우만 표시) -->
				<div class="alert alert-light mb-0 rounded-0 border-bottom" role="alert" id="permission_alert" style="display: none">
					<div class="d-flex justify-content-between">
						<p class="f13 mb-0">
							<i class="fa fa-bell fa-fw text-primary" aria-hidden="true"></i> 데스크탑 푸시알림을 수신하면 공지사항은 물론 회원님이 게시글에 대한 피드백 또는 내가 언급된 글에 대한 정보들을 실시간으로 받아보실 수 있습니다.
							<a href="#" class="alert-link" onclick="requestPermission()"><u>권한 설정</u></a>
						</p>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" title="나중에 하기">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
				<?php include __KIMS_CONTENT__ ?>

			</main>
		</div>


	</div>

  <script type="text/javascript">

  document.title = '대시보드 · <?php echo $my['nic'] ?> ';

  $('body').on('click','[data-act="newNoti"]',function(){
    var new_noti = getAjaxData('<?php echo $g['s']?>/?r=<?php echo $r?>&m=notification&a=notice_check&noticedata=Y');
    $("#rb-alert-desk .alert").alert('close')
    $("#rb-noti-timeline").prepend(new_noti)
    $(".navbar").find('.mail-status').removeClass('unread')
    $(".blankslate").addClass('d-none')
    document.title = '킴스큐';
    });

  </script>

	<?php include $g['dir_layout'].'/_includes/component.php' ?>
	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

</body>
</html>
