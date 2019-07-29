<header class="bar bar-nav bar-dark bg-primary px-0" data-snap-ignore="true">
  <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>
  <a class="icon fa fa-bell-o pull-right p-r-1 pl-1" role="button" data-toggle="drawer" href="#drawer-right" data-direction="right" data-showType="expand" data-history="true">
    <span class="badge badge-pill badge-danger noti-status" data-role="noti-status"><?php echo $my['num_notice']==0?'':$my['num_notice']?></span>
  </a>

  <?php if($d['layout']['header_search']=='true'):?>
  <a class="icon icon-search pull-right px-1" role="button" data-toggle="modal" href="#modal-search" data-title="검색"></a>
  <?php endif?>

  <a class="title" href="<?php echo RW(0)?>">
    <?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
  </a>
</header>
