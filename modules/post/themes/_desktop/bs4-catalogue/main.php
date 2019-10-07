<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$_WHERE = 'display<2 and site='.$s;
if ($cat) $_WHERE .= ' and ('.getPostCategoryCodeToSql($table[$m.'category'],$cat).')';

$TCD = getDbArray($table[$m.'index'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$m.'index'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);

while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

?>

<section>

	<div class="row">
		<div class="col-3">

			<div class="card">
				<div class="card-header">
					카테고리
				</div>
				<div class="card-body">
					<?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>false,'allOpen'=>true)?>
					<?php $_treeOptions['link'] = $g['url_reset'].'&amp;cat='?>
					<?php echo getTreeMenu($_treeOptions,$code,0,0,'')?>
				</div>
			</div><!-- /.card -->

		</div>
		<div class="col-9">

			<?php echo $_WHERE ?>
			<hr>

			<?php if ($NUM): ?>

			<?php echo $NUM ?>개
			<ul class="list-unstyled">
			<?php foreach($RCD as $R):?>
			<?php $R['mobile']=isMobileConnect($R['agent'])?>

			<li class="media my-4">
				<?php if ($R['featured_img']): ?>
				<a href="/post/<?php echo $R['cid']?>">
					<img src="<?php echo getPreviewResize(getUpImageSrc($R),'t') ?>" class="mr-3" alt="" style="width:100px">
				</a>
				<?php endif; ?>

				<div class="media-body">
					<h5 class="mt-0 mb-1">
						<a href="/post/<?php echo $R['cid']?>">
							<?php echo $R['subject']?>
						</a>
					</h5>
					<?php echo $R['review']?>
				</div>



			</li>
		  <?php endforeach?>
			</ul>

			<?php else: ?>

				자료가 없습니다.

			<?php endif; ?>

		</div>
	</div><!-- /.row -->

</section>
