<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'mbruid='.$my['uid'];
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
$g['post_write'] = $g['post_list'].'&amp;mod=write';
$g['post_modify']= $g['post_write'].'&amp;cid=';
$g['post_action']= $g['post_list'].'&amp;a=';
$g['post_delete']= $g['post_action'].'delete&amp;cid=';
?>

<div class="container">
	<div class="d-flex justify-content-between align-items-center subhead mt-0">
		<h3 class="mb-0">
			포스트 관리
		</h3>
		<div class="">
			<a href="<?php echo getProfileLink($my['uid']) ?><?php echo $_HS['rewrite']?'/':'&page=' ?>post" class="btn btn-white">
				<i class="fa fa-address-card-o fa-fw" aria-hidden="true"></i>
				프로필 이동
			</a>
			<a href="<?php echo RW('m=post&mod=write')?>" class="btn btn-primary">신규 작성</a>
		</div>
	</div>

	<div class="d-flex align-items-center border-top border-dark pt-4 pb-3" role="filter">
		<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
		<div class="form-inline ml-auto">


			<div class="dropdown mr-2">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					정열 : 최신순
				</a>

				<div class="dropdown-menu">
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo getProfileLink($_MP['uid']).$para_str ?>post">
						최신순
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo getProfileLink($_MP['uid']).$para_str ?>post">
						조회순
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
						추천순
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
						댓글순
					</a>
				</div>
			</div>

			<label class="sr-only">상태</label>
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
			  <input type="text" class="form-control" placeholder="제목,요약 검색">
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
		  <li class="media mt-4">

				<a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="mr-3">
					<img src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
				</a>

		    <div class="media-body">
		      <h5 class="my-1">
						<a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="muted-link" ><?php echo $R['subject']?></a>
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
				<div class="ml-3 align-self-center">
					<div class="dropdown">
						<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
							관리
						</button>
						<div class="dropdown-menu dropdown-menu-right" style="min-width: 5rem">
							<a class="dropdown-item" href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" >수정</a>
							<a class="dropdown-item" href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
							<a class="dropdown-item disabled" href="#">공개</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>" target="_blank">보기</a>

						</div>
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

<script type="text/javascript">
function submitCheck(f) {
	if (f.a.value == '')
	{
		return false;
	}
}

function actCheck(act) {
	var f = document.procForm;
    var l = document.getElementsByName('members[]');
    var n = l.length;
	var j = 0;
    var i;

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
		}
	}
	if (!j)
	{
		alert('선택된 항목이 없습니다.      ');
		return false;
	}

	if(confirm('정말로 실행하시겠습니까?    '))
	{
		f.a.value = act;
		f.submit();
	}
}

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

</script>
