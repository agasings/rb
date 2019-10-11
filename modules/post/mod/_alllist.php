<?php
$_WHERE = 'display<2 and site='.$s;
$where = $where?$where:'subject|tag';
$RCD = getDbArray($table[$m.'list'],$_WHERE,'*','d_regis','desc',20,$p);
$NUM = getDbRows($table[$m.'list'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>
