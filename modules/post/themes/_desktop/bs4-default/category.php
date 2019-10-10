<section>

	<div class="row">
		<div class="col-3">

			<div class="card">
				<div class="card-header">
					<a href="<?php echo RW('m=post') ?>" class="muted-link" title="전체보기">카테고리</a>
				</div>
				<div class="card-body">
					<?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>true,'dispHidden'=>true,'dispCheckbox'=>false,'allOpen'=>true)?>
					<?php $_treeOptions['link'] = RW('m=post&cat=')?>
					<?php echo getTreeCategory($_treeOptions,$code,0,0,'')?>
				</div>
			</div><!-- /.card -->

		</div>
		<div class="col-9">
			<h3> <?php echo $CAT['name']?$CAT['name']:'전체 포스트' ?></h3>
			<?php if ($NUM): ?>
			<?php echo $NUM ?>개 <small class="text-muted">(<?php echo $p?>/<?php echo $TPG?>페이지)</small>
			<ul class="list-unstyled">
			<?php foreach($RCD as $R):?>
			<?php $R['mobile']=isMobileConnect($R['agent'])?>

			<li class="media my-4">
				<?php if ($R['featured_img']): ?>

				<a href="<?php echo getPostLink($R,0) ?>">
					<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="" class="mr-3">
				</a>
				<?php endif; ?>

				<div class="media-body">
					<h5 class="mt-0 mb-1">
						<a class="muted-link" href="<?php echo getPostLink($R,0) ?>">
							<?php echo $R['subject']?>
						</a>
						<?php if(getNew($R['d_regis'],24)):?><small class="text-danger">new</small><?php endif?>
					</h5>
					<div class="text-muted line-clamp-1 mb-1"><?php echo $R['review']?></div>
					<div class="mb-1">
						<ul class="list-inline d-inline-block f13 text-muted">
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
							<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
							<?php endfor?>
						</span>
					</div>
				</div>

			</li>
		  <?php endforeach?>
			</ul>

			<?php else: ?>

				<div class="d-flex align-items-center justify-content-center" style="height: 50vh">
					<div class="text-muted">
						자료가 없습니다.
					</div>
				</div>


			<?php endif; ?>

		</div>
	</div><!-- /.row -->

</section>
