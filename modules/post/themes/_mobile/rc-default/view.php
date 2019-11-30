<?php

$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');
include $g['dir_module_skin'].'view_'.$formats[$R['format']].'.php';

include $g['dir_module_skin'].'component.php';

?>
