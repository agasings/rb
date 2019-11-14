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

$('#page-post-keyword').on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);
  var keyword = button.attr('data-keyword');
  var wrapper = page.find('[data-role="list"]');
  wrapper.html('');

  var settings={
    wrapper : wrapper,
    start : '#page-post-keyword',
    markup    : 'keyword-row',  // 테마 > _html > post-card-full.html
    keyword : keyword,
    totalNUM  : '<?php echo $NUM?>',
    recnum    : '',
    totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
  }

  getPostKeyword(settings);

})

$('#modal-post-view_video').on('shown.rc.modal', function(event) {
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

$('#modal-post-view_video').on('hidden.rc.modal', function(event) {
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

$('#page-post-view_video').on('shown.rc.page', function(event) {
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

$('#page-post-view_doc').on('shown.rc.page', function(event) {
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
    markup    : 'view_doc',  // 테마 > _html >
  });
})

$('#page-post-view_video').on('hidden.rc.page', function(event) {
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

$('#page-post-view_doc').on('hidden.rc.page', function(event) {
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
