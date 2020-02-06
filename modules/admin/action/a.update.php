<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$output = shell_exec('git pull origin master');

$text = preg_replace('/\r\n|\r|\n/','',$output);

if ($text =='Already up-to-date.') {
	$text = '이미 최신패치가 적용되어있습니다.';
}
getLink('','parent.',$text,'');


$_ufile = $g['path_var'].'update/'.$ufile.'.txt';

if ($type == 'delete')
{
	unlink($_ufile);
	getLink('reload','parent.','업데이트 기록이 제거되었습니다.','');
}
else if ($type == 'manual')
{
	$fp = fopen($_ufile,'w');
	fwrite($fp,$date['today'].',1');
	fclose($fp);
	@chmod($_ufile,0707);
	getLink('reload','parent.','수동 업데이트 처리되었습니다.','');
}
else {
	require $g['path_core'].'function/dir.func.php';
	include $g['path_core'].'function/rss.func.php';
	include $g['path_module'].'market/var/var.php';
	$_serverinfo = explode('/',$d['update']['url']);
	$_updatedate = getUrlData('https://kimsq.github.io/rb/update.v2.txt',10);
	$_updatelist = explode("\n",$_updatedate);
	$_updateleng = count($_updatelist)-1;



	$fp = fopen($_ufile,'w');
	fwrite($fp,$date['today'].',0');
	fclose($fp);
	@chmod($_ufile,0707);

	if ($_updateversion != $d['admin']['version'])
	{
		$d['admin']['version'] = $_updateversion;
		$_tmpdfile = $g['dir_module'].'var/var.version.php';
		$fp = fopen($_tmpdfile,'w');
		fwrite($fp, "<?php\n");
		foreach ($d['admin'] as $key => $val)
		{
			fwrite($fp, "\$d['admin']['".$key."'] = \"".$val."\";\n");
		}
		fwrite($fp, "?>");
		fclose($fp);
		@chmod($_tmpdfile,0707);
	}

	getLink('reload','parent.','업데이트가 완료되었습니다.','');
}
?>
