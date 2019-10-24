<!-- modal : 포스트 좋아요/싫어요 목록 -->
<div class="modal" tabindex="-1" role="dialog" id="modal-post-opinion">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 bg-light">

        <div class="media align-items-center">
          <span class="position-relative mr-3">
            <img class="border" data-role="featured_img" src="" alt="" style="width:100px">
          </span>
          <div class="media-body">
            <h5 class="f14 my-1 line-clamp-2">
              <span class="font-weight-light" data-role="subject"></span>
            </h5>
            <div class="mb-1">
              <ul class="list-inline d-inline-block f13 text-muted mb-0">
                <li class="list-inline-item">조회 <span data-role="hit"></span></li>
                <li class="list-inline-item">좋아요 <span data-role="likes"></span></li>
                <li class="list-inline-item">댓글 <span data-role="comment"></span></li>
              </ul>
            </div>
          </div>
        </div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <nav class="bg-light" style="margin-top: -5px;">
        <div class="nav nav-tabs nav-fill" role="tablist">
          <a class="nav-item nav-link active rounded-0 border-left-0" data-toggle="tab" href="#post-likesList" role="tab">
            좋아요 <span class="badge" data-role="like-num"></span>
          </a>
          <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#post-dislikesList" role="tab">
            싫어요  <span class="badge" data-role="dislike-num"></span>
          </a>
        </div>
      </nav>
      <div class="modal-body p-0">

        <div data-role="loader" class="d-none">
          <div class="d-flex justify-content-center align-items-center"  style="height:150px">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div class="tab-content p-0">
          <div class="tab-pane active" id="post-likesList" role="tabpanel" data-role="like">
            <div class="list-group list-group-flush" data-role="list"></div>
          </div>
          <div class="tab-pane" id="post-dislikesList" role="tabpanel" data-role="dislike">
            <div class="p-5 text-muted text-center">
              준비중입니다.
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- modal : 포스트 통계 -->
<div class="modal" tabindex="-1" role="dialog" id="modal-post-analytics">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 bg-light">

        <div class="media align-items-center">
          <span class="position-relative mr-3">
            <img class="border" data-role="featured_img" src="" alt="" style="width:100px">
          </span>
          <div class="media-body">
            <h5 class="f14 my-1 line-clamp-2">
              <span class="font-weight-light" data-role="subject"></span>
            </h5>
            <div class="mb-1">
              <ul class="list-inline d-inline-block f13 text-muted mb-0">
                <li class="list-inline-item">조회 <span data-role="hit"></span></li>
                <li class="list-inline-item">좋아요 <span data-role="likes"></span></li>
                <li class="list-inline-item">댓글 <span data-role="comment"></span></li>
              </ul>
            </div>
          </div>
        </div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <nav class="bg-light" style="margin-top: -5px;">
        <div class="nav nav-tabs nav-fill" role="tablist">
          <a class="nav-item nav-link active rounded-0 border-left-0" data-toggle="tab" href="#post-summary" role="tab">요약</a>
          <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#post-hit" role="tab">조회수</a>
          <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#post-likes" role="tab">좋아요</a>
          <a class="nav-item nav-link rounded-0" data-toggle="tab" href="#post-comment" role="tab">댓글</a>
          <a class="nav-item nav-link rounded-0 border-right-0" data-toggle="tab" href="#post-referer" role="tab">유입추이</a>
        </div>
      </nav>
      <div class="modal-body">

        <div data-role="_loader" class="d-none">
          <div class="d-flex justify-content-center align-items-center"  style="height:385px">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>

        <div class="dropdown">
          <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            지난 1주일
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">지난 한달</a>
            <a class="dropdown-item" href="#">지난달</a>
            <a class="dropdown-item" href="#">월별보기</a>
          </div>
        </div>


        <div class="tab-content">
          <div class="tab-pane active" id="post-summary" role="tabpanel">

            <canvas style="height: 450px"></canvas>

          </div>
          <div class="tab-pane" id="post-hit" role="tabpanel">

            <canvas style="height: 450px"></canvas>

          </div>
          <div class="tab-pane" id="post-likes" role="tabpanel">


          </div>
          <div class="tab-pane" id="post-comment" role="tabpanel">


          </div>
          <div class="tab-pane" id="post-referer" role="tabpanel">
            <canvas style="height: 450px" id="canvas-referer"></canvas>
          </div>
        </div>


      </div>

    </div>
  </div>
</div>


<script>

function setPostTrendChart(uid,mod) {

	if (mod=='hit') var chartSet = ['조회수 추이','#cce5ff','#004085']; //label ,backgroundColor,borderColor
	if (mod=='likes') var chartSet = ['좋아요 추이','#d4edda','#155724'];
	if (mod=='comment') var chartSet = ['댓글 추이','#f8d7da','#721c24'];
	if (mod=='follower') var chartSet = ['구독자 추이','#ffeeba','#856404'];

	var _ele = $('#post-hit').find('canvas');
	_ele.addClass('d-none');

	$('[data-role="loader"]').removeClass('d-none');

	$.post(rooturl+'/?r='+raccount+'&m=post&a=get_postTrend',{
    uid : uid,
		mod : mod,
		d_start : '<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4))) ?>'  //일주일전
		},function(response,status){
			if(status=='success'){
				var result = $.parseJSON(response);
				var chartLabel=result.label;
				var chartData=result.data;

				var data = {
					labels: chartLabel,
					datasets: [{
							label: chartSet[0],
							backgroundColor: chartSet[1],
							borderColor: chartSet[2],
							data: chartData
					}]
				};
				var chart = new Chart(_ele, {
					type: 'line',
					data: data,
					options: {}
				});
				_ele.removeClass('d-none');
				$('[data-role="loader"]').addClass('d-none');

			} else {
				alert(status);
			}
	});
}



$( document ).ready(function() {


  $('#modal-post-opinion').on('shown.bs.modal', function (e) {
    var modal = $(this);
    var button = $(e.relatedTarget);
    var uid = button.attr('data-uid');
    var opinion = button.attr('data-opinion');

    var item = button.closest('[data-role="item"]');
    var subject = item.attr('data-subject');
    var featured_img = item.attr('data-featured_img');
    var hit = item.attr('data-hit');
    var likes = item.attr('data-likes');
    var comment = item.attr('data-comment');

    modal.find('[data-role="loader"]').removeClass('d-none');
    modal.find('[data-role="like"] [data-role="list"]').html(''); //초기화
    modal.find('[data-role="like-num"]').text('');

    modal.find('[data-role="subject"]').text(subject);
    modal.find('[data-role="featured_img"]').attr('src',featured_img);
    modal.find('[data-role="hit"]').text(hit);
    modal.find('[data-role="likes"]').text(likes);
    modal.find('[data-role="comment"]').text(comment);

		setTimeout(function(){
      $.post(rooturl+'/?r='+raccount+'&m=post&a=get_opinionList',{
           uid : uid,
           opinion : opinion
        },function(response){
				 var result = $.parseJSON(response);
				 var _uid=result.uid;
				 var list=result.list;
				 var num=result.num;
         modal.find('[data-role="loader"]').addClass('d-none');

				 if (num) {
					 modal.find('[data-role="like"] [data-role="list"]').html(list);
           modal.find('[data-role="like-num"]').text(num);
				 } else {
				 	modal.find('[data-role="like"] [data-role="list"]').html('<div class="py-5 text-center text-muted">자료가 없습니다.</div>');
				 }

			 });
		 }, 300);
  })


  $('#modal-post-analytics').on('shown.bs.modal', function (e) {
    var modal = $(this);
    var button = $(e.relatedTarget);
    var uid = button.attr('data-uid');
    var mod = 'hit';

    var item = button.closest('[data-role="item"]');
    var subject = item.attr('data-subject');
    var featured_img = item.attr('data-featured_img');
    var hit = item.attr('data-hit');
    var likes = item.attr('data-likes');
    var comment = item.attr('data-comment');

    modal.find('[data-role="subject"]').text(subject);
    modal.find('[data-role="featured_img"]').attr('src',featured_img);
    modal.find('[data-role="hit"]').text(hit);
    modal.find('[data-role="likes"]').text(likes);
    modal.find('[data-role="comment"]').text(comment);

    setPostTrendChart(uid,mod);

  })

});

</script>
