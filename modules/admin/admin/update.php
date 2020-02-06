<?php
include $g['path_core'].'function/rss.func.php';
$_updatelist = getUrlData('https://kimsq.github.io/rb/update.v2.txt',10);
$_updatelist = explode("\n",$_updatelist);
$_updatelength = count($_updatelist)-1;
$_version = explode('.',$d['admin']['version']);
$recnum	=  10;
$TPG = getTotalPage($_updatelength,$recnum);

?>

<div id="update-body" class="p-4">
	<div class="media my-3">
		<div class="mr-3 align-self-center version">
			<span class=" kf-bi-01" style="font-size: 38px"> </span> <span class="h3 ml-2">Rb <code><?php echo $d['admin']['version']?></code></span>
		</div>
		<div class="media-body f12 text-muted">
			원격 업데이트를 이용하시면 킴스큐Rb를 항상 최신의 상태로 유지할 수 있습니다. <br>패치 및 업데이트 내용에 따라서 업데이트를 진행해 주세요.
		</div>
	</div>
</div>


<?php if (is_dir('./.git')): ?>

	<?php
	$output = shell_exec('git reset --hard');
	$output = shell_exec('git pull origin master');

	if (!$output) {
		$output = '패치내역이 없습니다.';
	}

	echo $output;

	?>

	<form name="updateForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_admin" class="p-4">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="admin">
		<input type="hidden" name="a" value="update">
		<input type="hidden" name="version" value="<?php echo $d['admin']['version']?>">

		<button type="submit" class="btn btn-primary">
			최신 패치
		</button>

	</form>


	<div class="update-info table-responsive">
		<table class="table f13 text-center">
			<thead class="small text-muted">
				<tr>
					<th>버전</th>
					<th>패치/업데이트</th>
					<th>적용일자</th>
					<th>처리여부</th>
					<th>관리</th>
				</tr>
			</thead>
			<tbody>

				<?php $_ishistory=false?>
				<?php for($i = $_updatelength-(($p-1)*$recnum)-1; $i > $_updatelength-($p*$recnum)-1; $i--):?>
				<?php $_update=trim($_updatelist[$i]);if(!$_update)continue?>
				<?php $var1=explode(',',$_update)?>
				<?php $var2=explode(',',$_updatelist[$i-1])?>
				<?php $_updatefile=$g['path_var'].'update/'.$var1[1].'.txt'?>
				<?php if(is_file($_updatefile)):?>
				<?php $_supdate=explode(',',implode('',file($_updatefile)))?>

				<tr class="active">
					<td>
						<span><?php echo $var1[0]?></span>
					</td>
					<td>
						<span>
							<?php if($var1[2]):?>
							<a href="<?php echo $var1[2]?>" target="_blank" data-tooltip="tooltip" title="업데이트 내역 보기"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php else:?>
							<a href="#." data-tooltip="tooltip" title="정보가 없는 없데이트입니다"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php endif?>
							&nbsp;
							<a href="<?php echo $var1[1]?>.zip" class="rb-update-download" data-tooltip="tooltip" title="파일 다운로드"><i class="glyphicon glyphicon-download-alt"></i></a>
						</span>
					</td>
					<td>
						<span><?php echo getDateFormat($_supdate[0],'Y.m.d')?></span>
					</td>
					<td>
						<button class="btn btn-light disabled">
							<i class="fa fa-circle-o"></i> 완료됨 <?php if($_supdate[1]):?>(수동)<?php else:?>(원격)<?php endif?>
						</button>
					</td>
					<td>
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;a=update&amp;type=delete&amp;ufile=<?php echo $var1[1]?>" title="업데이트기록 제거" onclick="return hrefCheck(this,true,'정말로 업데이트 기록을 제거하시겠습니까?');" class="btn btn-light"><i class="fa fa-times"></i> 기록제거</a>
					</td>
				</tr>

				<?php else:?>

				<tr>
					<td>
						<span><?php echo $var1[0]?></span>
					</td>
					<td>
						<span>
							<?php if($var1[2]):?>
							<a href="<?php echo $var1[2]?>" target="_blank" data-tooltip="tooltip" title="업데이트 내역 보기"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php else:?>
							<a href="#." data-tooltip="tooltip" title="정보가 없는 없데이트입니다"><?php echo $var1[0]?>_<?php echo $var1[1]?></a>
							<?php endif?>
							&nbsp;
							<a href="" class="rb-update-download" data-tooltip="tooltip" title="파일 다운로드"><i class="glyphicon glyphicon-download-alt"></i></a>
						</span>
					</td>
					<td></td>
					<td>
						<button class="btn btn-light disabled">
							<i class="glyphicon glyphicon-pause"></i> 미적용
						</button>
					</td>
					<td>

					</td>
				</tr>

				<?php endif?>
				<?php endfor?>
				<?php if(!$_updatelength):?>
				<tr>
				<td colspan="5">업데이트 대기리스트가 없습니다.</td>
				</tr>
				<?php endif?>
			</tbody>
		</table>

		<?php if($TPG>1):?>
		<div class="text-center">
			<ul class="pagination">
				<script>getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'');</script>
			</ul>
		</div>
		<?php endif?>

	</div>


	<div class="p-4">
		<p class="clearfix">
			<i class="fa fa-question-circle fa-lg"></i>
			<strong>원격 업데이트 도움말</strong>
		</p>

		<ul class="mb-0 list-unstyled text-muted small">
			<li>원격 업데이트는 킴스큐의 코어 및 관련 파일들을 항상 최신의 상태로 유지할 수 있는 시스템입니다.</li>
			<li>그러나 사용자가 직접 수정하거나 커스터마이징 한 사항이 업데이트 내역에 포함되어 있을 경우 해당사항이 덧씌워 지므로<br>이 경우 반드시 수작업으로 패치한 후 수동 업데이트를 클릭해 주어야 합니다.</li>
			<li>정상적으로 업데이트 되지 않았거나 재 업데이트를 원하시면 기록을 제거한 후 재시도해 주세요.</li>
			<li>이 작업은 데이터의 용량이나 처리내용에 따라서 다소 시간이 걸릴 수 있습니다.</li>
		</ul>
	</div>

<?php else: ?>

	git이 설치되어 있지 않습니다.

<?php endif; ?>
