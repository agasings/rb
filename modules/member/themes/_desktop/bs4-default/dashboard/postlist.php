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
	<div class="d-flex justify-content-between align-items-center subhead mb-3">
		<h3 class="mb-0">
			리스트 관리
		</h3>
		<div class="">
			<a href="<?php echo RW('m=post&mod=write')?>" class="btn btn-white">
				리스트 만들기
			</a>
		</div>
	</div>

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return submitCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<input type="hidden" name="a" value="" />

		<table class="table text-center border-bottom">
			<colgroup>
				<col width="50">
				<col>
				<col width="150">
			</colgroup>
			<thead class="thead-light">
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>

				<?php foreach($RCD as $R):?>
				<tr>

					<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
					<td class="text-left">
						<a href="<?php echo getPostLink($R,$d['post']['urlformat']) ?>" class="muted-link" target="_blank"><?php echo $R['subject']?></a>
						<?php if(getNew($R['d_regis'],24)):?><small class="text-danger">new</small><?php endif?>
						<br><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>
					</td>
					<td class="text-right">
						<a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="btn btn-light">수정</a>
						<a href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-light">삭제</a>
					</td>
				</tr>
				<?php endforeach?>

				<?php if(!$NUM):?>
				<tr>
					<td colspan="5" class="text-center text-muted p-5">저장된 자료가 없습니다.</td>
				</tr>
				<?php endif?>

			</tbody>
		</table>

		<div class="d-flex justify-content-between my-4">
			<div class=""></div>
			<ul class="pagination mb-0">
				<?php echo getPageLink(10,$p,$TPG,'')?>
			</ul>
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
