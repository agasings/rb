<?php
if(!defined('__KIMS__')) exit;

$recnum = $_POST['recnum'];

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'mod/_post.php';

$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/'.$m.'.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['dir_module'].'var/var.php';
include_once $svfile;

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['post']['skin_mobile'];
  $TMPL['start']=$start;
} else {
  $theme = $d['post']['skin_main'];
}

include_once $g['dir_module'].'themes/'.$theme.'/_var.php';

$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');

$result=array();
$result['error'] = false;
$list='';

foreach ($RCD as $R) {
  $TMPL['link']=getPostLink($R,1);
  $TMPL['subject']=stripslashes($R['subject']);
  $TMPL['format'] = $formats[$R['format']];
  $TMPL['uid']=$R['uid'];
  $TMPL['cid']=$R['cid'];
  $TMPL['mbruid']=$R['mbruid'];
  $TMPL['profile_url']=getProfileLink($R['mbruid']);
  $TMPL['hit']=$R['hit'];
  $TMPL['comment']=$R['comment'].($R['oneline']?'+'.$R['oneline']:'');
  $TMPL['likes']=$R['likes'];
  $TMPL['provider']=getFeaturedimgMeta($R,'provider');
  $TMPL['videoId']=getFeaturedimgMeta($R,'provider')=='YouTube'?getFeaturedimgMeta($R,'name'):'';
  $TMPL['featured_640'] = checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'640x360'):getPreviewResize('/files/noimage.png','640x360');
  $TMPL['time'] = checkPostPerm($R)?getUpImageTime($R):'';
  $TMPL['d_modify'] = getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c');
  $TMPL['avatar'] = getAvatarSrc($R['mbruid'],'68');
  $TMPL['nic'] = getProfileInfo($R['mbruid'],'nic');

  $skin=new skin($markup_file);
  $list.=$skin->make();
}

$result['list'] = $list;
$result['num'] = $NUM;

echo json_encode($result);
exit;
?>
