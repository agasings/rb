<!--
포스트 모듈 컴포넌트 모음

1. 페이지 : 전체 포스트
2. 페이지 : 전체 리스트
3. 페이지 : 리스트 보기
4. 페이지   : 전체 카테고리
5. 페이지 : 특정 카테고리 보기
6. 페이지 : 키워드 보기
7. 페이지 : 내 포스트 관리
8. 페이지 : 내 리스트 관리
9. 페이지 : 나중에 볼 포스트
10. 페이지 : 좋아요 한 포스트
11. 페이지 : 포스트 보기
12. 페이지 : 새 포스트
13. 모달 : 포스트 보기
14. 모달 : 포스트 사진 보기
15. 모달 : 포스트 좋아요 보기
16. 모달 : 전체 포스트
17. 모달 : 전체 리스트
18. 모달 : 리스트 보기
19. 모달 : 포스트 검색 (임시)
20. 팝업 : 포스트 옵션 더보기
21. 팝업 : 포스트 신고
22. 팝업 : 정렬방식 변경
23. 팝업 :  새 재생목록
24. 시트 : 포스트 필터
25. 시트 : 리스트 저장
-->

<!-- 페이지 : 전체포스트 -->
<div class="page right" id="page-post-allpost">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back">전체 포스트</span>
  </header>
  <main role="main" class="content bg-faded">
    <div data-role="list"></div>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 전체 리스트 -->
<div class="page right" id="page-post-alllist">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back">전체 리스트</span>
  </header>
  <main role="main" class="content">
    <ul class="table-view table-view-sm mt-2 border-top-0 border-bottom-0" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 리스트 보기 -->
<div class="page right" id="page-post-listview">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
  	<a class="icon material-icons pull-right px-3 mirror" role="button" data-toggle="popup" data-target="#popup-link-share" data-url>reply</a>
    <span class="title title-left" data-history="back" data-role="title">리스트 보기</span>
  </header>
  <section class="content">
  	<div data-role="box"></div>
  </section>
</div><!-- /.page -->

<!-- 페이지   : 전체 카테고리 -->
<div class="page right" id="page-post-category">
  <header class="bar bar-nav bar-light bg-faded px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <span class="title title-left" data-history="back" data-role="title"></span>
  </header>
  <main role="main" class="content">
  	<?php getWidget('post/rc-post-cat-collapse',array('smenu'=>'0','limit'=>'4','collid'=>'tree-post','dispfmenu'=>'1','collapse'=>'1'))?>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 특정 카테고리 보기 -->
<div class="page right" id="page-post-category-view">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" >
      <span data-role="title"></span>
    </span>
  </header>
  <div class="bar bar-standard bar-header-secondary bar-light bg-faded p-x-0">
  <span class="bg_shadow shadow_before"></span>
  <span class="bg_shadow shadow_after"></span>
  <div class="swiper-container-thumbs">
    <nav class="swiper-wrapper"></nav>
  </div>
</div>
  <main role="main" class="content">
    <div class="swiper-container">
      <div class="swiper-wrapper">
      </div><!-- /.swiper-wrapper -->
    </div><!-- /.swiper-container -->
  	<ul class="table-view table-view-sm mt-2 border-top-0 border-bottom-0" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 키워드 보기 -->
<div class="page right" id="page-post-keyword">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon pull-right material-icons px-3" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" data-role="title">키워드 보기</span>
  </header>
  <main role="main" class="content">
    <ul class="table-view table-view-sm mt-2 border-top-0 border-bottom-0" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 내 포스트 관리 -->
<div class="page right" id="page-post-mypost">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" data-role="title">내 포스트</span>
  </header>
  <main role="main" class="content">
    <div class="content-padded">
      <ul class="media-list" data-role="list"></ul>
    </div>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 내 리스트 관리 -->
<div class="page right" id="page-post-mylist">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" data-role="title">내 재생목록</span>
  </header>
  <main role="main" class="content">
    <div class="content-padded">
      <ul class="media-list" data-role="list"></ul>
    </div>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 나중에 볼 포스트 -->
<div class="page right" id="page-post-saved">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" data-role="title">나중에 볼 포스트</span>
  </header>
  <main role="main" class="content">
    <div class="content-padded">
      <ul class="media-list" data-role="list"></ul>
    </div>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 좋아요 한 포스트 -->
<div class="page right" id="page-post-liked">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back" data-role="title">좋아요 한 포스트</span>
  </header>
  <main role="main" class="content">
    <div class="content-padded">
      <ul class="media-list" data-role="list"></ul>
    </div>
  </main>
</div><!-- /.page -->

<!-- 페이지 : 포스트 보기 -->
<div class="page right" id="page-post-view" data-role="view">
</div><!-- /.page -->

<!-- 모달 : 포스트 보기 -->
<div class="modal" id="modal-post-view" data-role="view">
</div><!-- /.modal -->

<!-- 모달 : 포스트 통계 -->
<div class="modal fast" id="modal-post-analytics" data-start="<?php echo date("Ymd", strtotime("-1 week")); ?>">

  <section class="page center" id="page-post-analytics-main">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon icon-close pull-left px-3" data-history="back" role="button"></a>
      <h1 class="title" data-history="back">통계</h1>
    </header>
    <div class="content">

      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center text-muted" style="height:70vh">
          <div class="spinner-border mr-2" role="status"></div>
        </div>
      </div>
      <div class="d-none" data-role="article">
        <div class="media content-padded">
          <span class="media-left">
            <div class="embed-responsive embed-responsive-16by9 bg-faded">
              <img class="media-object bg-faded" src="" alt="" data-role="featured" style="width:110px">
              <time class="badge badge-default bg-black rounded-0 position-absolute f12 p-1" style="right:0;bottom:0" data-role="time"></time>
            </div>
          </span>
          <div class="media-body">
            <h5 class="media-heading f15 line-clamp-3 mb-0" data-role="subject"></h5>
            <small data-role="nic" class="text-muted"></small>
          </div>
        </div>
        <ul class="table-view">
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-hit" data-start="#page-post-analytics-main">
              <span class="badge badge-pill" data-role="hit"></span>
              유입추이
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-referer" data-start="#page-post-analytics-main">
              유입경로
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-device" data-start="#page-post-analytics-main">
              디바이스별
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-side" data-start="#page-post-analytics-main">
              외부유입
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-likes" data-start="#page-post-analytics-main">
              <span class="badge badge-pill" data-role="likes"></span>
              좋아요
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-dislikes" data-start="#page-post-analytics-main">
              <span class="badge badge-pill" data-role="dislikes"></span>
              싫어요
            </a>
          </li>
          <li class="table-view-cell">
            <a class="navigate-right" data-toggle="page" data-target="#page-post-analytics-comment" data-start="#page-post-analytics-main">
              <span class="badge badge-pill" data-role="comment"></span>
              댓글
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-hit">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">유입추이</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-referer">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">유입경로</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-device">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">디바이스별</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-side">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">외부유입</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-likes">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">좋아요</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-dislikes">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">싫어요</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

  <section class="page right" id="page-post-analytics-comment">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <h1 class="title" data-history="back">댓글</h1>
    </header>
    <div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center"  style="height:385px">
          <div class="spinner-border text-muted" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
      <div data-role="canvas">
        <div class="d-flex justify-content-center align-items-center"  style="height:80vh">
          <canvas></canvas>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.modal -->

<!-- 모달 : 포스트 사진 보기 -->
<section id="modal-post-photo" class="modal fast" data-role="post-photo">
  <header class="bar bar-nav bar-dark bg-black px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
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

<!-- 모달 : 포스트 좋아요 보기 -->
<section id="modal-post-opinion" class="modal fast" data-role="post-photo">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <h1 class="title title-left" data-history="back">좋아요</h1>
  </header>
  <div class="content">
    <div class="content-padded">
      <ul class="media-list" data-role="list"></ul>
    </div>
  </div>
</section>

<!-- 모달 : 전체 포스트 -->
<div id="modal-post-allpost" class="modal fast">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
  	<a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
  	<span class="title title-left" data-toggle="reload">전체 포스트</span>
  </header>
  <section class="content bg-faded">
  	<div data-role="list"></div>
  </section>
</div>

<!-- 모달 : 전체 리스트 -->
<div id="modal-post-alllist" class="modal">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
  	<a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
  	<span class="title title-left" data-toggle="reload">전체 리스트</span>
  </header>
  <section class="content">
  	<ul class="table-view table-view-sm mt-2 border-top-0 border-bottom-0" data-role="list"></ul>
  </section>
</div>

<!-- 모달 : 리스트 보기 -->
<div id="modal-post-listview" class="modal zoom">
  <header class="bar bar-nav bar-light bg-white px-0">
  	<a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
  	<span class="title title-left" data-toggle="reload">리스트 보기</span>
  </header>
  <section class="content">
  	<div data-role="box"></div>
  </section>
</div>

<!-- 모달 : 포스트 검색 -->
<div id="modal-post-search" class="modal fast">
  <header class="bar bar-nav bar-light bg-white">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title">Modal</h1>
  </header>
  <div class="content">
    <p class="content-padded">
    </p>
  </div>
</div>

<!-- 모달 : 포스트 편집 -->
<div class="modal fast" id="modal-post-write">

  <section class="page center" id="page-post-edit-main">

    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon icon-close pull-left px-3" data-history="back" role="button"></a>
      <button class="btn btn-link btn-nav pull-right px-4" data-act="submit">
        <span class="not-loading">
          저장
        </span>
        <span class="is-loading">
          <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">저장중...</span>
          </div>
        </span>
      </button>
      <span class="title" data-role="title">새 포스트</span>
    </header>
    <header class="bar bar-nav bar-light bg-faded p-x-0 border-top" data-role="editor-nav">
      <div class="d-flex align-items-center">
        <div class="toolbar-container w-100"></div>
        <?php if ($g['mobile']!='iphone' && $g['mobile']!='ipad'): ?>
        <div class="flex-shrink-1 border-left text-xs-center" style="min-width:4rem">
          <button class="btn btn-link" type="button">완료</button>
        </div>
      <?php endif; ?>
      </div>
    </header>

    <main role="main" class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center text-muted" style="height:70vh">
          <div class="spinner-border mr-2" role="status"></div>
        </div>
      </div>
      <form name="writeForm" method="post" class="d-none">

        <input type="hidden" name="uid" value="">
        <input type="hidden" name="category_members" value="">
        <input type="hidden" name="list_members" value="">
        <input type="hidden" name="upload" id="upfilesValue" value="">
        <input type="hidden" name="member" value="">
        <input type="hidden" name="featured_img" value="">
        <input type="hidden" name="html" value="HTML">
        <input type="hidden" name="review">
        <input type="hidden" name="display">
        <input type="hidden" name="format">
        <input type="hidden" name="dis_rating">
        <input type="hidden" name="dis_like">
        <input type="hidden" name="dis_comment">
        <input type="hidden" name="dis_listadd">
        <input type="hidden" name="goods">

        <div class="content-padded my-0 editor-focused-hide">
          <div class="media">
            <span class="media-left media-middle position-relative pr-0 mr-2" >
              <img class="media-object bg-faded" src="" alt="" data-role="featured" style="width:103px;height:58px">
              <time class="badge badge-default bg-black rounded-0 position-absolute f12 p-1" style="right:1px;bottom:1px" data-role="time"></time>
              <span class="badge badge-default bg-black rounded-0 position-absolute f12 p-1" style="right:1px;bottom:1px" data-role="attachNum"></span>
            </span>
            <div class="media-body f14" style="max-height: 300px;overflow: auto">
              <div class="form-list floating mb-1">
                <div class="input-row pl-1">
                  <label class="small text-muted">제목</label>
                  <textarea class="form-control p-0 border-0 mb-0" rows="2" name="subject" data-role="subject" data-plugin="autosize" placeholder="제목 입력..."></textarea>
                </div>
              </div>
            </div>
          </div><!-- /.media -->
        </div><!-- /.content-padded -->

        <div data-role="editor" style="margin-top: -5px;">
          <div data-role="editor-body" class="editable-container" style="color:#55595c"></div>
        </div>

        <ul class="table-view editor-focused-hide mt-3">
          <li class="table-view-cell">
            <a href="#page-post-edit-attach" data-start="#page-post-edit-main" data-toggle="page">
              사진 및 파일추가
            </a>
            <span class="badge badge-default badge-outline" data-role="attachNum"></span>
          </li>
          <li class="table-view-cell">
            <a href="#page-post-edit-link" data-start="#page-post-edit-main" data-toggle="page">
              링크추가
            </a>
            <span class="badge badge-default badge-outline" data-role="linkNum"></span>
          </li>

          <li class="table-view-cell">
            외부공개
            <div data-toggle="switch" data-role="public" class="switch">
              <div class="switch-handle"></div>
            </div>
          </li>
          <li class="table-view-cell">
            <a href="#page-post-edit-review" data-start="#page-post-edit-main" data-toggle="page">
              <span class="badge badge-default badge-inverted"></span>
              요약
            </a>
          </li>
          <li class="table-view-cell">
            <a href="#page-post-edit-tag" data-start="#page-post-edit-main" data-toggle="page">
              <span class="badge badge-default badge-inverted"></span>
              태그
            </a>
          </li>
          <li class="table-view-cell">
            <a href="#page-post-edit-format" data-start="#page-post-edit-main" data-toggle="page">
              <span class="badge badge-default badge-outline"></span>
              포맷
            </a>
          </li>
          <li class="table-view-cell">
            <a href="#page-post-edit-advan" data-start="#page-post-edit-main" data-toggle="page">
              고급설정
            </a>
          </li>
        </ul>

      </form><!-- /.content-padded -->

    </main>
  </section>

  <section class="page right" id="page-post-edit-attach">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">파일첨부</span>
    </header>
    <main class="content">
    </main>
  </section>

  <section class="page right" id="page-post-edit-link">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">링크추가</span>
    </header>
    <main class="content">

    </main>
  </section>

  <section class="page right" id="page-post-edit-review">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">요약설명</span>
    </header>
    <main class="content">

    </main>
  </section>

  <section class="page right" id="page-post-edit-tag">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">태그</span>
    </header>
    <main class="content">

    </main>
  </section>

  <section class="page right" id="page-post-edit-advan">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">고급설정</span>
    </header>
    <main class="content">
      <ul class="table-view mt-0 border-top-0">
        <li class="table-view-cell">
          <a href="#page-post-edit-category" data-start="#page-post-edit-advan" data-toggle="page">
            카테고리 지정
          </a>
        </li>
        <li class="table-view-cell">
          <a href="#page-post-edit-display" data-start="#page-post-edit-advan" data-toggle="page">
            <span class="badge badge-default badge-inverted"></span>
            공유설정
          </a>
        </li>
      </ul>
    </main>
  </section>

  <section class="page right" id="page-post-edit-category">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">카테고리 지정</span>
    </header>
    <main class="content">

    </main>
  </section>

  <section class="page right" id="page-post-edit-format">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">포맷</span>
    </header>
    <main class="content">

    </main>
  </section>

  <section class="page right" id="page-post-edit-display">
    <header class="bar bar-nav bar-light bg-faded px-0">
      <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
      <span class="title" data-history="back">공유설정</span>
    </header>
    <main class="content">

    </main>
  </section>

</div><!-- /.modal -->


<!-- 팝업 : 포스트 옵션 더보기 -->
<div id="popup-post-postMore" class="popup zoom">
  <div class="popup-content">
    <ul class="table-view table-view-full text-xs-center rounded-0" data-role="list" style="max-height: 328px;">
    </ul>
  </div>
</div>

<!-- 팝업 : 포스트 신고 -->
<div id="popup-post-report" class="popup zoom">
  <div class="popup-content rounded-0">
    <header class="bar bar-nav bg-white">
      <h1 class="title">컨텐츠 신고</h1>
    </header>
    <nav class="bar bar-tab">
      <a class="tab-item bg-white" role="button" data-history="back">
        취소
      </a>
      <a class="tab-item bg-white active" role="button" data-act="submit">
        신고
      </a>
    </nav>
    <div class="content rounded-0">
      <div class="p-3">

        <div class="custom-controls-stacked">
          <label class="custom-control custom-radio">
            <input id="radio-01" type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">성적인 콘텐츠</span>
          </label>

          <label class="custom-control custom-radio">
            <input id="radio-02" type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">폭력적 또는 혐오스러운 콘텐츠</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">증오 또는 악의적인 콘텐츠</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">유해한 위험 행위</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">아동 학대</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">테러 조장</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">스팸 또는 사용자를 현혹하는 콘텐츠</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">권리 침해</span>
          </label>

          <label class="custom-control custom-radio">
            <input type="radio" name="report" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">기타</span>
          </label>
        </div>

        <div class="mt-1">
          <small class="text-muted">
          커뮤니티 가이드를 위반한 계정은 제재를 받게 되며 심각하거나 반복적인 위반 행위에 대해서는 계정 해지 조치가 취해질 수 있습니다.
          </small>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- 팝업 : 정렬방식 변경 -->
<div id="popup-post-sort" class="popup zoom">
  <div class="popup-content">
    <ul class="table-view table-view-full text-xs-center rounded-0">
      <li class="table-view-cell">
        <a class="" data-toggle="sort" data-sort="hit">
          조회순
        </a>
      </li>
      <li class="table-view-cell">
        <a class="" data-toggle="sort" data-sort="hit">
          좋아요순
        </a>
      </li>
      <li class="table-view-cell">
        <a class="" data-toggle="sort" data-sort="d-regis" data-orderby="asc">
          추가된 날짜 (오래된순)
        </a>
      </li>
      <li class="table-view-cell" data-toggle="sort" data-sort="d-regis" data-orderby="desc">
        <a class="">
          추가된 날짜 (최신순)
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- 팝업 : 새 재생목록 -->
<div id="popup-post-newList" class="popup zoom">
  <div class="popup-content rounded-0">
    <div class="content rounded-0" style="min-height: 110px;">
      <div class="p-a-1">
        <h5>새 재생목록</h5>
        <div class="form-list stacked mt-3 mb-1">
				  <input type="text" placeholder="제목" name="name" class="border-primary px-0 py-2" autocomplete="off">

          <div class="input-row px-0 mt-3 border-bottom-0">
            <label class="text-muted mb-1">개인정보보호</label>
            <select class="form-control custom-select mb-0" name="display" style="height: inherit;">
              <?php $displaySet=explode('||',$d['displaySet'])?>
  						<?php $i=1;foreach($displaySet as $displayLine):if(!trim($displayLine))continue;$dis=explode(',',$displayLine)?>
              <option value="<?php echo $i ?>" class="<?php echo $dis[0]=='일부공개'?'d-none':'' ?>"><?php echo $dis[0]?></option>
  						<?php $i++;endforeach?>
            </select>
          </div>

				</div>

        <div class="text-xs-right">
          <button type="button" class="btn btn-lg btn-link text-muted mr-2" data-history="back">취소</button>
          <button type="button" class="btn btn-lg btn-link" data-act="submit">
            <span class="not-loading">
							만들기
						</span>
            <span class="is-loading">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </span>
          </button>
        </div>

			</div>
    </div>
  </div>
</div>

<!-- 팝업 : 새 포스트 작업선택   -->
<div id="popup-post-newPost" class="popup zoom">
  <div class="popup-content rounded-0">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">작업선택</h1>
    </header>
    <div class="content rounded-0" style="min-height: 185px;">
      <div class="content-padded">
        <div class="row">
          <div class="col-xs-4">
            <button type="button" class="btn btn-block btn-link text-reset" data-toggle="newpost" data-type="photo">
              <div class="material-icons" style="font-size: 64px;">
                insert_photo
              </div>
              <div><small class="text-black">사진 추가</small></div>
            </button>
          </div>
          <div class="col-xs-4">
            <button type="button" class="btn btn-block btn-link text-reset" data-toggle="newpost" data-type="link">
              <div class="material-icons" style="font-size: 64px;">
                link
              </div>
              <div><small class="text-black">링크 추가</small></div>
            </button>
          </div>
          <div class="col-xs-4">
            <button type="button" class="btn btn-block btn-link text-reset" data-toggle="newpost" data-type="editor">
              <div class="material-icons" style="font-size: 64px;">
                notes
              </div>
              <div><small class="text-black">본문 작성</small></div>
            </button>
          </div>
        </div><!-- /.row -->
      </div>
    </div>
  </div>
</div>

<!-- 팝업 : 삭제확인 안내-->
<div id="popup-post-delConfirm" class="popup zoom">
  <div class="popup-content rounded-0">
    <div class="content rounded-0" style="min-height: 110px;">
      <div class="p-a-1">
        <h5 data-role="title">정말로 삭제하시겠습니까?</h5>
				<span data-role="subtext" class="f14 text-muted"></span>
        <div class="text-xs-right mt-4">
          <button type="button" class="btn btn-link text-muted mr-2" data-history="back">취소</button>
          <button type="button" class="btn btn-link" data-act="submit">
            <span class="not-loading">
              삭제
            </span>
            <span class="is-loading">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">처리중...</span>
              </div>
            </span>
          </button>
        </div>
			</div>
    </div>
  </div>
</div>

<!-- 시트 : 포스트 필터 -->
<div id="sheet-post-filter" class="sheet shadow">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon icon-close pull-left px-3" data-history="back" role="button"></a>
    <a class="icon icon-check pull-right px-3" role="button"></a>
    <h1 class="title">보기옵션</h1>
  </header>
  <div style="padding-top: 2.75rem;">
    <div class="content-padded py-5">

      <div class="text-xs-center mb-2 text-muted">정렬 선택</div>
      <div class="nav nav-control">
        <a class="nav-link active" role="button">등록순</a>
        <a class="nav-link" role="button">최신순</a>
        <a class="nav-link" role="button">좋아요순</a>
        <a class="nav-link" role="button">댓글순</a>
      </div>
    </div>
  </div>
</div>

<!-- 시트 : 리스트 저장 -->
<div id="sheet-post-listadd" class="sheet shadow">
  <header class="bar bar-nav bar-light bg-white">
    <button class="btn btn-link btn-nav pull-right px-3" data-toggle="newList">
      새 재생목록
    </button>
    <h1 class="title title-left px-3">포스트 저장</h1>
  </header>
  <nav class="bar bar-tab bar-light bg-white">
    <a class="tab-item text-muted" role="button" data-history="back">
      취소
    </a>
    <a class="tab-item text-primary" role="button" data-act="submit">
      저장
    </a>
  </nav>
  <main>
    <div class="content-padded px-1">

      <div class="d-flex justify-content-between align-items-center py-2">
        <label class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" type="checkbox" id="saved" name="saved" {$is_saved}>
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description" for="saved">나중에 볼 동영상</span>
        </label>
        <i class="material-icons text-muted mr-2" data-toggle="tooltip" title="비공개">lock</i>
      </div>

      <div data-role="list-selector"></div>

    </div>
  </main>
</div>

<!-- 시트 : 새 포스트 링크추가 -->
<div id="sheet-post-linkadd" class="sheet shadow" style="height: 135px;">
  <header class="bar bar-nav bar-light bg-white">
    <button class="btn btn-link btn-nav pull-right px-3" data-act="submit">
      <span class="not-loading">
        다음
      </span>
      <span class="is-loading">
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">저장중...</span>
        </div>
      </span>
    </button>
    <h1 class="title title-left px-3">링크 추가</h1>
  </header>
  <main>
    <textarea class="form-control border-0" rows="3" placeholder="복사한 링크를 붙여넣기 하세요."></textarea>
  </main>
</div>

<!-- 시트 : 새 포스트 사진 추가 -->
<div id="sheet-post-photoadd" class="sheet shadow" style="top: 40vh;">
  <header class="bar bar-nav bar-light bg-white">
    <button class="btn btn-link btn-nav pull-right px-3" data-history="back" >
      취소
    </button>
    <h1 class="title title-left px-3">사진 추가</h1>
  </header>
  <nav class="bar bar-tab bar-light bg-white">
    <a class="tab-item text-muted" role="button" data-act="submit">
      <span class="not-loading">
        다음
      </span>
      <span class="is-loading d-none">
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">저장중...</span>
        </div>
      </span>
    </a>
  </nav>
  <main>

    <?php
    // 설정값 세팅
    $attachSkin = '_mobile/rc-col';  // 업로드 테마
    $parent_module=$m; // 첨부파일 사용하는 모듈
    $parent_data=$R; // 해당 포스트 데이타 (수정시 필요)
    $attach_module_theme=$attachSkin; // 첨부파일 테마
    $attach_handler_file='[data-role="attach-handler-file"]'; //파일첨부 실행 엘리먼트 button or 기타 엘리먼트 data-role="" 형태로 하는 것을 권고
    $attach_handler_photo='[data-role="attach-handler-photo"]'; // 사진첨부 실행 엘리먼트 button or 기타 엘리먼트 data-role="" 형태로 하는 것을 권고
    $attach_handler_getModalList='.getModalList'; // 첨부파일 리스트 호출 handler
    $attach_object_type= 'photo';//첨부 대상에 따른 분류 : photo, file, link, video....

    // 함수 인클루드
    include $g['path_module'].'mediaset/attach.php';
    ?>

  </main>
</div>

<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/component.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/post.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/list.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/list_view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/keyword.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/category.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/best.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/write.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/mypost.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/mylist.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/saved.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/liked.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/feed.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/opinion.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/more.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/analytics.js<?php echo $g['wcache']?>" ></script>
