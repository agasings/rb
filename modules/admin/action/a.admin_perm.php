<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
if ($my['uid'] != 1 || $memberuid == 1) getLink('','','권한이 없습니다.','');

$perm = '';
foreach($module_members as $mds)
{
	$perm .= '['.$mds.']';
}

getDbUpdate($table['s_mbrdata'],"adm_view='".$perm."'",'memberuid='.$memberuid);

getLink('reload','parent.','반영 되었습니다.','');
?>
