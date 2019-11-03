<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<section>

<?php getWidget('post/post-bs4-card-deck',array('limit'=>'4','line'=>'4','title'=>'최근 포스트','subtitle'=>'따끈따끈한 정보들','link'=>'#'))?>

<?php getWidget('post/list-bs4-card-deck',array('limit'=>'4','line'=>'4','listid'=>'6603598','subtitle'=>'따끈따끈한 정보들'))?>

<?php getWidget('post/post-bs4-card-category',array('limit'=>'4','line'=>'4','cat'=>'11'))?>

<?php getWidget('post/profile-bs4-card-deck',array('limit'=>'4','line'=>'4','title'=>'금주의 추천채널','subtitle'=>'이번 주를 뜨겁게 달군 핫한 채널들','term'=>'-1 week','sort'=>'post_hit'))?>

<?php getWidget('post/post-bs4-card-tag',array('limit'=>'3','line'=>'3','tag'=>'소방헬기추락','subtitle'=>'이번 주를 뜨겁게 달군 핫한 키워드'))?>

</section>
