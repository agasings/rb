<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error'] = false;

$R = getUidData($table[$m.'data'],$uid);

if (!$R['uid']) getLink('','','존재하지 않는 포스트입니다.','');
if (!checkPostOwner($R)) getLink('','','잘못된 접근입니다.','');

$hidden = $display==1 || $display==2?1:0;
$d_modify =$date['totime']; // 수정 등록일

//데이터 업데이트
$QVAL1 = "display='$display',hidden='$hidden',d_modify='$d_modify'";
getDbUpdate($table[$m.'data'],$QVAL1,'uid='.$R['uid']);

getDbUpdate($table[$m.'member'],'display='.$display,'data='.$R['uid']); //멤버 인덱스 업데이트
getDbUpdate($table[$m.'index'],'display='.$display,'data='.$R['uid']); //카테고리 인덱스 업데이트
getDbUpdate($table[$m.'list_index'],'display='.$display,'data='.$R['uid']); //리스트 인덱스 업데이트

echo json_encode($result);
exit;

?>
