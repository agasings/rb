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

<div class="page right" id="page-post-listview">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon material-icons pull-left  px-3" role="button" data-history="back">arrow_back</a>
  	<a class="icon material-icons pull-right px-3 mirror" role="button" data-toggle="popup" data-target="#popup-link-share" data-url>reply</a>
    <span class="title title-left" data-history="back">리스트 보기</span>
  </header>
  <main role="main" class="content">
    <div data-role="box"></div>
  </main>
</div><!-- /.page -->

<div class="page right" id="page-post-category">
  <header class="bar bar-nav bar-light bg-faded px-0">
    <button class="btn btn-link btn-nav pull-left p-x-1" data-history="back">
      <i class="material-icons">arrow_back</i>
    </button>

    <h1 class="title title-left" data-role="title" data-history="back">
     분류
   </h1>
  </header>
  <div class="bar bar-standard bar-header-secondary bar-light bg-faded p-x-0">
    <span class="bg_shadow shadow_before"></span>
    <span class="bg_shadow shadow_after"></span>
    <div class="swiper-container-thumbs">
      <nav class="swiper-wrapper"></nav>
    </div>
  </div>
  <main role="main" class="content bg-faded">
  </main>
</div><!-- /.page -->

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

<div class="page right" id="page-post-view_doc">
  <header class="bar bar-nav bar-light bg-white px-0">
    <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
  	<a class="icon material-icons pull-right px-3 mirror" role="button" data-toggle="popup" data-target="#popup-link-share" data-url>reply</a>
    <span class="title title-left" data-history="back">포스트 보기</span>
  </header>
  <div class="bar bar-standard bar-header-secondary bar-light bg-faded px-0" data-role="listCollapse">
  </div>
  <main role="main" class="content post-section">
    <div data-role="box"></div>
  </main>
</div><!-- /.page -->

<div class="page right" id="page-post-view_video">
  <header class="bar bar-standard px-0 bar-dark bg-black border-bottom-0 bar-media shadow-sm">
	  <img src="/_core/images/black-1024x576.png" class="img-fluid" alt="" data-role="featured" style="opacity: .5;">
	  <div class="modia-loader"></div>
	  <div class="embed-responsive embed-responsive-16by9 bg-black" data-role="video">
	    <oembed id="page-player"></oembed>
	  </div>
    <div data-role="listCollapse" class="bg-black text-white"></div>
	</header>
	<main class="content post-section">
		<div data-role="box"></div>
	</main>
</div><!-- /.page -->

<div class="modal" id="modal-post-view_video">
	<header class="bar bar-standard px-0 bar-dark bg-black border-bottom-0 bar-media shadow-sm">
	  <img src="/_core/images/black-1024x576.png" class="img-fluid" alt="" data-role="featured" style="opacity: .5;">
	  <div class="modia-loader"></div>
	  <div class="embed-responsive embed-responsive-16by9 bg-black" data-role="video">
	    <oembed id="modal-player"></oembed>
	  </div>
    <div data-role="listCollapse"></div>
	</header>
	<article class="content post-section">
		<div data-role="box"></div>
	</article>
</div><!-- /.page -->


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

<div id="modal-post-listview" class="modal zoom">
  <header class="bar bar-nav bar-light bg-white px-0">
  	<a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
  	<span class="title title-left" data-toggle="reload">리스트 보기</span>
  </header>
  <section class="content">
  	<div data-role="box"></div>
  </section>
</div>

<div id="modal-post-listview" class="modal zoom">
  <header class="bar bar-nav bar-light bg-white">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title">리스트 뷰</h1>
  </header>
  <div class="content">
    <p class="content-padded">
      The contents of my modal go here.
    </p>
  </div>
</div>

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


<div id="modal-member-profile" class="modal fast">
  <header class="bar bar-nav bar-light bg-white">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title">프로필</h1>
  </header>
  <div class="content">
    <p class="content-padded">
      The contents of my modal go here.
    </p>
  </div>
</div>

<!-- Popup -->
<div id="popup-post-listmore" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">Popup</h1>
    </header>
    <div class="content">
      <p class="content-padded">The contents of my popup go here.</p>
    </div>
  </div>
</div>

<!-- Popup -->
<div id="popup-post-filter" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">필터</h1>
    </header>
    <div class="content">
      <p class="content-padded">The contents of my popup go here.</p>
    </div>
  </div>
</div>


<!-- Sheet 시작 -->
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

<script src="/modules/post/themes/_mobile/rc-default/_js/post.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/_mobile/rc-default/_js/list.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/_mobile/rc-default/_js/list_view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/_mobile/rc-default/_js/view.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/_mobile/rc-default/_js/keyword.js<?php echo $g['wcache']?>" ></script>
<script src="/modules/post/themes/_mobile/rc-default/_js/component.js<?php echo $g['wcache']?>" ></script>
