<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$LIST=getDbData($table['postlist'],"id='".$id."'",'*');

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$listque = 'list='.$LIST['uid'].' and site='.$s;
$TCD = getDbArray($table['postlist_index'],$listque,'*',$sort,$orderby,$recnum,$p);

while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'uid='.$_R['data'],'*');

$NUM = getDbRows($table['postlist_index'],$listque);
$TPG = getTotalPage($NUM,$recnum);

$g['post_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m=post',array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
$g['post_list']	= $g['post_reset'].getLinkFilter('',array($p>1?'p':'',$sort!='gid'?'sort':'',$orderby!='asc'?'orderby':'',$recnum!=$d['bbs']['recnum']?'recnum':'',$type?'type':'',$where?'where':'',$keyword?'keyword':''));
$g['pagelink']	= $g['post_reset'];
$g['post_orign'] = $g['post_reset'];
$g['post_action']= $g['post_list'].'&amp;a=';
$g['listindex_delete']= $g['post_action'].'deletelistindex&amp;uid=';
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

		<div class="col-8">


			<div class="py-4">

				<div class="media">
					<span class="position-relative mr-3">
						<img src="<?php echo getPreviewResize(getListImageSrc($LIST['uid']),'180x100') ?>" class="" alt="...">
						<span class="list_mask">
							<span class="txt"><?php echo $LIST['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
						</span>
					</span>

				  <div class="media-body">

						<div class="list-header">
							<div class="list-header-show">

								<div class="d-flex">
									<h5 class="mt-0">
										<?php echo $LIST['name'] ?>
									</h5>
									<div class="ml-auto">
										<a href="#" class="badge badge-light edit" data-toggle="tooltip" title="리스트명 수정"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									</div>

								</div>

								<span class="text-muted">업데이트: <time data-plugin="timeago" datetime="<?php echo getDateFormat($LIST['d_last'],'c')?>"></time></span>
							</div>

							<div class="list-header-edit">
								<form class="form-inline" action="<?php echo $g['s']?>/" method="post" id="listName" onsubmit="return false">
									<input type="hidden" name="r" value="<?php echo $r?>">
			      			<input type="hidden" name="m" value="post">
			      			<input type="hidden" name="a" value="regis_list">
									<input type="hidden" name="type" value="name">
			      			<input type="hidden" name="uid" value="<?php echo $LIST['uid']?>">
									<label class="sr-only" for="">리스트명</label>
									<input type="text" name="name" class="form-control mb-2 mr-sm-2 mb-sm-0 bg-white" placeholder="제목을 작성하세요." value="<?php echo $LIST['name']?>" style="width:300px">

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
								</h5>
								<div class="mb-1">
									<ul class="list-inline d-inline-block ml-2 f13 text-muted">
										<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
										<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
										<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
									</ul>
								</div>
							</div>
							<div class="ml-3">
								<div class="dropdown">
									<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
										관리
									</button>
									<div class="dropdown-menu dropdown-menu-right"  style="min-width: 5rem">
										<a class="dropdown-item" href="<?php echo $g['listindex_delete'].$R['uid'].'&amp;listid='.$id?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 제외 하시겠습니까?');">제외</a>
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
		<div class="col-4 border-left">

			<div class="sidebar-item mt-3 d-none" data-role="display">
				<button class="btn btn-link btn-block text-left px-0 text-reset" type="button" data-toggle="dropdown">
					<span class="d-flex justify-content-between small text-muted">
						공개상태
						<i class="fa fa-cog fa-lg" aria-hidden="true"></i>
					</span>
				</button>
				<div class="dropdown-menu dropdown-menu-right shadow py-0" style="width:300px;line-height: 1.2">

					<div class="list-group list-group-flush">
						<button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==4?' active':'' ?>" data-icon="globe" data-display="4">
							<div class="media align-items-center">
								<i class="fa fa-globe fa-2x mr-3"></i>
								<div class="media-body">
									<span data-heading>전체공개</span><br>
									<small data-description>모든 사용자가 검색하고 볼 수 있음</small>
								</div>
							</div>
						</button>
						<button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==3?' active':'' ?>" data-icon="link" data-display="3">
							<div class="media align-items-center">
								<i class="fa fa-link fa-2x mr-3" aria-hidden="true"></i>
								<div class="media-body">
									<span data-heading>미등록</span><br>
									<small data-description>링크 있는 사용자만 볼 수 있음.<br>로그인 불필요</small>
								</div>
							</div>
						</button>
						<button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==2?' active':'' ?>" data-icon="users" data-display="2">
							<div class="media align-items-center">
								<i class="fa fa-users fa-2x mr-3" aria-hidden="true"></i>
								<div class="media-body">
									<span data-heading>회원공개</span><br>
									<small data-description>사이트 회원만 볼수 있음. 로그인 필요</small>
								</div>
							</div>
						</button>
						<button type="button" class="list-group-item list-group-item-action<?php echo !$R['display']?' active':'' ?>" data-icon="lock" data-display="0">
							<div class="media align-items-center">
								<i class="fa fa-lock fa-2x ml-1 mr-4" aria-hidden="true"></i>
								<div class="media-body">
									<span data-heading>비공개</span><br>
									<small data-description>나만 볼수 있음</small>
								</div>
							</div>
						</button>
					</div>

				</div>
				<ul class="list-group list-group-flush f13 mt-1 item-body">
					<li class="list-group-item d-flex w-100 justify-content-between align-items-center px-0">

						<div class="media">
							<span class="fa-stack fa-lg mr-2">
								<i class="fa fa-square fa-stack-2x"></i>
								<i class="" data-role="icon"></i>
							</span>

							<div class="media-body align-self-center">
								<span data-role="heading"></span> <br><span data-role="description"></span>
							</div>
						</div>


					</li>

				</ul>

			</div><!-- /.sidebar-item -->

			<div class="sidebar-item mt-4" data-role="tag">

				<button class="btn btn-link btn-block text-left px-0 text-reset" type="button" data-toggle="dropdown">
					<div class="d-flex justify-content-between small text-muted">
						태그
						<i class="fa fa-cog fa-lg" aria-hidden="true"></i>
					</div>
				</button>
				<div class="dropdown-menu dropdown-menu-right bg-light shadow" style="width: 300px;">

					<div class="dropdown-body p-2">
						<textarea class="form-control" name="tag" placeholder="검색태그를 입력해 주세요." rows="3"><?php echo $LIST['tag']?></textarea>
						<small class="form-text text-muted">이 리스트를 가장 잘 표현할 수 있는 단어를 콤마(,)로 구분해서 입력해 주세요.</small>
					</div>

					<div class="dropdown-footer row p-2">
						<div class="col-6 pr-1">
							<button type="button" class="btn btn-light btn-block">취소</button>
						</div>
						<div class="col-6 pl-1">
							<button type="button" class="btn btn-primary btn-block" data-role="submit">
								<span class="not-loading">저장</span>
								<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 저장중 ...</span>
							</button>
						</div>
					</div>

				</div>

				<div class="mt-1 pt-3 border-top">
					<?php if($LIST['tag']):?>
					<?php $_tags=explode(',',$LIST['tag'])?>
					<?php $_tagn=count($_tags)?>
					<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
					<?php $_tagk=trim($_tags[$i])?>
					<a class="badge badge-light" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>">
						<?php echo $_tagk?>
					</a>
					<?php endfor?>
					<?php else: ?>
					<div class="text-center small text-muted py-5">
						태그가 없습니다.
					</div>
					<?php endif?>
				</div>
			</div><!-- /.sidebar-item -->

		</div><!-- /.col-3 -->
	</div><!-- /.row -->

</div>

<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js') ?>

<script type="text/javascript">

putCookieAlert('listview_action_result') // 실행결과 알림 메시지 출력

function setPostDisplay(display) {
  var section = $('[data-role="display"]');
  var button = section.find('.list-group-item[data-display="'+display+'"]')
  var icon = button.attr('data-icon');
  var heading = button.find('[data-heading]').text();
  var description = button.find('[data-description]').html();
  section.find('.list-group-item').removeClass('active'); // 상태초기화
  button.addClass('active');
  section.find('[data-role="icon"]').removeAttr('class').addClass('fa fa-'+icon+' fa-stack-1x fa-inverse');
  section.find('[data-role="heading"]').text(heading);
  section.find('[data-role="description"]').html(description);
  section.removeClass('d-none')
}

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

var title =  document.title;

$(document).ready(function() {

	setPostDisplay(<?php echo $LIST['display'] ?>) // 현재 공개상태 셋팅

	// dropdown 내부클릭시 dropdown 유지
	$('.dropdown-body, .dropdown-footer [data-role="submit"]').on('click', function(e) {
		e.stopPropagation();
	});

	// 태그입력
	$('[data-role="tag"]').on('show.bs.dropdown', function () {
	 setTimeout(function(){
		 $('[data-role="tag"]').find('[name="tag"]').focus().putCursorAtEnd()
	 }, 100);
	})

	$('[data-role="tag"]').find('[data-role="submit"]').click(function(){
	  var tag = $('[name="tag"]').val()
		$(this).attr( 'disabled', true );
		setTimeout(function(){
		  $.post(rooturl+'/?r='+raccount+'&m=post&a=regis_list',{
		    tag : tag,
		    type : 'tag',
				uid : <?php echo $LIST['uid']?>
		    },function(response,status){
		      if(status=='success'){
						location.reload();
		      }else{
		        alert(status);
		      }
		  });
		 }, 300);


	});

	$('[data-role="display"] .dropdown-menu .list-group-item').click(function(){
		var button = $(this)
		var display = button.attr('data-display');
		setPostDisplay(display) // 공개상태 변경

		$.post(rooturl+'/?r='+raccount+'&m=post&a=regis_list',{
			uid : <?php echo $LIST['uid']?>,
			display : display,
			type : 'display'
			},function(response,status){
				if(status=='success'){
					$.notify({message: '공개상태가 변경되었습니다.'},{type: 'success'});
				} else {
					alert(status);
				}
		});

	});

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
