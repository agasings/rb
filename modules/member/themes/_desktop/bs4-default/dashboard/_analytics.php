<header class="d-flex justify-content-between align-items-center py-2">
	<strong>통계분석</strong>
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
				<a class="nav-link active" href="#">조회수</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">좋아요</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" tabindex="-1" aria-disabled="true">구독자</a>
			</li>
		</ul>

		<small class="text-muted" data-toggle="tooltip" title="10.01~10.07">최근 일주일</small>
	</div>
	<canvas class="card-body" id="myChart"></canvas>
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
