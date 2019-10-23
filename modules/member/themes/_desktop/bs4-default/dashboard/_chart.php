<header class="d-flex justify-content-between align-items-center py-2">
	<strong>포스트 통합추이</strong>
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
				<a class="nav-link active" data-toggle="tab" href="#chart-hit" data-mod="hit">조회수</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-likes" data-mod="likes">좋아요</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-comment" data-mod="comment">댓글</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-referer" data-mod="referer">외부유입</a>
			</li>
		</ul>
		<small class="text-muted" data-toggle="tooltip" title="<?php echo date("m/d", strtotime("-1 week")).'~'. date("m/d", strtotime("now"))  ?>">
			최근 일주일
		</small>
	</div>
	<div class="tab-content card-body">
		<div data-chart="loader">
			<div class="d-flex justify-content-center align-items-center"  style="height:267px">
				<div class="spinner-border" role="status">
					<span class="sr-only">Loading...</span>
				</div>
			</div>
		</div>
		<div class="tab-pane show active" id="chart-hit" role="tabpanel">
			<canvas class="d-none"></canvas>
		</div>
		<div class="tab-pane" id="chart-likes" role="tabpanel">
			<canvas class="d-none"></canvas>
		</div>
		<div class="tab-pane" id="chart-comment" role="tabpanel">
			<canvas class="d-none"></canvas>
		</div>
		<div class="tab-pane" id="chart-referer" role="tabpanel">
			<canvas class="d-none"></canvas>
		</div>
	</div>
</div>

<script>

function setWidgetPostLineChart(ele,mod) {

	if (mod=='hit') var chartSet = ['조회수 추이','#cce5ff','#004085']; //label ,backgroundColor,borderColor
	if (mod=='likes') var chartSet = ['좋아요 추이','#d4edda','#155724'];
	if (mod=='comment') var chartSet = ['댓글 추이','#f8d7da','#721c24'];
	if (mod=='referer') var chartSet = ['유입경로 추이','#ffeeba','#856404'];

	var _ele = $(ele).find('canvas');
	_ele.addClass('d-none');
	$('[data-chart="loader"]').removeClass('d-none');

	$.post(rooturl+'/?r='+raccount+'&m=member&a=get_mbrTrend',{
		mod : mod,
		d_start : '<?php echo date("Ymd", strtotime("-1 week")); ?>'  //일주일전
		},function(response,status){
			if(status=='success'){
				var result = $.parseJSON(response);
				var chartLabel=result.label;
				var chartData=result.data;

				if (mod=='referer') {
					var data = {
						labels: chartLabel,
						datasets: [{
								label: chartSet[0],
								backgroundColor: chartSet[1],
								borderColor: chartSet[2],
								data: chartData
						}]
					};
				} else {

					var data = {
						labels: chartLabel,
						datasets: [{
								label: chartSet[0],
								backgroundColor: chartSet[1],
								borderColor: chartSet[2],
								data: chartData
						}]
					};

				}

				var chart = new Chart(_ele, {
					type: 'line',
					data: data,
					options: {}
				});
				_ele.removeClass('d-none');
				$('[data-chart="loader"]').addClass('d-none');

			} else {
				alert(status);
			}
	});
}

$(document).ready(function(){

	setWidgetPostLineChart('#chart-hit','hit');

	$('#widget-post-chart').find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(this).attr('href');
		var mod = $(this).data('mod');
		var ele = $(target).find('canvas');
		setWidgetPostLineChart(target,mod);
	})

});

</script>
