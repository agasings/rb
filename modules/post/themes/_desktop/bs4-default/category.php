<section>

	<div class="row">
		<div class="col-3">

			<div class="card">
				<div class="card-header">
					카테고리
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
			<?php echo $NUM ?>개
			<ul class="list-unstyled">
			<?php foreach($RCD as $R):?>
			<?php $R['mobile']=isMobileConnect($R['agent'])?>

			<li class="media my-4">
				<?php if ($R['featured_img']): ?>

				<a href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>">
					<img src="<?php echo getPreviewResize(getUpImageSrc($R),'t') ?>" class="mr-3" alt="" style="width:100px">
				</a>
				<?php endif; ?>

				<div class="media-body">
					<h5 class="mt-0 mb-1">
						<a href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>">
							<?php echo $R['subject']?>
						</a>
					</h5>
					<div class="text-muted line-clamp-1 mb-1"><?php echo $R['review']?></div>
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
							<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
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

		</div>
	</div><!-- /.row -->

</section>
