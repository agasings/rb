<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('reload','parent.','정상적인 접근이 아닙니다.','');

$mbruid =  $my['uid'];
$last_log	= $date['totime'];
$id   = $id ? trim($id) : substr($g['time_srnad'],9,7);;
$name = trim($name);

if (!$name) getLink('reload','parent.','리스트 이름을 입력해 주세요.','');
if (!$id) getLink('reload','parent.','아이디를 입력해 주세요.','');

if(getDbRows($table[$m.'list'],"id='".$id."'")) getLink('reload','parent.','이미 같은 아이디의 리스트가 존재합니다.','');
if(getDbRows($table[$m.'list'],"name='".$name."'")) getLink('reload','parent.','이미 같은 이름의 리스트가 존재합니다.','');

$mingid = getDbCnt($table[$m.'list'],'min(gid)','');
$gid = $mingid ? $mingid-1 : 100000000;

$QKEY = "gid,site,id,name,mbruid,num_r,d_last,d_regis,imghead,imgfoot,puthead,putfoot,addinfo,writecode";
$QVAL = "'$gid','$s','$id','$name','$mbruid','0','$last_log','$last_log','$imghead','$imgfoot','$puthead','$putfoot','$addinfo','$writecode'";
getDbInsert($table[$m.'list'],$QKEY,$QVAL);

setrawcookie('postlist_action_result', rawurlencode($name.' 리스트가 추가 되었습니다.|success'));  // 처리여부 cookie 저장
getLink('reload','parent.','','');

?>
