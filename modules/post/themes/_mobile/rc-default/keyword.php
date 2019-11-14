<header class="bar bar-nav bar-light bg-white px-0">
	<span class="title">#<?php echo $keyword ?></span>
	<a class="icon pull-left material-icons px-3" role="button">arrow_back</a>
	<a class="icon pull-right material-icons pl-2 pr-3" role="button" data-toggle="popup" data-target="#popup-post-filter">tune</a>
	<a class="icon pull-right material-icons px-2" role="button">clear</a>
</header>

<section class="content">

	<ul class="table-view table-view-sm mt-2 border-top-0 border-bottom-0">

		<?php foreach($RCD as $R):?>
	  <li class="table-view-cell border-bottom-0">

			<div data-toggle="modal" data-target="#modal-post-view">
				<span class="media-object pull-left position-relative">
					<img class="" src="<?php echo checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'480x270'):getPreviewResize('/files/noimage.png','480x270') ?>" class="img-fluid" alt="" style="width:160px">
					<time class="badge badge-default bg-black rounded-0 position-absolute f13" style="top:auto;left:auto;right:1px;bottom:1px"><?php echo checkPostPerm($R)?getUpImageTime($R):'' ?></time>
				</span>

				<div class="media-body">
					<div class="f14 line-clamp-3" style="line-height:1.3"><?php echo checkPostPerm($R)?stripslashes($R['subject']):'[비공개 포스트]'?></div>

					<div class="f12" style="margin-top:.2rem;line-height:1.3">
						<p><?php echo getProfileInfo($R['mbruid'],$_HS['nametype']) ?></p>
						<ul class="list-inline text-muted mb-0">
							<li class="list-inline-item">조회수 <?php echo $R['hit']?>회 </li>
							<li class="list-inline-item"><time class="" data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>"></time></li>
						</ul>
					</div>


				</div>
			</div>

	    <span class="badge badge-default badge-inverted">
				<a href="#popup-post-listmore" data-toggle="popup" data-uid="<?php echo $R['uid']?>" class="icon material-icons text-muted">more_vert</a>
			</span>
	  </li>
		<?php endforeach?>

	</ul>

</section>
