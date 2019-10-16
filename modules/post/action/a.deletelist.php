<?php
if(!defined('__KIMS__')) exit;

$R = getUidData($table[$m.'list'],$uid);

if (!$R['uid']) getLink('','','삭제되었거나 존재하지 않는 리스트 입니다.','');


//태그삭제
if ($R['tag'])
{
	$_tagdate = substr($R['d_regis'],0,8);
	$_tagarr1 = explode(',',$R['tag']);
	foreach($_tagarr1 as $_t)
	{
		if(!$_t) continue;
		$_TAG = getDbData($table['s_tag'],"site=".$R['site']." and date='".$_tagdate."' and keyword='".$_t."'",'*');
		if($_TAG['uid'])
		{
			if($_TAG['hit']>1) getDbUpdate($table['s_tag'],'hit=hit-1','uid='.$_TAG['uid']);
			else getDbDelete($table['s_tag'],'uid='.$_TAG['uid']);
		}
	}
}

getDbUpdate($table['s_mbrdata'],'num_list=num_list-1','memberuid='.$R['mbruid']);  //회원 리스트수 조정
getDbDelete($table[$m.'list'],'uid='.$R['uid']); // 리스트 삭제
getDbDelete($table[$m.'list_index'],'list='.$R['uid']);//인덱스삭제

setrawcookie('list_action_result', rawurlencode('리스트가 삭제 되었습니다.|danger'));  // 처리여부 cookie 저장
getLink(RW('mod=dashboard&page=list') ,'parent.' , $alert , $history);
?>