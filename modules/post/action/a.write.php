<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'lib/tree.func.php';
include_once $g['dir_module'].'lib/action.func.php';

$mbruid		= $author ? $author : $my['uid'];
$tag		= trim($tag);
$subject	= $subject?htmlspecialchars(trim($subject)):'(제목 없음)';
$review		= trim($review);
$content	= trim($content);

$hit		= 0;
$comment	= 0;
$oneline	= 0;

$d_regis	= $date['totime']; // 최초 등록일
if($uid) $d_modify =$date['totime']; // 수정 등록일
else $d_modify=''; // 최초에는 수정일 없음


if ($uid) {

  $R = getUidData($table[$m.'data'],$uid);
	if (!$R['uid']) getLink('','','존재하지 않는 포스트입니다.','');

  $log = $my[$_HS['nametype']].'|'.getDateFormat($date['totime'],'Y.m.d H:i').'<s>'.$R['log'];
  $QVAL1 = "subject='$subject',review='$review',content='$content',tag='$tag',";
  $QVAL1 .="d_modify='$d_modify',upload='$upload',log='$log',featured_img='$featured_img',linkedmenu='$linkedmenu'";
  getDbUpdate($table[$m.'data'],$QVAL1,'uid='.$R['uid']);

  $_orign_category_members = getDbArray($table[$m.'index'],'data='.$R['uid'],'*','data','asc',0,1);

	while($_ocm=db_fetch_array($_orign_category_members)) {
  	if(!strstr($category_members,'['.$_ocm['category'].']')) {
  		getDbDelete($table[$m.'index'],'category='.$_ocm['category']);
      getDbUpdate($table[$m.'category'],'num=num-1','uid='.$_ocm['category']);
  	}
	}

	$_category_members = array();
	$_category_members = getArrayString($category_members);
	foreach($_category_members['data'] as $_ct1) {
    if (getDbRows($table[$m.'index'],'data='.$uid.' and category='.$_ct1)) continue;
    $mingid = getDbCnt($table[$m.'data'],'min(gid)','');
    $gid = $mingid ? $mingid-1 : 100000000;
    $_ct1_info=getUidData($table[$m.'category'],$_ct1);
    $_ct1_depth=$_ct1_info['depth'];
    getDbInsert($table[$m.'index'],'site,data,category,depth,gid',"'".$s."','".$R['uid']."','".$_ct1."','".$_ct1_depth."','".$gid."'");
    getDbUpdate($table[$m.'category'],'num=num+1','uid='.$_ct1);
	}


} else {

  $cid	= substr($g['time_srnad'],9,7);
  $mingid = getDbCnt($table[$m.'data'],'min(gid)','');
  $gid = $mingid ? $mingid-1 : 100000000;
  $log = $my[$_HS['nametype']].'|'.getDateFormat($date['totime'],'Y.m.d H:i').'<s>';

  $QKEY1 = "site,gid,mbruid,cid,subject,review,content,tag,html,";
  $QKEY1.= "hit,comment,oneline,d_regis,d_modify,d_comment,upload,log,display,d_display,featured_img,format";
  $QVAL1 = "'$s','$gid','$mbruid','$cid','$subject','$review','$content','$tag','$html',";
  $QVAL1.= "'0','0','0','$d_regis','','','$upload','$log','$display','$d_display','$featured_img','$format'";
  getDbInsert($table[$m.'data'],$QKEY1,$QVAL1);

  $LASTUID = getDbCnt($table[$m.'data'],'max(uid)','');
  $QKEY2 = "mbruid,gid,data,auth,level,d_regis";
  $QVAL2 = "'$mbruid','$gid','$LASTUID','1','1','$d_regis'";
  getDbInsert($table[$m.'member'],$QKEY2,$QVAL2);

  $_category_members = array();
	$_category_members = getArrayString($category_members);

	foreach($_category_members['data'] as $_ct1)
	{
    $_ct1_info=getUidData($table[$m.'category'],$_ct1);
    $_ct1_depth=$_ct1_info['depth'];
    if (!getDbRows($table[$m.'index'],'data='.$LASTUID.' and category='.$_ct1))
    {
      getDbInsert($table[$m.'index'],'site,data,category,depth,gid',"'".$s."','".$LASTUID."','".$_ct1."','".$_ct1_depth."','".$gid."'");
      getDbUpdate($table[$m.'category'],'num=num+1','uid='.$_ct1);
    }
	}

	if ($gid == 100000000)
	{
		db_query("OPTIMIZE TABLE ".$table[$m.'data'],$DB_CONNECT);
		db_query("OPTIMIZE TABLE ".$table[$m.'index'],$DB_CONNECT);
	}

}

$NOWUID = $LASTUID ? $LASTUID : $R['uid'];

// 업로드 파일에 대한 parent 값 업데이트
if ($upload) {
	$_updata = getArrayString($upload);
	foreach ($_updata['data'] as $_ups)
	{
		getDbUpdate($table['s_upload'],"parent='".$m.$NOWUID."'",'uid='.$_ups);
	}
}

// 링크 첨부에 대한 parent 값 업데이트
if($attachLink) {
	foreach ($attachLink as $val) {
		getDbUpdate($table['s_link'],"module='".$m."',entry='".$NOWUID."' ",'uid='.$val);
	}
}


// 태그 등록 함수 실행 - lib/action.func.php 참조
if ($tag || $R['tag']) RegisPostTag($tag,$R,$m,$B['uid'],$reply,$NOWUID);

if ($uid) {
  setrawcookie('post_action_result', rawurlencode('저장 되었습니다.'));
	getLink('reload','parent.','','');
} else {
  setrawcookie('post_action_result', rawurlencode('포스트가 등록 되었습니다.'));
	getLink(RW('mod=dashboard&page=post'),'parent.','','');
}

?>
