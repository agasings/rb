<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<section>

<?php getWidget('post/bs4-post-best-card',array('limit'=>'4','line'=>'4','title'=>'금주의 추천 포스트','subtitle'=>'이번 주를 뜨겁게 달군 핫한 포스트','term'=>'-1 week','sort'=>'hit'))?>

<?php getWidget('post/bs4-post-new-card',array('limit'=>'4','line'=>'4','title'=>'최근 포스트','subtitle'=>'따끈따끈한 정보들','link'=>'/post'))?>

<?php getWidget('post/bs4-list-new-card',array('limit'=>'4','line'=>'4','title'=>'최근 리스트','subtitle'=>'따끈따끈한 정보들','link'=>'/list'))?>

<?php getWidget('post/bs4-list-view-card',array('limit'=>'4','line'=>'4','listid'=>'4517103','subtitle'=>'따끈따끈한 정보들'))?>

<?php getWidget('post/bs4-post-cat-card',array('limit'=>'4','line'=>'4','cat'=>'11'))?>

<?php getWidget('post/bs4-post-tag-card',array('limit'=>'3','line'=>'3','tag'=>'소방헬기추락','subtitle'=>'이번 주를 뜨겁게 달군 핫한 키워드'))?>

<?php getWidget('profile/bs4-best-card',array('limit'=>'4','line'=>'4','title'=>'금주의 추천채널','subtitle'=>'이번 주를 뜨겁게 달군 핫한 채널들','term'=>'-1 week','sort'=>'post_hit'))?>

</section>
