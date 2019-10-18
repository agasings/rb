<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error'] = false;

$R = getUidData($table[$m.'data'],$uid);
if (!$R['uid']) getLink('','','존재하지 않는 포스트입니다.','');

if (!checkPostPerm($R)) {
  getLink('','','잘못된 접근입니다.','');
}

$log = $my[$_HS['nametype']].'|'.getDateFormat($date['totime'],'Y.m.d H:i').'<s>'.$R['log'];
$QVAL1 = "subject='$subject',review='$review',content='$content',tag='$tag',display='$display',hidden='$hidden',";
$QVAL1 .="d_modify='$d_modify',upload='$upload',log='$log',featured_img='$featured_img',linkedmenu='$linkedmenu',dis_comment='$dis_comment',dis_like='$dis_like',dis_rating='$dis_rating'";
getDbUpdate($table[$m.'data'],$QVAL1,'uid='.$R['uid']);

//포스트 공유설정 업데이트
getDbUpdate($table[$m.'member'],'display='.$display,'data='.$R['uid']);

$_category_members = array();
$_category_members = getArrayString($category_members);
foreach($_category_members['data'] as $_ct1) {

  if (getDbRows($table[$m.'index'],'data='.$uid.' and category='.$_ct1)) {
    getDbUpdate($table[$m.'index'],'display='.$display,'data='.$uid.' and category='.$_ct1);
  } else {
    $mingid = getDbCnt($table[$m.'data'],'min(gid)','');
    $gid = $mingid ? $mingid-1 : 100000000;
    $_ct1_info=getUidData($table[$m.'category'],$_ct1);
    $_ct1_depth=$_ct1_info['depth'];
    getDbInsert($table[$m.'index'],'site,data,category,display,depth,gid',"'".$s."','".$R['uid']."','".$_ct1."','".$display."','".$_ct1_depth."','".$gid."'");
    getDbUpdate($table[$m.'category'],'num=num+1','uid='.$_ct1);
  }

}

//리스트 업데이트
$_orign_list_members = getDbArray($table[$m.'list_index'],'data='.$R['uid'].' and mbruid='.$mbruid,'*','data','asc',0,1);

while($_olm=db_fetch_array($_orign_list_members)) {
	if(!strstr($list_members,'['.$_olm['list'].']')) {
		getDbDelete($table[$m.'list_index'],'list='.$_olm['list'].' and data='.$R['uid'].' and mbruid='.$mbruid);
    getDbUpdate($table[$m.'list'],'num=num-1','uid='.$_olm['list']);
	}
}

$_list_members = array();
$_list_members = getArrayString($list_members);

foreach($_list_members['data'] as $_lt1) {
  if (getDbRows($table[$m.'list_index'],'data='.$uid.' and list='.$_lt1)) {
    getDbUpdate($table[$m.'list_index'],'display='.$display,'data='.$uid.' and list='.$_lt1);
  } else {
    $maxgid = getDbCnt($table[$m.'list_index'],'max(gid)','');
    $gid = $maxgid ? $maxgid+1 : 1;
    getDbInsert($table[$m.'list_index'],'site,list,display,data,gid,mbruid',"'".$s."','".$_lt1."','".$display."','".$R['uid']."','".$gid."','".$mbruid."'");
    getDbUpdate($table[$m.'list'],'num=num+1,d_last='.$d_regis,'uid='.$_lt1);
  }
}

$_R = getUidData($table[$m.'data'],$LASTUID);
getLink(RW('m=post&mod=write&cid='.$_R['cid']),'parent.','','');

?>
