<?php
$_WHERE = 'site='.$s;
$where = $where?$where:'subject|tag|review';

if ($sort == 'gid' && !$keyword  && !$listid) {

	if (!$my['uid']) $_WHERE .= ' and display<>4';

	if ($cat)  $_WHERE .= ' and ('.getPostCategoryCodeToSql($table[$m.'category'],$cat).')';
	$TCD = getDbArray($table[$m.'index'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows($table[$m.'index'],$_WHERE);
	while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

} else if ($listid) {

	$LIST=getDbData($table[$m.'list'],"id='".$listid."'",'*');
	$_IS_LISTOWN=getDbRows($table[$m.'list'],'mbruid='.$my['uid'].' and uid='.$LIST['uid']);
	$_perm['list_owner'] = $my['admin'] || $_IS_LISTOWN  ? true : false;

	if (!$LIST['uid'] || ($LIST['display']==1&&!$_perm['list_owner']) || ($LIST['display']==4 && !$my['uid'])) $mod = '_404';

	if ($mbrid) {
		$M = getDbData($table['s_mbrid'],"id='".$mbrid."'",'*');
		$MBR = getDbData($table['s_mbrdata'],'memberuid='.$M['uid'],'*');
	}
	$_WHERE .= ' and list="'.$LIST['uid'].'"';
	$recnum = 16;  // 4의 배수로 지정 (예: 8,12,16,20..)
	$TCD = getDbArray($table[$m.'list_index'],$_WHERE,'*','gid','asc',$recnum,$p);
	$NUM = getDbRows($table[$m.'list_index'],$_WHERE);
	while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

} else {

	if (!$my['uid']) $_WHERE .= ' and display<>4';

	if ($where && $keyword) {
		if (strpos('[nic][id][ip]',$where)) $_WHERE .= " and ".$where."='".$keyword."'";
		else if ($where == 'term') $_WHERE .= " and d_regis like '".$keyword."%'";
		else $_WHERE .= getSearchSql($where,$keyword,$ikeyword,'or');
	}

	if ($cat) $_WHERE .= ' and ('.getPostCategoryCodeToSql2($table[$m.'category'],$cat).')';
	$orderby = $sort == 'gid'?'asc':'desc';
	$TCD = getDbArray($table[$m.'data'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows($table[$m.'data'],$_WHERE);
	while($_R = db_fetch_array($TCD)) $RCD[] = $_R;
}

$TPG = getTotalPage($NUM,$recnum);

?>
