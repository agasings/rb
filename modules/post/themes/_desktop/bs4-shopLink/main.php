<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$c_recnum = 3; // 한 열에 출력할 카드 갯수
$recnum	= $recnum && $recnum < 200 ? $recnum : 24;
$_WHERE = 'display<2 and site='.$s;
if ($cat) $_WHERE .= ' and ('.getPostCategoryCodeToSql($table[$m.'category'],$cat).')';

$TCD = getDbArray($table[$m.'index'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$m.'index'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);

while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'gid='.$_R['gid'],'*');

?>

<section>

	<?php if ($NUM): ?>

	<div class="card-deck">
		<?php
			 $totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
			 $total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
			 $print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
			 $lack_card_num = $total_card_num;
		?>
		<?php  $i=1;foreach($RCD as $R):?>
		<?php $R['mobile']=isMobileConnect($R['agent'])?>
	  <div class="card">
			<?php if ($R['featured_img'] || $R['linkedshop']): ?>
	    <a href="/post/<?php echo $R['cid']?>">
				<?php
				if ($R['linkedshop']):;
					$linkedshopArr = getArrayString($R['linkedshop']);
					$SH=getUidData($table['shopproduct'],$linkedshopArr['data'][0]);
				?>
				<img src="<?php echo getPreviewResize(getUpImageSrc($SH),'300x200') ?>" class="card-img-top" alt="...">
				<?php else: ?>
				<img src="<?php echo getPreviewResize(getUpImageSrc($R),'300x200') ?>" class="card-img-top" alt="...">
				<?php endif; ?>

			</a>
			<?php endif; ?>
	    <div class="card-body">
	      <h5 class="card-title h6">
					<a href="/post/<?php echo $R['cid']?>">
						<?php echo $R['subject']?>
					</a>
				</h5>
	      <p class="card-text"><?php echo $R['review']?></p>
	    </div>
	  </div>

	<?php
			$print_card_num++; // 카드 출력될 때마 1씩 증가
			$lack_card_num = $total_card_num - $print_card_num;
	 ?>
	<?php if(!($i%$c_recnum)):?></div><div class="card-deck mt-5"><?php endif?>
	<?php $i++;endforeach?>
	<?php if($lack_card_num ):?>
			<?php for($j=0;$j<$lack_card_num;$j++):?>
				 <a class="card border-0"></a>
			<?php endfor?>
	<?php endif?>
	</div><!-- /.card-deck -->


	<?php else: ?>

		자료가 없습니다.

	<?php endif; ?>


</section>
