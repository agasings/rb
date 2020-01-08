<?php
//사이트별 레이아웃 설정 변수
$g['layoutVarForSite'] = $g['dir_layout'].'_var/_var.'.$r.'.php';
include is_file($g['layoutVarForSite']) ? $g['layoutVarForSite'] : $g['dir_layout'].'_var/_var.php';

//사이트별 웹앱 매니페스트
$g['manifestForSite'] = $g['path_var'].'site/'.$r.'/manifest.json';
$g['url_manifest'] = $g['s'].'/_var/site/'.$r.'/manifest.json';
$manifestForSite = file_exists($g['manifestForSite']) ? $g['url_manifest'] : $g['path_module'].'site/var/manifest.json';

//아이폰 전용 apple-touch-icon
$g['touchIconForSite'] = $g['path_var'].'site/'.$r.'/homescreen.png';
$g['url_touchIcon'] = $g['s'].'/_var/site/'.$r.'/homescreen-180x180.png';
$touchIconForSite = file_exists($g['touchIconForSite']) ? $g['url_touchIcon'] : $g['img_core'].'/touch/homescreen-180x180.png';

if ($layoutPage) {
  $g['main'] = $g['path_layout'].$d['site_layout'].'/_pages/'.$layoutPage.'.php';
}

?>
