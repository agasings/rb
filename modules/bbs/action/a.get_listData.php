<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error']=false;

$bid = $_POST['bid'];
$mod = $_POST['mod'];

$B = getDbData($table['bbslist'],'id="'.$bid.'"','*');

//게시판 공통설정 변수
$g['bbsVarForSite'] = $g['path_var'].'site/'.$r.'/bbs.var.php';
include_once file_exists($g['bbsVarForSite']) ? $g['bbsVarForSite'] : $g['path_module'].'bbs/var/var.php';

include_once $g['dir_module'].'var/var.'.$bid.'.php';

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['bbs']['m_skin']?$d['bbs']['m_skin']:$d['bbs']['skin_mobile'];
} else {
  $theme = $d['bbs']['skin']?$d['bbs']['skin']:$d['bbs']['skin_main'];
}

include_once $g['dir_module'].'themes/'.$theme.'/_var.php';
include_once $g['path_core'].'function/sys.class.php';

$bbsque = 'site='.$s.' and notice=0';
$bbsque .= ' and bbs='.$B['uid'];

$recnum = $d['bbs']['recnum'];
$NUM = getDbRows($table[$m.'data'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);

$TMPL['show_bbs_category'] = $B['category']?'':'d-none';
$TMPL['show_bbs_search'] = $d['theme']['search']==1?'':'d-none';
$TMPL['show_bbs_write'] = $my['uid']?'':'d-none';
$TMPL['bbs_name'] = $B['name'];
$TMPL['bbs_id'] = $bid;
$TMPL['bbs_write'] = '/b/'.$bid.'/write';

$skin=new skin('bar-tab'); //게시판 테마폴더 > _html > bar-tab.html
$result['bar_tab']=$skin->make();
$result['theme'] = $theme;
$result['sort'] = 'gid';
$result['orderby'] = 'asc';
$result['recnum'] = $recnum;
$result['NUM'] = $NUM;
$result['TPG'] = $TPG;

echo json_encode($result);
exit;
?>
