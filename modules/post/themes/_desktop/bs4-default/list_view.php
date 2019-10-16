<?php
$c_recnum = 4; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<section>

	<div class="d-flex justify-content-between align-items-center py-2 mt-3 mb-4 border-bottom border-dark">
		<h3 class="h4 mb-0">
			<a href="<?php echo getProfileLink($LIST['mbruid'])?><?php echo $_HS['rewrite']?'/':'&page=' ?>list" data-toggle="tooltip" title="<?php echo $MBR['name'] ?>의 리스트" class="d-inline-block align-bottom">
				<img src="<?php echo getAvatarSrc($LIST['mbruid'],'30') ?>" width="30" height="30" alt="<?php echo $MBR['name'] ?>" class="mr-1 rounded-circle">
			</a>
			<?php echo $LIST['name'] ?> <small class="text-muted"><?php echo $NUM ?>개</small>
		</h3>
		<div class="">
			<a class="btn btn-white"  href="/list">전체 리스트</a>
			<button class="btn btn-white" data-history="back" type="button">이전</button>
			<?php if ($_perm['list_owner']): ?>
			<a class="btn btn-white"  href="<?php echo RW('mod=dashboard&page=list_view&id='.$listid)?>">관리</a>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($NUM): ?>

	<div class="card-deck">

		<?php $i=0;foreach($RCD as $R):$i++?>
		<?php $_IS_POSTMBR=getDbRows($table[$m.'member'],'mbruid='.$my['uid'].' and data='.$R['uid'].' and auth=1'); ?>
		<?php $perm_post = ($my['admin'] || $_IS_POSTMBR && $R['hidden']) || ($R['display'] > 2) || ($R['display']==2 && $my['uid']) ? true : false; ?>
		<div class="card">
			<?php if ($R['featured_img']): ?>
			<a href="<?php echo getPostLink($R,$mbrid?1:0).($GLOBALS['_HS']['rewrite']?'?':'&').'list='.$listid ?>" class="position-relative">
				<img src="<?php echo $perm_post?getPreviewResize(getUpImageSrc($R),'320x180'):getPreviewResize('/files/noimage.png','320x180') ?>" class="img-fluid" alt="">
				<time class="badge badge-dark rounded-0 position-absolute f14" style="right:1px;bottom:1px"><?php echo getUpImageTime($R) ?></time>
			</a>
			<?php endif; ?>
			<div class="card-body p-3">
				<h5 class="card-title h6 mb-1 line-clamp-2">
					<a class="muted-link" href="<?php echo getPostLink($R,$mbrid?1:0).($GLOBALS['_HS']['rewrite']?'?':'&').'list='.$listid ?>">
						<?php echo $perm_post?$R['subject']:'[비공개 포스트]'?>
					</a>
				</h5>
				<?php if ($perm_post): ?>
				<ul class="list-inline f13 text-muted mb-0">
					<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
					<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
					<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
				</ul>
				<time class="text-muted small" data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>">
					<?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
				</time>
				<?php if(getNew($R['d_regis'],$d['post']['newtime'])):?><span class="rb-new ml-1"></span><?php endif?>
				<?php endif; ?>
			</div><!-- /.card-body -->
		</div><!-- /.card -->

		<?php
			$print_card_num++; // 카드 출력될 때마 1씩 증가
			$lack_card_num = $total_card_num - $print_card_num;
		 ?>

		<?php if(!($i%$c_recnum)):?></div><div class="card-deck"><?php endif?>
		<?php endforeach?>

		<?php if($lack_card_num ):?>
		<?php for($j=0;$j<$lack_card_num;$j++):?>
		 <div class="card border-0"></div>
		<?php endfor?>
		<?php endif?>
	</div><!-- /.card-deck -->


	<?php else: ?>

		<div class="p-5 text-center text-muted">
			등록된 포스트가 없습니다.
		</div>

	<?php endif; ?>

</section>