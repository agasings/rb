<?php
if ($my['uid'] && $d['layout']['main_dashboard']=='true') getLink('/dashboard','','','');
include $g['dir_layout'].'_var/_var.main.php';
?>

<?php getWidgetList($d['layout']['main_widget_top']) ?>

<div class="row">
  <div class="col-6">
    <?php getWidgetList($d['layout']['main_widget_left']) ?>
  </div>
  <div class="col-6">
    <?php getWidgetList($d['layout']['main_widget_right']) ?>
  </div>
</div>
