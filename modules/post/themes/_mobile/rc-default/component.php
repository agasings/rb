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
9. 페이지 : 나중에 볼 동영상
10. 페이지 : 포스트 보기
11. 모달 : 포스트 보기
12. 모달 : 전체 포스트
13. 모달 : 전체 리스트
14. 모달 : 리스트 보기
15. 모달 : 포스트 검색 (임시)
16. 팝업 : 포스트 옵션 더보기
17. 시트 : 포스트 필터
-->

<!-- 1. 페이지 : 전체포스트 -->
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

<!-- 2. 페이지 : 전체 리스트 -->
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

<!-- 3. 페이지 : 리스트 보기 -->
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

<!-- 4. 페이지   : 전체 카테고리 -->
<div class="page right" id="page-post-category">
  <header class="bar bar-nav bar-light bg-faded px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <span class="title title-left" data-history="back" data-role="title"></span>
  </header>
  <main role="main" class="content">
  	<?php getWidget('post/rc-post-cat-collapse',array('smenu'=>'0','limit'=>'4','collid'=>'tree-post','dispfmenu'=>'1','collapse'=>'1'))?>
  </main>
</div><!-- /.page -->

<!-- 5. 페이지 : 특정 카테고리 보기 -->
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

<!-- 6. 페이지 : 키워드 보기 -->
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

<!-- 7. 페이지 : 내 포스트 관리 -->
<div class="page right" id="page-post-mypost">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back">내 동영상</span>
  </header>
  <main role="main" class="content">
    <ul class="media-list content-padded" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 8. 페이지 : 내 리스트 관리 -->
<div class="page right" id="page-post-mylist">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back">내 재생목록</span>
  </header>
  <main role="main" class="content">
    <ul class="media-list content-padded" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 9. 페이지 : 나중에 볼 동영상 -->
<div class="page right" id="page-post-saved">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <a class="icon pull-right material-icons px-2" role="button" data-toggle="sheet" data-target="#sheet-post-filter" data-backdrop="static">tune</a>
    <span class="title title-left" data-history="back">나중에 볼 동영상</span>
  </header>
  <main role="main" class="content">
    <ul class="media-list content-padded" data-role="list"></ul>
  </main>
</div><!-- /.page -->

<!-- 10. 페이지 : 포스트 보기 -->
<div class="page right" id="page-post-view">
</div><!-- /.page -->


<!-- 11. 모달 : 포스트 보기 -->
<div class="modal" id="modal-post-view">
</div><!-- /.modal -->

<!-- 12. 모달 : 전체 포스트 -->
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

<!-- 13. 모달 : 전체 리스트 -->
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

<!-- 14. 모달 : 리스트 보기 -->
<div id="modal-post-listview" class="modal zoom">
  <header class="bar bar-nav bar-light bg-white px-0">
  	<a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
  	<span class="title title-left" data-toggle="reload">리스트 보기</span>
  </header>
  <section class="content">
  	<div data-role="box"></div>
  </section>
</div>

<!-- 15. 모달 : 포스트 검색 -->
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

<!-- 16. 팝업 : 포스트 옵션 더보기 -->
<div id="popup-post-optionMore" class="popup zoom">
  <div class="popup-content">
    <ul class="table-view table-view-full text-xs-center rounded-0">
      <li class="table-view-cell">
        <a class="" data-toggle="postSaved">
          나중에 볼 동영상에 저장
        </a>
      </li>
      <li class="table-view-cell" data-toggle="listAdd">
        <a class="">
          재생목록에 저장
        </a>
      </li>
      <li class="table-view-cell" data-toggle="linkShare">
        <a class="">
          공유
        </a>
      </li>
      <li class="table-view-cell" data-toggle="postReport">
        <a class="">
          신고
        </a>
      </li>
    </ul>
  </div>
</div>

<!-- 17. 시트 : 포스트 필터 -->
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
<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/feed.js<?php echo $g['wcache']?>" ></script>

<script src="/modules/post/themes/<?php echo $d['post']['skin_mobile'] ?>/_js/component.js<?php echo $g['wcache']?>" ></script>
