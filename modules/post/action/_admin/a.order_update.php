<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$i=0;
foreach($blogmembers as $val) getDbUpdate($table[$m.'list'],'gid='.($i++),'uid='.$val);

getLink('','','','');
?>
