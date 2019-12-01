<header class="bar bar-nav bar-light bg-white pr-0 bar-top-shadow" data-snap-ignore="true" id="navMain">
  <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left pl-1 pr-3" role="button"></a>

  <?php if ($my['uid']): ?>
  <a role="button" data-toggle="modal" href="#modal-settings-general" data-title="설정" class="icon px-2 pr-3 pull-right" data-url="/settings">
    <img class="img-circle" data-role="avatar" src="<?php echo getAvatarSrc($my['uid'],'50') ?>" width="25">
  </a>
  <?php else: ?>
  <a role="button" data-toggle="modal" href="#modal-login" data-title="로그인" class="icon material-icons px-2 pr-3 pull-right">
    account_circle
  </a>
  <?php endif ?>
  <?php if($d['layout']['header_search']=='true'):?>
  <a class="icon material-icons pull-right px-2" role="button" data-toggle="modal" href="#modal-search" data-title="검색">search</a>
  <?php endif?>

  <?php if ($my['uid']): ?>
  <a role="button" data-toggle="popup" href="#popup-post-newPost" data-title="작업선택" class="icon material-icons px-2 pull-right">
    add_box
  </a>
  <?php endif; ?>

  <a class="title title-left strong" data-href="<?php echo RW(0)?>" data-text="새로고침" style="font-weight: 700;">
    <img src="<?php echo $g['img_layout'] ?>/logo-youtube.svg" alt="" style="width: 29px;vertical-align:text-bottom" class="mr-1">
    <?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
  </a>
</header>

<nav class="bar bar-tab bg-faded bg-white shadow" data-snap-ignore="true">
  <a class="tab-item active" role="button" data-tab="tab-main">
    <span class="icon material-icons">house</span>
    <span class="tab-label">홈</span>
  </a>
  <a class="tab-item" role="button" data-tab="tab-best" data-sort="hit" data-d_start="<?php echo date("Ymd", strtotime("-1 week")) ?>">
    <span class="icon material-icons">whatshot</span>
    <span class="tab-label">인기</span>
  </a>
  <a class="tab-item" role="button" data-tab="tab-feed">
    <span class="icon material-icons">subscriptions</span>
    <span class="tab-label">구독</span>
  </a>
  <a class="tab-item" role="button" data-tab="tab-noti">
    <span class="icon material-icons">notifications</span>
    <span class="tab-label">알림</span>
    <span class="badge badge-pill badge-primary noti-status" data-role="noti-status"><?php echo $my['num_notice']==0?'':$my['num_notice']?></span>
  </a>
  <a class="tab-item" role="button" data-tab="tab-libary">
    <span class="icon material-icons">video_library</span>
    <span class="tab-label text-muted">보관함</span>
  </a>
</nav>
