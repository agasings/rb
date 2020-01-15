<section id="page-bbs-list" class="page center" data-role="bbs-list" data-snap-ignore="true">

  <header class="bar bar-nav bar-light bg-white p-x-0">
    <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>
    <a href="#popover-bbs-listMarkup" data-toggle="popover" data-bid="<?php echo $bid ?>" class="icon icon-more-vertical pull-right pl-2 pr-3"></a>
    <h1 class="title">
      <a data-location="reload" data-text="새로고침..">
        <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
      </a>
    </h1>
  </header>

  <?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
  <nav class="bar bar-tab bar-light bg-white px-0 shadow-sm swiper-pagination-clickable swiper-pagination-bullets">
    <a class="tab-item active" role="button" data-act="reset" data-role="list">
      <span class="icon icon-list"></span>
      <span class="tab-label">목록</span>
    </a>

    <?php if ($B['category']): ?>
    <a class="tab-item" href="#modal-bbs-category" data-toggle="modal" data-role="category" role="button">
      <span class="icon fa fa-folder-o"></span>
      <span class="tab-label">분류</span>
    </a>
    <?php endif; ?>

    <a class="tab-item" href="#modal-bbs-search" data-toggle="modal" data-title="<?php echo $B['name'] ?>" data-role="search" role="button">
      <span class="icon icon-search"></span>
      <span class="tab-label">검색</span>
    </a>
    <a class="tab-item" href="#modal-bbs-write" data-toggle="modal" data-mod="new" data-url="<?php echo $g['bbs_write']?>" role="button">
      <span class="icon icon-compose"></span>
      <span class="tab-label">쓰기</span>
    </a>
  </nav>
  <?php endif; ?>

  <main class="content bg-white" data-role="bbs-list"></main>

</section>

<!-- Page : 게시물 보기 -->
<section id="page-bbs-view" class="page right" data-role="bbs-view">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  
  <header class="bar bar-nav bar-light bg-white p-x-0" data-scroll-header>
    <a class="icon pull-left material-icons px-3" role="button" data-history="back" data-role="hback">arrow_back</a>
    <a href="#popover-bbs-view" data-toggle="popover" class="icon icon-more-vertical pull-right pl-2 pr-3" data-role="owner" data-url=""></a>
    <a class="icon material-icons pull-right px-3 mirror" id="btn-linkShare" data-role="linkShare">reply</a>
  </header>

  <main class="content">

    <div class="clearfix content-padded">

      <div class="pull-xs-left">

        <div class="media" style="width:15rem"
          data-mbruid=""
          data-toggle="page"
          data-target="#page-member-profile"
          data-start="#page-bbs-view">
          <img class="media-object pull-left rb-avatar img-circle bg-faded" src="" style="width:2.25rem;height:2.25rem" data-role="avatar">
          <div class="media-body rb-meta m-l-1">
            <span class="badge badge-default badge-inverted" data-role="name"></span> <br>
            <span class="badge badge-default badge-inverted" data-role="d_regis"></span>
            <span class="badge badge-default badge-inverted">조회 <span data-role="hit"></span></span>
          </div>
        </div>

      </div>

      <div class="pull-xs-right pt-1">
        <button type="button" class="btn btn-outline-secondary"
          data-toggle="move"
          data-target="[data-role='comment-box']"
          data-page="#page-bbs-view" data-role="btn_comment">
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
    <div data-role="article" data-plugin="photoswipe">
      <div class="p-4 text-xs-center">다시 시도해주세요.</div>
    </div>

    <!-- 댓글출력 -->
    <div data-role="comment"></div>

  </main>
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
      <h3 data-role="subject" class="rb-article-title line-clamp-3"></h3>
      <span data-role="cat" class="badge badge-primary badge-inverted"></span>
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

  $( document ).ready(function() {

    getBbsList(settings_list,category,keyword); // 목록 셋팅
    getBbsData(settings_view); // 게시물 보기

  });


</script>
