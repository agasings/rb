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
<script>



$('#modal-post-allpost').on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    markup    : 'post-row',  // 테마 > _html > post-card-full.html
    totalNUM  : '<?php echo $NUM?>',
    recnum    : '',
    totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostAll(settings);

})

$('#modal-post-alllist').on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    markup    : 'list-row',  // 테마 > _html > post-card-full.html
    totalNUM  : '<?php echo $NUM?>',
    recnum    : '',
    totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostListAll(settings);

})

$('#modal-post-listview').on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var wrapper = modal.find('[data-role="box"]');
  var listid = button.attr('data-id');
  wrapper.html('');

  getPostListview({
    listid : listid,
    wrapper : wrapper,
    markup    : 'listview-box',  // 테마 > _html > list-tableview.html
    totalNUM  : '<?php echo $NUM?>',
    recnum    : '<?php echo $recnum ?>',
    totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
    sort      : '<?php echo $sort ?>',
    orderby   : '<?php echo $orderby ?>',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  });

})

$('#modal-post-view-video').on('shown.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var mod = 'modal';
  var uid = button.attr('data-uid');
  var list = button.attr('data-list');
  var featured = button.attr('data-featured');
  var provider = button.attr('data-provider');
  var videoId = button.attr('data-videoId');
  getPostView({
    mod : mod,
    uid : uid,
    list : list,
    featured : featured,
    provider : provider,
    videoId : videoId,
    wrapper : modal,
    markup    : 'view_video',  // 테마 > _html >
  });
})

$('#modal-post-view-video').on('hidden.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  modal.find('oembed').empty().removeAttr('url');
  modal.find('[data-role="featured"]').removeClass('d-none');
  modal.find('[data-role="listCollapse"]').empty();
  modal.find('[data-role="box"]').empty();

  player = new YT.Player('modal-player');
  player.destroy()

  modal.find('.embed-responsive').append($('<oembed/>', {
    id: 'modal-player'
  }));
})

$('#page-post-view-video').on('shown.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var mod = 'page';
  var uid = button.attr('data-uid');
  var list = button.attr('data-list');
  var featured = button.attr('data-featured');
  var provider = button.attr('data-provider');
  var videoId = button.attr('data-videoId');

  getPostView({
    mod : mod,
    uid : uid,
    list : list,
    featured : featured,
    provider : provider,
    videoId : videoId,
    wrapper : page,
    markup    : 'view_video',  // 테마 > _html >
  });
})

$('#page-post-view-video').on('hidden.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  page.find('oembed').empty().removeAttr('url');
  page.find('[data-role="featured"]').removeClass('d-none');
  page.find('[data-role="listCollapse"]').empty();
  page.find('[data-role="box"]').empty();

  player = new YT.Player('page-player');
  player.destroy()

  page.find('.embed-responsive').append($('<oembed/>', {
    id: 'page-player'
  }));

})



</script>
