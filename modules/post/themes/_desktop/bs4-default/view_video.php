
<section class="post-section row">

	<div class="col-8">

		<oembed url="<?php echo getFeaturedimgMeta($R,'linkurl') ?>">
			<div class="bg-light border d-flex align-items-center justify-content-center text-muted" style="height: 360px">
				<div class="spinner-border" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
			</div>
		</oembed>

		<h2 class="mt-4 h5"><?php echo $R['subject'] ?></h2>

		<div class="page-meta border-bottom pb-4 mb-4">
			<div class="d-flex justify-content-between">

				<div class="text-muted">

					<span class="mr-1">
						조회수 <?php echo $R['hit']?>회
					</span>

					<span class="badge badge-light align-middle border border-success text-success mr-1"><?php echo $g['projectSet']['type'][$R['type']] ?></span>
					<time class="mr-1">
						•<?php echo getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'Y-m-d H:i') ?>
					</time>

				</div>
				<div class="">

					<?php if (!$R['disabled_like']): ?>
					<span class="ml-2">· <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="text-muted" data-role=like_num><?php echo $R['likes']?></span></span>
					<?php endif; ?>

					<?php if ($R['num_rating'] && !$R['disabled_rating']): ?>
					<span class="ml-2" data-toggle="tooltip" title="참여: <?php echo $R['num_rating'] ?>명 , 평점 <?php echo $R['rating']/$R['num_rating']?>" role="button">· <i class="fa fa-star-o" aria-hidden="true"></i>
					<a href="#" class="muted-link"> <?php echo $R['rating']/$R['num_rating']?></a></span>
					<?php endif; ?>

					<?php if($_perm['post_owner']):?>
 					 <a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="btn btn-white text-danger">관리</a>
 					<?php endif?>

				</div>
			</div><!-- /.page-meta-body -->
		</div>


		<div class="d-flex justify-content-between">

			<div class="media">
				<a href="<?php echo getProfileLink($R['mbruid']) ?>" class="mr-3">
			  	<img src="<?php echo getAvatarSrc($R['mbruid'],'48') ?>" class="rounded-circle" width="48" height="48" alt="<?php echo $M1[$_HS['nametype']] ?>의 프로필">
				</a>
			  <div class="media-body pt-1">
			    <h6 class="mb-1"><?php echo $M1[$_HS['nametype']] ?></h6>
					<p class="text-muted"><?php echo $M1['email'] ?></p>

					<!-- 태그 -->
					<?php if ($R['tag']): ?>
					<div class="mb-2">
					  <?php $_tags=explode(',',$R['tag'])?>
					  <?php $_tagn=count($_tags)?>
					  <?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
					  <?php $_tagk=trim($_tags[$i])?>
					  <a class="badge badge-light rounded-0 f15 font-weight-light bg-light border-0 py-2" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>">
					  #<?php echo $_tagk?>
					  </a>
					  <?php endfor?>
					</div>
					<?php endif; ?>


					<!-- 본문 -->
					<article class="rb-article" data-plugin="shorten">
						<?php echo getContents($R['content'],$R['html'])?>

						<?php if (IsPostCat($R['uid'])): ?>
            <span class="ml-2 f13 text-muted">
              <i class="fa fa-folder-o mr-1" aria-hidden="true"></i> <?php echo getAllPostCat($R['uid']) ?>
            </span>
            <?php endif; ?>

					</article>

					<section class="mt-1">
						<?php include $g['dir_module_skin'].'_view_attach.php'?>
					</section>

			  </div>
			</div><!-- /.media -->

		</div><!-- /.d-flex -->

		<?php if (!$R['dis_comment']): ?>
		<aside class="border-top mt-4 pt-4">
			<?php include $g['dir_module_skin'].'_comment.php'?>
		</aside>
		<?php endif; ?>


	</div><!-- /.col -->

	<div class="col-4 pr-0">

		<?php if ($list): ?>
		<div class="d-flex justify-content-between align-items-center py-2 mt-3 mb-4 border-bottom border-dark">
			<h3 class="h4 mb-0">
				<a href="<?php echo getListLink($LIST,$mbrid?1:0) ?>" data-toggle="tooltip" title="<?php echo $MBR['name'] ?>의 리스트" class="d-inline-block align-bottom">
					<img src="<?php echo getAvatarSrc($LIST['mbruid'],'30') ?>" width="30" height="30" alt="<?php echo $MBR['name'] ?>" class="mr-1 rounded-circle">
				</a>
				<?php echo $LIST['name'] ?>
			</h3>
			<div class="">
					<button class="btn btn-white" data-history="back" type="button">이전</button>
			</div>
		</div>
		<?php endif; ?>

		<?php include $g['dir_module_skin'].'_newPost.php' ?>


		<?php include $g['dir_module_skin'].'_newList.php' ?>


	</div><!-- /.col -->

</section>


<!-- jquery.shorten : https://github.com/viralpatel/jquery.shorten -->
<?php getImport('jquery.shorten','jquery.shorten.min','1.1.0','js')?>

<script>
$('[data-plugin="shorten"]').shorten({
	moreText: '더보기',
	lessText: ''
});
</script>
