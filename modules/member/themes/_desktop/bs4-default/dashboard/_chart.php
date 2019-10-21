<header class="d-flex justify-content-between align-items-center py-2">
	<strong>포스트 활동추이</strong>
	<div class="mr-2">
		<a href="/dashboard?page=analytics" class="muted-link small">
			더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
		</a>
	</div>
</header>

<div class="card shadow-sm" id="widget-post-chart">
	<div class="card-header d-flex justify-content-between align-items-end">
		<ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#chart-hit">조회수 전체</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-likes">좋아요 전체</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-comment">댓글 전체</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-follower">구독자</a>
			</li>
		</ul>
		<small class="text-muted" data-toggle="tooltip" title="<?php echo date('m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>~<?php echo getDateFormat($date['today'],'m/d')?>">최근 일주일</small>
	</div>
	<div class="tab-content card-body">
		<div class="tab-pane show active" id="chart-hit" role="tabpanel">
			<canvas></canvas>
		</div>
		<div class="tab-pane" id="chart-likes" role="tabpanel">
			<canvas></canvas>
		</div>
		<div class="tab-pane" id="chart-comment" role="tabpanel">
			<canvas></canvas>
		</div>
		<div class="tab-pane" id="chart-follower" role="tabpanel">
			<canvas></canvas>
		</div>
	</div>
</div>

<script>

function setWidgetPostLineChart(ele,chartLabels,chartSet,chartData) {
	if (!chart) {
		var data = {
			labels: chartLabels,
			datasets: [{
					label: chartSet[0],
					backgroundColor: chartSet[1],
					borderColor: chartSet[2],
					data: chartData
			}]
		};
		var chart = new Chart(ele, {
			type: 'line',
			data: data,
			options: {}
		});
	}
}

$(document).ready(function(){

	var ele = $('#chart-hit canvas');
	var labels = ['1월', '2월', '3월', '4월', '5월', '6월', '7월'];
	var set = ['조회수 추이','#cce5ff','#004085'] //label ,backgroundColor,borderColor
	var data =  [10, 20, 15, 22, 20, 30, 35];
	setWidgetPostLineChart(ele,labels,set,data);

	$('#widget-post-chart').find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var chartLabels = [];
		var chartData = [];
		var target = $(this).attr('href');
		var sort = $(this).data('sort');
		var ele = $(target).find('canvas');
		var labels = ['1월', '2월', '3월', '4월', '5월', '6월', '7월'];

		var previous_target = $(e.relatedTarget).attr('href')
		var previous_canvas = $(previous_target).find('canvas').empty();

		if (target=='#chart-hit') {
			var set = ['조회수 추이','#cce5ff','#004085'] //label ,backgroundColor,borderColor
			var data =  [10, 20, 15, 22, 20, 30, 35];
		}

		if (target=='#chart-likes') {
			var set = ['좋아요 추이','#d4edda','#155724'] //label ,backgroundColor,borderColor
			var data =  [80, 50, 5, 2, 20, 30, 35];
		}
		if (target=='#chart-comment') {
			var set = ['댓글 추이','#f8d7da','#721c24'] //label ,backgroundColor,borderColor
			var data =  [50, 10, 5, 2, 20, 30, 35];
		}
		if (target=='#chart-follower') {
			var set = ['팔로워 추이','#ffeeba','#856404'] //label ,backgroundColor,borderColor
			var data =  [20, 30, 5, 2, 20, 30, 45];
		}


		setWidgetPostLineChart(ele,labels,set,data);
	})

});

</script>
