<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 201 ? $recnum : 15;
$where = 'name|tag';
$listque	= 'mbruid='.$my['uid'].' and site='.$s;

if ($display) $listque .= ' and display='.$display;

if ($where && $keyword) {
	if (strstr('[id]',$where)) $listque .= " and ".$where."='".$keyw."'";
	else $listque .= getSearchSql($where,$keyword,$ikeyword,'or');
}

$RCD = getDbArray($table['postlist'],$listque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['postlist'],$listque);
$TPG = getTotalPage($NUM,$recnum);

$g['post_reset']	= RW('mod=dashboard&page=list');
$g['post_list']	= $g['post_reset'].getLinkFilter('',array($p>1?'p':'',$sort!='gid'?'sort':'',$orderby!='asc'?'orderby':'',$display?'display':'',$where?'where':'',$keyword?'keyword':''));
$g['pagelink']	= $g['post_list'];
$g['post_orign'] = $g['post_reset'];
$g['post_view']	= $g['post_list'].'&amp;uid=';
$g['post_write'] = $g['post_list'].'&amp;mod=write';
$g['post_modify']= $g['post_write'].'&amp;uid=';
$g['post_reply']	= $g['post_write'].'&amp;reply=Y&amp;uid=';
$g['post_action']= $g['post_list'].'&amp;a=';
$g['post_list_delete']= $g['post_action'].'deletelist&amp;uid=';
?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center subhead">
		<h3 class="mb-0">
			리스트 관리
		</h3>
		<div class="">
			<a href="<?php echo getProfileLink($my['uid']) ?><?php echo $_HS['rewrite']?'/':'&page=' ?>list" class="btn btn-white">
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
		<form name="toolbarForm" action="<?php echo $_HS['rewrite']? RW('mod=dashboard&page='.$page):$g['s']?>" method="get"  class="form-inline ml-auto">

			<?php if (!$GLOBALS['_HS']['rewrite']): ?>
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="mod" value="dashboard">
			<?php endif; ?>

			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="display" value="<?php echo $display?>">

			<label class="mt-1 mr-2 sr-only">상태</label>
			<div class="dropdown" data-role="display">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					상태 : <?php echo $display?$g['displaySet']['label'][$display]:'전체' ?>
				</a>

				<div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuLink">
					<button class="dropdown-item d-flex justify-content-between align-items-center<?php echo !$display?' active':'' ?>" type="button">
						전체
						<small><?php echo number_format(getDbRows($table['postlist'],'mbruid='.$my['uid'].' and site='.$s))?></small>
					</button>
					<div class="dropdown-divider"></div>
					<button class="dropdown-item d-flex justify-content-between align-items-center<?php echo $display==5?' active':'' ?>" data-value="5" type="button">
						<span>
							<i class="fa fa-<?php echo $g['displaySet']['icon'][5] ?> fa-fw" aria-hidden="true"></i>
							<?php echo $g['displaySet']['label'][5] ?>
						</span>
						<small><?php echo number_format(getDbRows($table['postlist'],'mbruid='.$my['uid'].' and site='.$s.' and display=5'))?></small>
					</button>
					<button class="dropdown-item d-flex justify-content-between align-items-center<?php echo $display==4?' active':'' ?>" data-value="4" type="button">
						<span>
							<i class="fa fa-<?php echo $g['displaySet']['icon'][4] ?> fa-fw" aria-hidden="true"></i>
							<?php echo $g['displaySet']['label'][4] ?>
						</span>
						<small><?php echo number_format(getDbRows($table['postlist'],'mbruid='.$my['uid'].' and site='.$s.' and display=4'))?></small>
					</button>
					<button class="dropdown-item d-flex justify-content-between align-items-center<?php echo $display==3?' active':'' ?>" data-value="3" type="button">
						<span>
							<i class="fa fa-<?php echo $g['displaySet']['icon'][3] ?> fa-fw" aria-hidden="true"></i>
							<?php echo $g['displaySet']['label'][3] ?>
						</span>
						<small><?php echo number_format(getDbRows($table['postlist'],'mbruid='.$my['uid'].' and site='.$s.' and display=3'))?></small>
					</button>
					<button class="dropdown-item d-flex justify-content-between align-items-center<?php echo $display==1?' active':'' ?>" data-value="1" type="button">
						<span>
							<i class="fa fa-<?php echo $g['displaySet']['icon'][1] ?> fa-fw" aria-hidden="true"></i>
							<?php echo $g['displaySet']['label'][1] ?>
						</span>
						<small><?php echo number_format(getDbRows($table['postlist'],'mbruid='.$my['uid'].' and site='.$s.' and display=1'))?></small>
					</button>
				</div>
			</div>

			<div class="input-group ml-2">
			  <input type="text" name="keyword" class="form-control" placeholder="리스트명 검색" value="<?php echo $keyword ?>">
			  <div class="input-group-append">
					<button class="btn btn-white text-muted border-left-0" type="submit">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
					<?php if ($keyword): ?>
					<a href="<?php echo RW('mod=dashboard&page='.$page)?>" class="btn btn-white">초기화</a>
					<?php endif; ?>
			  </div>
			</div>

		</form><!-- /.form-inline -->
	</div><!-- /.d-flex -->

	<form id="nestableForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="post">
		<input type="hidden" name="front" value="<?php echo $front?>">
		<input type="hidden" name="type" value="list">
		<input type="hidden" name="a" value="modifygid">

		<div class="dd" id="nestable-list">
			<ul class="dd-list list-unstyled" style="margin-top: -1rem" data-plugin="markjs">

				<?php $_i=1;while($R=db_fetch_array($RCD)):?>
			  <li class="media align-items-center my-3 serial dd-item bg-light p-3" data-id="<?php echo $_i?>">
					<input type="checkbox" name="listmembers[]" value="<?php echo $R['uid']?>" checked class="d-none">
					<span class="dd-handle pr-3">
						<i class="fa fa-arrows" aria-hidden="true"></i>
					</span>
					<strong class="counter mr-3 f18"></strong>
					<a href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>" class="position-relative mr-3">
						<img src="<?php echo getPreviewResize(getListImageSrc($R['uid']),'180x100') ?>" alt="">
						<span class="list_mask">
							<span class="txt"><?php echo $R['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
						</span>
					</a>

			    <div class="media-body">
			      <h5 class="mt-0 mb-1"><a class="muted-link" href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>"><?php echo $R['name']?></a></h5>
						<span class="text-muted">업데이트: <time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_last'],'c')?>"></time></span>
						<?php if(getNew($R['d_last'],12)):?><small class="text-danger">new</small><?php endif?>
						<div class="">
							<?php if ($R['tag']): ?>
							<span class="f13 text-muted mr-2">
								<!-- 태그 -->
								<?php $_tags=explode(',',$R['tag'])?>
								<?php $_tagn=count($_tags)?>
								<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
								<?php $_tagk=trim($_tags[$i])?>
								<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
								<?php endfor?>
							</span>
							<?php endif; ?>
						</div>
			    </div>
					<div class="ml-3 align-self-center form-inline">

						<div class="dropdown mr-2">
							<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 7.67rem">
								<?php echo $g['displaySet']['label'][$R['display']] ?>
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow-sm" style="min-width: 5rem">
								<a class="dropdown-item<?php echo $R['display']==5?' active':'' ?>" href="">
									<i class="fa fa-<?php echo $g['displaySet']['icon'][5] ?> fa-fw" aria-hidden="true"></i>
									<?php echo $g['displaySet']['label'][5] ?>
								</a>
								<a class="dropdown-item<?php echo $R['display']==4?' active':'' ?>" href="">
									<i class="fa fa-<?php echo $g['displaySet']['icon'][4] ?> fa-fw" aria-hidden="true"></i>
									<?php echo $g['displaySet']['label'][4] ?>
								</a>
								<a class="dropdown-item<?php echo $R['display']==3?' active':'' ?>" href="">
									<i class="fa fa-<?php echo $g['displaySet']['icon'][3] ?> fa-fw" aria-hidden="true"></i>
									<?php echo $g['displaySet']['label'][3] ?>
								</a>
								<a class="dropdown-item<?php echo $R['display']==1?' active':'' ?>" href="">
									<i class="fa fa-<?php echo $g['displaySet']['icon'][1] ?> fa-fw" aria-hidden="true"></i>
									<?php echo $g['displaySet']['label'][1] ?>
								</a>
							</div>
						</div>

						<div class="dropdown">
							<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
								관리
							</button>
							<div class="dropdown-menu dropdown-menu-right shadow-sm"  style="min-width: 5rem">
								<a class="dropdown-item" href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>" >수정</a>
								<a class="dropdown-item" href="<?php echo $g['post_list_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
								<a class="dropdown-item disabled" href="#">공개</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo getListLink($R,0) ?>" target="_blank">보기</a>
							</div>
						</div>

					</div>
			  </li>
			<?php $_i++;endwhile?>

			<?php if(!$NUM):?>
			<li>
				<div class="d-flex align-items-center justify-content-center" style="height: 40vh">
					<div class="text-muted">리스트가 없습니다.</div>
				</div>
			</li>
			<?php endif?>

			</ul>
		</div>


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
        <h5 class="modal-title" id="exampleModalLongTitle">새 리스트</h5>
      </div>
      <div class="modal-body">

				<form id="listAddForm" role="form" action="<?php echo $g['s']?>/" method="post" >
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="post">
					<input type="hidden" name="a" value="regis_list">
					<input type="hidden" name="display" value="4">

					<div class="input-group input-group-lg">
					  <input type="text" name="name" class="form-control rounded-0" placeholder="리스트명 입력" required>
					</div>

				</form>

      </div>
      <div class="modal-footer bg-light">

				<div class="dropdown mr-auto">
				  <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <i class="fa fa-<?php echo $g['displaySet']['icon'][4] ?> fa-fw"></i>
						<?php echo $g['displaySet']['label'][4] ?>
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    <a class="dropdown-item active" href="#" data-display="4"><i class="fa fa-<?php echo $g['displaySet']['icon'][4] ?> fa-fw"></i> <?php echo $g['displaySet']['label'][4] ?></a>
				    <a class="dropdown-item" href="#" data-display="3"><i class="fa fa-<?php echo $g['displaySet']['icon'][3] ?> fa-fw"></i> <?php echo $g['displaySet']['label'][3] ?></a>
				    <a class="dropdown-item" href="#" data-display="2"><i class="fa fa-<?php echo $g['displaySet']['icon'][2] ?> fa-fw"></i> <?php echo $g['displaySet']['label'][2] ?></a>
						<a class="dropdown-item" href="#" data-display="0"><i class="fa fa-<?php echo $g['displaySet']['icon'][0] ?> fa-fw"></i> <?php echo $g['displaySet']['label'][0] ?></a>
				  </div>
				</div>

				<div class="">
					<button type="button" class="btn btn-light" data-dismiss="modal">취소</button>
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
</div>

<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js') ?>

<!-- bootstrap-maxlength -->
<?php getImport('bootstrap-maxlength','bootstrap-maxlength.min',false,'js')?>

<script type="text/javascript">

var f = document.getElementById("listAddForm")
var form = $('#listAddForm');
var modal = $('#modal-list-new');

putCookieAlert('list_action_result') // 실행결과 알림 메시지 출력

$(document).ready(function() {

	$('#nestable-list').nestable({
		maxDepth : 0
	});
	$('.dd').on('change', function() {
		var f = document.getElementById("nestableForm");
		getIframeForAction(f);
		f.submit();
	});

	$('input.rb-title').maxlength({
		alwaysShow: true,
		threshold: 10,
		warningClass: "label label-success",
		limitReachedClass: "label label-danger",
	});

	modal.on('shown.bs.modal', function () {
		var modal = $(this);
		modal.find('.form-control').val('').trigger('focus')
	})

	modal.find('.dropdown').on('hidden.bs.dropdown', function () {
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

	// 새 리스트 모달 내부 공개범위 설정 dropdown
	modal.find('.dropdown-item').click(function(){
		var item = $(this);
		var display = item.attr('data-display');
		var label = item.html();
		modal.find('.dropdown-item').removeClass('active')
		item.addClass('active');
		modal.find('[name="display"]').val(display);
		modal.find('[data-toggle="dropdown"]').html(label);
	});

	// 툴바
	$('[name="toolbarForm"] .dropdown-item').click(function(){
		var form = $('[name="toolbarForm"]');
		var value = $(this).attr('data-value');
		var role = $(this).closest('.dropdown').attr('data-role');
		form.find('[name="'+role+'"]').val(value)
		form.submit();
	});

	// marks.js
	$('[data-plugin="markjs"]').mark("<?php echo $keyword ?>");

});

</script>
