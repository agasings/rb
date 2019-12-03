<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';
require_once $g['dir_module'].'lib/base.class.php';
require_once $g['dir_module'].'lib/module.class.php';

$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/'.$m.'.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['dir_module'].'var/var.php';
include_once $svfile;

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['post']['skin_mobile'];
} else {
  $theme = $d['post']['skin_main'];
}

$_IS_POSTOWN=getDbRows($table[$m.'member'],'mbruid='.$my['uid'].' and data='.$uid.' and level=1');
$_perm['post_owner'] = $my['admin'] || $_IS_POSTOWN  ? true : false;

$post = new Post();
$post->theme_name = $theme;

$result=array();
$result['error'] = false;

$R = getUidData($table[$m.'data'],$uid);
$TMPL['uid'] = $R['uid'];
$TMPL['cid'] = $R['cid'];

$list='';
$list = $post->getHtml('post-option');
$list .= $_perm['post_owner']?$post->getHtml('post-option-owner'):'';

$result['list'] = $list;
$result['num'] = $i;

echo json_encode($result);
exit;
?>
