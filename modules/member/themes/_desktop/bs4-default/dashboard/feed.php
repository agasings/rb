<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'site='.$s;

$postque .= ' and (display=2 and hidden=0) or display>3';

$postque .= ' and mbruid='.$my['uid'];
$NUM = getDbRows($table['s_feed'],$postque);
$TCD = getDbArray($table['s_feed'],$postque,'entry',$sort,$orderby,$recnum,$p);
while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'uid='.$_R['entry'],'*');

$TPG = getTotalPage($NUM,$recnum);

?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center subhead mt-0">
		<h3 class="mb-0">
			피드
		</h3>
		<div class="">
			<a href="<?php echo getProfileLink($my['uid']) ?><?php echo $_HS['rewrite']?'/':'&page=' ?>following" class="btn btn-white">
				구독 관리
			</a>
			<a href="<?php echo RW('mod=dashboard&page=feed&view=card')?>" class="btn btn-white py-0">
				<i class="material-icons">view_module</i>
			</a>
			<a href="<?php echo RW('mod=dashboard&page=feed&view=media')?>" class="btn btn-white py-0">
				<i class="material-icons">view_list</i>
			</a>
		</div>
	</div>

	<div class="d-flex align-items-center border-top border-dark pt-4 pb-3" role="filter">
		<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
	</div><!-- /.d-flex -->

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return submitCheck(this);">


		<ul class="list-unstyled" style="margin-top: -1rem" data-plugin="markjs">
			<?php foreach($RCD as $R):?>
		  <li class="media mt-4"
				data-role="item"
				data-featured_img="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>"
				data-hit="<?php echo $R['hit']?>"
				data-likes="<?php echo $R['likes']?>"
				data-comment="<?php echo $R['comment']?>"
				data-subject="<?php echo stripslashes($R['subject'])?>">

				<a href="<?php echo getPostLink($R,1)?>" class="position-relative mr-3" target="_blank">
					<img class="border" src="<?php echo checkPostPerm($R) ?getPreviewResize(getUpImageSrc($R),'180x100'):getPreviewResize('/files/noimage.png','180x100') ?>" alt="" width="180">
					<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo checkPostPerm($R)?getUpImageTime($R):'' ?></time>
				</a>

		    <div class="media-body">
		      <h5 class="my-1 line-clamp-2">
						<a href="<?php echo getPostLink($R,1)?>" class="font-weight-light muted-link" <?php echo !checkPostOwner($R)?'target="_blank"':'' ?>>
							<?php echo stripslashes($R['subject'])?>
						</a>
					</h5>

					<?php if ($R['review']): ?>
					<p class="text-muted f13"><?php echo $R['review'] ?></p>
					<?php endif; ?>

					<div class="mb-1">
						<ul class="list-inline d-inline-block f13 text-muted">
							<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
							<li class="list-inline-item">
								<a class="text-reset" href="#modal-post-opinion" data-toggle="modal" data-uid="<?php echo $R['uid']?>" data-opinion="like">
									좋아요 <?php echo $R['likes']?>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="text-reset" href="#modal-post-opinion" data-toggle="modal" data-uid="<?php echo $R['uid']?>" data-opinion="dislike">
									싫어요 <?php echo $R['dislikes']?>
								</a>
							</li>
							<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
							<li class="list-inline-item">
								<time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c')?>"></time>
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
				<?php echo getPageLink(10,$p,$TPG,'')?>
			</ul>
			<?php endif; ?>

			<div class="">
			</div>
		</div>


	</form>
</div>

<?php include $g['path_module'].'post/mod/_component.desktop.php';?>

<script type="text/javascript">

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

$(document).ready(function() {



});

</script>
