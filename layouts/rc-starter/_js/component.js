$( document ).ready(function() {

  //포스트 : 전체 포스트 보기
  $('#page-post-allpost').on('show.rc.page', function(event) {
    var button = $(event.relatedTarget);
    var page = $(this);
    var wrapper = page.find('[data-role="list"]');
    wrapper.html('');

    getPostAll({
      wrapper : wrapper,
      markup    : 'post-row',  // 테마 > _html > post-row.html
      totalNUM  : '',
      recnum    : '',
      totalPage : '',
      sort      : 'gid',
      none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
    });
  })

  //포스트 : 전체 리스트 보기
  $('#page-post-alllist').on('show.rc.page', function(event) {
    var button = $(event.relatedTarget);
    var page = $(this);
    var wrapper = page.find('[data-role="list"]');
    wrapper.html('');

    getPostListAll({
      wrapper : wrapper,
      start : '#page-post-alllist',
      markup    : 'list-row',  // 테마 > _html > list-row.html
      totalNUM  : '',
      recnum    : '',
      totalPage : '',
      sort      : 'gid',
      none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
    });
  })

  //포스트 : 특정 리스트 보기
  $('#page-post-listview').on('show.rc.page', function(event) {
    var button = $(event.relatedTarget);
    var page = $(this);
    var wrapper = page.find('[data-role="box"]');
    var listid = button.attr('data-id');
    wrapper.html('');

    getPostListview({
      listid : listid,
      wrapper : wrapper,
      markup    : 'listview-box',  // 테마 > _html > listview-box.html
      totalNUM  : '',
      recnum    : '',
      totalPage : '',
      sort      : '',
      orderby   : '',
      none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
    });
  })


});
