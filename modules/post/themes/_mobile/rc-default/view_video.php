<section class="post-section" data-role="view">
	<header class="bar bar-nav bar-dark bg-black px-0">
		<a class="icon material-icons pull-left text-white px-3" role="button" data-href="<?php echo RW(0)?>" data-text="홈으로 이동">house</a>
		<span class="title" data-href="<?php echo RW(0)?>" data-text="홈으로 이동">
	    <?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
	  </span>
	</header>

	<div class="bar bar-standard bar-header-secondary px-0 bar-dark bg-black border-bottom-0 bar-media">
	  <img src="/_core/images/black-1024x576.png" class="img-fluid" alt="" data-role="featured">
	  <div class="modia-loader"></div>
	  <div class="embed-responsive bg-black" data-role="video">
	    <oembed url="" id="view-player"></oembed>
	  </div>

		<div data-role="listCollapse"></div>
	</div>

	<article class="content post-section">
		<div data-role="box">
	</article>

	</div>
</section>
