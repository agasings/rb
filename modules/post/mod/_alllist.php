<?php
$_WHERE = 'site='.$s;
$where = $where?$where:'subject|tag';

if ($my['uid']) $_WHERE .= ' and display = 2 or display = 4';  // 회원공개와 전체공개 리스트 출력
else $_WHERE .= ' and display = 4'; // 전체공개 리스트만 출력

$RCD = getDbArray($table[$m.'list'],$_WHERE,'*','d_regis','desc',20,$p);
$NUM = getDbRows($table[$m.'list'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>
