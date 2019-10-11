<?php
$c_recnum = 4; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<section>

	<h1 class="h4 my-5 text-center">

 	 전체 리스트<small class="text-muted"><?php echo $NUM ?>개</small>
	</h1>

	<?php if ($NUM): ?>

	<div class="card-deck">

		<?php $i=0;foreach($RCD as $R):$i++?>
		<?php $MBR = getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*'); ?>
		<div class="card">
			<a href="<?php echo getListLink($R,0) ?>" class="position-relative">
				<img src="<?php echo getPreviewResize(getListImageSrc($R['uid']),'320x180') ?>" class="img-fluid" alt="">
				<span class="list_mask">
					<span class="txt"><?php echo $R['num']?><i class="fa fa-list-ul d-block" aria-hidden="true"></i></span>
				</span>
				<img class="list_avatar border" src="<?php echo getAvatarSrc($R['mbruid'],'50') ?>" width="50" height="50" alt="<?php echo $MBR['name'] ?>">
			</a>

			<div class="card-body pt-5 p-3">
				<h5 class="card-title h6 mb-1">
					<a class="muted-link" href="<?php echo getListLink($R,0) ?>">
						<?php echo $R['name']?>
					</a>
				</h5>
				<ul class="list-inline f13 text-muted mb-0">
					<li class="list-inline-item"><?php echo getDateFormat($R['d_last'],'Y.m.d H:i')?></li>
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
			등록된 리스트가 없습니다.
		</div>

	<?php endif; ?>

</section>
