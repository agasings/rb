<?php
if(!defined('__KIMS__')) exit;

$R = getUidData($table[$m.'data'],$uid);

if (!$my['uid'] || !$R['uid']) {
	getLink('','','정상적인 접근이 아닙니다.','');
}

$result=array();
$result['error'] = false;

$labelArray = [];
$dataArray = [];

$date1 = $d_start;
$date2 = date("Ymd", strtotime("now")); // 오늘

$new_date = date("Ymd", strtotime($date1.' -1 day'));
while(true) {
	$_new_date = date("m/d", strtotime($new_date. '+1 day'));
	$new_date = date("Ymd", strtotime($new_date. '+1 day'));
	$R = getDbData($table[$m.'day'],'date ='.$new_date.' and data='.$R['uid'],'*');
	array_push($labelArray, $_new_date);
	array_push($dataArray,  $R['hit']?$R['hit']:0);
	if($new_date == $date2) break;
}

// $result['label'] = ['1월', '2월', '3월', '4월', '5월', '6월', '7월'];
// $result['data'] = [0, 0, 0, 0, 0, 30, 35];

$result['label'] = $labelArray;
$result['data'] = $dataArray;

echo json_encode($result);
exit;
?>
