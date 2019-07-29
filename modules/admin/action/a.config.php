<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
$fdset = array();
$fdset['config'] = array('version','themepc','pannellink','cache_flag','smtp_use','smtp_host','smtp_port','smtp_auth','smtp_ssl','smtp_user','smtp_pass',
						 'ftp_use','ftp_type','ftp_host','ftp_port','ftp_pasv','ftp_user','ftp_pass','ftp_rb','email','smtp','ftp','uninstall','dblclick','codeeidt',
						 'editor','syslang','sysmail','sysmodule','sms_tel','sms_id','sms_key','fcm_key','fcm_SenderId','fcm_VAPID');
$fdset['ssl'] = array('http_port','ssl_type','ssl_port','ssl_module','ssl_menu','ssl_page');
$fdset['security'] = array('secu_tags','secu_domain','secu_param');


//제거탭 출력 주의 알림
if (!$d['admin']['uninstall'] && $uninstall)
{
	$_message = '시스템 도구에서 <strong>제거</strong>(<code>Uninstall</code>) 탭이 출력되도록 설정되었습니다. 이 설정은 매우 위험할 수 있으니 확인하세요.';
	$_referer = $g['s'].'/?r='.$r.'&m=admin&module=admin';
	putNotice($my['uid'],$m,0,$_message,$_referer,'');
}

if ($act == 'config')
{
	if ($d['admin']['syslang'] != $syslang)
	{
		$RCD = getDbArray($table['s_module'],'','*','gid','asc',0,1);
		while($_R = db_fetch_array($RCD))
		{
			$new_modulename = $g['path_module'].$_R['id'].'/language/'.$syslang.'/name.module.txt';
			getDbUpdate($table['s_module'],"name='".($syslang&&is_file($new_modulename)?implode('',file($new_modulename)):getFolderName($g['path_module'].$_R['id']))."'","id='".$_R['id']."'");
		}
		$panel_reload = true;
	}
}
foreach ($fdset[$act] as $val)
{
	$d['admin'][$val] = str_replace("\n",'',trim(${$val}));
}

$_tmpdfile = $g['dir_module'].'var/var.system.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
foreach ($d['admin'] as $key => $val)
{
	fwrite($fp, "\$d['admin']['".$key."'] = \"".addslashes(stripslashes($val))."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);

//FCM 연결정보
$_tmpjfile = $g['path_var'].'fcm.info.js';
if ($fcm_SenderId) {
	$fp = fopen($_tmpjfile,'w');
	fwrite($fp, "var firebase_app_js_src = '".$fcm_app_js_src."'\n");
	fwrite($fp, "var firebase_messaging_js_src = '".$fcm_messaging_js_src."'\n");
	fwrite($fp, "var fcmSenderId = '".$fcm_SenderId."'\n");
	fwrite($fp, "var fcmVAPID = '".$fcm_VAPID."'\n");
	fwrite($fp, "var icon = '".$fcm_icon."'\n");
	fclose($fp);
	@chmod($_tmpjfile,0707);
} else {
	unlink($_tmpjfile);
}

if($autosave):
?>
<script>
parent.document.procForm.target = '';
parent.document.procForm.a.value = 'config';
parent.document.procForm.autosave.value = '';
</script>
<?php
exit;
endif;
if ($panel_reload) getLink($g['s'].'/?r='.$r.'&pickmodule='.$m.'&panel=Y','parent.parent.','','');
else {
	setrawcookie('admin_config_result', rawurlencode('시스템 설정이 변경 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}
?>
