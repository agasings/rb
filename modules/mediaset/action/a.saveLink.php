<?php
if(!defined('__KIMS__')) exit;

include $g['path_module'].'mediaset/themes/'.$theme.'/main.func.php';

$result=array();
$result['error']=false;

$d_regis=$date['totime'];
$mbruid=$my['uid'];

$fserver = 3;
$caption= $title;
$description= $description;
$thumbnail_url_arr=parse_url($thumbnail_url);
$thumbnail_host = $thumbnail_url_arr['scheme'].'://'.$thumbnail_url_arr['host'];
$thumbnail_query= $thumbnail_url_arr['query'];
$path_arr = explode('/',$thumbnail_url_arr['path']);
$_tmpname = array_pop($path_arr);

$folder =  str_replace($_tmpname,'',$thumbnail_url_arr['path']);
$folder = substr($folder ,0,-1);
$folder = substr($folder,1);

$tmpname = $_tmpname.($thumbnail_query?'?'.$thumbnail_query:'');
if ($provider=='YouTube') {
  $url_arr = explode('=',$url);
  $name = $url_arr[1];
} else {
  $name = $tmpname;
}
$linkurl= $url;
$fileExt  = getExt($_tmpname);
$fileExt  = $fileExt == 'jpeg' ? 'jpg' : $fileExt;
$src = $thumbnail_url;
if($uid){

      $QVAL1 = "caption='$title',description='$description',time='$time',embed='$embed' ";
      getDbUpdate($table['s_upload'],$QVAL1,'uid='.$uid);

      $NOWUID=$uid;
}else{

  $mingid = getDbCnt($table['s_upload'],'min(gid)','');
  $gid = $mingid ? $mingid - 1 : 100000000;

  $QKEY = "gid,pid,parent,hidden,tmpcode,site,mbruid,fileonly,type,ext,fserver,host,folder,name,tmpname,size,width,height,caption,description,src,provider,author,down,d_regis,d_update,linkurl,time,duration,embed";
  $QVAL = "'$gid','$gid','$parent','$hidden','$tmpcode','$s','$mbruid','0','$type','$fileExt','$fserver','$thumbnail_host','$folder','$name','$tmpname','$size','$width','$height','$caption','$description','$src','$provider','$author','$down','$d_regis','$d_update','$linkurl','$time','$duration','$embed'";
     getDbInsert($table['s_upload'],$QKEY,$QVAL);
     $NOWUID= getDbCnt($table['s_upload'],'max(uid)','');
}

$R=getUidData($table['s_upload'],$NOWUID);
$result['list']=getAttachPlatform($R,'','',$wysiwyg);
$result['table']=$table['s_upload'];
$reuslt['last_uid']=$NOWUID;
echo json_encode($result,true);
exit;
?>
