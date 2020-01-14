<?php if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');?>

<?php if ($d['site']['main_post_req']): ?>
<section class="widget" id="widget-post-req">
  <?php getWidget('post/rc-post-req-card',array('wrapper'=>'#widget-post-req','title'=>'추천 포스트','markup'=>'post-row','start'=>'#page-main','posts'=>$d['site']['main_post_req']))?>
</section>
<?php endif; ?>

<section class="widget bg-white pb-2 mb-2" id="widget-shop-req">
  <?php getWidget('shop/rc-shop-req-swipe',array('wrapper'=>'#widget-shop-req','title'=>'추천 상품','markup'=>'post-row','start'=>'#page-main','goods'=>'9,6,5'))?>
</section>
