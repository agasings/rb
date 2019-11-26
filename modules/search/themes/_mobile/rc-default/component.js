var modal_search = $('#modal-search');

function getSearchResult(settings) {
  var wrapper = settings.wrapper;
  var start = settings.start;
  var none = settings.none;

  wrapper.find('.content').loader({ position: 'inside' });

  setTimeout(function(){
    wrapper.find('.content').html(none)
    wrapper.find('[data-role="keyword-reset"]').removeClass("hidden");
  }, 1000);

} // getSearchResult

//검색 모달이 열렸을때
modal_search.on('shown.rc.modal', function () {
  var modal = $(this);
  setTimeout(function() {
    modal_search.find('#search-input').val('').focus();
  }, 100);

  modal_search.find('#search-input').autocomplete({
    lookup: function (query, done) {

       $.getJSON(rooturl+"/?m=tag&a=searchtag", {q: query}, function(res){
           var sg_tag = [];
           var data_arr = res.taglist.split(',');//console.log(data.usernames);
           $.each(data_arr,function(key,tag){
               var tagData = tag.split('|');
               var keyword = tagData[0];
               var hit = tagData[1];
               sg_tag.push({"value":keyword,"data":hit});
           });
           var result = {
               suggestions: sg_tag
           };
            done(result);
       });
   },
      onSelect: function (suggestion) {
        if (modal_search.find('#search-input').val().length >= 1) {

          getSearchResult({
            wrapper : modal,
            markup    : 'search-row',  // 테마 > _html > post-row.html
            totalNUM  : '',
            recnum    : '',
            totalPage : '',
            sort      : 'gid',
            none : '<div class="p-5 text-xs-center text-muted" data-role="none">검색된 자료가 없습니다.</div>'
          });

        }
      }
  });
})

//검색실행
modal_search.find('form').submit( function(e){
  var modal = modal_search;
  e.preventDefault();
  e.stopPropagation();

  getSearchResult({
    wrapper : modal,
    markup    : 'search-row',  // 테마 > _html > post-row.html
    totalNUM  : '',
    recnum    : '',
    totalPage : '',
    sort      : 'gid',
    none : '<div class="p-5 text-xs-center text-muted" data-role="none">검색된 자료가 없습니다.</div>'
  });

});

// 검색버튼과 검색어 초기화 버튼 동적 출력
modal_search.find('#search-input').on('keyup', function(event) {
  var modal = modal_search
  modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
  modal.find("#drawer-search-footer").addClass('hidden') //검색풋터(검색버튼 포함) 숨김
  modal.find('[data-role="none"]').addClass('d-none');
  if ($(this).val().length >= 2) {
    modal.find('[data-role="keyword-reset"]').removeClass("hidden");
  }
});

// 검색어 입력필드 초기화
$(document).on('tap click','[data-act="keyword-reset"]',function(){
  var modal = modal_search
  modal.find("#search-input").val('').autocomplete('clear'); // 입력필드 초기화
  setTimeout(function(){
    modal.find("#search-input").focus(); // 입력필드 포커싱
    modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
    modal.find('[data-role="none"]').addClass('d-none');
  }, 10);
});

// 검색모달이 닫혔을때
modal_search.on('hidden.rc.modal', function () {
  var modal = $(this)
  modal.find('#search-input').autocomplete('clear');
  $('.autocomplete-suggestions').remove();
  modal.find("#search-input").val('');
  modal.find('.content').html('');
  modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김'
})
