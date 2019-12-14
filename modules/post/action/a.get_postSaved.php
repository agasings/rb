<?php
if(!defined('__KIMS__')) exit;

$recnum = $_POST['recnum'];

require_once $g['path_core'].'function/sys.class.php';

// 포스트 공개관련
$d['displaySet'] = "||비공개,lock||일부공개,how_to_reg||미등록,insert_link||회원공개,people_alt||전체공개,public";
$g['displaySet']['label'] = [];
$g['displaySet']['icon'] = [];
$displaySet=explode('||',$d['displaySet']);
foreach ($displaySet as $displayLine) {
	$dis=explode(',',$displayLine);
	array_push($g['displaySet']['label'], $dis[0]);
	array_push($g['displaySet']['icon'], $dis[1]);
}

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

$sort	= 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;

$sqlque = 'mbruid='.$my['uid'].' and module="post"';

$TCD = getDbArray($table['s_saved'],$sqlque,'entry',$sort,$orderby,$recnum,$p);
while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'uid='.$_R['entry'],'*');

$NUM = getDbRows($table['s_saved'],$sqlque);
$TPG = getTotalPage($NUM,$recnum);

$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');

$result=array();
$result['error'] = false;
$list='';

$TMPL['start']=$start;

if (!empty($RCD)) {
	foreach ($RCD as $R) {
		if (!$R['uid']) continue;
	  $TMPL['link']=getPostLink($R,1);
	  $TMPL['subject']=stripslashes($R['subject']);
	  $TMPL['format'] = $formats[$R['format']];
	  $TMPL['uid']=$R['uid'];
	  $TMPL['cid']=$R['cid'];
	  $TMPL['hit']=$R['hit'];
		$TMPL['post_url']=getPostLink($R,0);
	  $TMPL['comment']=$R['comment'].($R['oneline']?'+'.$R['oneline']:'');
	  $TMPL['likes']=$R['likes'];
	  $TMPL['provider']=getFeaturedimgMeta($R,'provider');
	  $TMPL['videoId']=getFeaturedimgMeta($R,'provider')=='YouTube'?getFeaturedimgMeta($R,'name'):'';
	  $TMPL['featured_640'] = checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'640x360'):getPreviewResize('/files/noimage.png','640x360');
	  $TMPL['featured_320'] = checkPostPerm($R)?getPreviewResize(getUpImageSrc($R),'320x180'):getPreviewResize('/files/noimage.png','320x180');
		$TMPL['has_featured'] = !$R['featured_img']?'d-none':'';
	  $TMPL['time'] = checkPostPerm($R)?getUpImageTime($R):'';
	  $TMPL['d_modify'] = getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c');
	  $TMPL['avatar'] = getAvatarSrc($R['mbruid'],'68');
	  $TMPL['nic'] = getProfileInfo($R['mbruid'],'nic');
	  $TMPL['display']=$R['display']!=5?$g['displaySet']['icon'][$R['display']]:'';

	  $skin=new skin($markup_file);
	  $list.=$skin->make();
	}
}

$result['list'] = $list;
$result['num'] = $NUM;
$result['tpg']= $TPG;

echo json_encode($result);
exit;
?>
