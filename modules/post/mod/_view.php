<?php
if(!defined('__KIMS__')) exit;


if (!$my['admin'] && !strstr(','.($d['post']['admin']?$d['post']['admin']:'.').',',','.$my['id'].','))
{
	if ($d['post']['perm_l_view'] > $my['level'] || strpos('_'.$d['post']['perm_g_view'],'['.$my['sosok'].']'))
	{
		$g['main'] = $g['dir_module'].'mod/_permcheck.php';
		$d['post']['isperm'] = false;
	}
}

if ($R['hidden'])
{
	if ($my['uid'] != $R['mbruid'] && $my['uid'] != $R['pw'] && !$my['admin'])
	{
		if (!strpos('_'.$_SESSION['module_'.$m.'_pwcheck'],'['.$R['uid'].']'))
		{
			$g['main'] = $g['dir_module'].'mod/_pwcheck.php';
			$d['post']['isperm'] = false;
		}
	}
}

if ($d['post']['isperm'] && ($d['post']['hitcount'] || !strpos('_'.$_SESSION['module_'.$m.'_view'],'['.$R['uid'].']')))
{

	// 포스트 멤버의 포스트 통합조회수 +1
	$_WHERE1 = 'data='.$R['uid'].' and auth=1';
	$_RCD1 = getDbSelect($table[$m.'member'],$_WHERE1,'*');
	while($R1=db_fetch_array($_RCD1)) {
	  getDbUpdate($table['s_mbrdata'],'hit_post=hit_post+1','memberuid='.$R1['mbruid']);
	}

	getDbUpdate($table[$m.'data'],'hit=hit+1','uid='.$R['uid']);
	$_SESSION['module_'.$m.'_view'] .= '['.$R['uid'].']';
}

if ($d['post']['isperm'] && $R['upload'])
{
	$d['upload'] = array();
	$d['upload']['tmp'] = $R['upload'];
	$d['_pload'] = getArrayString($R['upload']);
	$attach_file_num=0;// 첨부파일 수량 체크  ---------------------------------> 2015.1.1 추가 by kiere.
	foreach($d['_pload']['data'] as $_val)
	{
		$U = getUidData($table['s_upload'],$_val);
		if (!$U['uid'])
		{
			$R['upload'] = str_replace('['.$_val.']','',$R['upload']);
			$d['_pload']['count']--;
		}
		else {
			$d['upload']['data'][] = $U;
			if (!$U['sync'])
			{
				$_SYNC = "sync='[".$m."][".$R['uid']."][uid,down][".$table[$m.'data']."][".$R['mbruid']."][m:".$m.",bid:".$R['bbsid'].",uid:".$R['uid']."]'";
				getDbUpdate($table['s_upload'],$_SYNC,'uid='.$U['uid']);
			}
		}
		if($U['hidden']==0) $attach_file_num++; // 숨김처리 안했으면 수량 ++
	}
	if ($R['upload'] != $d['upload']['tmp'])
	{
		// getDbUpdate($table[$m.'data'],"upload='".$R['upload']."'",'uid='.$R['uid']);
	}
	$d['upload']['count'] = $d['_pload']['count'];
}

if ($mbrid) {
	$M = getDbData($table['s_mbrid'],"id='".$mbrid."'",'*');
	$MBR = getDbData($table['s_mbrdata'],'memberuid='.$M['uid'],'*');
}

$LIST=getDbData($table[$m.'list'],"id='".$list."'",'*');

// 메타 이미지 세팅 = 해당 포스트의 대표 이미지를 메타 이미지로 적용한다.
if($R['featured_img']){
   $FI=getUidData($table['s_upload'],$R['featured_img']);
   //$featured_img=getPreviewResize($FI['tmpname'],'q'); // 동적 사이즈 조정
   $g['meta_img']=$g['url_root'].$FI['url'].$FI['folder'].'/'.$featured_img;
}

$mod = $mod ? $mod : 'view';

//포스트 멤버
$_POSTMBR_RCD = getDbArray($table[$m.'member'],'data='.$R['uid'].' and auth=1','*','gid','asc',0,1);
while($_POSTMBR_R = db_fetch_array($_POSTMBR_RCD)) $MBR_RCD[] = getDbData($table['s_mbrdata'],'memberuid='.$_POSTMBR_R['mbruid'],'*');


// 포스트 멤버




?>
