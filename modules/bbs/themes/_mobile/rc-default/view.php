<section id="page-bbs-view" class="page center" data-role="bbs-view" data-bid="<?php echo $bid?>" data-uid="<?php echo $uid?>">
	<header class="bar bar-nav bar-dark bg-primary px-0">
		<a class="btn btn-link btn-nav pull-left p-x-1" href="<?php echo RW(0)?>">
	    <span class="icon icon-home"></span>
	  </a>
		<?php if (!$my['uid']): ?>
		<a class="icon icon-person pull-right p-x-1" role="button" data-toggle="modal" href="#modal-login" data-title="로그인"></a>
		<?php endif; ?>
		<a class="title" data-href="<?php echo RW(0)?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
	</header>

	<div class="bar bar-standard bar-header-secondary bar-light bg-faded">
		<button class="btn btn-secondary pull-left js-btn-href" data-href="<?php echo $g['bbs_list']?>">
			목록
		</button>
	  <a class="title" data-href="<?php echo $g['bbs_list']?>">
			<?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
		</a>
	</div>

  <div class="content">

    <div class="clearfix content-padded">

      <div class="pull-xs-left">

        <div class="media" style="width:15rem">
          <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAvatarSrc($R['mbruid'],'84','') ?>" style="width:2.25rem;height:2.25rem" data-role="avatar">
          <div class="media-body rb-meta m-l-1">
            <span class="badge badge-default badge-inverted"><?php echo $R[$_HS['nametype']]?></span> <br>
            <span class="badge badge-default badge-inverted"><?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?></span>
            <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
          </div>
        </div>

      </div>

      <div class="pull-xs-right pt-1">
        <button type="button" class="btn btn-outline-secondary" data-toggle="move" data-target="[data-role='comment-box']" data-page="#page-bbs-view" data-role="btn_comment">
          <i class="fa fa-comment-o" aria-hidden="true"></i>
          <span data-role="total_comment" class="badge badge-default badge-inverted">
						<?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?>
					</span>
        </button>
      </div>

    </div><!-- /.clearfix -->
    <hr>
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted"><?php echo $R['category']?></span>
      <h3 class="rb-article-title"><?php echo $R['subject']?></h3>
    </div>
    <div data-role="article">

    </div>

    <div data-role="attach">

      <!-- 비디오 -->
      <div class="mb-3 hidden" data-role="attach-video">
      </div>

      <!-- 오디오 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-audio">
      </ul>

      <!-- 이미지 -->
      <div class="card-group mb-3 hidden" data-role="attach-photo" data-plugin="photoswipe">
      </div>

      <!-- 기타파일 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-file">
      </ul>
    </div>

    <!-- 댓글출력 -->
    <div data-role="bbs-comment"></div>

  </div>
</section>

<!-- Page : 게시물 사진 크게보기 -->
<section id="page-bbs-photo" class="page right" data-role="bbs-photo">
  <header class="bar bar-nav bar-dark bg-black px-0" style="opacity: 0.3;">
    <a class="icon icon-left-nav pull-left text-white p-x-1" role="button" data-history="back"></a>
   <h1 class="title" data-role="title" data-history="back"></h1>
  </header>
  <div class="bar bar-footer bar-dark bg-black text-muted" style="opacity: 0.3;">
    <span class="title"><small>이미지를 터치해서 확대해서 볼 수 있습니다.</small></span>
  </div>
  <div class="content bg-black py-0">
    <div class="d-flex" style="height:100vh">
      <div class="swiper-container align-self-center" style="height:100vh">
        <div class="swiper-wrapper">
          <div class="swiper-slide" style="height:100vh;overflow:hidden">
            <div class="swiper-zoom-container">
              <img src="">
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
</section>

<!-- Page : 게시물 좋아요한 사람 -->
<section id="page-bbs-opinion"  class="page right" data-role="bbs-opinion">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
    <a href="#popover-link-more" data-toggle="popover" class="icon icon-more-vertical pull-right pl-2 pr-3" data-role="owner" data-url=""></a>
    <h1 class="title title-left">좋아요한 사람</h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <h3 data-role="subject" class="rb-article-title line-clamp-3">게시물 제목</h3>
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
    </div>

    <div class="text-xs-center my-4">
      <button type="button" class="btn btn-outline-secondary btn-lg" data-send="ajax" data-toggle="opinion" data-uid="" data-opinion="like" data-effect="heartbeat" data-role="btn_post_like">
        <i class="fa fa fa-heart-o fa-fw fa-lg" aria-hidden="true"></i>
        <span data-role="likes_17351" class="badge badge-inverted"></span>
      </button>
    </div>

    <!-- 좋아요 목록 -->
    <ul class="table-view" data-role="list"></ul>

  </div>
</section>

<link href="<?php echo $g['url_root']?>/modules/comment/themes/<?php echo $d['bbs']['c_mskin']?>/css/style.css<?php echo $g['wcache']?>" rel="stylesheet">
<script src="<?php echo $g['url_module_skin'] ?>/_js/setBbsData.js<?php echo $g['wcache']?>" ></script>

<script>

	var settings={
	  bid      : '<?php echo $bid?>',
		uid      : '<?php echo $uid?>',
		markup   : 'view',
	  ctheme    : '<?php echo $d['bbs']['c_mskin']?>' // 댓글테마
	}

	setBbsData(settings); // 게시물 보기

</script>
