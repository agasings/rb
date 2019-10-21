<header class="d-flex justify-content-between align-items-center py-2">
	<strong>활동추이</strong>
	<div class="mr-2">
		<a href="/dashboard?page=analytics" class="muted-link small">
			더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
		</a>
	</div>
</header>

<div class="card shadow-sm">
	<div class="card-header d-flex justify-content-between align-items-end">
		<ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#chart-hit">조회수 전체</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-likes">좋아요 전체</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#chart-follower">구독자</a>
			</li>
		</ul>
		<small class="text-muted" data-toggle="tooltip" title="<?php echo date('m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>~<?php echo getDateFormat($date['today'],'m/d')?>">최근 일주일</small>
	</div>
	<div class="tab-content card-body">
		<div class="tab-pane show active" id="chart-hit" role="tabpanel">
			<canvas class="card-body" id="myChart"></canvas>
		</div>
		<div class="tab-pane" id="chart-likes" role="tabpanel">
			총 좋아요 추이
		</div>
		<div class="tab-pane" id="chart-follower" role="tabpanel">
			총 팔로워 추이
		</div>
	</div>
</div>

<script>

$(document).ready(function(){

	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
				labels: ['1월', '2월', '3월', '4월', '5월', '6월', '7월'],
				datasets: [{
						label: '조회수 추이',
						backgroundColor: '#e9f6fa',
						borderColor: '#007bff',
						data: [0, 10, 5, 2, 20, 30, 45]
				}]
		},

		// Configuration options go here
		options: {}
	});


});

</script>
