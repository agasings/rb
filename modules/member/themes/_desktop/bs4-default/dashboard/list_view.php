<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$R=getDbData($table['postlist'],"id='".$id."'",'*');

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$listque = 'list='.$R['uid'];
$TCD = getDbArray($table['postlist_index'],$listque,'*',$sort,$orderby,$recnum,$p);

while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'uid='.$_R['data'],'*');

$NUM = getDbRows($table['postlist_index'],$listque);
$TPG = getTotalPage($NUM,$recnum);

?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center subhead border-bottom border-dark ">
		<h3 class="mb-0">
			목록 수정
		</h3>
		<div class="">
			<a href="<?php echo getListLink($R,0) ?>" class="btn btn-white" target="_blank">보기</a>
			<button type="button" class="btn btn-white" data-history="back">이전</button>
		</div>
	</div>


	<div class="row">

		<div class="col-9">


			<div class="py-4">
				<h4><?php echo $R['name'] ?></h4>
				<?php echo getDateFormat($R['d_last'],'Y.m.d H:i')?>

			</div>


			<div class="d-flex align-items-center border-top pt-4 pb-3" role="filter">
				<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
				<div class="form-inline ml-auto">

					<label class="mt-1 mr-2 sr-only">상태</label>
					<div class="dropdown">
						<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							출력수 : <?php echo $recnum ?>개
						</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti">
								<?php echo $recnum ?>개
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
								20개
							</a>
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
								30개
							</a>
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
								40개
							</a>

						</div>
					</div>

				</div><!-- /.form-inline -->
			</div><!-- /.d-flex -->

			<form id="nestableForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="post">
				<input type="hidden" name="front" value="<?php echo $front?>">
				<input type="hidden" name="type" value="post">
				<input type="hidden" name="a" value="modifygid">

				<div class="dd" id="nestable-post">

				<ul class="dd-list list-unstyled" style="margin-top: -1rem">

					<?php $_i=1;foreach($RCD as $R):?>
					<li class="media mt-4 serial dd-item" data-id="<?php echo $_i?>">
						<input type="checkbox" name="listmembers[]" value="<?php echo $R['uid']?>" checked class="d-none">
						<span class="dd-handle px-3  align-self-center">
							<i class="fa fa-arrows" aria-hidden="true"></i>
						</span>
						<strong class="counter mr-3 f18  align-self-center"></strong>
						<a href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>" class="mr-3" target="_blank">
							<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
						</a>

						<div class="media-body">
							<h5 class="my-1">
								<a href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>" class="muted-link" target="_blank"><?php echo $R['subject']?></a>
								<?php if(getNew($R['d_regis'],24)):?><small class="text-danger">new</small><?php endif?>
							</h5>
							<div class="mb-1">
								<ul class="list-inline d-inline-block ml-2 f13 text-muted">
									<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
									<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
									<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
									<li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></li>
								</ul>
							</div>
						</div>
						<div class="ml-3">
							<div class="dropdown">
								<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
									관리
								</button>
								<div class="dropdown-menu dropdown-menu-right"  style="min-width: 5rem">
									<a class="dropdown-item" href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 제외 하시겠습니까?');">제외</a>
								</div>
							</div>
						</div>
					</li>
					<?php $_i++;endforeach?>

					<?php if(!$NUM):?>
					<li>
						<div class="text-center text-muted p-5">포스트가 없습니다.</div>
					</li>
					<?php endif?>


				</ul>

			</div><!-- /.dd -->

			</form>

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



		</div><!-- /.col-9 -->
		<div class="col-3 border-left">

			<div class="p-3">
				<a href="" class="badge badge-pill badge-light f14 mb-2"># 운전연습</a>
				<a href="" class="badge badge-pill badge-light f14 mb-2"># 진짜한다운전</a>
				<a href="" class="badge badge-pill badge-light f14 mb-2"># 장롱면허탈출</a>
			</div>


		</div><!-- /.col-3 -->
	</div><!-- /.row -->

</div>

<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js') ?>

<script type="text/javascript">

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

$(document).ready(function() {

	$('#nestable-post').nestable({
		maxDepth : 0
	});
	$('.dd').on('change', function() {
		var f = document.getElementById("nestableForm");
		getIframeForAction(f);
		f.submit();
	});

});

</script>
