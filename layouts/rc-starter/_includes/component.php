<!-- 컴포넌트 모음 -->

<!-- 회원가입 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/join/component.php'; ?>

<!-- 로그인 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/login/component.php';  ?>

<!-- 알림 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/noti/component.php';  ?>

<!-- 설정 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/settings/component.php';  ?>

<!-- 프로필 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/profile/component.php';  ?>

<!-- 포스트 -->
<?php include_once $g['path_module'].'post/themes/'.$d['post']['skin_mobile'].'/component.php';  ?>

<!-- 게시판 -->
<?php include_once $g['path_module'].'bbs/themes/'.$d['bbs']['skin_mobile'].'/component.php';  ?>

<!-- 댓글 -->
<?php include_once $g['path_module'].'comment/themes/'.$d['comment']['skin_mobile'].'/component.php';  ?>

<!-- 사이트 페이지 -->
<div class="page right" id="page-site-page">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
  	<a class="icon material-icons pull-right px-3 mirror" role="button" data-toggle="popup" data-target="#popup-link-share" data-url>reply</a>
    <h1 class="title title-left" data-role="title" data-history="back"></h1>
  </header>
  <main role="main" class="content bg-white">
    <div data-role="main" class="content-padded"></div>
  </main>
</div>

<!-- 통합검색 -->
<div id="modal-search" class="modal zoom">
	<header class="bar bar-nav bg-white p-2">
	  <form class="input-group input-group-lg border border-primary" action="<?php echo $g['s']?>/" id="modal-search-form">
			<input type="hidden" name="r" value="<?php echo $r?>">
	    <input type="hidden" name="m" value="search">
	    <input type="search" name="keyword" class="form-control bg-white" placeholder="검색어 입력" id="search-input" required autocomplete="off">
			<span class="input-group-btn hidden" data-role="keyword-reset" >
	      <button class="btn btn-link pr-2" type="button" data-act="keyword-reset" tabindex="-1">
	        <i class="fa fa-times-circle" aria-hidden="true"></i>
	      </button>
	    </span>
			<span class="input-group-btn">
			  <button class="btn btn-link text-primary" type="submit" id="modal-search-submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
	  </form>
	</header>
	<nav class="bar bar-tab bar-light bg-faded bg-white">
	  <a class="tab-item" role="button" data-history="back">
	    취소
	  </a>
	</nav>

	<main class="content bg-faded">
		<div class="content-padded">

		</div>
	</main>
</div><!-- /.modal -->

<!-- 레이아웃 위젯탐색기 -->
<div id="modal-widget-selector" class="modal">
  <header class="bar bar-nav bar-light bg-white">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title">위젯 탐색기</h1>
  </header>
  <div class="content">
    <p class="content-padded">
      <?php echo $d['layout']['dir'] ?>
    </p>
  </div>
</div>

<!-- 포토모달 : 갤러리형 -->
<div class="pswp pswp-gallery" tabindex="-1" role="dialog" aria-hidden="true">
	<input type="hidden" name="uid" value="">
  <input type="hidden" name="bid" value="">

  <!-- Background of PhotoSwipe.
       It's a separate element, as animating opacity is faster than rgba(). -->
  <div class="pswp__bg"></div>

  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap page center" id="page1">

		<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
		<div class="pswp__container">
				<!-- don't modify these 3 pswp__item elements, data is added later on -->
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
		</div>

		<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
		<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

						<!--  Controls are self-explanatory. Order can be changed. -->
						<div class="pswp__subject">
							<span data-role="category" class="text-primary"></span>
							<span data-role="subject"></span>
						</div>
						<div class="pswp__counter"></div>

						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

						<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
						<!-- element will get class pswp__preloader--active when preloader is running -->
						<div class="pswp__preloader">
								<div class="pswp__preloader__icn">
									<div class="pswp__preloader__cut">
										<div class="pswp__preloader__donut"></div>
									</div>
								</div>
						</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
						<div class="pswp__share-tooltip"></div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>

				<div class="pswp__caption">
						<div class="pswp__caption__center"></div>
				</div>
			</div>

  </div>

	<div class="pswp__reaction" hidden>
		<button type="button" class="pswp__button" data-toggle="page" data-start="#page1" data-target="#page2">
			<i class="fa fa-comment-o fa-lg" aria-hidden="true"></i>
			<br> <span data-role="comment"></span>
		</button>
		<button type="button" class="pswp__button">
			<i class="fa fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
			<br><span data-role="likes"></span>
		</button>
	</div>

</div>

<!-- 로그아웃-->
<div id="popup-logout" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <h1 class="title">로그아웃 전에 확인해주세요.</h1>
    </header>
    <nav class="bar bar-standard bar-footer">
      <div class="row">
        <div class="col-xs-6">
          <button type="button" class="btn btn-secondary btn-block" data-history="back">취소</button>
        </div>
        <div class="col-xs-6 p-l-0">
          <button type="button" class="btn btn-primary btn-block" data-act="logout">로그이웃</button>
        </div>
      </div>
    </nav>
    <div class="content">
      <div class="p-a-3 text-xs-center">
				정말로 로그아웃 하시겠습니까?
			</div>
    </div>
  </div>
</div>

<!-- 링크공유 -->
<div id="popup-link-share" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">
				<i class="fa fa-share-alt fa-fw" aria-hidden="true"></i>
				<span data-role="title">링크 공유</span>
			</h1>
    </header>
    <div class="content text-xs-center">
      <ul class="share list-inline m-b-0 m-t-2">
        <li class="list-inline-item">
          <a role="button" id="kakao-link-btn">
            <img src="<?php echo $g['img_core']?>/sns/kakaotalk.png" alt="카카오톡" class="img-circle">
            <p><small>카카오톡</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="facebook" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="img-circle">
            <p><small>페이스북</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="kakaostory" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/kakaostory.png" alt="카카오스토리" class="img-circle">
            <p><small>카카오스토리</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="naver" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/naver.png" alt="네이버" class="img-circle">
            <p><small>네이버</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="twitter" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/twitter.png" alt="트위터" class="img-circle">
            <p><small>트위터</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" data-role="email">
            <img src="<?php echo $g['img_core']?>/sns/mail.png" alt="메일" class="img-circle">
            <p><small>메일보내기</small></p>
          </a>
        </li>
      </ul>
      <p class="content-padded">
        <input class="form-control form-control-sm" type="text" data-role="share" readonly>
        <small>외부 공유시에 사용할 게시물의 URL 입니다.</small>
      </p>
    </div><!-- /.content -->
  </div><!-- /.popup-content -->
</div><!-- /.popup -->

<!-- 푸시알림 권한요청 -->
<div id="permission_alert" class="sheet">

  <div class="card card-full">

    <div class="card-header bg-primary">
      <i class="fa fa-bell-o fa-fw" aria-hidden="true"></i> 푸시알림 수신을 위한 권한요청
    </div>
    <div class="card-body">
      <div class="content-padded text-muted">
        <p>푸시알림을 허용하면 공지사항은 물론 게시글에 대한 피드백 또는 내가 언급된 글에 대한 정보들을 실시간으로 받아보실 수 있습니다.</p>
        <p>나중에 하기를 선택하실 경우, 설정 페이지에서 재설정 할 수 있습니다.</p>
      </div>
    </div>
    <div class="card-footer bg-white">
      <div class="row">
        <div class="col-xs-6">
          <button type="button" class="btn btn-secondary btn-block" data-history="back">나중에 하기</button>
        </div>
        <div class="col-xs-6 p-l-0">
          <button class="btn btn-outline-primary btn-block" onclick="requestPermission()">지금 설정하기</button>
        </div>
      </div>
    </div>
  </div><!-- /.card -->

</div>

<!-- 첨부파일 설정 -->
<div id="sheet-attach-moreAct" class="sheet bg-faded">
  <ul class="table-view table-view-full bg-white mb-0">
    <li class="table-view-cell table-view-divider" data-dismiss="sheet"><span data-role="title"></span></li>
    <li class="table-view-cell">
      <a data-attach-act="featured-img">
        대표이미지 설정
      </a>
    </li>
    <li class="table-view-cell d-none">
      <a data-attach-act="showhide">
        정보수정
      </a>
    </li>
    <li class="table-view-cell">
      <a data-attach-act="delete">
        삭제
      </a>
    </li>
  </ul>
</div>

<script src="<?php echo $g['url_layout']?>/_js/component.js"></script>
