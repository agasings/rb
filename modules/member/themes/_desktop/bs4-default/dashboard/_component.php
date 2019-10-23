
<!-- modal : 포스트 통계 -->
<div class="modal" tabindex="-1" role="dialog" id="modal-post-analytics">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 bg-light">

        <div class="media align-items-center">
          <a href="/@564390154/post/9659207" class="position-relative mr-3" target="_blank">
            <img class="border" src="/thumb-ssl/100x56/u/i.ytimg.com/vi/iGCnbGPS3OE/maxresdefault.jpg" alt="" style="width:100px">
            <time class="badge badge-dark rounded-0 position-absolute" style="right:1px;bottom:1px">15:31</time>
          </a>
          <div class="media-body">
            <h5 class="f14 my-1 line-clamp-2">
              <a href="" class="font-weight-light muted-link">
                잡념 없애는 법 (2) 마음을 비우는 구체적 방법들, 잡념 처리에도 유효기간이 있다
              </a>
            </h5>
            <div class="mb-1">
              <ul class="list-inline d-inline-block f13 text-muted">
                <li class="list-inline-item">조회 5</li>
                <li class="list-inline-item">좋아요 1</li>
                <li class="list-inline-item">댓글 0</li>
                <li class="list-inline-item">
                  <time data-plugin="timeago" datetime="2019-10-21T15:29:28+09:00">약 21시간 전</time>
                </li>
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
          <a class="nav-item nav-link rounded-0 border-right-0" data-toggle="tab" href="#post-referer" role="tab">유입경로</a>
        </div>
      </nav>
      <div class="modal-body">

        <div data-role="loader" class="d-none">
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

  $('#modal-post-analytics').on('shown.bs.modal', function (e) {
    var modal = $(this);
    var button = $(e.relatedTarget);
    var uid = button.attr('data-uid');
    var mod = 'hit';

    setPostTrendChart(uid,mod);


  })



  var myDoughnutChart_ele = $('#post-summary').find('canvas');

  var myDoughnutChart_data = {
      datasets: [{
          data: [10, 20, 30],
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
          'Red',
          'Yellow',
          'Blue'
      ]
  };

  var myDoughnutChart = new Chart(myDoughnutChart_ele, {
      type: 'doughnut',
      data: myDoughnutChart_data,
      // options: options
  });


});








</script>
