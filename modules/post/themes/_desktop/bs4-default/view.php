<?php include $g['dir_module_skin'].'_header.php'?>


<section class="post-section">
	<?php if ($list): ?>
	<div class="d-flex justify-content-between align-items-center py-2 mt-3 mb-4 border-bottom border-dark">
		<h3 class="h4 mb-0">
			<a href="<?php echo getListLink($LIST,$mbrid?1:0) ?>" data-toggle="tooltip" title="<?php echo $MBR['name'] ?>의 리스트" class="d-inline-block align-bottom">
				<img src="<?php echo getAvatarSrc($LIST['mbruid'],'30') ?>" width="30" height="30" alt="<?php echo $MBR['name'] ?>" class="mr-1 rounded-circle">
			</a>
			<?php echo $LIST['name'] ?>
		</h3>
		<div class="">
				<button class="btn btn-white" data-history="back" type="button">이전</button>
		</div>
	</div>


	<?php endif; ?>
	<h2><?php echo $R['subject'] ?></h2>

	<div class="page-meta f13">
    <div class="page-meta-body">
      <div class="project-meta">

        <span class="badge badge-light align-middle border border-success text-success mr-1"><?php echo $g['projectSet']['type'][$R['type']] ?></span>
        <time class="js-timeago mr-1 text-muted js-tooltip" title="등록일시">
          <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo getDateFormat($R['d_regis'],'Y-m-d H:i') ?>
        </time>
        <?php if($R['d_modify']):?>
        <time class="text-muted f12">
          (<?php echo '수정 : '.getDateFormat($R['d_modify'],'Y-m-d H:i') ?>)
        </time>
        <?php endif?>

				<?php if (!$R['disabled_comment']): ?>
				<span class="ml-2">· 댓글 : <a class="muted-link" href="#comments"><?php echo $R['comment']?></a></span>
				<?php endif; ?>


        <span class="ml-2">
          조회 : <?php echo $R['hit']?>
        </span>

				<?php if (!$R['disabled_like']): ?>
				<span class="ml-2">· <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span class="text-muted" data-role=like_num><?php echo $R['likes']?></span></span>
				<?php endif; ?>

				<?php if ($R['num_rating'] && !$R['disabled_rating']): ?>
				<span class="ml-2" data-toggle="tooltip" title="참여: <?php echo $R['num_rating'] ?>명 , 평점 <?php echo $R['rating']/$R['num_rating']?>" role="button">· <i class="fa fa-star-o" aria-hidden="true"></i>
				<a href="#" class="muted-link"> <?php echo $R['rating']/$R['num_rating']?></a></span>
				<?php endif; ?>

      </div>
    </div><!-- /.page-meta-body -->
  </div>

	<!-- 본문 -->
	<article class="py-4 rb-article">
		<?php echo getContents($R['content'],$R['html'])?>
	</article>

	<section class="mt-5">
		<?php include $g['dir_module_skin'].'_view_attach.php'?>
	</section>

	<!-- 포스트 소유자멤버 -->
	<div class="list-group">
	<?php foreach($MBR_RCD as $MBR): ?>
	<a href="<?php echo getProfileLink($MBR['memberuid']) ?>" class="list-group-item list-group-item-action media">
		<img class="rounded-circle mr-3" src="<?php echo getAvatarSrc($MBR['memberuid'],'50') ?>" width="50" height="50" alt="<?php echo $MBR['name'] ?>">
    <div class="media-body">
      <h5 class="mt-0 mb-1"><?php echo $MBR[$_HS['nametype']] ?></h5>
      <small><?php echo $MBR['bio'] ?>.
    </div>
	</a>
	<?php endforeach?>
	</div>


	<footer class="d-flex justify-content-between align-items-center my-5 d-print-none">
		<div class="btn-group">
			 <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
				 <a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="btn btn-light">수정</a>
				 <a href="<?php echo $g['post_delete'].$R['cid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-light">삭제</a>
				<?php endif?>
		 </div>
		 <div class="">
			 <button type="button" class="btn btn-light" data-history="back">이전가기</button>
		 </div>

	</footer>

</section>


<aside class="mt-4">
	<?php include $g['dir_module_skin'].'_comment.php'?>
</aside>

<?php include $g['dir_module_skin'].'_footer.php'?>
