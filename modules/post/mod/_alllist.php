<?php
$_WHERE = 'site='.$s;
$where = 'name|tag';

if ($my['uid']) $_WHERE .= ' and display > 3';  // 회원공개와 전체공개 리스트 출력
else $_WHERE .= ' and display = 5'; // 전체공개 리스트만 출력

if ($keyword) $_WHERE .= getSearchSql($where,$keyword,$ikeyword,'or');
$recnum = 16;  // 4의 배수로 지정 (예: 8,12,16,20..)
$sort = $sort?$sort:'d_regis';
$RCD = getDbArray($table[$m.'list'],$_WHERE,'*',$sort,'desc',$recnum,$p);
$NUM = getDbRows($table[$m.'list'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>
