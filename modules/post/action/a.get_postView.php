<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';

$g['postVarForSite'] = $g['path_var'].'site/'.$r.'/'.$m.'.var.php';
$svfile = file_exists($g['postVarForSite']) ? $g['postVarForSite'] : $g['dir_module'].'var/var.php';
include_once $svfile;

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['post']['skin_mobile'];
} else {
  $theme = $d['post']['skin_main'];
}

include_once $g['dir_module'].'themes/'.$theme.'/_var.php';

$formats = explode(',', $d['theme']['format']);array_unshift($formats,'');

$result=array();
$result['error'] = false;

$uid = $_POST['uid']; // 포스트 고유번호
$R = getUidData($table[$m.'data'],$uid);
$mod = 'view';
$d['post']['isperm'] = true;

include_once $g['dir_module'].'mod/_view.php';

if ($list) {
  $LIST=getDbData($table[$m.'list'],"id='".$list."'",'*');
  $_WHERE = 'site='.$s;
  $_WHERE .= ' and list="'.$LIST['uid'].'"';
  $TCD = getDbArray($table[$m.'list_index'],$_WHERE,'*','gid','asc',11,1);
  $NUM = getDbRows($table[$m.'list_index'],$_WHERE);
  while($_R = db_fetch_array($TCD)) $LCD[] = getDbData($table[$m.'data'],'uid='.$_R['data'],'*');

  $TMPL['list_name'] = $LIST['name'];
  $TMPL['list_num'] = $LIST['num'];
  $TMPL['list_id'] = $LIST['id'];
  $TMPL['list_mbrnic'] = getProfileInfo($LIST['mbruid'],'nic');

  $listPost = '';

  foreach ($LCD as $_L) {
    $TMPL['L_active']=$_L['uid']==$uid?'table-view-active':'';
    $TMPL['L_uid']=$_L['uid'];
    $TMPL['L_cid']=$_L['cid'];
    $TMPL['L_subject']=stripslashes($_L['subject']);
    $TMPL['L_featured_240'] = getPreviewResize(getUpImageSrc($_L),'240x134');
    $TMPL['L_featured_640'] = getPreviewResize(getUpImageSrc($_L),'640x360');
    $TMPL['L_time'] = getUpImageTime($_L);
    $TMPL['L_provider']=getFeaturedimgMeta($_L,'provider');
    $TMPL['L_videoId']=getFeaturedimgMeta($_L,'provider')=='YouTube'?getFeaturedimgMeta($_L,'name'):'';
    $TMPL['L_format']=$formats[$_L['format']];
    $skin_listPost=new skin('view_listPost');
    $listPost.=$skin_listPost->make();
  }
  $TMPL['listPost'] = $listPost;
  $skin_listCollapse=new skin('view_list-collapse');
  $result['listCollapse']=$skin_listCollapse->make();
}

$TMPL['list_name'] = $LIST['name'];
$TMPL['list_num'] = $LIST['num'];

$TMPL['uid'] = $R['uid'];
$TMPL['avatar'] = getAvatarSrc($R['mbruid'],'48');
$TMPL['nic'] = getProfileInfo($R['mbruid'],'nic');
$TMPL['subject'] = stripslashes($R['subject']);
$TMPL['content'] = getContents($R['content'],'HTML');
$TMPL['hit'] = $R['hit'];
$TMPL['likes'] = $R['likes'];
$TMPL['dislikes'] = $R['dislikes'];
$TMPL['comment'] = $R['comment'];
$TMPL['tag'] = $R['tag']?getPostTag($R['tag']):'';
$TMPL['d_regis'] = getDateFormat($R['d_regis'],'Y.m.d H:i');
$TMPL['d_modify'] = getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c');

//최근 포스트
$postque = 'mbruid='.$R['mbruid'].' and site='.$s.' and data <>'.$R['uid'];
if ($my['uid']) $postque .= ' and display > 3';  // 회원공개와 전체공개 포스트 출력
else $postque .= ' and display = 5'; // 전체공개 포스트만 출력
$_RCD=getDbArray($table['postmember'],$postque,'*','gid','asc',6,1);
while($_R = db_fetch_array($_RCD)) $RCD[] = getDbData($table['postdata'],'gid='.$_R['gid'],'*');
$_NUM = getDbRows($table['postmember'],$postque);
$newPost = '';

if ($_NUM) {
  foreach ($RCD as $POST) {
    $TMPL['newpost_uid']=$POST['uid'];
    $TMPL['newpost_cid']=$POST['cid'];
    $TMPL['newpost_format']=$formats[$POST['format']];
    $TMPL['newpost_subject']=stripslashes($POST['subject']);
    $TMPL['newpost_featured_640'] = getPreviewResize(getUpImageSrc($POST),'640x360');
    $TMPL['newpost_featured_320'] = getPreviewResize(getUpImageSrc($POST),'320x180');
    $TMPL['newpost_provider']=getFeaturedimgMeta($POST,'provider');
    $TMPL['newpost_videoId']=getFeaturedimgMeta($POST,'provider')=='YouTube'?getFeaturedimgMeta($POST,'name'):'';
    $TMPL['newpost_hit']=$POST['hit'];
    $TMPL['newpost_d_modify'] = getDateFormat($POST['d_modify']?$POST['d_modify']:$POST['d_regis'],'c');
    $TMPL['newpost_nic'] = getProfileInfo($POST['mbruid'],'nic');
    $TMPL['newpost_time'] = getUpImageTime($POST);
    $skin_newPost=new skin('view_newPost');
    $newPost.=$skin_newPost->make();
  }
}

$TMPL['newPost'] = $newPost;

$markup_file = $markup_file?$markup_file:'view_doc_content';
$skin=new skin($markup_file);

$result['linkurl']=getFeaturedimgMeta($R,'linkurl');
$result['article']=$skin->make();
echo json_encode($result);
exit;
?>
