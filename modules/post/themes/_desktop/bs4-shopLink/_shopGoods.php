<style media="screen">
.carousel-indicators {
  position: relative;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 15;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-pack: center;
  justify-content: center;
  padding-left: 0;
  margin-right: 15%;
  margin-left: 15%;
  list-style: none;
}
.carousel-indicators li {
  position: relative;
  -ms-flex: 0 1 auto;
  flex: 0 1 auto;
  width: auto;
  height: auto;
  margin-right: 3px;
  margin-left: 3px;
  text-indent: 0;
  cursor: pointer;
  background-color: rgba(255,255,255,.5);
}
.carousel-indicators .active img  {
	border: 2px solid #35c5f0 !important
}
</style>


<?php

if ($SH['upload']) {
	$d['upload'] = array();
	$d['upload']['tmp'] = $SH['upload'];
	$d['_pload'] = getArrayString($SH['upload']);
	$attach_file_num=0;// 첨부파일 수량 체크  ---------------------------------> 2015.1.1 추가 by kiere.
	foreach($d['_pload']['data'] as $_val)
	{
		$U = getUidData($table['s_upload'],$_val);
		if (!$U['uid'])
		{
			$SH['upload'] = str_replace('['.$_val.']','',$SH['upload']);
			$d['_pload']['count']--;
		}
		else {
			$d['upload']['data'][] = $U;
			if (!$U['sync'])
			{
				$_SYNC = "sync='[".$m."][".$SH['uid']."][uid,down][".$table[$m.'data']."][".$SH['mbruid']."][m:".$m.",bid:".$SH['bbsid'].",uid:".$SH['uid']."]'";
				getDbUpdate($table['s_upload'],$_SYNC,'uid='.$U['uid']);
			}
		}
		if($U['hidden']==0) $attach_file_num++; // 숨김처리 안했으면 수량 ++
	}
	if ($SH['upload'] != $d['upload']['tmp'])
	{
		// getDbUpdate($table[$m.'data'],"upload='".$SH['upload']."'",'uid='.$SH['uid']);
	}
	$d['upload']['count'] = $d['_pload']['count'];
}

?>


<?php if ($SH['upload']): ?>
  <?php
  	 $img_files = array();
  	 foreach($d['upload']['data'] as $_u){
  			if($_u['type']==2 and $_u['hidden']==0) array_push($img_files,$_u);
  			else if($_u['type']==1 || $_u['type']==6 || $_u['type']==7 and $_u['hidden']==0) array_push($down_files,$_u);
  	 }
  	 $attach_photo_num = count ($img_files);
  ?>

  <?php if($attach_photo_num>0):?>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" data-plugin="photoswipe" itemscope itemtype="http://schema.org/ImageGallery">
  		<?php foreach($img_files as $_u):?>
  		<?php
  			$img_origin='/'.$_u['folder'].'/'.$_u['tmpname'];
  			$thumb_list=getPreviewResize($_u['src']?$_u['src']:$img_origin,'z'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
  			$thumb_modal=getPreviewResize($_u['src']?$_u['src']:$img_origin,'c'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
  		?>
      <figure class="carousel-item border<?php echo $_u === reset($img_files)?' active':'' ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
  			<a href="<?php echo $img_origin ?>" data-size="<?php echo $_u['width']?>x<?php echo $_u['height']?>" itemprop="contentUrl">
        	<img class="d-block w-100" src="<?php echo $thumb_list ?>" alt="<?php echo $_u['name']?>">
  			</a>
  			<figcaption itemprop="caption description" hidden><?php echo $_u['caption']?></figcaption>
      </figure>
  	<?php endforeach?>
    </div>

  	<ol class="carousel-indicators">
  		<?php $i = 0;foreach($img_files as $_u):?>
  		<?php
  			$img_origin='/'.$_u['folder'].'/'.$_u['tmpname'];
  			$thumb_list=getPreviewResize($_u['src']?$_u['src']:$img_origin,'70x50'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
  		?>
      <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"<?php echo $i==0?' class="active"':'' ?>>
  			<img class="border" src="<?php echo $thumb_list ?>" alt="<?php echo $_u['name']?>">
  		</li>
  		<?php $i++;endforeach?>
    </ol>

  	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <?php endif?>

<?php else: ?>

<div class="text-muted f12 text-center py-5">
  <p><i class="fa fa-picture-o fa-5x mb-3" aria-hidden="true"></i></p>
  등록된 이미지가 없습니다.
</div>

<?php endif; ?>

<?php echo getContents($SH['content'],$SH['html'])?>

<hr>

<a href="/?r=<?php echo $r ?>&m=shop&uid=<?php echo $SH['uid'] ?>" class="btn btn-primary btn-block">구매하기</a>
