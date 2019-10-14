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
			리스트 수정
		</h3>
		<div class="">
			<a href="<?php echo getListLink($R,0) ?>" class="btn btn-white" target="_blank">보기</a>
			<button type="button" class="btn btn-white" data-history="back">이전</button>
		</div>
	</div>


	<div class="row">

		<div class="col-9">


			<div class="py-4">

				<div class="media">
					<span class="position-relative mr-3">
						<img src="<?php echo getPreviewResize(getListImageSrc($R['uid']),'180x100') ?>" class="" alt="...">
						<span class="list_mask">
							<span class="txt"><?php echo $R['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
						</span>
					</span>

				  <div class="media-body">

						<div class="list-header">
							<div class="list-header-show">

								<div class="d-flex">
									<h5 class="mt-0">
										<?php echo $R['name'] ?>
									</h5>
									<div class="ml-auto">
										<a href="#" class="badge badge-light edit" data-toggle="tooltip" title="리스트명 수정"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									</div>

								</div>

								<span class="text-muted">업데이트: <time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_last'],'c')?>"></time></span>
							</div>

							<div class="list-header-edit">
								<form class="form-inline" action="<?php echo $g['s']?>/" method="post" id="listName" onsubmit="return false">
									<input type="hidden" name="r" value="<?php echo $r?>">
			      			<input type="hidden" name="m" value="post">
			      			<input type="hidden" name="a" value="regis_list">
			      			<input type="hidden" name="uid" value="<?php echo $R['uid']?>">
									<label class="sr-only" for="">리스트명</label>
									<input type="text" name="name" class="form-control mb-2 mr-sm-2 mb-sm-0 bg-white" placeholder="제목을 작성하세요." value="<?php echo $R['name']?>" style="width:350px">

									<button type="button" class="btn btn-light" data-act="submit">
										<span class="not-loading">저장</span>
										<span class="is-loading">
							        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							      </span>
									</button>
									<button type="button" class="btn btn-link cancle">취소</button>
								</form>
							</div><!-- /.list-header-edit -->
						</div>


				  </div>
				</div>

			</div>


			<div class="d-flex align-items-center border-top pt-4 pb-3" role="filter">
				<div class="form-inline">

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
							<a href="<?php echo getPostLink($R,1) ?>" class="position-relative mr-3" target="_blank">
								<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
								<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo getUpImageTime($R) ?></time>
							</a>

							<div class="media-body">
								<h5 class="my-1">
									<a href="<?php echo getPostLink($R,1) ?>" class="muted-link" target="_blank"><?php echo $R['subject']?></a>
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
										<a class="dropdown-item" href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" >수정</a>
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

			<div class="p-3 d-none">
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

putCookieAlert('listview_action_result') // 실행결과 알림 메시지 출력

// Textarea 또는 Input의 끝으로 커서 이동
jQuery.fn.putCursorAtEnd = function() {
  return this.each(function() {
    var $el = $(this),
        el = this;
    if (!$el.is(":focus")) {
     $el.focus();
    }
    if (el.setSelectionRange) {
      var len = $el.val().length * 2;
      setTimeout(function() {
        el.setSelectionRange(len, len);
      }, 1);
    } else {
      $el.val($el.val());
    }
    this.scrollTop = 999999;
  });
};

$(document).ready(function() {

	var title =  document.title;

	// 리스트 제목(타이틀)수정
	$('.list-header .edit').click(function(){
		$('.list-header').addClass('edit');
		$('.list-header').find('[name="name"]').focus().putCursorAtEnd() ;
		document.title = '수정중 ·  '+ title;
	});
	$('.list-header .cancle').click(function(){
		$('.list-header').removeClass('edit')
		document.title = title;
	});

	$('#nestable-post').nestable({
		maxDepth : 0
	});
	$('.dd').on('change', function() {
		var f = document.getElementById("nestableForm");
		getIframeForAction(f);
		f.submit();
	});

  $('#listName').find('[data-act="submit"]').click(function(e){
		var button = $(this)
		var f = document.getElementById("listName");
		button.attr( 'disabled', true );
		setTimeout(function(){
			getIframeForAction(f);
			f.submit();
		}, 200);
  });


});

</script>
