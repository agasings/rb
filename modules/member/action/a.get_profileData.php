<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';

$g['memberVarForSite'] = $g['path_var'].'site/'.$_HS['id'].'/member.var.php'; // 사이트 회원모듈 변수파일
$_varfile = file_exists($g['memberVarForSite']) ? $g['memberVarForSite'] : $g['dir_module'].'var/var.php';
include_once $_varfile; // 변수파일 인클루드

$result=array();
$result['error']=false;

$mbruid = $_POST['mbruid'];
$type = $_POST['type'];

if ($g['mobile']&&$_SESSION['pcmode']!='Y') {
  $theme = $d['member']['theme_mobile'];
} else {
  $theme = $d['member']['theme_main'];
}

$_MH = getUidData($table['s_mbrid'],$mbruid);
$_MD = getDbData($table['s_mbrdata'],"memberuid='".$mbruid."'",'*');

$TMPL['id'] = $_MH['id'];
$TMPL['nic'] = $_MD['nic'];
$TMPL['name'] = $_MD['name'];
$TMPL['cover'] = getCoverSrc($mbruid,'800','600');
$TMPL['avatar'] = getAvatarSrc($mbruid,'136');
$TMPL['grade'] = $g['grade']['m'.$_MD['level']];
$TMPL['point'] = number_format($_MD['point']);
$TMPL['level'] = $_MD['level'];
$TMPL['bio'] = $_MD['bio'];
$TMPL['d_regis'] = getDateFormat($_MD['d_regis'],'Y.m.d');
$TMPL['num_follower'] = number_format($_MD['num_follower']);

if ($type=='popover') {
  $markup_file = 'profile-popover'; // 기본 마크업 페이지 전달 (테마 내부 _html/profile-popover.html)
}


//최근 포스트
$postque = 'mbruid='.$mbruid.' and site='.$s;
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
    $TMPL['newpost_format']='video';
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



$TMPL['newList'] = '새리스트';

if (!$type || $type=='modal' || $type=='page') {
  $markup_file = 'profile'; // 기본 마크업 페이지 전달 (테마 내부 _html/profile.html)
}

// 최종 결과값 추출 (sys.class.php)
$skin=new skin($markup_file);
$result['profile']=$skin->make();
$result['nic'] = $_MD['nic'];

echo json_encode($result);
exit;
?>
