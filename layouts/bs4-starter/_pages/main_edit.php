<?php
if (!$my['admin']) getLink('/','','','');

$g['layoutPageVarForSite'] = $g['dir_layout'].'_var/_page.main.'.$r.'.php'; // 레이아웃 메인페이지 웨젯설정
include is_file($g['layoutPageVarForSite']) ? $g['layoutPageVarForSite'] : $g['dir_layout'].'_var/_page.main.php';
?>

<div class="row">
  <div class="col-8">

    <div class="mb-2 border-bottom">
      <h3 class="pb-2">메인 페이지 설정</h3>
    </div>

    <form name="settingMain" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>"  class="my-4" role="form">
      <input type="hidden" name="r" value="<?php echo $r?>">
      <input type="hidden" name="a" value="regislayoutpage">
      <input type="hidden" name="m" value="site">
      <input type="hidden" name="page" value="main">
      <input type="hidden" name="area" value="main_widget_top,main_widget_left,main_widget_right">
      <input type="hidden" name="main_widget_top" value="">
      <input type="hidden" name="main_widget_left" value="">
      <input type="hidden" name="main_widget_right" value="">

      <div data-role="widgetPage" data-area="top">

        <div class="card text-muted mb-3" data-role="item" data-name="추천 포스트" data-path="post/bs4-list-view-card" id="main-top">
          <input type="hidden" name="widget_members[]" value="<?php echo $d['layout']['main_widget_top'] ?>">
          <div class="card-body text-center">
            <a href="#" class="text-reset" data-role="title" data-act="edit">추천 포스트</a>
          </div>
        </div>

      </div>

      <div class="row gutter-half">
        <div class="col-6">
          <div data-role="widgetPage" data-area="left" data-plugin="nestable" class="dd">
            <?php getWidgetListEdit($d['layout']['main_widget_left']) ?>
            <div data-role="addWidget" class="">
              <button type="button" class="btn btn-white text-muted btn-block f13 py-3" data-target="#modal-widget-selector" data-toggle="modal" data-area="left" style="border-style: dashed;">
                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i> 위젯 추가
              </button>
              <div class="card card-placeholder">
                <div class="card-body">&nbsp;</div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-6">

          <div data-role="widgetPage" data-area="right" data-plugin="nestable" class="dd">
            <?php getWidgetListEdit($d['layout']['main_widget_right']) ?>
            <div data-role="addWidget" class="">
              <button type="button" class="btn btn-white text-muted btn-block f13 py-3" data-target="#modal-widget-selector" data-toggle="modal" data-area="right" style="border-style: dashed;">
                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i> 위젯 추가
              </button>
              <div class="card card-placeholder">
                <div class="card-body">&nbsp;</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="text-center mt-5">
        <button type="button" data-act="submit" class="btn btn-outline-primary btn-block btn-lg">
          <span class="not-loading">
            저장하기
          </span>
          <span class="is-loading">
            처리중...
          </span>
        </button>
      </div>

    </form>

  </div>
  <div class="col-4">

    <div data-role="widgetConfig" class="sticky-top d-none">
      <div data-role="form" class="my-3"></div>
    </div>

  </div>
</div><!-- /.row -->

<!-- nestable : https://github.com/dbushell/Nestable -->
<?php getImport('nestable','jquery.nestable',false,'js') ?>
<?php getImport('clipboard','clipboard.min','2.0.4','js') ?>

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
  if (!wdgvar) wdgvar = 'blank';
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
