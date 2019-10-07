<section class="p-3">
  <div class="text-reset text-center">
    <a href="<?php echo getProfileLink($my['uid'])?>" class="d-inline-block">
      <img src="<?php echo getAvatarSrc($my['uid'],'60') ?>" width="60" height="60" alt="" class="rounded-circle border">
    </a>
    <span class="d-block f16 mt-2">
      <?php echo $my['nic'] ?>
    </span>
  </div>
</section>

<ul class="nav flex-column border-bottom">
  <li class="nav-item<?php echo $page=='main'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard')?>">대시보드</a>
  </li>
  <li class="nav-item<?php echo $page=='post' || $page=='postlist'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=post')?>">포스트</a>
    <ul class="nav flex-column">
      <li class="nav-item<?php echo $page=='post'?' active':'' ?>">
        <a class="nav-link" href="<?php echo RW('mod=dashboard&page=post')?>">포스트</a>
      </li>
      <li class="nav-item<?php echo $page=='postlist'?' active':'' ?>">
        <a class="nav-link" href="<?php echo RW('mod=dashboard&page=postlist')?>">리스트</a>
      </li>
    </ul>
  </li>
  <li class="nav-item<?php echo $page=='noti'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=noti')?>">알림내역</a>
  </li>
  <li class="nav-item<?php echo $page=='saved'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=saved')?>">저장내역</a>
  </li>
  <li class="nav-item<?php echo $page=='point'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=point')?>">포인트내역</a>
  </li>
  <li class="nav-item<?php echo $page=='order'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=order')?>">구매내역</a>
  </li>
</ul>
