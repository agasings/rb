<?php
if(!defined('__KIMS__')) exit;

$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/'.$m.'.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['dir_module'].'var/var.php';
include_once $svfile;

$d['post']['skin'] = $d['post']['skin_total'];
$d['post']['isperm'] = true;

$g['displaySet']['label'] = array('비공개','지정공개','회원공개','미등록','전체공개');
$g['displaySet']['icon'] = array('lock','user-secret','users','link','globe');

include_once $g['dir_module'].'_main.php';

$mod = $mod ? $mod : 'category';

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby && strpos('[asc][desc]',$orderby) ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['post']['recnum'];

$_perm = array();

if ($cat) $mod='category';

if ($cid) {
  $mod = $mod ? $mod : 'view';
	include_once $g['dir_module'].'mod/_view.php';
}

switch ($mod) {
  case 'category' :
    include_once $g['dir_module'].'mod/_list.php';
    $CAT  = getDbData($table[$m.'category'],"id='".$cat."'",'*');
  break;

  case 'keyword' :
    include_once $g['dir_module'].'mod/_list.php';
  break;

  case 'list' :
    include_once $g['dir_module'].'mod/_alllist.php';
  break;

  case 'list_view' :
    include_once $g['dir_module'].'mod/_list.php';
  break;

  case 'view' :
    include_once $g['dir_module'].'mod/_view.php';
  break;

  case 'write' :
  if (!$my['uid']) getLink('/','','','');

  // 수정권한 체크
  if (!$my['admin'] && !strstr(','.($d['post']['admin']?$d['post']['admin']:'.').',',','.$my['id'].','))
	{
		if ($d['post']['perm_l_write'] > $my['level'] || strpos('_'.$d['post']['perm_g_write'],'['.$my['mygroup'].']'))
		{
			$g['main'] = $g['dir_module'].'mod/_permcheck.php';
			$d['bbs']['isperm'] = false;
		}
		if ($R['uid'] && $reply != 'Y')
		{
			if ($my['uid'] != $R['mbruid'])
			{
				 if (!strpos('_'.$_SESSION['module_'.$m.'_pwcheck'],'['.$R['uid'].']')) $g['main'] = $g['dir_module'].'mod/_pwcheck.php';
			}
		}
	}


  if (!$g['mobile']||$_SESSION['pcmode']=='Y') {
    $layoutArr = explode('/',$d['post']['layout']);
    $d['post']['layout'] = $layoutArr[0].'/blank.php';
  }

  break;
}

// include_once $g['path_module'].$m.'/themes/'.$d['post']['skin'].'/_var.php';

if ($c) $g['post_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
else $g['post_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
$g['post_list']	= $g['post_reset'].getLinkFilter('',array($p>1?'p':'',$sort!='gid'?'sort':'',$orderby!='asc'?'orderby':'',$recnum!=$d['post']['recnum']?'recnum':'',$type?'type':'',$where?'where':'',$keyword?'keyword':''));
$g['pagelink']	= $g['post_list'];
$g['post_orign'] = $g['post_reset'];
$g['post_view']	= $g['post_list'].'&amp;mod=view&amp;cid=';
$g['post_write'] = $g['post_list'].'&amp;mod=write';
$g['post_modify']= $g['post_write'].'&amp;cid=';
$g['post_action']= $g['post_list'].'&amp;a=';
$g['post_delete']= $g['post_action'].'delete&amp;cid=';
$g['post_print'] = $g['post_reset'].'&amp;iframe=Y&amp;print=Y&amp;cid=';

if ($_HS['rewrite'] && $sort == 'gid' && $orderby == 'asc' && $recnum == $d['post']['recnum'] && $p==1 && !$skin && !$type && !$iframe) {
	$g['post_reset']= $g['r'].'/post';
	$g['post_list'] = $g['post_reset'];
	$g['post_view'] = $g['post_list'].'/';
	$g['post_write']= $g['post_list'].'/write';
}

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
	$_HM['m_layout'] = $_HM['m_layout'] ? $_HM['m_layout'] : $d['post']['m_layout'];
  $g['dir_module_skin'] = $g['dir_module'].'/themes/'.$d['post']['skin_mobile'].'/';
  $g['url_module_skin'] = $g['url_module'].'/themes/'.$d['post']['skin_mobile'];
  $g['img_module_skin'] = $g['url_module_skin'].'/images';
} else {
  $_HM['layout'] = $_HM['layout'] ? $_HM['layout'] : $d['post']['layout'];
  $g['dir_module_skin'] = $g['dir_module'].'themes/'.$d['post']['skin_main'].'/';
  $g['url_module_skin'] = $g['url_module'].'/themes/'.$d['post']['skin_main'];
  $g['img_module_skin'] = $g['url_module_skin'].'/images';
}

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['url_reset'] = $g['s'].'/?r='.$r.'&m='.$m;
$g['push_location'] = '<li class="active">'.$_HMD['name'].'';

if($R['linkedmenu'])
{
	$c=substr($R['linkedmenu'],-1)=='/'?str_replace('/','',$R['linkedmenu']):$R['linkedmenu'];
	$_CA = explode('/',$c);
	$_FHM = getDbData($table['s_menu'],"id='".$_CA[0]."' and site=".$s,'*');

	$_tmp['count'] = count($_CA);
	$_tmp['split_id'] = '';
	for ($_i = 0; $_i < $_tmp['count']; $_i++)
	{
		$_tmp['location'] = getDbData($table['s_menu'],"id='".$_CA[$_i]."'",'*');
		$_tmp['split_id'].= ($_i?'/':'').$_tmp['location']['id'];
		$g['location']   .= ' &gt; <a href="'.RW('c='.$_tmp['split_id']).'">'.$_tmp['location']['name'].'</a>';
		$_HM['uid'] = $_tmp['location']['uid'];
		$_HM['name'] = $_tmp['location']['name'];
		$_HM['addinfo'] = $_tmp['location']['addinfo'];
	}
}
$g['main'] = $g['dir_module_mode'].'.php';
?>