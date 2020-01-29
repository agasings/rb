<!--
컴포넌트 모음
-->

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

<!-- 통합검색 -->
<?php include_once $g['path_module'].'search/themes/_mobile/rc-default/component.php';  ?>

<!-- 포스트 -->
<?php include_once $g['path_module'].'post/themes/'.$d['post']['skin_mobile'].'/component.php';  ?>

<!-- 댓글 -->
<?php include_once $g['path_module'].'comment/themes/_mobile/rc-default/component.php';  ?>



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

<div class="page right" id="page-bbs-list">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
  	<a class="icon material-icons pull-right px-3 mirror" role="button" data-toggle="popup" data-target="#popup-link-share" data-url>reply</a>
    <h1 class="title title-left" data-role="title" data-history="back"></h1>
  </header>
  <div class="bar bar-standard bar-header-secondary bar-light bg-white p-0 d-none">
    <select class="form-control custom-select border-0 mb-0 text-primary" data-role="category"></select>
  </div>

  <main role="main" class="content bg-white" data-role="main"></main>
</div>

<!-- 게시물 보기 -->
<div id="modal-bbs-view" class="modal zoom">

	<section id="page-bbs-view" class="rb-bbs-list page center" data-role="bbs-view">
		<input type="hidden" name="bid" value="">
	  <input type="hidden" name="uid" value="">
	  <header class="bar bar-nav bar-light bg-faded px-0">
			<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
	    <h1 class="title text-truncate text-nowrap w-75" style="left:12.5%" data-role="title">게시물 보기</h1>
	  </header>
	  <div class="content">
	    <div class="content-padded" data-role="post">
	      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
	      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>
			</div>

      <div data-role="article">
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

	  </div>
	</section>

	<!-- 전체댓글보기 -->
	<section id="page-bbs-allcomments" class="page right" data-role="bbs-comment">
	  <div class="commentting-all"></div>
	</section>

  <section id="page-bbs-photo" class="page right" data-role="bbs-photo">
    <header class="bar bar-nav bar-dark bg-black px-0">
      <button class="btn btn-link btn-nav pull-left p-x-1" data-history="back">
      	<i class="material-icons">arrow_back</i>
      </button>
      <h1 class="title" data-role="title" data-history="back">제목</h1>
    </header>
    <div class="bar bar-standard bar-header-secondary bar-dark bg-black">
      <h1 class="title text-muted"><small><i class="fa fa-expand mr-2" aria-hidden="true"></i> 이미지를 터치해서 확대해서 볼 수 있습니다.</small></h1>
    </div>
    <div class="bar bar-footer bar-dark bg-black text-muted">
      <div class="swiper-pagination"></div>
    </div>
    <div class="content bg-black">
      <div class="d-flex" style="height:78vh">
      	<div class="swiper-container align-self-center" style="height:78vh">
      		<div class="swiper-wrapper">
      		</div>
      </div>
        <!-- Add Navigation -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
	</section>

</div><!-- /.modal -->

<!-- 게시물 쓰기 -->
<?php
if ($m=='bbs') {
  $bbs_component = $g['path_module'].'bbs/themes/'.$d['bbs']['skin'].'/component.php';
  if (file_exists($bbs_component)) include_once $bbs_component;
}
?>

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

<!-- 팝업 : 링크공유 -->
<div id="popup-link-share" class="popup zoom">
  <div class="popup-content rounded-0">
    <header class="bar bar-nav rounded-0">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">
				링크 복사
			</h1>
    </header>
    <div class="content text-xs-center rounded-0">

      <ul class="table-view mt-0" style="max-height: 400px;">
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/kakaotalk.png" alt="카카오톡" class="media-object pull-left img-circle" style="width:38px">
          카카오톡
          <button class="btn btn-secondary" id="kakao-link-btn">링크공유</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/youtube.png" alt="유튜브" class="media-object pull-left img-circle" style="width:38px">
          유튜브
          <button class="btn btn-secondary" data-role="youtube" data-toggle="linkCopy" data-clipboard-text="">
            링크복사
          </button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/instagram.png" alt="인스타그램" class="media-object pull-left img-circle" style="width:38px">
          인스타그램
          <button class="btn btn-secondary" data-role="instagram" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="media-object pull-left img-circle" style="width:38px">
          페이스북
          <button class="btn btn-secondary" data-role="facebook" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/band.png" alt="밴드" class="media-object pull-left img-circle" style="width:38px">
          밴드
          <button class="btn btn-secondary" data-role="band" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/naver.png" alt="네이버 카페" class="media-object pull-left img-circle" style="width:38px">
          네이버 카페
          <button class="btn btn-secondary" data-role="naver" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/kakaostory.png" alt="카카오스토리" class="media-object pull-left img-circle" style="width:38px">
          카카오스토리
          <button class="btn btn-secondary" data-role="kakaostory" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/twitter.png" alt="트위터" class="media-object pull-left img-circle" style="width:38px">
          트위터
          <button class="btn btn-secondary" data-role="twitter" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/mail.png" alt="이메일" class="media-object pull-left img-circle" style="width:38px">
          이메일
          <button class="btn btn-secondary" data-role="email" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <img src="<?php echo $g['img_core']?>/sns/sms.png" alt="SMS" class="media-object pull-left img-circle" style="width:38px">
          SMS
          <button class="btn btn-secondary" data-role="sms" data-toggle="linkCopy">링크복사</button>
        </li>
        <li class="table-view-cell media align-items-center">
          <span class="ml-2">기타</span>
          <button class="btn btn-secondary" data-role="etc" data-toggle="linkCopy">링크복사</button>
        </li>

        <?php if ($my['admin']): ?>
        <li class="table-view-cell media align-items-center">
          <span class="ml-2">고유번호</span>
          <button class="btn btn-secondary" data-role="uid" data-toggle="linkCopy">복사</button>
        </li>
        <?php endif; ?>
      </ul>





    </div><!-- /.content -->
  </div><!-- /.popup-content -->
</div><!-- /.popup -->

<!-- 시트 : 푸시알림 권한요청 -->
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

<!-- 시트 : 첨부파일 설정 -->
<div id="sheet-attach-moreAct" class="sheet bg-faded">
  <ul class="table-view table-view-full bg-white mb-0">
    <li class="table-view-cell table-view-divider" data-history="back"><span data-role="title" class="line-clamp-1"></span></li>
    <li class="table-view-cell">
      <a data-attach-act="featured-img">
        대표이미지 설정
      </a>
    </li>
    <li class="table-view-cell">
      <a data-attach-act="edit" class="navigate-right">
        정보수정
      </a>
    </li>
    <li class="table-view-cell">
      <a data-attach-act="showhide">
        보이기
      </a>
    </li>
    <li class="table-view-cell">
      <a data-attach-act="delete">
        삭제
      </a>
    </li>
  </ul>
</div>

<!-- 팝업 : 첨부파일 업로드 성공 -->
<div id="popup-success" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav bar-dark bg-inverse">
      <h1 class="title">업로드 완료</h1>
    </header>
    <nav class="bar bar-standard bar-footer">
      <button type="button" class="btn btn-secondary btn-block" data-history="back">확인</button>
    </nav>
    <div class="content">
      <div class="p-a-3 text-xs-center">
        본문작성으로 돌아가려면 <br> 상단 <code>본문작성</code>을 누르세요.
      </div>
    </div>
  </div>
</div>

<!-- 사이트 설정 -->
<div id="modal-site-settings" class="modal">
  <header class="bar bar-nav bg-white px-0">
    <a class="icon icon-close pull-left px-3" data-history="back" role="button"></a>
    <h1 class="title">사이트 설정</h1>
  </header>
  <nav class="bar bar-tab bar-dark bar-dark bg-inverse border-top-0">
    	<a class="tab-item bg-primary" data-act="submit" role="button">
        <span class="not-loading">
          저장하기
        </span>
        <span class="is-loading">
          <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">저장중...</span>
          </div>
        </span>
    	</a>
    </nav>
  <div class="content">
    <div class="content-padded">

      <div class="form-group">
        <label for="">추천 포스트</label>
        <textarea class="form-control" name="main_post_req" rows="3" placeholder="고유번호 입력"></textarea>
        <small class="form-text text-muted">
          홈화면 상단에 고정출력 됩니다. 콤마(,)로 구분하여 포스트 고유번호를 입력해주세요. <br><br>고정된 포스트의 중복출력을 피하기 위해 포스트의 공개설정을 '미등록' 으로 변경해주세요.
        </small>
      </div>


    </div>
  </div>
</div>