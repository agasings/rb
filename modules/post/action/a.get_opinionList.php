<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';
include_once $g['dir_module'].'var/var.php';

$result=array();
$result['error']=false;

$R = getUidData($table[$m.'data'],$uid);

include_once $g['path_module'].'post/var/var.php';

$result['uid'] = $R['uid'];

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['post']['m_skin']?$d['post']['m_skin']:$d['post']['skin_mobile'];
  $device = 'mobile';
} else {
  $theme = $d['post']['skin']?$d['post']['skin']:$d['post']['skin_main'];
  $device = 'desktop';
}

$sort = 'uid';
$orderby = 'desc';
$recnum = 20;
$where = 'module="'.$m.'" and opinion="'.$opinion.'" and entry='.$uid; // 출력 조건
$RCD = getDbArray($table['s_opinion'],$where,'*',$sort,$orderby,$recnum,1);
$NUM = getDbRows($table['s_opinion'],$where);

$html='';
foreach ($RCD as $R) {
  $M	= getUidData($table['s_mbrid'],$R['mbruid']);
  $M1 = getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'nic');
  $TMPL['nic']=$M1['nic'];
  $TMPL['id']=$M['id'];
  $TMPL['mbruid']=$R['mbruid'];
  $TMPL['avatar']=getAvatarSrc($R['mbruid'],'84');
  $TMPL['profile_link']=getProfileLink($R['mbruid']);
  $TMPL['d_regis']=getDateFormat($R['d_regis'],'Y-m-d H:i');
  $skin_item=new skin('opinion-item');
  $html.=$skin_item->make();
}

$result['num']=$NUM;
$result['list']=$html;
echo json_encode($result);
exit;
?>
