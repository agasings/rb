<?php
$orderby = 'desc';
$recnum = $wdgvar['line']; // 한 열에 출력할 카드 갯수
$totalCardRow=ceil($wdgvar['limit']/$recnum); // row 갯수
$total_card_num = $totalCardRow*$recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;

$query = 'site='.$s.' and ';
$_WHERE1= $query.'date >= '.date("Ymd", strtotime($wdgvar['term'])).' and '.$wdgvar['sort'].'>0';

if ($wdgvar['sort']=='hit') $_WHERE2= 'data,sum(hit) as hit';
if ($wdgvar['sort']=='likes') $_WHERE2= 'data,sum(likes) as likes';
if ($wdgvar['sort']=='comment') $_WHERE2= 'data,sum(comment) as comment';

$_RCD	= getDbSelect($table['postday'],$_WHERE1.' group by data order by '.$wdgvar['sort'].' '.$orderby.' limit 0,'.$wdgvar['limit'],$_WHERE2);
while($_R = db_fetch_array($_RCD)) $RCD[] = getDbData($table['postdata'],'uid='.$_R['data'],'*');
?>

<section class="widget widget-best-card mb-4">
  <header class="d-flex justify-content-between align-items-center mb-2">
    <div class="">

      <div class="media align-items-center">
        <i class="material-icons mr-2">emoji_objects</i>
        <div class="media-body">
          <h5 class="my-0">
            <?php echo $wdgvar['title']?>
            <small class="ml-2 text-muted f13"><?php echo $wdgvar['subtitle']?></small>
          </h5>
        </div>
      </div>

    </div>
    <div class="">
      <?php if($wdgvar['link']):?>
      <a href="<?php echo $wdgvar['link']?>" class="btn btn-white btn-sm">더보기</a>
      <?php endif?>
    </div>
  </header>

  <div class="card-deck">

    <?php $i=0;foreach($RCD as $R):$i++;?>
    <div class="card shadow-sm card-mask">
      <a href="<?php echo getPostLink($R,1) ?>" class="position-relative">
        <img src="<?php echo getPreviewResize(getUpImageSrc($R),'235x130') ?>" class="card-img-top" alt="...">
        <span class="position-absolute rank-icon active"><?php echo $i ?></span>
      </a>
      <div class="card-body pb-0 f14">
        <a href="<?php echo getPostLink($R,1) ?>" class="text-reset text-decoration-none line-clamp-2 mb-1"><?php echo$R['subject'] ?></a>
        <a href="<?php echo getProfileLink($R['mbruid']) ?>" class="d-block f13 text-muted text-decoration-none">
          <?php echo getProfileInfo($R['mbruid'],$_HS['nametype']) ?>
        </a>
      </div>
      <div class="card-footer border-top-0 bg-white py-1 px-3 d-flex justify-content-between">
        <div>
          <button type="button" class="btn btn-link text-muted px-1 text-decoration-none">
            <i class="material-icons align-text-bottom f20">thumb_up</i>
            <span class="ml-1 f13"><?php echo $R['likes'] ?></span>
          </button>
          <button type="button" class="btn btn-link text-muted px-1 text-decoration-none">
            <i class="material-icons align-text-bottom f20">visibility</i>
            <span class="ml-1 f13"><?php echo $R['hit'] ?></span>
          </button>
        </div>
        <div class="">
          <button type="button" class="btn btn-link text-muted px-1 text-decoration-none">
            <i class="material-icons align-text-bottom f20">comment</i>
            <span class="ml-1 f13"> <?php echo $R['comment'] ?></span>
          </button>
        </div>
      </div>
    </div><!-- /.card -->
    <?php
      $print_card_num++; // 카드 출력될 때마 1씩 증가
      $lack_card_num = $total_card_num - $print_card_num;
     ?>

    <?php if(!($i%$recnum)):?></div><div class="card-deck mt-3" data-role="post-list"><?php endif?>
    <?php endforeach?>

    <?php if($lack_card_num ):?>
      <?php for($j=0;$j<$lack_card_num;$j++):$i++;?>
       <div class="card border-0" style="background-color: transparent"></div>
       <?php if(!($i%$recnum)):?></div><div class="card-deck mt-3" data-role="post-list"><?php endif?>
      <?php endfor?>
    <?php endif?>

  </div><!-- /.card-deck -->

</section>
