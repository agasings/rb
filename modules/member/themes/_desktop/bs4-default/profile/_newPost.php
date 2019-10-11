<?php
$wdgvar['limit'] = 3; //전체 출력수
$wdgvar['recnum'] =3; //한 열에 출력할 카드 갯수
$wdgvar['title'] ='최근 포스트';
$recnum = $wdgvar['recnum']; // 한 열에 출력할 카드 갯수
$totalCardRow=ceil($wdgvar['limit']/$recnum); // row 갯수
$total_card_num = $totalCardRow*$recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<section class="widget-post-card-01">
  <header class="d-flex justify-content-between align-items-center py-2">
    <strong><?php echo $wdgvar['title']?></strong>
    <?php if($wdgvar['link']):?>
    <a href="<?php echo $wdgvar['link']?>" class="muted-link small">
      더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <?php endif?>
  </header>

  <div class="row gutter-half" data-role="post-list">

    <?php
      $_RCD=getDbArray($table['postmember'],'mbruid='.$_MP['uid'],'*','gid','asc',$wdgvar['limit'],1);
      while($_R = db_fetch_array($_RCD)) $RCD[] = getDbData($table['postdata'],'gid='.$_R['gid'],'*');
      $i=0;foreach($RCD as $R):$i++;
    ?>

    <div class="col">
      <div class="card border-0" id="item-<?php echo $_R['uid'] ?>">

        <a class="text-nowrap text-truncate muted-link" href="<?php echo getPostLink($R,1) ?>">
          <img src="<?php echo getPreviewResize(getUpImageSrc($R),'320x180') ?>" alt="" class="card-img-top">
        </a>
        <div class="card-body py-3 px-0">
          <h6 class="card-title mb-0 line-clamp-2">
            <a class="muted-link" href="<?php echo getPostLink($R,1) ?>">
              <?php echo getStrCut($R['subject'],100,'..')?>
            </a>
          </h6>
          <time class="text-muted small" data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>"></time>
        </div>

      </div><!-- /.card -->
    </div><!-- /.col -->

    <?php
      $print_card_num++; // 카드 출력될 때마 1씩 증가
      $lack_card_num = $total_card_num - $print_card_num;
     ?>

    <?php if(!($i%$recnum)):?></div><div class="row gutter-half mt-3" data-role="post-list"><?php endif?>
    <?php endforeach?>

    <?php if($lack_card_num ):?>
      <?php for($j=0;$j<$lack_card_num;$j++):?>
       <div class="col"></div>
      <?php endfor?>
    <?php endif?>

  </div>  <!-- /.row -->
</section><!-- /.widget -->
