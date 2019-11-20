<?php
if(!defined('__KIMS__')) exit;

$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 16;
$postque = 'site='.$s;
$postque .= ' and (display=2 and hidden=0) or display>3';
$postque .= ' and mbruid='.$my['uid'];
$NUM = getDbRows($table['s_feed'],$postque);
$TCD = getDbArray($table['s_feed'],$postque,'entry',$sort,$orderby,$recnum,$p);
while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table['postdata'],'uid='.$_R['entry'],'*');

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';
include_once $g['dir_module'].'var/var.php';

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

$i=1;foreach ($RCD as $R) {
  $TMPL['link']=getPostLink($R,1);
  $TMPL['subject']=htmlspecialchars(stripslashes($R['subject']));
  $TMPL['format'] = $formats[$R['format']];
  $TMPL['uid']=$R['uid'];
  $TMPL['hit']=$R['hit'];
  $TMPL['mbruid']=$R['mbruid'];
  $TMPL['profile_url']=getProfileLink($R['mbruid']);
  $TMPL['comment']=$R['comment'].($R['oneline']?'+'.$R['oneline']:'');
  $TMPL['likes']=$R['likes'];
  $TMPL['dislikes']=$R['dislikes'];
  $TMPL['provider']=getFeaturedimgMeta($R,'provider');
  $TMPL['videoId']=getFeaturedimgMeta($R,'provider')=='YouTube'?getFeaturedimgMeta($R,'name'):'';
  $TMPL['featured_640'] = checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'640x360'):getPreviewResize('/files/noimage.png','640x360');
  $TMPL['featured_img'] = checkPostPerm($R) ?getPreviewResize(getUpImageSrc($R),'300x168'):getPreviewResize('/files/noimage.png','300x168');
  $TMPL['time'] = checkPostPerm($R)?getUpImageTime($R):'';
  $TMPL['d_modify'] = getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c');
  $TMPL['avatar'] = getAvatarSrc($R['mbruid'],'68');
  $TMPL['nic'] = getProfileInfo($R['mbruid'],'nic');

  if ($sort=='hit') $TMPL['num']=$R['hit']?'조회 '.$R['hit']:'';
  if ($sort=='likes') $TMPL['num']=$R['likes']?'좋아요 '.$R['likes']:'';
  if ($sort=='dislikes') $TMPL['num']=$R['dislikes']?'싫어요 '.$R['dislikes']:'';
  if ($sort=='comment') $TMPL['num']=$R['comment']?'댓글 '.$R['comment']:'';

  $skin=new skin($markup_file);
  $list.=$skin->make();

  if ($i==$limit) break;
  $i++;
}

$result['list'] = $list;
echo json_encode($result);
exit;
?>
