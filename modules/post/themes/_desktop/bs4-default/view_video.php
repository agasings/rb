<section class="post-section row">

	<div class="col-8">

		<oembed url="<?php echo getFeaturedimgMeta($R,'linkurl') ?>">
			<div class="bg-black d-flex align-items-center justify-content-center text-muted" style="height: 360px">
				<div class="spinner-border" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
			</div>
		</oembed>

		<h2 class="mt-4 h5"><?php echo $R['subject'] ?></h2>

		<div class="page-meta border-bottom pb-1 mb-4">
			<div class="d-flex justify-content-between align-items-center">

				<div class="text-muted">

					<span>
						조회수 <?php echo number_format($R['hit'])?>회
					</span>

					<span class="badge badge-light align-middle border border-success text-success mr-1"><?php echo $g['projectSet']['type'][$R['type']] ?></span>
					<time class="mr-1">
						•<?php echo getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'Y-m-d H:i') ?>
					</time>

				</div>
				<div class="">

					<!-- 좋아요 or 싫어요 -->
			    <?php if (!$R['dis_like']): ?>
			    <button type="button" class="btn btn-link muted-link px-2<?php if($is_liked):?> active<?php endif?>"
			      data-toggle="actionIframe"
			      data-url="<?php echo $g['post_action']?>opinion&amp;opinion=like&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
			      data-role="btn_post_like">
			      <i class="material-icons align-text-bottom">thumb_up</i>
			      <span data-role='likes_<?php echo $R['uid']?>' class="ml-1 f13 text-muted"><?php echo $R['likes']?$R['likes']:'좋아요'?></span>
			    </button>

			    <button type="button" class="btn btn-link muted-link px-2<?php if($is_disliked):?> active<?php endif?>"
			      data-toggle="actionIframe"
			      data-url="<?php echo $g['post_action']?>opinion&amp;opinion=dislike&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
			      data-role="btn_post_dislike">
			      <i class="material-icons align-text-bottom">thumb_down</i>
			      <span data-role='dislikes_<?php echo $R['uid']?>' class="ml-1 f13 text-muted"><?php echo $R['dislikes']?$R['dislikes']:'싫어요'?></span>
			    </button>
			    <?php endif; ?>

					<button type="button" class="btn btn-link muted-link px-2<?php if($is_disliked):?> active<?php endif?>"
						data-toggle="actionIframe"
						data-url="<?php echo $g['post_action']?>opinion&amp;opinion=dislike&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
						data-role="btn_post_dislike">
						<i class="material-icons align-text-bottom mirror">reply</i>
						<span class="f13 text-muted">공유</span>
					</button>

					<button type="button" class="btn btn-link muted-link px-2<?php if($is_disliked):?> active<?php endif?>"
						data-toggle="actionIframe"
						data-url="<?php echo $g['post_action']?>opinion&amp;opinion=dislike&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
						data-role="btn_post_dislike">
						<i class="material-icons align-text-bottom">playlist_add</i>
						<span class="f13 text-muted">저장</span>
					</button>

					<?php if ($R['num_rating'] && !$R['disabled_rating']): ?>
					<span class="ml-2" data-toggle="tooltip" title="참여: <?php echo $R['num_rating'] ?>명 , 평점 <?php echo $R['rating']/$R['num_rating']?>" role="button">· <i class="fa fa-star-o" aria-hidden="true"></i>
					<a href="#" class="muted-link"> <?php echo $R['rating']/$R['num_rating']?></a></span>
					<?php endif; ?>



				</div>
			</div><!-- /.page-meta-body -->
		</div>


		<div class="d-flex justify-content-between">

			<div class="media w-100">
				<a href="<?php echo getProfileLink($R['mbruid']) ?>" class="mr-3">
			  	<img src="<?php echo getAvatarSrc($R['mbruid'],'48') ?>" class="rounded-circle" width="48" height="48" alt="<?php echo $M1[$_HS['nametype']] ?>의 프로필">
				</a>
			  <div class="media-body pt-1">

					<div class="d-flex justify-content-between">
						<div class="mb-2">
							<h6 class="mb-1"><?php echo $M1[$_HS['nametype']] ?></h6>
							<p class="mb-0 text-muted"><?php echo $M1['email'] ?></p>
						</div>
						<div data-role="item" data-featured_img="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" data-subject="<?php echo $R['subject'] ?>">
							<?php if($_perm['post_owner']):?>

							<?php if ($R['likes'] || $R['dislikes']): ?>
							<button type="button" class="btn btn btn-outline-primary"
							 data-target="#modal-post-opinion"
							 data-opinion="like"
							 data-toggle="modal"
							 data-uid="<?php echo $R['uid'] ?>">
								좋아요 내역
							</button>
							<?php endif; ?>

							 <button type="button" class="btn btn btn-outline-primary"
							 	data-target="#modal-post-analytics"
								data-toggle="modal"
								data-uid="<?php echo $R['uid'] ?>">
								 분석
							 </button>
		 					 <a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="btn btn-primary">수정</a>
		 					<?php endif?>
						</div>
					</div><!-- /.flex -->


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
		<?php
		$LIST=getDbData($table[$m.'list'],"id='".$list."'",'*');
		$_WHERE = 'site='.$s;
		$_WHERE .= ' and list="'.$LIST['uid'].'"';
		$TCD = getDbArray($table[$m.'list_index'],$_WHERE,'*','gid','asc',11,1);
		$NUM = getDbRows($table[$m.'list_index'],$_WHERE);
		while($_R = db_fetch_array($TCD)) $LCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');
		?>

		<div class="card mb-4 shadow-sm">
		  <div class="card-body px-2 pt-2 pb-1">

				<a href="<?php echo getListLink($LIST,$mbrid?1:0) ?>" class="media text-reset text-decoration-none">
					<i class="material-icons mr-1 text-muted" style="font-size: 34px;">playlist_play</i>
					<div class="media-body">
						<h5 class="h6 mb-0">
							<?php echo $LIST['name'] ?>
						</h5>
				    <small class="text-muted"><?php echo $MBR['name'] ?></small>
					</div>
				</a><!-- /.media -->

		  </div>
		  <ul class="list-group list-group-flush">
				<?php foreach($LCD as $_L): ?>
				<a href="<?php echo getPostLink($_L,$mbrid?1:0).($GLOBALS['_HS']['rewrite']?'?':'&').'list='.$list ?>"
					class="list-group-item list-group-item-action p-1 pr-3 serial<?php echo $_L['cid']==$cid?' active':' bg-light' ?>">
					<div class="media">
						<span class="align-self-center pr-2 pl-1 f12 counter"></span>
						<span class="position-relative mr-2">
		          <img class="" src="<?php echo getPreviewResize(getUpImageSrc($_L),'100x56') ?>" alt="">
		          <time class="badge badge-dark rounded-0 position-absolute" style="right:1px;bottom:1px"><?php echo getUpImageTime($_L) ?></time>
		        </span>

		        <div class="media-body">
		          <h5 class="f13 my-1 font-weight-light line-clamp-2">
		            <?php echo $_L['subject']?>
		          </h5>
							<ul class="list-inline d-inline-block f13">
								<li class="list-inline-item">
									<time data-plugin="timeago" datetime="<?php echo getDateFormat($_L['d_regis'],'c')?>"></time>
								</li>
							</ul>
		        </div>
					</div>
				</a>
				<?php endforeach; ?>

		  </ul>
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
