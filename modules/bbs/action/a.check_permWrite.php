<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';

include_once $g['path_module'].'bbs/var/var.php';
include_once $g['dir_module'].'var/var.'.$bid.'.php';

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['bbs']['m_skin']?$d['bbs']['m_skin']:$d['bbs']['skin_mobile'];
} else {
  $theme = $d['bbs']['skin']?$d['bbs']['skin']:$d['bbs']['skin_main'];
}
include_once $g['dir_module'].'themes/'.$theme.'/_var.php';

$result=array();
$result['error']=false;

$B = getUidData($table['bbslist'],$R['bbs']);

$mbruid = $my['uid'];


//게시물 쓰기 권한체크
if (!$my['admin'] && !strstr(','.($d['bbs']['admin']?$d['bbs']['admin']:'.').',',','.$my['id'].',')) {
	if ($d['bbs']['perm_l_view'] > $my['level'] || strpos('_'.$d['bbs']['perm_g_view'],'['.$my['mygroup'].']')) {
    $markup_file = 'permcheck'; //잠김페이지 전달 (테마 내부 _html/permcheck.html)
    $result['hidden'] = 1;
	}
}


$d['bbs']['isperm'] = true;

if ($d['bbs']['isperm'] && ($d['bbs']['hitcount'] || !strpos('_'.$_SESSION['module_'.$m.'_view'],'['.$uid.']')))
{
	if ($R['point2'])
	{
		// $g['main'] = $g['dir_module'].'mod/_pointcheck.php';
    $markup_file = 'pointcheck';
		$d['bbs']['isperm'] = false;
	}
	else {
		getDbUpdate($table[$m.'data'],'hit=hit+1','uid='.$uid);
		$_SESSION['module_'.$m.'_view'] .= '['.$uid.']';
	}
}

// 최종 결과값 추출 (sys.class.php)
$skin=new skin($markup_file);
$result['article']=$skin->make();

echo json_encode($result);
exit;
?>
