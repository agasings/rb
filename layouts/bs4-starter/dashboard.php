<?php
if (!$my['uid']) getLink('/','','','');
?>

<!DOCTYPE html>
<html lang="<?php echo $lang['xlayout']['lang']?>" class="h-100">
<head>
<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>
</head>
<body class="rb-layout-dashboard d-flex flex-column h-100<?php echo $page=='main'?' bg-light':'' ?>" style="padding-top:67px">

	<nav class="navbar fixed-top navbar-expand navbar-light bg-white border-bottom">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php  echo RW(0) ?>">
				<?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
				<span class="font-weight-light">대시보드</span>
			</a>

			<div class="">

				<?php if($d['layout']['header_login']=='true'):?>
				<ul class="navbar-nav">
				<?php if ($my['uid']): ?>
					<li class="nav-item dropdown js-tooltip mr-2" title="알림" id="navbarPopoverNoti">
						<a class="nav-link notification-indicator" href="/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="badge badge-danger noti-status" data-role="noti-status"><?php echo $my['num_notice']==0?'':$my['num_notice']?></span>
							<strong>새 알림</strong>
						</a>
						<div class="dropdown-menu dropdown-menu-right py-0" >

							<h6 class="dropdown-header d-flex justify-content-between align-items-center py-2 f13">
								<strong>새 알림</strong>
								<ul class="list-inline small">
									<li class="list-inline-item">
										<span role="presentation" aria-hidden="true"> · </span>
										<a href="/?r=<?php echo $r ?>&mod=settings&page=noti" class="muted-link">설정</a>
									</li>
								</ul>
							</h6>

							<div class="list-group list-group-flush" data-role="noti-list" style="max-height: 435px;overflow: auto;">
								<!-- 드롭다운이 열릴때, 여기에 알림정보를 받아옴 -->
							</div><!-- /.list-group -->

							<a class="btn btn-block btn-link muted-link f13 py-2 border-top" href="<?php echo RW('mod=noti')?>">모두보기</a>

						</div><!-- /.dropdown-menu -->
					</li>
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-role="tooltip" title="프로필보기 및 회원계정관리">
							<?php echo $my['email'] ?>
					  </a>
					  <div class="dropdown-menu dropdown-menu-right">
					    <h6 class="dropdown-header"><?php echo $my['nic'] ?> 님</h6>
							<div class="dropdown-divider"></div>
							<h6 class="dropdown-header">포스트</h6>
							<a class="dropdown-item" href="<?php echo RW('m=post&mod=write')?>">
								<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> 새 포스트
							</a>

							<button class="dropdown-item" type="button" data-act="logout" role="button">
								<i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> 로그아웃
							</button>
							<?php if ($my['admin']): ?>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item text-danger" href="/?m=admin&pickmodule=site&panel=Y" target="_top">관리자모드</a>
							<?php endif; ?>
					  </div>
					</li>
					<?php else: ?>
					<li class="nav-item">
						<a class="nav-link" href="#modal-join" data-toggle="modal" data-backdrop="static">회원가입</a>
					</li>
					<li class="nav-item position-relative" id="navbarPopoverLogin">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="드롭다운형 로그인">
							로그인
						</a>
					</li>

					<?php endif; ?>
		    </ul>
				<?php endif?>
			</div>
		</div><!-- /.container -->
	</nav>

	<nav class="sidebar d-print-none">
		<?php include $g['dir_layout'].'/_includes/sidebar-dashboard.php' ?>
	</nav>

	<main role="main">

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
