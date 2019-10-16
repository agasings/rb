<?php include $g['dir_module_skin'].'_header.php'?>

<section class="post-section">


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
    <div class="page-meta-actions pr-3">

      <?php if($_perm['owner']):?>

			<?php if ($R['type']==3): ?>
			<a href="<?php echo $g['project_modify'].$R['uid'] ?>" class="btn btn-outline-primary">수정</a>
			<?php else: ?>
			<?php if (!$R['published']): ?>
			<button type="button" class="btn btn-outline-danger" data-toggle="tooltip" data-act="publish" data-publish="1" title="외부에 공개됩니다.">
				공개 처리
			</button>
			<?php else: ?>
			<button type="button" class="btn btn-outline-warning" data-toggle="tooltip" data-act="publish" data-publish="0" title="매니저와 팀원에게만 공개됩니다.">
				비공개 처리
			</button>
			<?php endif; ?>
			<?php endif; ?>

      <a href="<?php echo $g['project_act']?>post_delete&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" class="btn btn-outline-warning">삭제</a>
      <?php endif?>
    </div><!-- /.page-meta-actions -->
  </div>


	<!-- 본문 -->
	<article class="py-4 rb-article">
		<?php echo getContents($R['content'],$R['html'])?>
	</article>

	<section data-role="project-article" class="project-section mt-5">
		<h3 class="pb-2 mb-3 border-bottom d-flex justify-content-between align-items-end">
			<span class="font-weight-light">수행결과</span>
			<div class="section-actions">
			</div>
		</h3>
		<h5 class="d-flex justify-content-between">
			<span class="font-weight-light text-muted">· 첨부파일</span>
		</h5>

		<?php include $g['dir_module_skin'].'_view_attach.php'?>
	</section>

</section>


<aside class="mt-4">
	<?php include $g['dir_module_skin'].'_comment.php'?>
</aside>

<?php include $g['dir_module_skin'].'_footer.php'?>