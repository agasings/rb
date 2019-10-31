<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';
include_once $g['dir_module'].'var/var.php';

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['post']['skin_mobile'];
} else {
  $theme = $d['post']['skin_main'];
}

$result=array();
$result['error'] = false;

$uid = $_POST['uid']; // 제품 고유번호


$R = getUidData($table[$m.'data'],$uid);
$linkedshopArr = getArrayString($R['linkedshop']);

$result['goods'] = $linkedshopArr['data'][0];
$result['article'] = getContents($R['content'],'HTML');
$result['hit'] = $R['hit'];
$result['likes'] = $R['likes'];
$result['dislikes'] = $R['dislikes'];
$result['comment'] = $R['comment'];

$markup_file = $markup_file?$markup_file:'view';

// 최종 결과값 추출 (sys.class.php)
//$skin=new skin($markup_file);
//$result['article']=$skin->make();
echo json_encode($result);
exit;
?>
