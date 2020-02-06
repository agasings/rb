<?php
if (!$my['admin']) getLink('/','','','');

$g['layoutPageVarForSite'] = $g['dir_layout'].'_var/_page.main.'.$r.'.php'; // 레이아웃 메인페이지 웨젯설정
include is_file($g['layoutPageVarForSite']) ? $g['layoutPageVarForSite'] : $g['dir_layout'].'_var/_page.main.php';
?>

<div class="row">
  <div class="col-8">

    <div class="mb-2 border-bottom">
      <h3 class="pb-2">사이트 설정</h3>
    </div>



  </div>
  <div class="col-4">



  </div>
</div><!-- /.row -->
