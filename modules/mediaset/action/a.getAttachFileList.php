<?php
if(!defined('__KIMS__')) exit;

$uid = $_POST['uid'];
$mod = $_POST['mod'];
$theme_file = $_POST['theme_file'];
$theme = $theme_file;

$R = getUidData($table[$p_module.'data'],$uid);

$result=array();
$result['error']=false;

include_once $g['path_module'].'mediaset/themes/'.$theme_file.'/main.func.php';

if($R['upload']) {
  $result['file'] =  getAttachFileList($R,$mod,'file','');
  $result['photo'] = getAttachFileList($R,$mod,'photo','');
  $result['video'] = getAttachFileList($R,$mod,'video','');
  $result['audio'] = getAttachFileList($R,$mod,'audio','');
}

echo json_encode($result);
exit;
?>
