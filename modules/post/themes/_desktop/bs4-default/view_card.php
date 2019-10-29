카드형
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


	<div class="d-flex my-4 justify-content-between d-print-none">
		<div class="my-4 text-center d-print-none">
			<!-- 스크탭-->
			<button type="button" class="btn btn-white <?php if($is_saved):?> active<?php endif?>"
				data-toggle="actionIframe"
				data-url="<?php echo $g['post_action']?>saved&amp;uid=<?php echo $R['uid']?>"
				data-role="btn_post_saved">
				<i class="fa fa-bookmark-o"></i> 저장
			</button>

			<!-- 좋아요 or 싫어요 -->
			<?php if (!$R['dis_like']): ?>
			<button type="button" class="btn btn-white<?php if($is_liked):?> active<?php endif?>"
				data-toggle="actionIframe"
				data-url="<?php echo $g['post_action']?>opinion&amp;opinion=like&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
				data-role="btn_post_like">
				<i class="fa fa fa-heart-o fa-fw" aria-hidden="true"></i> <strong></strong>
				<span data-role='likes_<?php echo $R['uid']?>' class="badge badge-inverted"><?php echo $R['likes']?></span>
			</button>

			<button type="button" class="btn btn btn-white<?php if($is_disliked):?> active<?php endif?>"
				data-toggle="actionIframe"
				data-url="<?php echo $g['post_action']?>opinion&amp;opinion=dislike&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
				data-role="btn_post_dislike">
				<i class="fa fa-thumbs-o-down fa-fw" aria-hidden="true"></i> <strong></strong>
				<span data-role='dislikes_<?php echo $R['uid']?>' class="badge badge-inverted"><?php echo $R['dislikes']?></span>
			</button>
			<?php endif; ?>
		</div>


		<!-- 링크 공유 -->
		<div class="my-4 d-print-none text-center">
			<?php include $g['dir_module_skin'].'_linkshare.php'?>
		</div>
	</div>

	<!-- 태그 -->
	<?php if ($R['tag']): ?>
	<div class="">
		<?php $_tags=explode(',',$R['tag'])?>
		<?php $_tagn=count($_tags)?>
		<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
		<?php $_tagk=trim($_tags[$i])?>
		<a class="badge badge-light rounded-0 f15 font-weight-light bg-light border-0 py-2" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>">
		#<?php echo $_tagk?>
		</a>
		<?php endfor?>
	</div>
	<?php endif; ?>

	<!-- 작성자 정보 -->
	<div class="text-center my-4 py-5 border-top">
		<a href="<?php echo getProfileLink($R['mbruid']) ?>" class="text-reset text-decoration-none">
			<img class="mb-3 rounded-circle border" src="<?php echo getAvatarSrc($R['mbruid'],'64') ?>" width="64" height="64" alt="<?php echo $M1[$_HS['nametype']] ?>의 프로필">
			<h5 class="mb-1"><?php echo $M1[$_HS['nametype']] ?></h5>
			<span class="f13 text-muted"><?php echo $M1['bio'] ?></span>
		</a>
	</div>

	<!-- 포스트 멤버 -->
	<div class="list-group">
		<?php
			$MEMBERS = getArrayString($R['member']);
			foreach($MEMBERS['data'] as $_val):
			$_M = getDbData($table['s_mbrdata'],'memberuid='.$_val,'*');
		?>
		<?php if ($_M['memberuid']): ?>
		<?php if($_M['memberuid']==$R['mbruid']) continue; ?>
		<a href="<?php echo getProfileLink($_val) ?>" class="list-group-item list-group-item-action media">
			<img class="rounded-circle mr-3" src="<?php echo getAvatarSrc($_val,'50') ?>" width="50" height="50" alt="<?php echo $_M['name'] ?>">
	    <div class="media-body">
	      <h5 class="mt-0 mb-1"><?php echo $_M[$_HS['nametype']] ?></h5>
	      <small><?php echo $_M['bio'] ?>
	    </div>
		</a>
		<?php endif; ?>
		<?php endforeach?>
	</div>

	<footer class="d-flex justify-content-between align-items-center my-5 d-print-none">
		<div class="btn-group">
			 <?php if($_perm['post_owner']):?>
				 <a href="<?php echo RW('m=post&mod=write&cid='.$R['cid']) ?>" class="btn btn-white text-danger">관리</a>
				<?php endif?>
		 </div>
		 <div class="">
			 <button type="button" class="btn btn-white" data-history="back">이전가기</button>
		 </div>

	</footer>

</section>


<?php if (!$R['dis_comment']): ?>
<aside class="mt-4">
	<?php include $g['dir_module_skin'].'_comment.php'?>
</aside>
<?php endif; ?>
