<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 201 ? $recnum : 20;
$listque	= 'mbruid='.$my['uid'];

if ($where && $keyw)
{
	if (strstr('[id]',$where)) $listque .= " and ".$where."='".$keyw."'";
	else $listque .= getSearchSql($where,$keyw,$ikeyword,'or');
}

$RCD = getDbArray($table['postlist'],$listque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['postlist'],$listque);
$TPG = getTotalPage($NUM,$recnum);

?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center subhead">
		<h3 class="mb-0">
			리스트 관리
		</h3>
		<div class="">
			<a href="<?php echo getProfileLink($my['uid']) ?><?php echo $_HS['rewrite']?'?':'&' ?>page=list" class="btn btn-white">
				<i class="fa fa-address-card-o fa-fw" aria-hidden="true"></i>
				프로필 이동
			</a>
			<a href="#modal-list-new" data-toggle="modal" data-backdrop="static" class="btn btn-primary">
				리스트 만들기
			</a>
		</div>
	</div>

	<div class="d-flex align-items-center border-top border-dark pt-4 pb-3" role="filter">
		<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
		<div class="form-inline ml-auto">

			<label class="mt-1 mr-2 sr-only">상태</label>
			<div class="dropdown">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					상태 : 전체
				</a>

				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti">
						전체
						<small>2</small>
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
						공개
						<small>0</small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
						미등록
						<small>0</small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti&amp;fromsys=Y">
						비공개
						<small>0</small>
					</a>

				</div>
			</div>

			<div class="input-group ml-2">
			  <input type="text" class="form-control" placeholder="리스트명 검색">
			  <div class="input-group-append">
			    <button class="btn btn-white text-muted border-left-0" type="button">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
			  </div>
			</div>

		</div><!-- /.form-inline -->
	</div><!-- /.d-flex -->

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return submitCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<input type="hidden" name="a" value="" />

		<ul class="list-unstyled" style="margin-top: -1rem">

			<?php foreach($RCD as $R):?>
		  <li class="media align-items-center my-4">
				<span class="px-3">
					:
				</span>
				<strong class="mr-3 f18">1</strong>
				<a href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>" class="position-relative mr-3">
					<img src="/thumb-ssl/180x100/u/rb2demo.s3.ap-northeast-2.amazonaws.com/post/2019/10/08/d2b5ca33bd970f64a6301fa75ae2eb22145339.png" alt="">
					<span class="list_mask">
						<span class="txt"><?php echo $R['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
					</span>
				</a>

		    <div class="media-body">
		      <h5 class="mt-0 mb-1"><a class="muted-link" href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>"><?php echo $R['name']?></a></h5>
		      <?php echo getDateFormat($R['d_last'],'Y.m.d H:i')?>
		    </div>
				<div class="ml-3">
					<div class="dropdown">
						<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
							관리
						</button>
						<div class="dropdown-menu dropdown-menu-right"  style="min-width: 5rem">
							<a class="dropdown-item" href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>" >수정</a>
							<a class="dropdown-item" href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
							<a class="dropdown-item" href="#">공개</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>" target="_blank">보기</a>
						</div>
					</div>
				</div>
		  </li>
		<?php endforeach?>

		<?php if(!$NUM):?>
		<li>
			<div class="text-center text-muted p-5">리스트가 없습니다.</div>
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

<!-- Modal -->
<div class="modal" id="modal-list-new" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 560px">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLongTitle">목록 생성</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

				<form id="listAddForm" role="form" action="<?php echo $g['s']?>/" method="post" >
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="post">
					<input type="hidden" name="a" value="regis_list">

					<div class="input-group input-group-lg">
					  <input type="text" name="name" class="form-control rounded-0" placeholder="리스트명 입력" required>
					  <div class="input-group-append">
					    <span class="input-group-text bg-white rounded-0" id="basic-addon2">0<span class="text-muted">/45</span></span>
					  </div>
					</div>

				</form>

      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-white" data-dismiss="modal">취소</button>
        <button type="button" class="btn btn-primary" data-act="submit">
					<span class="not-loading">
		        저장
		      </span>
		      <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i>저장 중 ...</span>
				</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

var f = document.getElementById("listAddForm")
var form = $('#listAddForm');
var modal = $('#modal-list-new');

putCookieAlert('list_action_result') // 실행결과 알림 메시지 출력

modal.on('shown.bs.modal', function () {
	var modal = $(this);
  modal.find('.form-control').trigger('focus')
})

modal.find('[data-act="submit"]').click(function() {

	var name = modal.find('[name="name"]')
	if (!name.val()) {
		name.addClass('is-invalid').focus();
		return false
	}

	$(this).attr('disabled',true)
	getIframeForAction(f);
	setTimeout(function(){
		form.submit()
	}, 500);
});

</script>
