<section class="post-section" data-role="view">
	<header class="bar bar-nav bar-dark bg-black px-0">
		<a class="icon material-icons pull-left text-white px-3" role="button" data-href="<?php echo RW(0)?>" data-text="홈으로 이동">house</a>
		<span class="title" data-href="<?php echo RW(0)?>" data-text="홈으로 이동">
	    <?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
	  </span>
	</header>

	<div class="bar bar-standard bar-header-secondary px-0 bar-dark bg-black border-bottom-0 bar-media shadow-sm">
	  <div class="modia-loader"></div>
	  <div class="embed-responsive embed-responsive-16by9 bg-black" data-role="video" style="background-size: cover;">
	    <oembed url="<?php echo getFeaturedimgMeta($R,'linkurl') ?>" id="player"></oembed>
	  </div>

		<?php if ($list): ?>
		<div data-role="listCollapse"></div>
		<?php endif; ?>

	</div>

	<?php if ($R['goods']): ?>
	<nav class="bar bar-tab bar-dark bar-dark bg-inverse border-top-0" data-role="goodsLink">
	  <a class="tab-item bg-primary" role="button" data-title="이영상에 사용된 제품" data-target="#page-shop-category" data-index="1" data-parent="1" data-category="6" data-toggle="page" data-start="#page-post-view-video" data-act="pauseVideo">
			제품 구매하기
		</a>
	</nav>
	<?php endif; ?>

	<article class="content post-section">

		<?php if ($R['tag']): ?>
		<div class="content-padded mb-0" data-role="tag">
			<?php $_tags=explode(',',$R['tag'])?>
			<?php $_tagn=count($_tags)?>
			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
			<?php $_tagk=trim($_tags[$i])?>
			<a class="badge bg-white rounded-0 f13 font-weight-light border-0" href="<?php echo RW('m=post&mod=keyword&') ?>keyword=<?php echo urlencode($_tagk)?>">
			#<?php echo $_tagk?>
			</a>
			<?php endfor?>
		</div>
		<?php endif; ?>

		<button class="d-flex justify-content-between mt-3 px-0 collapsed text-reset w-100" data-toggle="collapse" data-target="#collapseContent">
		  <div class="content-padded my-1 text-xs-left">
		    <strong data-role="title" class="h5 mb-0 line-clamp-2">
		      <?php echo stripslashes($R['subject']) ?>
		    </strong>
		    <small class="d-block text-muted mt-1">
		      조회수 <?php echo number_format($R['hit'])?>회
		    </small>
		  </div>
		  <div class="pr-3">
		    <i class="fa fa-caret-up text-muted" aria-hidden="true"></i>
		  </div>
		</button>

		<div class="d-flex text-xs-center px-3">
		  <div class="flex-fill" data-role="opinion">
		    <button type="button" class="btn btn-link muted-link px-3"
		      data-toggle="view_opinion"
		      data-title="동영상이 마음에 드시나요?"
		      data-subtext="로그인하여 의견을 알려주세요."
		      data-send="_ajax"
		      data-uid="{$uid}"
		      data-opinion="like"
		      data-effect="heartbeat"
		      data-role="btn_post_like_{$uid}">
		      <i class="material-icons d-block mb-1">thumb_up</i>
		      <small class="text-muted" data-role='likes_{$uid}'><?php echo $R['likes']?$R['likes']:'좋아요'?></small>
		    </button>
		  </div>
		  <div class="flex-fill" data-role="opinion">
		    <button type="button" class="btn btn-link muted-link px-3"
		      data-toggle="view_opinion"
		      data-target="#popup-login-guide"
		      data-title="동영상이 마음에 안 드시나요?"
		      data-subtext="로그인하여 의견을 알려주세요."
		      data-send="_ajax"
		      data-uid="{$uid}"
		      data-opinion="dislike"
		      data-effect="heartbeat"
		      data-role="btn_post_dislike_{$uid}">
		      <i class="material-icons d-block mb-1">thumb_down</i>
		      <small class="text-muted" data-role='dislikes_{$uid}'><?php echo $R['dislikes']?$R['dislikes']:'싫어요'?></small>
		    </button>
		  </div>
		  <div class="flex-fill" data-role="linkShare">
		    <button type="button" class="btn btn-link muted-link px-3"
		      data-toggle="linkShare"
		      data-subject="{$subject}"
		      data-desc="{$review}"
		      data-url="{$post_url}"
		      data-title="링크공유">
		      <i class="material-icons d-block mb-1 mirror" style="font-size: 30px;margin-top:-6px">reply</i>
		      <small>공유</small>
		    </button>
		  </div>
		  <div class="flex-fill" data-role="listadd">
		    <button type="button" class="btn btn-link muted-link px-3"
		      data-toggle="view_listadd"
		      data-title="나중에 다시 보고 싶으신가요?"
		      data-subtext="로그인하여 동영상을 재생목록에 추가하세요."
		      data-uid="{$uid}">
		      <i class="material-icons d-block mb-1" style="font-size: 26px;">library_add</i>
		      <small>저장</small>
		    </button>
		  </div>
		  <div class="flex-fill">
		    <button type="button" class="btn btn-link muted-link px-3"
		      data-toggle="view_report"
		      data-title="동영상을 신고하시겠습니까?"
		      data-subtext="부적절한 콘텐츠를 신고하려면 로그인하세요."
		      data-uid="{$uid}">
		      <i class="material-icons d-block mb-1" style="font-size: 30px;margin-top:-2px">flag</i>
		      <small>신고</small>
		    </button>
		  </div>
		</div>

		<div class="border-top border-bottom">
		  <div class="d-flex justify-content-between align-items-center content-padded">

		    <div class="text-reset media"
		      data-toggle="profile"
		      data-target="#modal-member-profile"
		      dat-url="{$profile_url}"
		      data-mbruid="{$mbruid}"
		      data-nic="{$nic}" data-change="true">
		      <img src="<?php echo getAvatarSrc($R['mbruid'],'48') ?>" class="mr-2 rounded-circle" width="34" height="34" alt="<?php echo $M1[$_HS['nametype']] ?>의 프로필">
		      <div class="media-body">
		        <div class="f16" style="line-height: 1.2;"><?php echo $M1[$_HS['nametype']] ?></div>
		        <p class="mb-0 text-muted f12">
		            구독자
		            <span data-role="num_follower"><?php echo number_format($M1['num_follower'])?></span>명
		        </p>
		      </div>
		    </div><!-- /.media -->

		    <div>

					<?php if ($my['uid']&&$R['likes']&&!$R['dis_like']): ?>
					<button type="button" class="btn btn-link"
					 data-target="#modal-post-opinion"
					 data-opinion="like"
					 data-toggle="modal"
					 data-featured_img="{$avatar}" data-subject="{$subject}"
					 data-uid="{$uid}">
					  좋아요 내역
					</button>
					<?php endif; ?>

					<?php if ($my['uid']!=$R['mbruid']): ?>
					<button type="button" class="btn btn-link {$isFollowing} mr-2"
					   data-title="채널을 구독하시겠습니까?"
					   data-subtext="채널을 구독하려면 로그인하세요."
					   data-toggle="follow"
					   data-mbruid="{$mbruid}">
					  구독
					</button>
					<?php endif; ?>

					<?php if ($_perm['post_owner']): ?>
					<button type="button" class="btn btn btn-outline-primary"
					 data-target="#modal-post-analytics"
					 data-toggle="modal"
					 data-uid="{$uid}">
					  분석
					</button>
					<a href="" class="btn btn-outline-primary">수정</a>
					<?php endif; ?>

		    </div>

		  </div><!-- /.d-flex -->
		</div>

		<!-- 본문 -->
		<article class="collapse border-bottom" id="collapseContent">
		  <div class="f15 text-muted content-padded" data-plugin="shorten">
		    <?php echo getContents($R['content'],$R['html'])?>
		  </div>
		</article>

		<?php include $g['dir_module_skin'].'_newPost.php' ?>

		<aside class="mt-4">
		  <div data-role="comment"></div>
		</aside>

	</article>
</section>

<script type="text/javascript">


setPostView({
	format : '<?php echo $formats[$R['format']] ?>',
	uid : '<?php echo $R['uid'] ?>',
	featured : '<?php echo checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'640x360'):getPreviewResize('/files/noimage.png','640x360'); ?>',
	videoId : '<?php echo getFeaturedimgMeta($R,'provider')=='YouTube'?getFeaturedimgMeta($R,'name'):''; ?>',
	provider : '<?php echo getFeaturedimgMeta($R,'provider'); ?>',
	dis_comment : <?php echo $R['dis_comment'] ?>,
	url : '',
});

</script>
