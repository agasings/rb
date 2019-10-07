<?php
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$SITEN   = db_num_rows($SITES);
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$_WHERE='uid>0';
$account = $SD['uid'];
if($account) $_WHERE .=' and site='.$account;
if ($d_start) $_WHERE .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $_WHERE .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($bid) $_WHERE .= ' and bbs='.$bid;
if ($category) $_WHERE .= " and category ='".$category."'";
if ($notice) $_WHERE .= ' and notice=1';
if ($hidden) $_WHERE .= ' and hidden=1';
if ($where && $keyw)
{
	if (strstr('[name][nic][id][ip]',$where)) $_WHERE .= " and ".$where."='".$keyw."'";
	else $_WHERE .= getSearchSql($where,$keyw,$ikeyword,'or');
}
$RCD = getDbArray($table[$module.'data'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'data'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>

<section class="p-4">
	<form action="<?php echo $g['s']?>/" method="post" name="FormName" onsubmit="return FormCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $module?>">
	<input type="hidden" name="a" value="action">




<?php if ($num): ?>
<div class="d-flex justify-content-between">
	<div class="">
		목록
	</div>
	<div class="">
		<a class="btn btn-primary" href="<?php echo $g['adm_href']?>&amp;front=post_regis">신규등록</a>
	</div>
</div><!-- /.d-flex -->

<table class="table">
  <thead class="small text-muted">
    <tr>
      <th scope="col">#</th>
			<th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">관리</th>
    </tr>
  </thead>
  <tbody>

		<?php while($R=db_fetch_array($RCD)):?>
		<?php $R['mobile']=isMobileConnect($R['agent'])?>
    <tr>
			<td><input type="checkbox" name="post_members[]" value="<?php echo $R['uid']?>" class="rb-post-user" onclick="checkboxCheck();"/></td>
			<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
      <td><a href="#"><?php echo $R['subject']?></a></td>
      <td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
			<td>
				<a href="<?php echo $g['adm_href']?>&amp;front=post_regis&amp;uid=<?php echo $R['uid']?>" class="btn btn-light btn-sm">수정</a>
			</td>
    </tr>
		<?php endwhile?>
  </tbody>
</table>
<?php else: ?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh">
	<div class="p-5 text-center text-muted">
		<p>리스트가 없습니다.</p>
		<a class="btn btn-outline-primary" href="<?php echo $g['adm_href']?>&amp;front=post_regis">새 리스트</a>
	</div>
</div>


<?php endif; ?>








	</form>
</section>


<script>

putCookieAlert('result_post_main') // 실행결과 알림 메시지 출력

function FormCheck(f)
{
	if (confirm('정말로 실행하시겠습니까?'))
	{
		getIframeForAction(f);
		return true;
	}
	return false;
}
</script>
