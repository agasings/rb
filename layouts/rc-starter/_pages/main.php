<?php $d['layout']['main_allpost']='true' ?>

<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<?php if ($d['layout']['main_type']=='allpost'): ?>
<?php getWidget('post/rc-post-all-scroll',array('wrapper'=>'[data-role="postAll"].widget','start'=>'#page-main','recnum'=>5))?>
<?php else: ?>
<button type="button" class="btn btn-secondary" data-toggle="page" data-start="#page-main" data-target="#page-post-allpost" data-title="전체 포스트" data-url="/post">
  전체 포스트 보기
</button>
<?php getWidget('bbs/rc-bbs-list-01',array('bid'=>'free','limit'=>'5','title'=>'자유게시판','link'=>'/c/6'))?>
<?php endif; ?>
