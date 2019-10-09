<?php
$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$levelname= getDbData($table['s_mbrlevel'],'uid='.$my['level'],'*');
?>

<section class="pt-4 px-3">
  <div class="text-reset text-center">
    <a href="<?php echo getProfileLink($my['uid'])?>" class="d-inline-block">
      <img src="<?php echo getAvatarSrc($my['uid'],'60') ?>" width="60" height="60" alt="" class="rounded-circle border">
    </a>
    <span class="d-block f16 mt-2">
      <?php echo $my['nic'] ?>
    </span>
  </div>

  <ul class="nav flex-column mt-3 py-3 border-top">
    <li class="nav-item">
      <a class="nav-link d-flex justify-content-between py-1 px-2 f13 text-reset" href="<?php echo RW('mod=dashboard&page=point')?>">
        <span>포인트</span>
        <span>
          <strong class="text-danger"><?php echo number_format($my['point'])?> </strong> P
          <i class="fa fa-angle-right text-muted ml-2" aria-hidden="true"></i>
        </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex justify-content-between py-1 px-2 f13 text-reset" href="<?php echo RW('mod=dashboard&page=point')?>">
        <span>등급</span>
        <span>
          <?php echo $levelname['name']?>
          <small>(<?php echo $my['level']?>/<?php echo $levelnum['uid']?>)</small>
          <i class="fa fa-angle-right text-muted ml-2" aria-hidden="true"></i>
        </span>
      </a>
    </li>
  </ul>

</section>



<ul class="nav nav-menu flex-column border-bottom">
  <li class="nav-item<?php echo $page=='main'?' active':'' ?>">
    <a class="nav-link" href="<?php echo RW('mod=dashboard')?>">대시보드</a>
  </li>
  <li class="nav-item<?php echo $page=='post' || $page=='list'?' active':'' ?>">
    <a class="nav-link d-flex justify-content-between align-items-center" href="<?php echo RW('mod=dashboard&page=post')?>">
      포스트
      <i class="fa fa-plus mr-4" aria-hidden="true"></i>
    </a>
    <ul class="nav flex-column">
      <li class="nav-item<?php echo $page=='post'?' active':'' ?>">
        <a class="nav-link" href="<?php echo RW('mod=dashboard&page=post')?>">포스트</a>
      </li>
      <li class="nav-item<?php echo $page=='list'?' active':'' ?>">
        <a class="nav-link" href="<?php echo RW('mod=dashboard&page=list')?>">리스트</a>
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
    <a class="nav-link" href="<?php echo RW('mod=dashboard&page=order')?>">구매내역 <span class="badge badge-pill badge-light">준비중</span></a>
  </li>
</ul>
