<?php
if(!defined('__KIMS__')) exit;

//***********************************************************************************
// 여기에 이 위젯에서 사용할 변수들을 정의합니다.
// 변수 작성법은 매뉴얼을 참고하세요.
//***********************************************************************************

$d['widget']['dom'] = array(

	'bs4-bbs-gallery-01' => array(
		'게시판-갤러리형-01',  //위젯명
		array(
			array('bbsid','bbs','게시판 선택',''),
			array('title','input','타이틀',''),
			array('limit','select','총 항목수','1개=1,2개=2,3개=3,4개=4,5개=5,6개=6,7개=7,8개=8,9개=9,10개=10,11개=11,12개=12'),
			array('line','select','한열 항목수','1개=1,2개=2,3개=3,4개=4,5개=5'),
			array('view','select','보기형식','모달 레이어=modal,일반 링크=link'),
			array('link','input','링크연결','')
		),
	),
);

?>
