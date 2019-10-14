<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('reload','parent.','정상적인 접근이 아닙니다.','');

$mbruid =  $my['uid'];
$last_log	= $date['totime'];
$id   = $id ? trim($id) : substr($g['time_srnad'],9,7);;
$name = trim($name);

if (!$name) getLink('reload','parent.','리스트 이름을 입력해 주세요.','');
if (!$id) getLink('reload','parent.','아이디를 입력해 주세요.','');

if ($uid) {
  $R = getUidData($table[$m.'list'],$uid);

  if ($R['mbruid']!=$mbruid) getLink('reload','parent.','정상적인 접근이 아닙니다.','');
  if(getDbRows($table[$m.'list'],"name='".$name."' and mbruid=".$mbruid." and uid<>".$R['uid'])) getLink('reload','parent.','이미 같은 이름의 리스트가 존재합니다.','');

  getDbUpdate($table[$m.'list'],'name="'.$name.'",d_last='.$last_log,'uid='.$R['uid']);  //리스트명 조정
  setrawcookie('listview_action_result', rawurlencode('리스트명이 수정 되었습니다.|success'));  // 처리여부 cookie 저장
  getLink('reload','parent.','','');

} else {

  if(getDbRows($table[$m.'list'],"id='".$id."'")) getLink('reload','parent.','이미 같은 아이디의 리스트가 존재합니다.','');
  if(getDbRows($table[$m.'list'],"name='".$name."' and mbruid=".$mbruid)) getLink('reload','parent.','이미 같은 이름의 리스트가 존재합니다.','');

  $maxgid = getDbCnt($table[$m.'list'],'max(gid)','');
  $gid = $maxgid ? $maxgid+1 : 1;

  $QKEY = "gid,site,id,name,mbruid,num,d_last,d_regis,imghead,imgfoot,puthead,putfoot,addinfo,writecode";
  $QVAL = "'$gid','$s','$id','$name','$mbruid','0','$last_log','$last_log','$imghead','$imgfoot','$puthead','$putfoot','$addinfo','$writecode'";
  getDbInsert($table[$m.'list'],$QKEY,$QVAL);
  getDbUpdate($table['s_mbrdata'],'num_list=num_list+1','memberuid='.$my['uid']);  //회원 리스트수 조정

  $LASTUID = getDbCnt($table[$m.'list'],'max(uid)','');

  if ($send_mod == 'ajax') {

    $result=array();
    $result['error'] = false;
    $result['uid'] = $LASTUID;
    echo json_encode($result);
  	exit;

  } else {

    setrawcookie('list_action_result', rawurlencode($name.' 리스트가 추가 되었습니다.|success'));  // 처리여부 cookie 저장
    getLink('reload','parent.','','');
  }

}

?>
