<?php
if(!defined('__KIMS__')) exit;

//***********************************************************************************
// 여기에 이 위젯에서 사용할 변수들을 정의합니다.
// 변수 작성법은 매뉴얼을 참고하세요.
//***********************************************************************************

$d['widget']['dom'] = array(

	'bs4-list-view-card' => array(
		'특정 리스트',  //위젯명
		array(
			array('listid','postlist','내 리스트',''),
			array('limit','select','노출갯수','1개=1,2개=2,3개=3,4개=4,5개=5'),
			array('line','select','한줄 아이템수','1개=1,2개=2,3개=3,4개=4,5개=5'),
		),
	),
);

?>