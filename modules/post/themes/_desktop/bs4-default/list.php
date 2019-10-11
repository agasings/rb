<?php
$c_recnum = 4; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<section>

	<div class="d-flex justify-content-between align-items-center mt-4">
		<h3 class="mb-0">
			전체 리스트
		</h3>
		<div class="">
		</div>
	</div>

	<div class="d-flex align-items-center border-top border-dark pt-4 pb-3" role="filter">
		<span class="f18">전체 <span class="text-primary"><?php echo number_format($NUM)?></span> 개</span>
		<div class="form-inline ml-auto">

			<label class="mt-1 mr-2 sr-only">정열</label>
			<div class="dropdown">
				<a class="btn btn-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					상태 : 생성순
				</a>

				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="#">
						생성순
					</a>
					<a class="dropdown-item" href="#">
						수정순
					</a>
				</div>
			</div>

			<div class="input-group ml-2">
			  <input type="text" class="form-control" placeholder="리스트명 검색">
			  <div class="input-group-append">
			    <button class="btn btn-white text-muted border-left-0" type="button">
						<i class="fa fa-search" aria-hidden="true"></i>
					</button>
			  </div>
			</div>

		</div><!-- /.form-inline -->
	</div><!-- /.d-flex -->

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
				<time class="text-muted small" data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_last'],'c')?>"></time>
				<?php if(getNew($R['d_last'],$d['post']['newtime'])):?><span class="rb-new ml-1"></span><?php endif?>
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
