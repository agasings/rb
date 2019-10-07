<section>

	<div class="row">
		<div class="col-3">

			<div class="card">
				<div class="card-header">
					카테고리(기본 스킨 )
				</div>
				<div class="card-body">
					<?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>true,'dispHidden'=>true,'dispCheckbox'=>false,'allOpen'=>true)?>
					<?php $_treeOptions['link'] = RW('m=post&cat=')?>
					<?php echo getTreeMenu($_treeOptions,$code,0,0,'')?>
				</div>
			</div><!-- /.card -->

		</div>
		<div class="col-9">
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
					<?php echo $R['review']?>
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
