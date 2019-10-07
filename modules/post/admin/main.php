<?php
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$SITEN   = db_num_rows($SITES);
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 18;
$_WHERE='uid>0';
$account = $SD['uid'];
if($account) $_WHERE .=' and site='.$account;

if ($hidden) $_WHERE .= ' and hidden=1';
if ($where && $keyw) {
	$_WHERE .= getSearchSql($where,$keyw,$ikeyword,'or');
}
$RCD = getDbArray($table[$module.'data'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'data'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>

<section class="p-4">

	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="module" value="<?php echo $module?>" />
			<input type="hidden" name="front" value="<?php echo $front?>" />
			<div class="form-inline mb-2">

				<select name="display" onchange="this.form.submit();" class="form-control custom-select mr-2">
					<option value=""<?php if($display==''):?> selected="selected"<?php endif?>>판매상태</option>
					<option value="0"<?php if($display=='0'):?> selected="selected"<?php endif?>>정상판매</option>
					<option value="1"<?php if($sort=='1'):?> selected="selected"<?php endif?>>임시품절</option>
					<option value="2"<?php if($sort=='2'):?> selected="selected"<?php endif?>>노출중단</option>
				</select>
				<select name="sort" onchange="this.form.submit();" class="form-control custom-select mr-2">
					<option value="gid"<?php if($sort=='gid'):?> selected="selected"<?php endif?>>등록일</option>
					<option value="price"<?php if($sort=='price'):?> selected="selected"<?php endif?>>판매가격</option>
					<option value="point"<?php if($sort=='point'):?> selected="selected"<?php endif?>>적립금</option>
					<option value="hit"<?php if($sort=='hit'):?> selected="selected"<?php endif?>>조회</option>
					<option value="wish"<?php if($sort=='wish'):?> selected="selected"<?php endif?>>위시</option>
					<option value="qna"<?php if($sort=='qna'):?> selected="selected"<?php endif?>>문의</option>
					<option value="comment"<?php if($sort=='comment'):?> selected="selected"<?php endif?>>평가</option>
					<option value="vote"<?php if($sort=='vote'):?> selected="selected"<?php endif?>>평가점수</option>
					<option value="buy"<?php if($sort=='buy'):?> selected="selected"<?php endif?>>판매</option>
				</select>
				<select name="orderby" onchange="this.form.submit();" class="form-control custom-select mr-2">
					<option value="desc"<?php if($orderby=='desc'):?> selected="selected"<?php endif?>>역순</option>
					<option value="asc"<?php if($orderby=='asc'):?> selected="selected"<?php endif?>>정순</option>
				</select>
				<select name="recnum" onchange="this.form.submit();" class="form-control custom-select mr-2">
					<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20개</option>
					<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35개</option>
					<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50개</option>
					<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75개</option>
					<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90개</option>
				</select>
			</div>
			<div class="form-inline mb-2">
				<select name="where" class="form-control custom-select mr-2">
					<option value="subject"<?php if($where=='subject'):?> selected="selected"<?php endif?>>제목</option>
					<option value="tags"<?php if($where=='tags'):?> selected="selected"<?php endif?>>태그</option>
				</select>
				<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="form-control w-25 mr-2">
				<input type="submit" value="검색" class="btn btn-light mr-2">
				<input type="button" value="리셋" class="btn btn-light mr-2" onclick="location.href='<?php echo $g['adm_href']?>';">

			</div>
		</form>
	</div>

	<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="" />

		<?php if ($NUM): ?>
		<div class="d-flex justify-content-between">
			<div class="f13">
				<?php echo number_format($NUM)?>개 (<?php echo $p?>/<?php echo $TPG?>페이지)
			</div>
			<div class="">
				<a class="btn btn-primary" href="<?php echo $g['adm_href']?>&amp;front=post_regis">신규등록</a>
			</div>
		</div><!-- /.d-flex -->

		<table class="table text-muted">
		  <thead class="small text-muted">
		    <tr>
		      <th scope="col">#</th>
					<th scope="col">#</th>
		      <th scope="col">First</th>
					<th>카테고리</th>
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
		      <td>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;mod=view&amp;cid=<?php echo $R['cid']?>" target="_blank">
							<?php echo $R['subject']?>
						</a>
					</td>
					<td>
						<?php echo getAllPostCat($R['uid']) ?>
					</td>
		      <td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
					<td>
						<a href="<?php echo $g['adm_href']?>&amp;front=post_regis&amp;uid=<?php echo $R['uid']?>" class="btn btn-light btn-sm">수정</a>
					</td>
		    </tr>
				<?php endwhile?>
		  </tbody>
		</table>

		<div class="d-flex justify-content-between">
			<div class="">
				<input type="button" value="선택/해제" class="btn btn-light" onclick="chkFlag('post_members[]');" />
				<input type="button" value="삭제" class="btn btn-outline-danger" onclick="actCheck('post_multi_delete');" />
			</div>
			<ul class="pagination">
				<script>getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'');</script>
			</ul>
			<div class="">
			</div>
		</div><!-- /.flex -->

		<?php else: ?>

		<div class="d-flex align-items-center justify-content-center p-5 f14 text-muted" style="height:80vh">
			<div class="text-center">
				<p>자료가 없습니다.</p>
				<a class="btn btn-lg btn-outline-primary" href="<?php echo $g['adm_href']?>&amp;front=post_regis">신규 등록</a>
			</div>
		</div>

		<?php endif; ?>

	</form>
</section>


<script>

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

function actCheck(act) {
	var f = document.listForm;
    var l = document.getElementsByName('post_members[]');
    var n = l.length;
	var j = 0;
    var i;
	var s = '';
    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
			s += '['+l[i].value+']';
		}
	}
	if (!j)
	{
		alert('선택된 상품이 없습니다.      ');
		return false;
	}
	if (act == 'post_multi_delete')
	{
		if(confirm('정말로 삭제하시겠습니까?    '))
		{
			f.a.value = act;
			f.submit();
		}
	}
	return false;
}

function FormCheck(f) {
	if (confirm('정말로 실행하시겠습니까?'))
	{
		getIframeForAction(f);
		return true;
	}
	return false;
}


// 선택박스 체크 이벤트 핸들러
$(".checkAll-post-user").click(function(){
	$(".rb-post-user").prop("checked",$(".checkAll-post-user").prop("checked"));
	checkboxCheck();
});

// 선택박스 체크시 액션버튼 활성화 함수
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('post_members[]');
    var n = l.length;
    var i;
	var j=0;
	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true) j++;
	}
	if (j) $('.rb-action-btn').prop("disabled",false);
	else $('.rb-action-btn').prop("disabled",true);
}

</script>
