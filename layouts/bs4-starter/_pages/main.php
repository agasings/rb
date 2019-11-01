<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<section>

<?php getWidget('post/post-bs4-card-deck',array('limit'=>'4','sort'=>'gid'))?>

<?php getWidget('post/post-bs4-card-category',array('limit'=>'4','sort'=>'gid'))?>

<?php getWidget('post/profile-bs4-card-deck',array('limit'=>'4','sort'=>'gid'))?>

<?php getWidget('post/post-bs4-card-tag',array('limit'=>'4','sort'=>'gid'))?>

</section>
