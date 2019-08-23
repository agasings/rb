<?php
if ($c) $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':''));
else $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':''));
?>

<section id="page-bbs-list" class="rb-bbs-list page center" data-role="bbs-list" data-snap-ignore="true">

  <header class="bar bar-nav bar-dark bg-primary p-x-0">

    <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>

    <a class="btn btn-link btn-nav pull-right p-x-1" data-href="/" data-text="홈으로 이동..">
      <span class="icon icon-home"></span>
    </a>

    <h1 class="title">
      <a data-href="<?php echo $g['bbs_reset'] ?>" data-text="새로고침..">
        <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
      </a>
    </h1>
  </header>

  <?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
  <nav class="bar bar-tab bar-light bg-faded px-0">
    <!-- 동적생성 -->
  </nav>
  <?php endif; ?>

  <main class="content rb-bbs-list" id="page-bbs-list" data-role="bbs-list">

    <div class="swiper-container">
      <div class="swiper-wrapper">

        <!-- 전체글 -->
        <div class="swiper-slide" id="swiper-allpost">
          <ul class="table-view my-0 border-top-0" data-role="allpost">
            <?php if ($cat || $keyword): ?>
            <li class="table-view-cell table-view-active text-muted">
              <i class="fa <?php echo $cat?'fa-folder-open-o':'fa-search' ?> fa-fw" aria-hidden="true"></i> <?php echo $cat ?> <?php echo $keyword ?> <small>(<?php echo $NUM ?>건)</small>
              <a class="btn btn-secondary js-btn-href" data-href="<?php echo $g['bbs_reset'] ?>" data-text="전체글 보기.."><i class="fa fa-history fa-lg" aria-hidden="true"></i></a>
            </li>
            <?php endif; ?>

            <?php if ($NUM): ?>
            <!-- 일반글 출력부 -->
            <?php foreach($RCD as $R):?>
            <?php $R['mobile']=isMobileConnect($R['agent'])?>
            <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?><?php echo $R['hidden']?' secret':'' ?>" id="item-<?php echo $R['uid']?>" data-plugin="markjs">
              <a data-title="<?php echo $B['name']?>"
                 data-toggle="page"
                 data-target="#page-bbs-view"
                 data-start="#page-bbs-list"
                 data-subject="<?php echo $R['subject']?>"
                 data-cat="<?php echo $R['category']?>"
                 data-url="<?php echo $g['bbs_view'].$R['uid']?>"
                 data-bid="<?php echo $B['id']?>"
                 data-uid="<?php echo $R['uid'] ?>" role="button">

                <?php if (!$R['depth']): ?>
                  <?php if ($d['theme']['media_object']=='1'): ?>
                  <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAvatarSrc($R['mbruid'],'84') ?>" width="42">
                  <?php elseif ($d['theme']['media_object']=='2'): ?>
                    <?php if (getUpImageSrc($R)): ?>
                      <img class="media-object pull-left bg-faded border" src="<?php echo getPreviewResize(getUpImageSrc($R),$d['theme']['thumb_size']) ?>" width="60" data-role="featured_img">
                    <?php endif; ?>
                  <?php else: ?>
                  <?php endif; ?>
                <?php else: ?>
                <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
                <?php endif; ?>

                <span class="badge badge-default badge-outline text-xs-center rounded">
                  <strong data-role="total_comment"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></strong><br>
                  <small>댓글</small>
                </span>
                <div class="media-body">

                  <span class="line-clamp-2">
                    <?php if(getNew($R['d_regis'],24)):?><span class="rb-new mr-1"></span><?php endif?>
                    <?php if($R['hidden']):?><span class="badge badge-default badge-inverted"><i class="fa fa-lock fa-lg"></i></span><?php endif?>
                    <span data-role="subject"><?php echo getStrCut($R['subject'],100,'')?></span>
                  </span>

                  <p>
                    <?php if($R['notice']):?><span class="badge badge-primary badge-outline">공지</span><?php endif?>
                    <span class="badge badge-default badge-inverted"><?php echo $R[$_HS['nametype']]?></span>
                    <?php if($R['category']):?><span class="badge badge-default badge-inverted"><i class="fa fa-folder-o fa-fw"></i> <?php echo $R['category']?></span><?php endif?>
                    <time class="badge badge-default badge-inverted" <?php echo $d['theme']['timeago']?'data-plugin="timeago"':'' ?> datetime="<?php echo getDateFormat($R['d_regis'],'c')?>">
                      <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                    </time>
                    <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
                    <span class="badge badge-default badge-inverted">좋아요 <?php echo $R['likes']?></span>
                    <?php if($R['upload']):?><span class="badge badge-default badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                  </p>
                </div>
              </a>
            </li>
            <?php endforeach?>

            <?php else: ?>
            <div class="rb-none" data-role="empty">
              <div class="text-xs-center">
                <div class="display-1">
                  <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                </div>
                <p>게시물이 없습니다.</p>
                <?php if ($keyword): ?><a data-href="<?php echo $g['bbs_reset'] ?>&type=search" class="btn btn-outline-primary btn-lg" data-text="전체글 보기">재검색</a><?php endif; ?>
                <?php if ($cat): ?><a data-href="<?php echo $g['bbs_reset'] ?>&type=category" class="btn btn-outline-primary btn-lg" data-text="전체글 보기">재탐색</a><?php endif; ?>
              </div>
            </div>
            <?php endif; ?>
          </ul>
        </div><!-- /.swiper-slide -->

        <!-- 공지 -->
        <?php if ($NUM_NOTICE): ?>
        <div class="swiper-slide">
          <ul class="table-view border-top-0 mt-0" data-role="notice">
            <?php foreach($NCD as $R):?>
            <?php $R['mobile']=isMobileConnect($R['agent'])?>
            <li class="table-view-cell<?php echo $R['depth']?' rb-reply rb-reply-0'.$R['depth']:'' ?><?php echo $R['hidden']?' secret':'' ?>" id="item-<?php echo $R['uid']?>">
              <a data-title="게시물 보기"
                 data-toggle="page"
                 data-target="#page-bbs-view"
                 data-start="#page-bbs-list"
                 data-subject="<?php echo $R['subject']?>"
                 data-cat="<?php echo $R['category']?>"
                 data-url="<?php echo $g['bbs_view'].$R['uid']?>"
                 data-bid="<?php echo $B['id']?>"
                 data-uid="<?php echo $R['uid'] ?>" role="button">
                <?php if (!$R['depth']): ?>
                  <?php if ($d['theme']['media_object']=='1'): ?>
                  <img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAvatarSrc($R['mbruid'],'84') ?>" width="42">
                  <?php elseif ($d['theme']['media_object']=='2'): ?>
                    <?php if (getUpImageSrc($R)): ?>
                      <img class="media-object pull-left bg-faded border" src="<?php echo getPreviewResize(getUpImageSrc($R),$d['theme']['thumb_size']) ?>" width="60" data-role="featured_img">
                    <?php endif; ?>
                  <?php else: ?>
                  <?php endif; ?>
                <?php else: ?>
                <span class="media-object pull-left"><span class="rb-icon fa fa-level-up fa-rotate-90"></span></span>
                <?php endif; ?>

                <span class="badge badge-default badge-outline text-xs-center rounded">
                  <strong data-role="total_comment"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></strong><br>
                  <small>댓글</small>
                </span>
                <div class="media-body">

                  <span class="line-clamp-2">
                    <?php if(getNew($R['d_regis'],24)):?><span class="rb-new mr-1"></span><?php endif?>
                    <?php if($R['hidden']):?><span class="badge badge-default badge-inverted"><i class="fa fa-lock fa-lg"></i></span><?php endif?>
                    <span data-role="subject"><?php echo getStrCut($R['subject'],100,'')?></span>
                  </span>

                  <p>
                    <?php if($R['notice']):?><span class="badge badge-primary badge-outline">공지</span><?php endif?>
                    <?php if($R['category']):?><span class="badge badge-default badge-inverted"><i class="fa fa-folder-o fa-fw"></i> <?php echo $R['category']?></span><?php endif?>
                    <time class="badge badge-default badge-inverted" <?php echo $d['theme']['timeago']?'data-plugin="timeago"':'' ?> datetime="<?php echo getDateFormat($R['d_regis'],'c')?>">
                      <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                    </time>
                    <span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
                    <span class="badge badge-default badge-inverted">좋아요 <?php echo $R['likes']?></span>
                    <?php if($R['upload']):?><span class="badge badge-default badge-inverted"><i class="fa fa-floppy-o"></i></span><?php endif?>
                  </p>
                </div>
              </a>
            </li>
            <?php endforeach?>
          </ul>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

        <!-- 분류 -->
        <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
        <div class="swiper-slide" data-hash="category">
          <ul class="table-view border-top-0 mt-0">
            <li class="table-view-divider"><?php echo $_catexp[0]?></li>
            <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
            <li class="table-view-cell">
              <a data-href="<?php echo $g['bbs_reset'] ?>&cat=<?php echo $_catexp[$i]?>" data-text="<?php echo $_catexp[$i]?> 분류">
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
          <form class="content-padded" name="bbssearchf" action="<?php echo $g['s']?>/">
            <input type="hidden" name="r" value="<?php echo $r?>">
            <input type="hidden" name="c" value="<?php echo $c?>">
            <input type="hidden" name="m" value="<?php echo $m?>">
            <input type="hidden" name="bid" value="<?php echo $bid?>">
            <input type="hidden" name="sort" value="<?php echo $sort?>">
            <input type="hidden" name="orderby" value="<?php echo $orderby?>">
            <input type="hidden" name="recnum" value="<?php echo $recnum?>">
            <input type="hidden" name="type" value="<?php echo $type?>">
            <input type="hidden" name="iframe" value="<?php echo $iframe?>">
            <input type="hidden" name="skin" value="<?php echo $skin?>">
            <input type="hidden" name="type" value="">

            <div class="form-group">
              <label class="sr-only">검색어</label>
              <input type="search" class="form-control" placeholder="검색어를 입력해주세요." name="keyword" value="<?php echo $_keyword?>" autocomplete="off">
            </div>

            <div class="form-group">
              <label class="sr-only">검색범위</label>
              <select class="form-control form-control-sm" name="where" style="width: 92%;height: 1.5rem;">
                <option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
                <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
                <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
                <option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
                <option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
              </select>
            </div>

          </form>
        </div><!-- /.swiper-slide -->
        <?php endif; ?>

      </div><!-- /.swiper-wrapper -->
    </div><!-- /.swiper-container -->
  </main>

</section>

<section id="page-bbs-view" class="page right" data-role="bbs-view">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-dark bg-primary p-x-0" data-scroll-header>
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
    <a href="#popover-bbs-view" data-toggle="popover" class="icon icon-more-vertical pull-right pl-2 pr-3" data-role="owner" data-url=""></a>
    <h1 class="title" data-role="title" data-history="back">
      <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
    </h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>
    </div>

    <div data-role="article">
      <div class="p-4 text-xs-center">다시 시도해주세요.</div>
    </div>

    <div data-role="attach">

      <!-- 유튜브 -->
      <div class="card-group mb-3 hidden" data-role="attach-youtube">
      </div>

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

<!-- 전체댓글보기 -->
<section id="page-bbs-allcomments" class="page right" data-role="bbs-comment">
  <div class="commentting-all"></div>
</section>

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

<!-- 댓글 출력관련  -->
<?php $d['bbs']['c_mskin_modal'] = '_mobile/rc-default'; ?>

<link href="<?php echo $g['url_root']?>/modules/comment/themes/<?php echo $d['bbs']['c_mskin_modal']?>/css/style.css<?php echo $g['wcache']?>" rel="stylesheet">
<script src="<?php echo $g['url_module_skin'] ?>/js/getPostData.js<?php echo $g['wcache']?>" ></script>

<script>

var settings={
  type    : 'page', // 타입(modal,page)
  mid     : '#page-bbs-view', // 컴포넌트 아이디
  ctheme  : '<?php echo $d['bbs']['c_mskin_modal']?>' //모달 댓글테마
}

getPostData(settings); // 모달 출력관련

<?php if ($NUM_NOTICE || $B['category'] || $d['theme']['search']): ?>
// 하단 tab(swiper)
var bar_tab_swiper = new Swiper('#page-bbs-list .swiper-container', {
  autoHeight: true,
  pagination: {
    el: '.rb-bbs-list .bar-tab',
    dynamicBullets: false,
    type: 'bullets',
    className : 'tab-swiper',
    bulletClass: 'tab-swiper',
    bulletActiveClass : 'active' ,
    clickable: true,
    renderBullet: function (index, className) {
      var title;
      var tab_allpost = '<span class="icon icon-list"></span><span class="tab-label">전체글</span>';
      var tab_category ='<span class="icon fa fa-folder-o"></span><span class="tab-label">분류</span>';
      var tab_notice = '<span class="icon icon-sound"></span><span class="tab-label">공지 <?php echo $NUM_NOTICE ?></span>';
      var tab_search = '<span class="icon icon-search"></span><span class="tab-label">검색</span>';



      <?php if (!$NUM_NOTICE && $B['category'] && !$d['theme']['search']): ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_category
      <?php elseif (!$NUM_NOTICE && !$B['category'] && $d['theme']['search']): ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_search
      <?php elseif (!$NUM_NOTICE && $B['category'] && $d['theme']['search']): ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_category
      if (index === 2) title = tab_search
      <?php elseif ($NUM_NOTICE && $B['category'] && !$d['theme']['search']): ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_notice
      if (index === 2) title = tab_category
      <?php elseif ($NUM_NOTICE && !$B['category'] && $d['theme']['search']): ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_notice
      if (index === 2) title = tab_search
      <?php else: ?>
      if (index === 0) title = tab_allpost
      if (index === 1) title = tab_notice
      if (index === 2) title = tab_category
      if (index === 3) title = tab_search
      <?php endif; ?>
      return '<a class="tab-item tab-swiper ' + className + '">'+title+'</a>';
    }
  },
  on: {
    init: function () {
      console.log('bar_tab_swiper init');
      <?php if($B['uid']):?>
      var btn_write = '<a class="tab-item" role="button" tabindex="0" href="#modal-bbs-write" data-toggle="modal" data-mod="new"><span class="icon icon-compose"></span><span class="tab-label">글쓰기</span></a>';
      <?php endif?>
      setTimeout(function(){ $('.rb-bbs-list .bar-tab').append(btn_write); }, 300);
    },
  }
});
<?php endif; ?>

$(document).ready(function() {

  // 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
  putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

  // marks.js
  $('[data-plugin="markjs"]').mark("<?php echo $keyword ?>");

  bar_tab_swiper.on('slideChange', function () {

    setTimeout(function(){
      var activeSlide = $('.swiper-slide-active').data('hash');
      if (activeSlide=='search') $('[name="keyword"]').focus();
    }, 300);

    if (bar_tab_swiper.activeIndex == 0) {
      $('.infinitescroll-end').removeClass("d-none");
      $('.infinitescroll-load').removeClass("d-none");
    } else {
      $('.infinitescroll-end').addClass("d-none");
      $('.infinitescroll-load').addClass("d-none");
    }
  });

  // 더보기(무한스크롤)
  var currentPage =1; // 처음엔 무조건 1, 아래 더보기 진행되면서 +1 증가
  var totalPage = '<?php echo $TPG?>';
  var totalNUM = '<?php echo $NUM?>';
  var bbs = '<?php echo $B['uid']?>';
  var sort = '<?php echo $sort?>';
  var orderby = '<?php echo $orderby?>';
  var recnum = '<?php echo $recnum?>';
  var bbs_view =  '<?php echo $g['bbs_view'] ?>';
  var prevNUM = currentPage * recnum;
  var moreNUM = totalNUM - prevNUM ;

  $('#page-bbs-list .content').infinitescroll({
    dataSource: function(helpers, callback){
      var nextPage = parseInt(currentPage)+1;
      if (totalPage>currentPage) {
        $.get(rooturl+'/?r='+raccount+'&m='+moduleid+'&a=get_moreList',{
            page : nextPage,
            bbs: bbs,
            sort: sort,
            orderby: orderby,
            recnum: recnum,
            bbs_view: bbs_view
        },function(response) {
            var result = $.parseJSON(response);
            var error = result.error;
            var content = result.content;
            if(error) alert(result.error_comment);
            callback({ content: content });
            var height = $('#swiper-allpost').height()
            $('.swiper-wrapper').height(height) //swiper 높이 재조정
            currentPage++; // 현재 페이지 +1
            console.log(currentPage+'페이지 불러옴')
            $('[data-plugin="timeago"]').timeago();
        });
      } else {
        callback({ end: true });
        console.log('더이상 불러올 페이지가 없습니다.')
      }
    },
    appendToEle : $('#swiper-allpost .table-view'),
    percentage : 95,  // 95% 아래로 스크롤할때 다움페이지 호출
    hybrid : false  // true: 버튼형, false: 자동
  });


})

</script>
