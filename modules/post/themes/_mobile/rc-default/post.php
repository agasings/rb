<?php $recnum = 3 ?>

<header class="bar bar-nav bar-light bg-white px-0">
	<a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
	<a class="icon icon-search pull-right pl-2 pr-3" role="button" data-toggle="modal" data-target="#modal-post-search"></a>
	<a class="icon pull-right material-icons px-2" role="button" data-toggle="popup" data-target="#popup-post-filter">tune</a>
	<span class="title title-left" data-location="reload">전체 포스트</span>
</header>

<section class="content bg-faded">
	<div data-role="list"></div>
</section>

<script src="<?php echo $g['url_module_skin'] ?>/_js/post.js<?php echo $g['wcache']?>" ></script>

<script>

	getPostAll({
		wrapper : $('[data-role="list"]'),
		markup    : 'post-card-full',  // 테마 > _html > post-card-full.html
		totalNUM  : '<?php echo $NUM?>',
    recnum    : <?php echo $recnum ?>,
		totalPage : '<?php echo getTotalPage($NUM,$recnum)?>',
		sort      : '<?php echo $sort ?>',
		orderby   : '<?php echo $orderby ?>',
		none : '<div class="p-5 text-xs-center text-muted">등록된 포스트가 없습니다.</div>'
	});

</script>
