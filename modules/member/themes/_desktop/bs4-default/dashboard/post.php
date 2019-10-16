<?php
$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/post.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['path_module'].'post/var/var.php';
include_once $svfile;

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'mbruid='.$my['uid'].' and site='.$s;

if ($display) $postque .= ' and display='.$display;

$orderby= $orderby && strpos('[asc][desc]',$orderby) ? $orderby : 'asc';

if ($sort == 'gid' && !$keyword) {

	$NUM = getDbRows($table['postmember'],$postque);
	$TCD = getDbArray($table['postmember'],$postque,'*',$sort,$orderby,$recnum,$p);
	while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'gid='.$_R['gid'],'*');

} else {

	if ($where && $keyword) {
		if (strstr('[name][nic][id][ip]',$where)) $postque .= " and ".$where."='".$keyword."'";
		else if ($where == 'term') $postque .= " and d_regis like '".$keyword."%'";
		else $postque .= getSearchSql($where,$keyword,$ikeyword,'or');
	}

	$NUM = getDbRows($table['postdata'],$postque);
	$TCD = getDbArray($table['postdata'],$postque,'*',$sort,$orderby,$recnum,$p);
	while($_R = db_fetch_array($TCD)) $RCD[] = $_R;

}


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
<?php echo $orderby ?>
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
			<a href="<?php echo RW('m=post&mod=write')?>" class="btn btn-primary">새 포스트</a>
		</div>
	</div>

	<div class="d-flex align-items-center border-top border-dark pt-4 pb-3" role="filter">
		<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
		<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="form-inline ml-auto">

		   <input type="hidden" name="r" value="<?php echo $r?>">
		   <input type="hidden" name="m" value="post">
		   <input type="hidden" name="front" value="<?php echo $front?>">
			 <input type="hidden" name="page" value="<?php echo $page?>">

			 <input type="hidden" name="sort" value="">
			 <input type="hidden" name="display" value="">

			<div class="dropdown mr-2">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					정열 : 최신순
				</a>

				<div class="dropdown-menu shadow-sm">
					<a class="dropdown-item" href="" data-sort="gid">
						최신순
					</a>
					<a class="dropdown-item" href="" data-sort="hit">
						조회순
					</a>
					<a class="dropdown-item" href="#" data-sort="likes">
						추천순
					</a>
					<a class="dropdown-item" href="#" data-sort="comment">
						댓글순
					</a>
				</div>
			</div>

			<label class="sr-only">상태</label>
			<div class="dropdown">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					상태 : 전체
				</a>

				<div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="/dashboard?page=noti">
						전체
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s))?></small>
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="">
						<?php echo $g['displaySet']['label'][4] ?>
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s.' and display=4'))?></small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="">
						<?php echo $g['displaySet']['label'][3] ?>
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s.' and display=3'))?></small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="">
						<?php echo $g['displaySet']['label'][2] ?>
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s.' and display=2'))?></small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="">
						<?php echo $g['displaySet']['label'][1] ?>
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s.' and display=1'))?></small>
					</a>
					<a class="dropdown-item d-flex justify-content-between align-items-center" href="">
						<?php echo $g['displaySet']['label'][0] ?>
						<small><?php echo number_format(getDbRows($table['postmember'],'mbruid='.$my['uid'].' and site='.$s.' and display=0'))?></small>
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

		</form><!-- /.form-inline -->
	</div><!-- /.d-flex -->

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return submitCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<input type="hidden" name="a" value="" />


		<ul class="list-unstyled" style="margin-top: -1rem">

			<?php foreach($RCD as $R):?>
		  <li class="media mt-4">

				<a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="position-relative mr-3">
					<img class="border" src="<?php echo getPreviewResize(getUpImageSrc($R),'180x100') ?>" alt="">
					<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo getUpImageTime($R) ?></time>
				</a>

		    <div class="media-body">
		      <h5 class="my-1">
						<a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="font-weight-light muted-link" ><?php echo $R['subject']?></a>
					</h5>
					<div class="mb-1">
						<ul class="list-inline d-inline-block f13 text-muted">
							<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
							<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
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

						<span class="badge badge-secondary ml-2"><?php echo $R['display']!=4?$g['displaySet']['label'][$R['display']]:'' ?></span>

					</div>
		    </div>
				<div class="ml-3 align-self-center">
					<div class="dropdown">
						<button class="btn btn-white btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 5rem">
							관리
						</button>
						<div class="dropdown-menu dropdown-menu-right shadow-sm" style="min-width: 5rem">
							<a class="dropdown-item" href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" >수정</a>
							<a class="dropdown-item" href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
							<a class="dropdown-item disabled" href="#">공개</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?php echo getPostLink($R,1) ?>" target="_blank">보기</a>

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
