<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<?php getWidget('post/rc-post-all-scroll',array('wrapper'=>'[data-role="postAll"]','start'=>'#page-main','recnum'=>5))?>

<?php //getWidget('bbs/rc-bbs-list-01',array('bid'=>'free','limit'=>'5','title'=>'자유게시판','link'=>'/c/6'))?>
