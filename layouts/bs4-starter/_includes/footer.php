<footer class="container my-5 border-top py-4">

	<div class="d-flex justify-content-between">
		<span class="text-muted">© Company <?php echo $date['year']?></span>

		<ul class="list-inline">
			<li class="list-inline-item">
				<a href="<?php echo RW('mod=policy')?>" class="muted-link">이용약관</a>
			</li>
			<li class="list-inline-item">
				<a href="<?php echo RW('mod=privacy')?>" class="muted-link">개인정보취급방침</a>
			</li>

			<?php if ($my['uid']): ?>
			<li class="list-inline-item">
				<a href="<?php echo $g['s']?>/logout" class="muted-link" title="">
					로그아웃
				</a>
			</li>
			<?php else: ?>
			<li class="list-inline-item">
				<a href="<?php echo RW('mod=login')?>" class="muted-link" title="페이지형 로그인">
					로그인<span class="badge badge-pill badge-light align-middle">P</span>
				</a>
			</li>
			<li class="list-inline-item">
				<a href="#modal-login" data-toggle="modal" class="muted-link" title="모달형 로그인">
					로그인<span class="badge badge-pill badge-light align-middle">M</span>
				</a>
			</li>
			<?php endif; ?>

		</ul>
	</div>
	<p><!-- 출력을 원치 않으실 경우 지우세요 -->Powered by kimsQ rb (Runtime <?php echo round(getNowTimes()-$g['time_start'],3)?>)</p>

</footer>

<!-- highlight.js : https://github.com/highlightjs/highlight.js -->
<?php getImport('highlight.js','styles/default','9.15.8','css') ?>
<?php getImport('highlight.js','highlight.pack','9.15.8','js') ?>

<script>
$(document).ready(function() {
	$('pre').each(function(i, block) {
		hljs.highlightBlock(block);
	});
});



</script>
