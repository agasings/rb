<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$_WHERE = 'display<2 and site='.$s;
$where = $where?$where:'subject|tag|review';

if ($sort == 'gid' && (!$cat || $keyword)) {

	if ($where && $keyword) {
		if (strpos('[nic][id][ip]',$where)) $_WHERE .= " and ".$where."='".$keyword."'";
		else if ($where == 'term') $_WHERE .= " and d_regis like '".$keyword."%'";
		else $_WHERE .= getSearchSql($where,$keyword,$ikeyword,'or');
	}

	$TCD = getDbArray($table[$m.'data'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows($table[$m.'data'],$_WHERE);
	while($_R = db_fetch_array($TCD)) $RCD[] = $_R;

} else {

	$_WHERE .= ' and ('.getPostCategoryCodeToSql($table[$m.'category'],$cat).')';
	$TCD = getDbArray($table[$m.'index'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows($table[$m.'index'],$_WHERE);
	while($_R = db_fetch_array($TCD)) $RCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

}

$TPG = getTotalPage($NUM,$recnum);

?>
