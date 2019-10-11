<?php
$c_recnum = 4; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<section>

	<h1 class="h4 my-5 text-center">

		<a href="<?php echo getProfileLink($LIST['mbruid'])?><?php echo $_HS['rewrite']?'/':'&page=' ?>list" title="<?php echo $MBR['name'] ?>의 리스트">
			<img src="<?php echo getAvatarSrc($LIST['mbruid'],'40') ?>" width="40" height="40" alt="<?php echo $MBR['name'] ?>" class="mr-2 rounded-circle d-inline-block align-middle">
		</a>
		<?php echo $LIST['name'] ?> <small class="text-muted"><?php echo $NUM ?>개</small>


	</h1>

	<?php if ($NUM): ?>

	<div class="card-deck">

		<?php $i=0;foreach($RCD as $R):$i++?>
		<div class="card">
			<?php if ($R['featured_img']): ?>
			<a href="<?php echo getPostLink($R,$mbrid?1:0).($GLOBALS['_HS']['rewrite']?'?':'&').'list='.$listid ?>">
				<img src="<?php echo getPreviewResize(getUpImageSrc($R),'320x180') ?>" class="img-fluid" alt="">
			</a>
			<?php endif; ?>

			<div class="card-body p-3">
				<h5 class="card-title h6 mb-1">
					<a class="muted-link" href="<?php echo getPostLink($R,$mbrid?1:0).($GLOBALS['_HS']['rewrite']?'?':'&').'list='.$listid ?>">
						<?php echo $R['subject']?>
					</a>
				</h5>
				<ul class="list-inline f13 text-muted mb-0">
					<li class="list-inline-item">조회 <?php echo $R['hit']?> </li>
					<li class="list-inline-item">추천 <?php echo $R['likes']?> </li>
					<li class="list-inline-item">댓글 <?php echo $R['comment']?> </li>
					<li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></li>
				</ul>
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
