<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'mbruid='.$_MP['uid'];
if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $postque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $postque .= " and d_regis like '".$keyword."%'";
	else $postque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$TCD = getDbArray($table['postmember'],$postque,'*',$sort,$orderby,$recnum,$p);

while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'gid='.$_R['gid'],'*');

$NUM = getDbRows($table['postmember'],$postque);
$TPG = getTotalPage($NUM,$recnum);

$m = 'post';
$g['post_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
$g['post_list']	= $g['post_reset'].getLinkFilter('',array($p>1?'p':'',$sort!='gid'?'sort':'',$orderby!='asc'?'orderby':'',$recnum!=$d['post']['recnum']?'recnum':'',$type?'type':'',$where?'where':'',$keyword?'keyword':''));
$g['pagelink']	= $g['post_list'];
$g['post_view']	= $g['post_list'].'&amp;mod=view&amp;cid=';

?>

<div class="page-wrapper row">
	<div class="col-3 page-nav">

		<?php include $g['dir_module_skin'].'_vcard.php';?>
	</div>

	<div class="col-9 page-main">
		<?php include $g['dir_module_skin'].'_nav.php';?>

		<section>

			<header class="d-flex justify-content-between align-items-center mt-4 mb-2">
				<div>
					<?php echo number_format($NUM)?>개 <small class="text-muted">(<?php echo $p?>/<?php echo $TPG?>페이지)</small>
				</div>
				<a href="<?php echo RW('mod=dashboard&page=post')?>" class="btn btn-light btn-sm">관리</a>
			</header>

			<ul class="list-unstyled" style="margin-top: -1rem">

				<?php foreach($RCD as $R):?>
			  <li class="media mt-4">

					<a href="<?php echo getPostLink($R,1) ?>" class="mr-3">
						<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
					</a>

			    <div class="media-body">
			      <h5 class="my-1">
							<a href="<?php echo getPostLink($R,1) ?>" class="muted-link" ><?php echo $R['subject']?></a>
							<?php if(getNew($R['d_regis'],24)):?><small class="text-danger">new</small><?php endif?>
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

				<?php if(!$NUM):?>
				<li>
					<div class="text-center text-muted p-5">포스트가 없습니다.</div>
				</li>
				<?php endif?>

			</ul>


			<div class="d-flex justify-content-between my-4">
				<div class=""></div>

				<?php if ($NUM > $recnum): ?>
				<ul class="pagination mb-0">
					<?php echo getPageLink(10,$p,$TPG,'')?>
				</ul>
				<?php endif; ?>

				<div class="">
				</div>
			</div>

			<footer class="d-flex justify-content-between align-items-center my-4">
		    <ul class="pagination mb-0">
					<?php $_N =  '/@'.$mbrid.'?page='.$page.'&' ?>
	        <?php echo getPageLink(10,$p,$TPG,$_N)?>
		    </ul>

				<form name="bbssearchf" action="<?php echo $g['s']?>/" class="form-inline">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<?php if($_mod):?>
					<input type="hidden" name="mod" value="<?php echo $_mod?>" />
					<?php else:?>
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="front" value="<?php echo $front?>" />
					<?php endif?>
					<input type="hidden" name="page" value="<?php echo $page?>" />
					<input type="hidden" name="sort" value="<?php echo $sort?>" />
					<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
					<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
					<input type="hidden" name="type" value="<?php echo $type?>" />
					<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
					<input type="hidden" name="skin" value="<?php echo $skin?>" />

					<select name="where" class="form-control">
						<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
						<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
					</select>

					<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="form-control ml-2">
					<button class="btn btn-light ml-2" type="submit" name="button">검색</button>
				</form>

		  </footer>

		</section>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->
