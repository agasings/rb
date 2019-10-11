<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$postque = 'mbruid='.$_MP['uid'];
if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $postque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $postque .= " and d_regis like '".$keyword."%'";
	else $postque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['postlist'],$postque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['postlist'],$postque);
$TPG = getTotalPage($NUM,$recnum);

$c_recnum = 3; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;

?>

<div class="page-wrapper row">
	<div class="col-3 page-nav">

		<?php include $g['dir_module_skin'].'_vcard.php';?>
	</div>

	<div class="col-9 page-main">
		<?php include $g['dir_module_skin'].'_nav.php';?>

		<section>

			<header class="d-flex justify-content-between align-items-end my-3">
				<div>
					<?php echo number_format($NUM)?>개 <small class="text-muted">(<?php echo $p?>/<?php echo $TPG?>페이지)</small>
				</div>

				<div class="">
					<div class="dropdown d-inline">
						<a class="btn btn-white btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							정열 : 기본
						</a>

						<div class="dropdown-menu" style="min-width: 85px;">
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
								기본
							</a>
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
								생성순
							</a>
							<a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
								수정순
							</a>
						</div>
					</div>

					<a href="<?php echo RW('mod=dashboard&page=list')?>" class="btn btn-light btn-sm">관리</a>
				</div>

			</header>

			<div class="card-deck">

				<?php $i=0;while($R=db_fetch_array($RCD)):$i++?>
				<div class="card border-0">
					<a href="<?php echo getListLink($R,1) ?>" class="position-relative">
						<img class="img-fluid" src="<?php echo getPreviewResize(getListImageSrc($R['uid']),'320x180') ?>" alt="">
						<span class="list_mask">
							<span class="txt"><?php echo $R['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
						</span>
					</a>
					<div class="card-body px-0 pt-2 pb-4">
			      <h5 class="card-title h6 mb-1"><a class="muted-link" href="<?php echo RW('mod=dashboard&page=list_view&id='.$R['id'])?>"><?php echo $R['name']?></a></h5>
			      <p class="card-text text-muted f13">
							<time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_last'],'c')?>"></time>
							<?php if(getNew($R['d_last'],12)):?><small class="text-danger">new</small><?php endif?>
						</p>

			    </div>
				</div><!-- /.card -->

				<?php
					$print_card_num++; // 카드 출력될 때마 1씩 증가
					$lack_card_num = $total_card_num - $print_card_num;
				 ?>

				<?php if(!($i%$c_recnum)):?></div><div class="card-deck"><?php endif?>
				<?php endwhile?>

				<?php if($lack_card_num ):?>
				<?php for($j=0;$j<$lack_card_num;$j++):?>
				 <div class="card border-0"></div>
				<?php endfor?>
			  <?php endif?>
			</div>

			<?php if(!$NUM):?>
			<div class="d-flex align-items-center justify-content-center" style="height: 40vh">
				<div class="text-muted">포스트가 없습니다.</div>
			</div>
			<?php endif?>

			<footer class="d-flex justify-content-between align-items-center my-4">
		    <ul class="pagination mb-0">
					<?php $_N =  '/@'.$mbrid.'?page='.$page.'&' ?>
	        <?php echo getPageLink(10,$p,$TPG,$_N)?>
		    </ul>

				<form name="bbssearchf" action="<?php echo $g['s']?>/" class="form-inline">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<?php if($_mod):?>
					<input type="hidden" name="mod" value="<?php echo $_mod?>" />
					<?php else:?>
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="front" value="<?php echo $front?>" />
					<?php endif?>
					<input type="hidden" name="page" value="<?php echo $page?>" />
					<input type="hidden" name="sort" value="<?php echo $sort?>" />
					<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
					<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
					<input type="hidden" name="type" value="<?php echo $type?>" />
					<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
					<input type="hidden" name="skin" value="<?php echo $skin?>" />
					<input type="hidden" name="mbrid" value="<?php echo $_MP['id']?>">

					<select name="where" class="form-control custom-select">
						<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
						<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
					</select>

					<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="form-control ml-2">
					<button class="btn btn-light ml-2" type="submit" name="button">검색</button>
				</form>

		  </footer>

		</section>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->
