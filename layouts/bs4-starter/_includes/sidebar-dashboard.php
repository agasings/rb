<section class="p-3">

  <div class="text-reset text-center">

    <a href="/<?php echo $my['id'] ?>" class="d-inline-block mb-2">
      <img src="<?php echo getAvatarSrc($my['uid'],'60') ?>" width="60" height="60" alt="" class="rounded-circle border">
    </a>

    <span class="d-block h3 contrib-number"><span id="myPoint"><?php echo number_format($my['point'])?></span>  <i class="fa fa-product-hunt" aria-hidden="true"></i></span>
    <a href="" data-toggle="modal" class="badge badge-pill badge-light mt-2 text-gray"><?php echo $g['grade']['m'.$my['level']]?></a>


  </div>

</section>


<div class="list-group list-group-flush border-bottom">
  <a href="<?php echo RW('mod=dashboard')?>" class="list-group-item list-group-item-action<?php echo $page=='main'?' active':'' ?>">
    대시보드
  </a>
  <a href="<?php echo RW('mod=dashboard&page=post')?>" class="list-group-item list-group-item-action<?php echo $page=='post'?' active':'' ?>">
    포스트
  </a>
  <a href="<?php echo RW('mod=dashboard&page=postlist')?>" class="list-group-item list-group-item-action<?php echo $page=='postlist'?' active':'' ?>">
    리스트
  </a>
  <a href="<?php echo RW('mod=dashboard&page=noti')?>" class="list-group-item list-group-item-action<?php echo $page=='noti'?' active':'' ?>">
    알림내역
  </a>

  <a href="<?php echo RW('mod=dashboard&page=saved')?>" class="list-group-item list-group-item-action<?php echo $page=='saved'?' active':'' ?>">
    저장내역
  </a>

  <a href="<?php echo RW('mod=dashboard&page=order')?>" class="list-group-item list-group-item-action<?php echo $page=='order'?' active':'' ?>">
    구매내역
  </a>
</div>
