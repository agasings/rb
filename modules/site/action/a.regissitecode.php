<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_HS = getDbData($table['s_site'],"id='".$r."'",'*');

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
	$layout = dirname($_HS['m_layout']);
} else {
  $layout = dirname($_HS['layout']);
}

include_once $g['path_layout'].$layout.'/_var/_var.php';

$fdset = array($d['layout']['site_code']);
$gfile = $g['path_var'].'sitephp/'.$s.'.php';
$fp = fopen($gfile,'w');
fwrite($fp, "<?php\n");
foreach ($fdset as $val)
{
	fwrite($fp, "\$d['site']['".$val."'] = \"".trim(${$val})."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($gfile,0707);

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
	$result=array();
	$result['error'] = false;
	echo json_encode($result);
	exit;

} else {
	setrawcookie('site_common_result', rawurlencode('<i class="fa fa-check" aria-hidden="true"></i> 설정이 변경 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}

?>
