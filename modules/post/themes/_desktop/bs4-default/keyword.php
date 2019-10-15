<section>





	<h1 class="h4 my-5 text-center">'<?php echo $keyword ?>' 	<small class="text-muted">포스트 검색결과 <?php echo $NUM ?>개</small></h1>

	<hr>
	<?php if ($NUM): ?>
	<ul class="list-unstyled" data-plugin="markjs">
	<?php foreach($RCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>

	<li class="media my-4">
		<?php if ($R['featured_img']): ?>

			<a href="<?php echo getPostLink($R,0) ?>" class="position-relative mr-3">
				<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
				<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo getUpImageTime($R) ?></time>
			</a>
		<?php endif; ?>

		<div class="media-body">
			<h5 class="mt-0 mb-1">
				<a href="<?php echo getPostLink($R,0) ?>">
					<?php echo $R['subject']?>
				</a>
			</h5>
			<div class="text-muted mb-1"><?php echo $R['review']?></div>
			<div class="mb-1">
				<ul class="list-inline d-inline-block ml-2 f13 text-muted">
					<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
					<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
					<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
					<li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></li>
				</ul>
				<span class="ml-2 f13 text-muted">
					<i class="fa fa-folder-o mr-1" aria-hidden="true"></i> <?php echo getAllPostCat($R['uid']) ?>
				</span>
				<span class="ml-2 f13 text-muted">
					<!-- 태그 -->
					<?php $_tags=explode(',',$R['tag'])?>
					<?php $_tagn=count($_tags)?>
					<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
					<?php $_tagk=trim($_tags[$i])?>
					<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>">
						# <?php echo $_tagk?>
					</a>
					<?php endfor?>
				</span>
			</div>

		</div>

	</li>
	<?php endforeach?>
	</ul>

	<?php else: ?>

		<div class="p-5 text-center text-muted">
			자료가 없습니다.
		</div>

	<?php endif; ?>

</section>

<!-- markjs js : https://github.com/julmot/mark.js -->
<?php getImport('markjs','jquery.mark.min','8.11.1','js')?>

<script>

$( document ).ready(function() {

	// marks.js
	$('[data-plugin="markjs"]').mark("<?php echo $keyword ?>");

});

</script>
