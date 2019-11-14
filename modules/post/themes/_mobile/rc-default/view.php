<?php
include $g['dir_module_skin'].'_header.php';
$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');
include $g['dir_module_skin'].'view_'.$formats[$R['format']].'.php';
include $g['dir_module_skin'].'_footer.php';

$featured_img = checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'640x360'):getPreviewResize('/files/noimage.png','640x360');
$provider = getFeaturedimgMeta($R,'provider');
$videoId = getFeaturedimgMeta($R,'provider')=='YouTube'?getFeaturedimgMeta($R,'name'):'';
?>


<script src="<?php echo $g['url_module_skin'] ?>/_js/view.js<?php echo $g['wcache']?>" ></script>

<script>

// youtube API
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

$( document ).ready(function() {

	getPostView({
		uid : '<?php echo $R['uid'] ?>',
		mod : 'view',
		list : '<?php echo $list ?>',
		wrapper : $('[data-role="view"]'),
		featured : '<?php echo $featured_img ?>',
		provider : '<?php echo $provider ?>',
		videoId : '<?php echo $videoId ?>',
		markup    : 'view_<?php echo $formats[$R['format']] ?>',  // 테마 > _html >
	});

});

</script>
