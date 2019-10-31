<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('reload','parent.','정상적인 접근이 아닙니다.','');

$R = getUidData($table[$m.'data'],$uid);
$mbruid =  $my['uid'];
$last_log	= $date['totime'];
$display = $R['display'];

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
    getDbUpdate($table[$m.'list'],'num=num+1,d_last='.$last_log,'uid='.$_lt1);
  }

}

$result=array();
$result['error'] = false;
echo json_encode($result);
exit;

?>
