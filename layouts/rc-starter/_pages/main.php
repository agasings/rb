<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<section class="widget" id="widget-post-all" data-role="postAll">
  <?php getWidget('post/rc-post-all-scroll',array('wrapper'=>'#widget-post-all','start'=>'#page-main','recnum'=>5,'link'=>'/post'))?>
</section>

<?php //getWidget('bbs/rc-bbs-list-01',array('bid'=>'free','limit'=>'5','title'=>'자유게시판','link'=>'/c/6'))?>
