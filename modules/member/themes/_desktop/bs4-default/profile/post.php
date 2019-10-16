<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'mbruid='.$_MP['uid'].' and site='.$s;

if (!$_IS_PROFILEOWN) {
	if ($my['uid']) $postque .= ' and display = 2 or display = 4';  // 회원공개와 전체공개 포스트 출력
	else $postque .= ' and display = 4'; // 전체공개 포스트만 출력
}

if ($sort == 'gid' && !$keyword) {

	$TCD = getDbArray($table['postmember'],$postque,'*',$sort,$orderby,$recnum,$p);
	while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'gid='.$_R['gid'],'*');
	$NUM = getDbRows($table['postmember'],$postque);


} else {

	if ($where && $keyword) {
		if (strstr('[name][nic][id][ip]',$where)) $postque .= " and ".$where."='".$keyword."'";
		else if ($where == 'term') $postque .= " and d_regis like '".$keyword."%'";
		else $postque .= getSearchSql($where,$keyword,$ikeyword,'or');
	}

	$orderby = 'desc';
	$NUM = getDbRows($table['postdata'],$postque);
	$TCD = getDbArray($table['postdata'],$postque,'*',$sort,$orderby,$recnum,$p);
	while($_R = db_fetch_array($TCD)) $RCD[] = $_R;
}

$TPG = getTotalPage($NUM,$recnum);

switch ($sort) {
	case 'hit'     : $sort_txt='조회순';break;
	case 'likes'   : $sort_txt='추천순';break;
	case 'comment' : $sort_txt='댓글순';break;
	default        : $sort_txt='최신순';break;
}

?>


<div class="page-wrapper row">
	<div class="col-3 page-nav">

		<?php include $g['dir_module_skin'].'_vcard.php';?>
	</div>

	<div class="col-9 page-main">
		<?php include $g['dir_module_skin'].'_nav.php';?>

		<section>

			<header class="d-flex justify-content-between align-items-center mt-3 mb-2">
				<div>
					<?php echo number_format($NUM)?>개 <small class="text-muted">(<?php echo $p?>/<?php echo $TPG?>페이지)</small>
				</div>

				<div class="form-inline">

					<div class="dropdown">
						<a class="btn btn-white btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							정열 : <?php echo $sort_txt ?>
						</a>
						<div class="dropdown-menu" style="min-width: 100px;">
							<button class="dropdown-item<?php echo $sort=='gid'?' active':'' ?>" type="button" data-sort="gid">
								최신순
							</button>
							<button class="dropdown-item<?php echo $sort=='hit'?' active':'' ?>" type="button" data-sort="hit">
								조회순
							</button>
							<button class="dropdown-item<?php echo $sort=='likes'?' active':'' ?>" type="button" data-sort="likes">
								추천순
							</button>
							<button class="dropdown-item<?php echo $sort=='comment'?' active':'' ?>" type="button" data-sort="comment">
								댓글순
							</button>
						</div>
					</div>

					<?php if ($_IS_PROFILEOWN): ?>
					<a href="<?php echo RW('mod=dashboard&page=post')?>" class="btn btn-white btn-sm ml-2">관리</a>
					<?php endif; ?>

				</div><!-- /.form-inline -->

			</header>

			<ul class="list-unstyled" style="margin-top: -1rem">

				<?php foreach($RCD as $R):?>
			  <li class="media mt-4">

					<a href="<?php echo getPostLink($R,1) ?>" class="position-relative mr-3">
						<img class="border" src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
						<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo getUpImageTime($R) ?></time>
					</a>

			    <div class="media-body">
			      <h5 class="my-1 font-weight-light">
							<a href="<?php echo getPostLink($R,1) ?>" class="muted-link" ><?php echo $R['subject']?></a>
						</h5>
						<div class="mb-1">
							<ul class="list-inline d-inline-block f13 text-muted">
								<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
								<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
								<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
								<li class="list-inline-item">
									<time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>"></time>
									<?php if(getNew($R['d_regis'],12)):?><small class="text-danger">new</small><?php endif?>
								</li>
							</ul>

							<?php if (IsPostCat($R['uid'])): ?>
							<span class="ml-2 f13 text-muted">
								<i class="fa fa-folder-o mr-1" aria-hidden="true"></i> <?php echo getAllPostCat($R['uid']) ?>
							</span>
							<?php endif; ?>

							<span class="ml-2 f13 text-muted">
								<!-- 태그 -->
								<?php $_tags=explode(',',$R['tag'])?>
								<?php $_tagn=count($_tags)?>
								<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
								<?php $_tagk=trim($_tags[$i])?>
								<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
								<?php endfor?>
							</span>
						</div>
			    </div>
			  </li>
				<?php endforeach?>

				<?php if(!$NUM):?>
				<li>
					<div class="d-flex align-items-center justify-content-center" style="height: 40vh">
						<div class="text-muted">포스트가 없습니다.</div>
					</div>
				</li>
				<?php endif?>

			</ul>


			<div class="d-flex justify-content-between my-4">
				<div class=""></div>

				<?php if ($NUM > $recnum): ?>
				<ul class="pagination mb-0">
					<?php $_N =  $GLOBALS['_HS']['rewrite']?'./'.$page.'?sort='.$sort.'&':'' ?>
	        <?php echo getPageLink(10,$p,$TPG,$_N)?>
				</ul>
				<?php endif; ?>

				<div class="">
				</div>
			</div>

			<footer class="d-flex justify-content-between align-items-center my-4">
				<div class=""></div>
				<form name="postsearchf" action="<?php echo $GLOBALS['_HS']['rewrite']?'./'.$page:$g['s'].'/' ?>" class="form-inline">

					<?php if ($GLOBALS['_HS']['rewrite']): ?>
					<input type="hidden" name="sort" value="<?php echo $sort?>">
					<?php else: ?>
					<input type="hidden" name="r" value="<?php echo $r?>">
					<?php if($_mod):?>
					<input type="hidden" name="mod" value="<?php echo $_mod?>">
					<?php else:?>
					<input type="hidden" name="m" value="<?php echo $m?>">
					<input type="hidden" name="front" value="<?php echo $front?>">
					<?php endif?>
					<input type="hidden" name="page" value="<?php echo $page?>">
					<input type="hidden" name="sort" value="<?php echo $sort?>">
					<input type="hidden" name="orderby" value="<?php echo $orderby?>">
					<input type="hidden" name="recnum" value="<?php echo $recnum?>">
					<input type="hidden" name="type" value="<?php echo $type?>" />
					<input type="hidden" name="mbrid" value="<?php echo $_MP['id']?>">
					<?php endif; ?>


					<select name="where" class="form-control custom-select">
						<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
						<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
					</select>

					<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="form-control ml-2">
					<button class="btn btn-light ml-2" type="submit">검색</button>

					<?php if ($keyword): ?>
					<a class="btn btn-light ml-1" href="<?php echo getProfileLink($_MP['uid']).$para_str.$page ?>">리셋</a>
					<?php endif; ?>
				</form>
				<div class=""></div>
		  </footer>

		</section>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->


<script>

$( document ).ready(function() {

	$('[data-sort]').click(function(){
		var sort =  $(this).attr('data-sort');
		var form =  $('[name="postsearchf"]')

		$('[name="where"],[name="keyword"]').remove();
		form.find('[name="sort"]').val(sort)
		form.submit();
	});

});


</script>
