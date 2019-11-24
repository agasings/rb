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
23. 시트 : 포스트 필터
24. 시트 : 리스트 저장
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

<!-- 페이지 : 새 포스트 -->
<div class="page right" id="page-post-new">
  <header class="bar bar-nav bar-light bg-faded">
    <button class="btn btn-link btn-nav pull-right px-3" data-history="back">
      취소
    </button>
    <span class="title" data-role="title">새 포스트</span>
  </header>
  <nav class="bar bar-tab bar-dark bar-dark bg-inverse border-top-0">
  	<a class="tab-item bg-primary disabled" role="button" data-title="이영상에 사용된 제품" data-target="#page-shop-category" data-index="1" data-parent="1" data-category="6" data-toggle="page" data-start="#page-post-view-video" data-act="pauseVideo">
  		저장하기
  	</a>
  </nav>
  <main role="main" class="content">
    <textarea class="form-control mb-0 border-0" rows="4" placeholder="복사한 URL를 붙여넣으세요."></textarea>
    <div class="content-padded">
      <small class="text-muted">
        외부링크가 포함되는 경우 URL 입력후 불러오기를 해주세요.
        링크의 메타정보를 불러와 빠르게 포스트를 셋팅합니다.
      </small>
    </div>
  </main>
</div><!-- /.page -->

<!-- 모달 : 포스트 보기 -->
<div class="modal" id="modal-post-view" data-role="view">
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
      The contents of my modal go here.
    </p>
  </div>
</div>

<!-- 팝업 : 포스트 옵션 더보기 -->
<div id="popup-post-optionMore" class="popup zoom">
  <div class="popup-content">
    <ul class="table-view table-view-full text-xs-center rounded-0">
      <li class="table-view-cell">
        <a class="" data-toggle="saved" data-title="나중에 다시 보고 싶으신가요" data-subtext="로그인하여 동영상을 저장하세요.">
          나중에 볼 동영상에 저장
        </a>
      </li>
      <li class="table-view-cell">
        <a class="" data-toggle="listAdd" data-title="나중에 다시 보고 싶으신가요" data-subtext="로그인하여 동영상을 재생목록에 추가하세요.">
          재생목록에 저장
        </a>
      </li>
      <li class="table-view-cell" data-toggle="linkShare" data-hback="true">
        <a class="">
          공유
        </a>
      </li>
      <li class="table-view-cell">
        <a class="" data-toggle="report" data-title="동영상을 신고하시겠습니까?" data-subtext="부적절한 콘텐츠를 신고하려면 로그인하세요.">
          신고
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- 팝업 : 포스트 신고 -->
<div id="popup-post-report" class="popup zoom">
  <div class="popup-content rounded-0">
    <header class="bar bar-nav bg-white">
      <h1 class="title">동영상 신고</h1>
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
    <button class="btn btn-link btn-nav pull-right px-3">
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

<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/post.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/list.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/list_view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/keyword.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/category.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/best.js<?php echo $g['wcache']?>" ></script>

<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/mypost.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/mylist.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/saved.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/liked.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/feed.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/opinion.js<?php echo $g['wcache']?>" ></script>

<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/component.js<?php echo $g['wcache']?>" ></script>
