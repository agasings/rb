<?php
checkAdmin(0);

include $g['dir_layout'].'_var/_var.main.php';  // 레이아웃 메인페이지 웨젯설정
?>

<header class="bar bar-nav bar-light bg-white p-x-0">
  <a data-href="/" class="icon icon-home pull-left p-x-1" role="button"></a>
  <a href="#modal-widget-selector" data-toggle="modal" class="icon icon-plus pull-right pl-2 pr-3">
  </a>
  <h1 class="title">
    <a data-location="reload" data-text="새로고침..">
      사이트 설정
    </a>
  </h1>
</header>

<nav class="bar bar-tab bar-dark bg-primary">
  <a class="tab-item" role="button">
    저장하기
  </a>
</nav>

<div class="content">

  <form name="settingMain" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>"  class="" role="form">
    <input type="hidden" name="r" value="<?php echo $r?>">
    <input type="hidden" name="a" value="regislayoutpage">
    <input type="hidden" name="m" value="site">
    <input type="hidden" name="page" value="main">
    <input type="hidden" name="area" value="main_widget_top,main_widget_left,main_widget_right">
    <input type="hidden" name="main_widget_top" value="">
    <input type="hidden" name="main_widget_left" value="">
    <input type="hidden" name="main_widget_right" value="">

    <div data-role="widgetPage" data-area="left" data-plugin="nestable" class="dd">
      <?php getWidgetListEdit($d['layout']['main_widget']) ?>

    </div>

  </form>

</div>


<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js') ?>

<script src="<?php echo $g['url_layout']?>/_js/widget.js"></script>

<script>
$('[data-role="widgetPage"]').on('click','[data-act="edit"]',function(e) {
  e.preventDefault();
  var item =  $(this).closest('[data-role="item"]')
  var id = item.attr('id');
  var name = item.attr('data-name');
  var path = item.attr('data-path');
  var wdgvar = item.find('[name="widget_members[]"]').val();
  var area;
  setWidgetConfig(id,name,path,wdgvar,area)
  $('[data-role="widgetPage"] [data-role="item"]').removeClass('active shadow-sm');
  $('[data-role="widgetConfig"]').attr('data-id',id);
  $('[data-role="addWidget"]').removeClass('active');
  item.addClass('active shadow-sm');
});

$('[name="settingMain"] [data-act="submit"]').click(function(){
  $(this).attr('disabled', true);
  var top_widgets=$(document).find('[data-area="top"] input[name="widget_members[]"]').map(function(){return $(this).val()}).get();
  var left_widgets=$(document).find('[data-area="left"] input[name="widget_members[]"]').map(function(){return $(this).val()}).get();
  var right_widgets=$(document).find('[data-area="right"] input[name="widget_members[]"]').map(function(){return $(this).val()}).get();
  var new_widgets='';

  if(top_widgets){
    for(var i=0;i<top_widgets.length;i++) {
      new_widgets+=top_widgets[i];
    }
    $('input[name="main_widget_top"]').val(new_widgets);
  }

  var new_widgets='';
  if(left_widgets){
    for(var i=0;i<left_widgets.length;i++) {
      new_widgets+=left_widgets[i];
    }
    $('input[name="main_widget_left"]').val(new_widgets);
  }

  var new_widgets='';
  if(right_widgets){
    for(var i=0;i<right_widgets.length;i++) {
      new_widgets+=right_widgets[i];
    }
    $('input[name="main_widget_right"]').val(new_widgets);
  }
  setTimeout(function(){
    $('[name="settingMain"]').submit();
    resetPage(); // 상태초기화
   }, 500);
});

</script>
