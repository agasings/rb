<?php
if(!defined('__KIMS__')) exit;

$p		= $p ? $p : 1;
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$sort	= $sort		? $sort		: 'hit';
$orderby= $orderby	? $orderby	: 'desc';
$query = 'site='.$s.' and ';

$_WHERE1= $query.'date >= '.$d_start;

if ($sort=='hit') $_WHERE2= 'data,sum(hit) as hit';
if ($sort=='likes') $_WHERE2= 'data,sum(likes) as likes';
if ($sort=='comment') $_WHERE2= 'data,sum(comment) as comment';

$RCD	= getDbSelect($table[$m.'day'],$_WHERE1.' group by data order by '.$sort.' '.$orderby.' limit 0,'.$recnum,$_WHERE2);
while($_R = db_fetch_array($RCD)) $_RCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

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

$list='';

$i=1;foreach ($_RCD as $R) {
  if (!strpos('_'.$R['member'],'['.$my['uid'].']')) continue;
  $TMPL['link']=getPostLink($R,1);
  $TMPL['subject']=htmlspecialchars($R['subject']);
  $TMPL['uid']=$R['uid'];
  $TMPL['hit']=$R['hit'];
  $TMPL['comment']=$R['comment'].($R['oneline']?'+'.$R['oneline']:'');
  $TMPL['likes']=$R['likes'];
  $TMPL['featured_img'] = checkPostPerm($R) ?getPreviewResize(getUpImageSrc($R),'100x56'):getPreviewResize('/files/noimage.png','100x56');
  $TMPL['time'] = checkPostPerm($R)?getUpImageTime($R):'';
  $TMPL['d_modify'] = getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c');

  $skin=new skin($markup_file);
  $list.=$skin->make();

  if ($i==$limit) break;
  $i++;
}

$result['list'] = $list;
$result['num'] = $i;

echo json_encode($result);
exit;
?>
