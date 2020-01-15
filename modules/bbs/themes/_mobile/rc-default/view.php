<header class="bar bar-nav bar-light bg-white p-x-0">
  <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>
  <a class="icon icon-home pull-right p-x-1" data-href="/" data-text="홈으로 이동"  role="button"></a>
  <h1 class="title">
    <a data-href="<?php echo RW('m=bbs&bid='.$bid) ?>" data-text="이동중..">
      <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
    </a>
  </h1>
</header>

<main class="content">
  <div data-role="loader">
    <div class="d-flex justify-content-center align-items-center text-muted" style="height:90vh">
      <div class="spinner-border" role="status"></div>
    </div>
  </div>

  <div class="d-flex align-items-center text-muted" style="height:90vh">
    <div class="content-padded">
      <ul class="media-list">
        <li class="media mb-2" data-role="item" data-landing="true"
            data-target="#modal-bbs-view" id ="veiw-<?php echo $R['uid'] ?>"
            data-toggle="modal"
            data-subject="<?php echo $R['subject'] ?>"
            data-cat="<?php echo $R['category'] ?>"
            data-avatar="<?php echo getAvatarSrc($R['mbruid'],'84'); ?>"
            data-name="<?php echo $R['name'] ?>"
            data-hit="<?php echo $R['hit'] ?>"
            data-comment="<?php echo $R['comment'].($R['oneline']?'+'.$R['oneline']:'') ?>"
            data-likes="<?php echo $R['likes'] ?>"
            data-dregis="<?php echo  getDateFormat($R['d_regis'],$d['theme']['date_viewf']); ?>"
            data-bid="<?php echo $bid ?>" data-uid="<?php echo $R['uid'] ?>" role="button"
            data-url="<?php echo $g['bbs_view'].$R['uid'] ?>">

          <?php if ($R['featured_img']): ?>
          <div class="media-left">
            <div class="embed-responsive embed-responsive-16by9 bg-faded">
              <img class="media-object" src="<?php echo getPreviewResize(getUpImageSrc($R),'320x180'); ?>" alt="" data-role="featured" style="width:160px">
            </div>
          </div>
          <?php endif; ?>

          <div class="media-body pt-1">
            <h4 class="media-heading f15 line-clamp-3"><?php echo stripslashes($R['subject']) ?></h4>
            <ul class="list-inline f13 text-muted mt-1 mb-0">
              <li class="list-inline-item"><?php echo $M1[$_HS['nametype']] ?></li>
              <li class="list-inline-item">조회수 <?php echo number_format($R['hit'])?>회 </li>
              <li class="list-inline-item">댓글 <?php echo number_format($R['comment'])?> </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>

</main>

<script>


$( document ).ready(function() {

  var settings_view={
    type      : 'modal',
    mid       : '#modal-bbs-view', // 컴포넌트 아이디
    ctheme    : '<?php echo $d['bbs']['c_mskin']?>' //모달 댓글테마
  }

  getBbsData(settings_view); // 게시물 보기

  $('#veiw-<?php echo $R['uid'] ?>').click();
  setTimeout(function(){ $('[data-role="loader"]').addClass('d-none'); }, 1000);

});

</script>
