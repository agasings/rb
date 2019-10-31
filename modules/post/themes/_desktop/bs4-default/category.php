<section>

	<div class="row">
		<div class="col-3">

			<div class="card">
				<div class="card-header">
					<a href="<?php echo RW('m=post') ?>" class="muted-link" title="전체보기">카테고리</a>
				</div>
				<div class="card-body">
					<?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>$my['uid']?true:false,'dispHidden'=>true,'dispCheckbox'=>false,'allOpen'=>true)?>
					<?php $_treeOptions['link'] = RW('m=post&cat=')?>
					<?php echo getTreeCategory($_treeOptions,$code,0,0,'')?>
				</div>
			</div><!-- /.card -->

		</div>
		<div class="col-9">

			<div class="d-flex justify-content-between align-items-center border-bottom border-dark mt-2 pb-2">
				<h3 class="mb-0">
					<?php echo $CAT['name']?$CAT['name']:'전체 카테고리' ?>
				</h3>
				<div class="">
				</div>
			</div>

			<?php if ($NUM): ?>
			<div class="d-flex align-items-center py-3" role="filter">
				<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
				<div class="form-inline ml-auto">

					<label class="mt-1 mr-2 sr-only">정열</label>
					<div class="dropdown">
						<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							상태 : 생성순
						</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="#">
								생성순
							</a>
							<a class="dropdown-item" href="#">
								수정순
							</a>
						</div>
					</div>

					<div class="input-group ml-2">
					  <input type="text" class="form-control" placeholder="포스트 검색">
					  <div class="input-group-append">
					    <button class="btn btn-white text-muted border-left-0" type="button">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
					  </div>
					</div>

				</div><!-- /.form-inline -->
			</div><!-- /.d-flex -->

			<ul class="list-unstyled">
			<?php foreach($RCD as $R):?>
			<li class="media my-4">
				<?php if ($R['featured_img']): ?>
				<a href="<?php echo getPostLink($R,0) ?>" class="position-relative mr-3">
					<img src="<?php echo checkPostPerm($R) ?getPreviewResize(getUpImageSrc($R),'180x100'):getPreviewResize('/files/noimage.png','180x100') ?>" alt="">
					<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo checkPostPerm($R)?getUpImageTime($R):'' ?></time>
				</a>
				<?php endif; ?>

				<div class="media-body">
					<h5 class="mt-0 mb-1">
						<a class="muted-link" href="<?php echo getPostLink($R,0) ?>">
							<?php echo checkPostPerm($R)?stripslashes($R['subject']):'[비공개 포스트]'?>
						</a>
					</h5>
					<?php if (checkPostPerm($R)): ?>
					<div class="mb-1">
						<ul class="list-inline d-inline-block f13 text-muted">
							<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
							<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
							<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
							<li class="list-inline-item">
								<time class="text-muted" data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>"></time>
								<?php if(getNew($R['d_regis'],$d['post']['newtime'])):?><span class="rb-new ml-1"></span><?php endif?>
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
						<span class="badge badge-secondary ml-2"><?php echo checkPostOwner($R) && $R['display']!=5?$g['displaySet']['label'][$R['display']]:'' ?></span>
					</div>
				</div>
				<?php else: ?>
					<p class="text-muted py-3">
						이 포스트에 대한 액세스 권한이 없습니다.
					</p>
				<?php endif; ?>

			</li>
		  <?php endforeach?>
			</ul>

			<?php else: ?>

				<div class="d-flex align-items-center justify-content-center" style="height: 50vh">
					<div class="text-muted">
						포스트가 없습니다.
					</div>
				</div>


			<?php endif; ?>

		</div>
	</div><!-- /.row -->

</section>

<script>
	document.title = '<?php echo $CAT['name']?$CAT['name']:'전체 카테고리' ?>  | <?php echo $g['browtitle']?>';
</script>
