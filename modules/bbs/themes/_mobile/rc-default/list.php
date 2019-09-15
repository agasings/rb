<script>$.loader({ text: "목록 구성중..." });</script>

<section id="page-bbs-list" class="page center" data-role="bbs-list" data-snap-ignore="true">

  <header class="bar bar-nav bar-dark bg-primary p-x-0">

    <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>
    <a href="#popover-bbs-listMarkup" data-toggle="popover" data-bid="<?php echo $bid ?>" class="icon icon-more-vertical pull-right pl-2 pr-3">
    </a>

    <h1 class="title">
      <a data-location="reload" data-text="새로고침..">
        <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
      </a>
    </h1>
  </header>

  <?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
  <nav class="bar bar-tab bar-light bg-white px-0 shadow-sm">
    <!-- 동적생성 -->
  </nav>
  <?php endif; ?>

  <main class="content bg-faded" data-role="bbs-list">
    <div class="swiper-container">
      <div class="swiper-wrapper">

        <!-- 전체글 -->
        <div class="swiper-slide" id="swiper-post" data-hash="post">
          <div data-pullToRefresh="true" data-role="post"></div>
        </div><!-- /.swiper-slide -->

        <!-- 공지 -->
        <?php if ($NUM_NOTICE): ?>
        <div class="swiper-slide" data-hash="notice">
          <ul class="table-view mb-0 border-bottom-0"><li class="table-view-divider text-muted">공지사항</li></ul>
          <div data-role="notice"></div>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

        <!-- 분류 -->
        <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
        <div class="swiper-slide" data-hash="category">
          <ul class="table-view bg-white border-top-0 mt-0">
            <li class="table-view-divider"><?php echo $_catexp[0]?></li>
            <li class="table-view-cell">
              <a data-act="reset" data-text="전체글 보기..">
                <span class="badge badge-pill"><?php echo $NUM ?></span>
                <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> 전체
              </a>
            </li>
            <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
            <li class="table-view-cell">
              <a data-act="category" data-cat="<?php echo $_catexp[$i]?>" data-text="<?php echo $_catexp[$i]?> 분류">
                <i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> <?php echo $_catexp[$i]?>
                <?php if($d['theme']['show_catnum']):?>
                <span class="badge badge-pill"><?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?></span>
                <?php endif?>
              </a>
            </li>
            <?php endfor?>
          </ul>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

        <!-- 검색 -->
        <?php if($d['theme']['search']):?>
        <div class="swiper-slide" data-hash="search">
          <form class="content-padded" data-role="search">

            <div class="form-group">
              <label class="sr-only">검색어</label>
              <input type="search" class="form-control" placeholder="검색어를 입력해주세요." name="keyword" value="" autocomplete="off" required>
            </div>

            <div class="form-group">
              <label class="sr-only">검색범위</label>
              <select class="form-control form-control-sm" name="where" style="width: 92%;height: 1.5rem;">
                <option value="subject|tag">제목+태그</option>
                <option value="content">본문</option>
                <option value="name">이름</option>
                <option value="nic">닉네임</option>
                <option value="id">아이디</option>
              </select>
            </div>

          </form>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

      </div><!-- /.swiper-wrapper -->
    </div><!-- /.swiper-container -->
  </main>

</section>

<!-- Page : 게시물 보기 -->
<section id="page-bbs-view" class="page right" data-role="bbs-view">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-light bg-white p-x-0" data-scroll-header>
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>

    <a href="#popover-bbs-view" data-toggle="popover" class="icon icon-more-vertical pull-right pl-2 pr-3" data-role="owner" data-url=""></a>

    <a class="btn-nav pull-right icon px-3" id="btn-linkShare"
      data-role="linkShare"
      data-subject="{$subject}"
      data-url=""
      data-likes="{$likes}"
      data-image="{$featured_img}"
      data-desc="">
      <i class="fa fa-share" aria-hidden="true"></i>
    </a>

  </header>
  <div class="content">

    <div class="clearfix content-padded">

      <div class="pull-xs-left">

        <div class="media" style="width:15rem">
          <img class="media-object pull-left rb-avatar img-circle bg-faded" src="" style="width:2.25rem;height:2.25rem" data-role="avatar">
          <div class="media-body rb-meta m-l-1">
            <span class="badge badge-default badge-inverted" data-role="name"></span> <br>
            <span class="badge badge-default badge-inverted" data-role="d_regis"></span>
            <span class="badge badge-default badge-inverted">조회 <span data-role="hit"></span></span>
          </div>
        </div>

      </div>

      <div class="pull-xs-right pt-1">
        <button type="button" class="btn btn-outline-secondary" data-toggle="move" data-target="[data-role='comment-box']" data-page="#page-bbs-view" data-role="btn_comment">
          <i class="fa fa-comment-o" aria-hidden="true"></i>
          <span data-role="total_comment" class="badge badge-default badge-inverted"></span>
        </button>
      </div>

    </div><!-- /.clearfix -->
    <hr>
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted"></span>
      <h3 data-role="subject" class="rb-article-title"></h3>
    </div>
    <div data-role="article">
      <div class="p-4 text-xs-center">다시 시도해주세요.</div>
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
<script src="<?php echo $g['url_module_skin'] ?>/_js/list.js<?php echo $g['wcache']?>" ></script>
<script src="<?php echo $g['url_module_skin'] ?>/_js/getBbsList.js<?php echo $g['wcache']?>" ></script>
<script src="<?php echo $g['url_module_skin'] ?>/_js/getBbsData.js<?php echo $g['wcache']?>" ></script>

<script>

  var bid = '<?php echo $bid?>';
  var theme_listMarkup = '<?php echo $d['theme']['listMarkup'] ?>';

  // 목록 마크업 (listMarkup)
  var local_listMarkup = localStorage.getItem('bbs-'+bid+'-listMarkup');

  if (local_listMarkup) {
    var listMarkup = local_listMarkup;
  } else {
    var listMarkup = theme_listMarkup;
    localStorage.setItem('bbs-'+bid+'-listMarkup', theme_listMarkup);
  }

  var settings_list={
    bid       :  bid, // 게시판 아이디
    recnum    : <?php echo $recnum ?>,
    totalPage : '<?php echo $TPG?>',
    totalNUM  : '<?php echo $NUM?>',
    sort      : 'gid',
    orderby   : 'asc',
    markup    : listMarkup
  }

  var settings_view={
    type      : 'page', // 타입(modal,page)
    mid       : '#page-bbs-view', // 컴포넌트 아이디
    ctheme    : '<?php echo $d['bbs']['c_mskin']?>' //모달 댓글테마
  }

  var category     = '';
  var keyword      = '';
  var bid          = bid;
  var num_notice   = <?php echo $NUM_NOTICE ?>;
  var b_category   = '<?php echo $B['category'] ?>';
  var theme_search = '<?php echo $d['theme']['search'] ?>';

  // 하단 tab(swiper)
  if ( bid || b_category || b_category || theme_search ) {
    setBbsTab(bid,num_notice,b_category,theme_search);
  }

  getBbsList(settings_list,category,keyword); // 목록 셋팅
  getBbsData(settings_view); // 게시물 보기


</script>
