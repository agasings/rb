<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
include_once $g['path_core'].'function/thumb.func.php';

$blogtype	= $blogtype;
$mbruid		= $my['uid'];
$managers	= trim($managers);
$members	= trim($members);
$id			= trim($id);
$name		= trim($name);
$d_regis	= $date['totime'];
$d_last		= '';
$num_w		= 0;
$num_c		= 0;
$num_o		= 0;
$num_m		= 0;

if ($mbrid)
{
	$M = getDbData($table['s_mbrid'],"id='".$mbrid."'",'*');
	$mbruid = $M['uid'];
}

if (!$name) getLink('','','포스트셋 제목을 입력해 주세요.','');
if (!$id) getLink('','','아이디를 입력해 주세요.','');

if ($blog)
{
	$R = getUidData($table[$m.'list'],$blog);

	$QVAL = "blogtype='$blogtype',mbruid='$mbruid',managers='$managers',members='$members',name='$name',use_auth='$use_auth'";
	getDbUpdate($table[$m.'list'],$QVAL,'uid='.$R['uid']);
}
else {

	if(getDbRows($table[$m.'list'],"id='".$id."'")) getLink('','','이미 같은 아이디의 포스트셋이 존재합니다.','');

	$Ugid = getDbCnt($table[$m.'list'],'max(gid)','') + 1;
	$QKEY = "gid,blogtype,mbruid,managers,members,id,name,d_regis,d_last,num_w,num_c,num_o,num_m,use_auth";
	$QVAL = "'$Ugid','$blogtype','$mbruid','$managers','$members','$id','$name','$d_regis','$d_last','0','0','0','0','$use_auth'";
	getDbInsert($table[$m.'list'],$QKEY,$QVAL);

	$LASTUID = getDbCnt($table[$m.'list'],'max(uid)','');
}


$fdset = array('layout','m_layout','theme_pc','theme_mobile','iframe','snsconnect','vtype','recnum','vopen','editor','rlength','sosokmenu');

$gfile= $g['dir_module'].'var/var.'.$id.'.php';
$fp = fopen($gfile,'w');
fwrite($fp, "<?php\n");
foreach ($fdset as $val)
{
	fwrite($fp, "\$d['blog']['".$val."'] = \"".trim(${$val})."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($gfile,0707);

getLink($_SERVER['HTTP_REFERER'],'','','');
?>
