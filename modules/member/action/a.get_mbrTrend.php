<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) {
	getLink('','','정상적인 접근이 아닙니다.','');
}

$result=array();
$result['error'] = false;

$labelArray = [];
$dataArray = [];

$data = array();

$new_date = date("Ymd", strtotime($d_start.' -1 day'));

$labelsArray = array ();
$dataArray = array ();
$dataytArray = array ();
$dataktArray = array ();
$dataksArray = array ();
$databdArray = array ();
$dataigArray = array ();
$datafbArray = array ();
$datattArray = array ();
$datanbArray = array ();
$yt=0;$kt=0;$ks=0;$bd=0;$ig=0;$fb=0;$tt=0;$nb=0;

while(true) {
	$_new_date = date("m/d", strtotime($new_date. '+1 day'));
	$new_date = date("Ymd", strtotime($new_date. '+1 day'));

	$_R = getDbData($table['s_mbrday'],'date ='.$new_date.' and mbruid='.$my['uid'],'*');
	array_push($labelsArray, $_new_date);
	array_push($dataArray,  $_R['post_'.$mod]?$_R['post_'.$mod]:0);
	array_push($dataytArray,  $_R['yt']?$_R['yt']:0);$yt+=$_R['yt'];
	array_push($dataktArray,  $_R['kt']?$_R['kt']:0);$kt+=$_R['kt'];
	array_push($dataksArray,  $_R['ks']?$_R['ks']:0);$ks+=$_R['ks'];
	array_push($databdArray,  $_R['bd']?$_R['bd']:0);$bd+=$_R['bd'];
	array_push($dataigArray,  $_R['ig']?$_R['ig']:0);$ig+=$_R['ig'];
	array_push($datafbArray,  $_R['fb']?$_R['fb']:0);$fb+=$_R['fb'];
	array_push($datattArray,  $_R['tt']?$_R['tt']:0);$tt+=$_R['tt'];
	array_push($datanbArray,  $_R['nb']?$_R['nb']:0);$nb+=$_R['nb'];
	if($new_date == date('Ymd', strtotime("now"))) break;
}

$type='line';
$data['labels'] =  $labelsArray;

if ($mod=='hit') {

	$data['datasets']= array (
		array (
			'label' => '조회수',
			'borderColor' => array('#004085'),
			'backgroundColor' => array('#cce5ff'),
			'data' => $dataArray,
			'fill' => true,
		)
	);

}

if ($mod=='likes') {
	$data['datasets']= array (
		array (
			'label' => '좋아요 추이',
			'backgroundColor' => array('#d4edda'),
			'borderColor' => array('#155724'),
			'data' => $dataArray
		)
	);
}

if ($mod=='dislikes') {
	$data['datasets']= array (
		array (
			'label' => '싫어요 추이',
			'backgroundColor' => array('#f8d7da'),
			'borderColor' => array('#721c24'),
			'data' => $dataArray
		)
	);
}

if ($mod=='comment') {
	$data['datasets']= array (
		array (
			'label' => '댓글 추이',
			'backgroundColor' => array('#fff3cd'),
			'borderColor' => array('#856404'),
			'data' => $dataArray
		)
	);
}

$result['type'] = $type;
$result['data'] = $data;
$result['options'] = $options;

echo json_encode($result);
exit;
?>
