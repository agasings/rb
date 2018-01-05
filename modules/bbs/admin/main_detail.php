<?php
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 20;
$bbsque ='uid>0';
// 키원드 검색 추가
if ($keyw)
{
	$bbsque .= " and (id like '%".$keyw."%' or name like '%".$keyw."%')";
}
$RCD = getDbArray($table[$module.'list'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'list'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
if ($uid)
{
	$R = getUidData($table[$module.'list'],$uid);
	if ($R['uid'])
	{
		include_once $g['path_module'].$module.'/var/var.'.$R['id'].'.php';
	}
}
?>

<div class="container-fluid">
	<div class="row">
	   <div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar">

				<select name="account" class="form-control custom-select border-0" onchange="this.form.submit();">
					<option value="">ㆍ전체사이트</option>
					<?php while($S = db_fetch_array($SITES)):?>
					<option value="<?php echo $S['uid']?>"<?php if($account==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
					<?php endwhile?>
					<?php if(!db_num_rows($SITES)):?>
					<option value="">등록된 사이트가 없습니다.</option>
					<?php endif?>
				</select>
			 <div id="accordion" role="tablist">
			   <div class="card">
			     <div class="card-header p-0" role="tab" id="headingOne">
						 <a class="muted-link d-block" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
							게시판 목록
						 </a>
			     </div>

			     <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">

						 <div class="list-group list-group-flush" style="height: calc(100vh - 16.6rem);">
							 <?php if($NUM):?>
							 <?php $_i=1;while($BR = db_fetch_array($RCD)):?>
							 <a href="<?php echo $g['adm_href']?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;uid=<?php echo $BR['uid']?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center<?php if($uid==$BR['uid']):?> border border-primary<?php endif?>">
								 <?php echo $BR['name']?>(<?php echo $BR['id']?>)
								 <span class="badge badge-dark badge-pill ml-auto"><?php echo number_format($BR['num_r'])?></span>
							 </a>
							 <?php $_i++;endwhile?>
							 <?php else:?>
							 <div class="text-center text-muted d-flex align-items-center justify-content-center" style="height: calc(100vh - 15.6rem);">
								 <div><i class="fa fa-exclamation-circle fa-3x mb-2" aria-hidden="true"></i> <br>등록된 게시판이 없습니다. </div>
							 </div>
							 <?php endif?>
					   </div>

						 <div class="card-footer p-1">
						 	 <a href="" class="btn btn-link btn-sm btn-block muted-link"><i class="fa fa-cog"></i> 게시판 정열 및 검색</a>
						 </div>
						 <div class="card-footer">
						 	 <a href="<?php echo $g['adm_href']?>&amp;front=main_detail"  class="btn btn-outline-primary btn-block"><i class="fa fa-plus"></i> 새 게시판 만들기</a>
						 </div>

			     </div>
			   </div>
			   <div class="card">
			     <div class="card-header p-0" role="tab" id="headingTwo">
						 <a class="d-block collapsed muted-link" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
							 순서변경
						 </a>
			     </div>
			     <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">

						 <?php if($NUM):?>
	 					<form name="bbsform" role="form" action="<?php echo $g['s']?>/" method="post" target="_orderframe_">
	 					<input type="hidden" name="r" value="<?php echo $r?>" />
	 					<input type="hidden" name="m" value="<?php echo $module?>" />
	 					<input type="hidden" name="a" value="bbsorder_update" />
	 					<div class="dd" id="nestable-menu">
	 						<ul class="dd-list list-unstyled">
	 						<?php $_i=1;while($BR = db_fetch_array($RCD)):?>
	 						<li class="dd-item" data-id="<?php echo $_i?>">
	 							<input type="checkbox" name="bbsmembers[]" value="<?php echo $BR['uid']?>" checked class="hidden"/>
	 							<span class="dd-handle <?php if($BR['uid']==$R['uid']):?>alert alert-info<?php endif?>" ><i class="fa fa-arrows fa-fw"></i>
	 							   <?php echo $BR['name']?>(<?php echo $BR['id']?>)
	 							</span>
	 							<span title="<?php echo number_format($BR['num_r'])?>개" data-tootip="tooltip">
	 								<a href="<?php echo $g['adm_href']?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;uid=<?php echo $BR['uid']?>" data-tooltip="tooltip" title="수정하기">
	 									<i class="glyphicon glyphicon-edit"></i>
	 								</a>
	 							</span>
	 						</li>
	 						<?php $_i++;endwhile?>
	 						</ul>
	 					</div>
	 					</form>
	 					<!-- nestable : https://github.com/dbushell/Nestable -->
	 					<?php getImport('nestable','jquery.nestable',false,'js') ?>
	 					<script>
	 						$('#nestable-menu').nestable();
	 						$('.dd').on('change', function() {
	 							var f = document.bbsform;
	 							getIframeForAction(f);
	 							f.submit();
	 						});
	 					</script>

	 					<?php else:?>
						<div class="text-center text-muted d-flex align-items-center justify-content-center" style="height: calc(100vh - 15.6rem);">
							<div><i class="fa fa-exclamation-circle fa-3x mb-2" aria-hidden="true"></i> <br>등록된 게시판이 없습니다. </div>
						</div>
	 					<?php endif?>




			     </div>
			   </div>

			 </div>


	   	<div class="card d-none">  <!-- 메뉴 리스트 패털 시작 -->

	   		<!-- 메뉴 패널 헤더 : 아이콘 & 제목 -->
				<div class="card-header">
					게시판 리스트
					<span class="pull-right">
						<button type="button" class="btn btn-light btn-xs<?php if(!$_SESSION['sh_site_bbs_search']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#panel-search" data-tooltip="tooltip" title="검색필터" onclick="sessionSetting('sh_site_bbs_search','1','','1');getSearchFocus();">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
				<div id="panel-search" class="collapse<?php if($_SESSION['sh_site_bbs_search']):?> in<?php endif?>">
					<form role="form" action="<?php echo $g['s']?>/" method="get">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="<?php echo $m?>">
					<input type="hidden" name="module" value="<?php echo $module?>">
					<input type="hidden" name="front" value="<?php echo $front?>">
						<div class="panel-heading rb-search-box">
							<div class="input-group">
								<div class="input-group-addon"><small>출력수</small></div>
								<div class="input-group-btn">
									<select class="form-control" name="recnum" onchange="this.form.submit();">
									<option value="15"<?php if($recnum==15):?> selected<?php endif?>>15</option>
									<option value="30"<?php if($recnum==30):?> selected<?php endif?>>30</option>
									<option value="60"<?php if($recnum==60):?> selected<?php endif?>>60</option>
									<option value="100"<?php if($recnum==100):?> selected<?php endif?>>100</option>
									</select>
								</div>
							</div>
						</div>
						<div class="rb-keyword-search input-group input-group-sm">
							<input type="text" name="keyw" class="form-control" value="<?php echo $keyw?>" placeholder="아이디 or 이름">
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit">검색</button>
							</span>
						</div>
					</form>
				</div>
				<div class="panel-body" style="border-top:1px solid #DEDEDE;">

	         </div>
				<div class="card-footer">
					<ul class="pagination justify-content-center">
					<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
					<?php //echo getPageLink(5,$p,$TPG,'')?>
					</ul>
				</div>
				<div class="card-footer">
					<a href="<?php echo $g['adm_href']?>&amp;front=main_detail" class="btn btn-outline-primary btn-block">
						<i class="fa fa-plus"></i> 새 게시판 만들기
					</a>
				</div>
			</div> <!-- 좌측 패널 끝 -->



	   </div><!-- 좌측  내용 끝 -->
	   <!-- 우측 내용 시작 -->
	   <div id="tab-content-view" class="col-sm-8 col-md-8 ml-sm-auto col-xl-9 pt-3">
			<form name="procForm" class="form-horizontal rb-form" role="form" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="makebbs">
				<input type="hidden" name="bid" value="<?php echo $R['id']?>">
				<input type="hidden" name="perm_g_list" value="<?php echo $R['perm_g_list']?>">
				<input type="hidden" name="perm_g_view" value="<?php echo $R['perm_g_view']?>">
				<input type="hidden" name="perm_g_write" value="<?php echo $R['perm_g_write']?>">
				<input type="hidden" name="perm_g_down" value="<?php echo $R['perm_g_down']?>">

			<div class="page-header d-flex justify-content-between align-items-center mt-1">
				<?php if($R['uid']):?>
				<h4 class="pull-left m-0">게시판 등록정보</h4>
				<div class="pull-right rb-top-btnbox">
						<a href="<?php echo $g['adm_href']?>&amp;front=main" class="btn btn-light">
							<i class="fa fa-list-alt" aria-hidden="true"></i> 게시판 목록
						</a>
					</div>
				<?php else:?>
				<h4>새 게시판 만들기</h4>
				<?php endif?>
			</div>


	       <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">게시판 이름</label>
					<div class="col-lg-10 col-xl-9">
						<div class="input-group">
							<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $R['name']?>"<?php if(!$R['uid'] && !$g['device']):?> autofocus<?php endif?>>
							<?php if($R['uid']):?>
							<div class="input-group-append">
								<a href="<?php echo RW('m='.$module.'&bid='.$R['id'])?>" target="_blank" class="btn btn-light" data-tooltip="tooltip" title="게시판 보기">
									<i class="fa fa-link fa-lg"></i>
								</a>
							</div>
							<?php endif?>
						</div>
						<small class="form-text text-muted">게시판제목에 해당되며 한글,영문등 자유롭게 등록할 수 있습니다.</small>
					</div>
			 </div>
			 <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">게시판 아이디</label>
					<div class="col-lg-10 col-xl-9">
						<div class="input-group">
							<input class="form-control" placeholder="" type="text" name="id" value="<?php echo $R['id']?>" <?php if($R['uid']):?>readonly<?php endif?>>
							<?php if($R['uid']):?>
							<div class="input-group-append">
								<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletebbs&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'삭제하시면 모든 게시물이 지워지며 복구할 수 없습니다.\n정말로 삭제하시겠습니까?');"  class="btn btn-light" data-tooltip="tooltip" title="삭제하기">
								<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</div>
							<?php endif?>
						</div>
						<small class="form-text text-muted">영문 대소문자+숫자+_ 조합으로 만듭니다.</small>
					</div>
			 </div>
			 <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">카테고리</label>
					<div class="col-lg-10 col-xl-9">
						<input class="form-control" placeholder="" type="text" name="category" value="<?php echo $R['category']?>">
						<small class="form-text text-muted">
							분류를 <strong>콤마(,)</strong>로 구분해 주세요. <strong>첫분류는 분류제목</strong>이 됩니다.<br>
							보기)<strong>구분</strong>,유머,공포,엽기,무협,기타
						</small>
					</div>
			 </div>
	       <div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">레이아웃</label>
					<div class="col-lg-10 col-xl-9">
				   	 <select name="layout" class="form-control custom-select">
						 	<option value="">&nbsp;+ 사이트 대표레이아웃</option>
								<?php $dirs = opendir($g['path_layout'])?>
								<?php while(false !== ($tpl = readdir($dirs))):?>
								<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
								<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
								<?php while(false !== ($tpl1 = readdir($dirs1))):?>
								<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
								<option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['bbs']['layout']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo str_replace('.php','',$tpl1)?>)</option>
								<?php endwhile?>
								<?php closedir($dirs1)?>
								<?php endwhile?>
								<?php closedir($dirs)?>
						</select>
					</div>
			 </div>
			 <div class="form-group row">
		  	  <label class="col-lg-2 col-form-label text-lg-right">게시판 테마 </label>
			     <div class="col-lg-10 col-xl-9">
	  		    <select name="skin" class="form-control custom-select">
							<option value="">&nbsp;+ 게시판 대표테마</option>
							<?php $tdir = $g['path_module'].$module.'/theme/_pc/'?>
							<?php $dirs = opendir($tdir)?>
							<?php while(false !== ($skin = readdir($dirs))):?>
							<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
							<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
							<?php endwhile?>
							<?php closedir($dirs)?>
						</select>
					</div> <!-- .col-sm-10  -->
			</div> <!-- .form-group  -->
			<div class="form-group row">
	  	  <label class="col-lg-2 col-form-label text-lg-right">(모바일 접속)</label>
		     <div class="col-lg-10 col-xl-9">
 			  		<select name="m_skin" class="form-control custom-select">
							<option value="">&nbsp;+ 게시판 모바일 대표테마</option>
							<?php $tdir = $g['path_module'].$module.'/theme/_mobile/'?>
							<?php $dirs = opendir($tdir)?>
							<?php while(false !== ($skin = readdir($dirs))):?>
							<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
							<option value="_mobile/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['m_skin']=='_mobile/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
							<?php endwhile?>
							<?php closedir($dirs)?>
						</select>
					</div> <!-- .col-sm-10  -->
			</div> <!-- .form-group  -->
			<div class="form-group row">
					<label class="col-lg-2 col-form-label text-lg-right">연결메뉴</label>
					<div class="col-lg-10 col-xl-9">
						<select name="sosokmenu" class="form-control custom-select">
							 <option value="">&nbsp;+ 사용 안함</option>
								<?php include_once $g['path_core'].'function/menu1.func.php'?>
								<?php $cat=$d['bbs']['sosokmenu']?>
								<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
						 </select>
						 <small class="form-text text-muted">
							 이 게시판을 메뉴에 연결하였을 경우 해당메뉴를 지정해 주세요.<br>
								연결메뉴를 지정하면 게시물수,로케이션이 동기화됩니다.
						 </small>
					</div>
			 </div>
			 <div class="form-group row">
	      <label class="col-lg-2 col-form-label text-lg-right">소셜연동</label>
					<div class="col-lg-10 col-xl-9">
						<select name="snsconnect" class="form-control custom-select">
						 <option value="0">&nbsp;+ 연동안함</option>
						 <?php $tdir = $g['path_module'].'social/inc/'?>
						 <?php if(is_dir($tdir)):?>
						 <?php $dirs = opendir($tdir)?>
						 <?php while(false !== ($skin = readdir($dirs))):?>
						 <?php if($skin=='.' || $skin == '..')continue?>
						 <option value="social/inc/<?php echo $skin?>"<?php if($d['bbs']['snsconnect']=='social/inc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo str_replace('.php','',$skin)?></option>
						 <?php endwhile?>
						 <?php closedir($dirs)?>
						 <?php endif?>
					 </select>
					 <small class="form-text text-muted">
						게시물 등록시 SNS에 동시등록을 가능하게 합니다.<br>
						이 서비스를 위해서는 소셜연동 모듈을 설치해야 합니다.
					 </small>
					</div>
			 </div>
			<!-- 추가설정 시작 : panel-group 으로 각각의 panel 을 묶는다.-->
       <div id="bbs-settings" class="panel-group">
				 <div id="bbs-settings-add" class="card"> <!-- 추가설정-->
				    <div class="card-header p-0">
							<a onclick="boxDeco('add');" href="#bbs-settings-add-body" data-parent="#bbs-settings" data-toggle="collapse" class="d-block collapsed muted-link pl-2">
								<i class="fa fa-caret-right fa-fw"></i>추가설정
							</a>
					 </div> <!-- .panel-heading -->
					<div class="collapse" id="bbs-settings-add-body">
						<div class="card-body">
							  <!-- .form-group 나열  -->
							  <?php include $g['path_module'].$module.'/admin/_add_fgroup.php';?>
						</div>
						<div class="card-footer">
		  					<small class="text-muted">
		  						<i class="fa fa-info-circle fa-lg fa-fw"></i> 이상 추가설정 내용입니다.
		  					</small>
						</div>
					</div> <!-- .panel-body & .panel-footer : 숨겼다 보였다 하는 내용  -->
				 </div> <!-- .panel 전체 -->
				 <div id="bbs-settings-right" class="card"><!--권한설정-->
					 <div class="card-header p-0">
						 <a onclick="boxDeco('right');" href="#bbs-settings-right-body" data-parent="#bbs-settings" data-toggle="collapse" class="collapsed d-block collapsed muted-link pl-2">
							 <i class="fa fa-caret-right fa-fw"></i>권한설정
						 </a>
					 </div>
					 <div class="collapse" id="bbs-settings-right-body">
						 <div class="card-body">
					        <!-- .form-group 나열  -->
					        <?php include $g['path_module'].$module.'/admin/_right_fgroup.php';?>
					    </div>
					    <div class="card-footer">
		  					 <small class="text-muted">
		  					 	 <i class="fa fa-info-circle fa-lg fa-fw"></i> 이상 권한설정 내용입니다.
		  					 </small>
						</div>
		          </div> <!-- .panel-body & .panel-footer : 숨겼다 보였다 하는 내용  -->
	          </div>  <!-- .panel 전체 -->
	          <div id="bbs-settings-hcode" class="card"><!--헤더삽입-->
					 <div class="card-header p-0">
						 <a onclick="boxDeco('hcode');" href="#bbs-settings-hcode-body" data-parent="#bbs-settings" data-toggle="collapse" class="collapsed d-block collapsed muted-link pl-2">
							 <i class="fa fa-caret-right fa-fw"></i>헤더삽입
						 </a>
					 </div>
					 <div class="collapse" id="bbs-settings-hcode-body">
						 <div class="card-body">
					        <!-- .form-group 나열  -->
					        <?php include $g['path_module'].$module.'/admin/_header_fgroup.php';?>
					    </div>
					    <div class="card-footer">
		  					 <small class="text-muted">
		  					 	 <i class="fa fa-info-circle fa-lg fa-fw"></i> 이상 헤더삽입 내용입니다.
		  					 </small>
						</div>
		          </div> <!-- .panel-body & .panel-footer : 숨겼다 보였다 하는 내용  -->
	          </div>  <!-- .panel 전체 -->
	          <div id="bbs-settings-fcode" class="card"><!--풋터삽입-->
					 <div class="card-header p-0">
						 <a onclick="boxDeco('fcode');" href="#bbs-settings-fcode-body" data-parent="#bbs-settings" data-toggle="collapse" class="collapsed d-block collapsed muted-link pl-2">
							 <i class="fa fa-caret-right fa-fw"></i>풋터삽입
						 </a>
					 </div>
					 <div class="collapse" id="bbs-settings-fcode-body">
						 <div class="card-body">
					        <!-- .form-group 나열  -->
					        <?php include $g['path_module'].$module.'/admin/_footer_fgroup.php';?>
					    </div>
					    <div class="card-footer">
		  					 <small class="text-muted">
		  					 	 <i class="fa fa-info-circle fa-lg fa-fw"></i> 이상 풋터삽입 내용입니다.
		  					 </small>
						</div>
		          </div> <!-- .panel-body & .panel-footer : 숨겼다 보였다 하는 내용  -->
	          </div>  <!-- .panel 전체 -->
	       </div> <!-- .panel-group -->
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4">
						<i class="fa fa-check fa-lg"></i> <?php echo $R['uid']?'게시판속성 변경':'새게시판 만들기'?>
					</button>
				</div>
			</div>
		</form>

	  </div> <!-- 우측내용 끝 -->
	</div> <!-- .row 전체 box -->
</div>


<iframe hidden name="_orderframe_"></iframe>
<script type="text/javascript">
//<![CDATA[
// 추가설정 패널 디자인 조정
function boxDeco(val)
{
	var layer_arr=["add","right","hcode","fcode"]; // 레이어 배열
   var parent='bbs-settings-';
   var this_layer='bbs-settings-'+val;
   for(var i=0;i<layer_arr.length;i++)
   {
      if(layer_arr[i]!=val) $('#'+parent+layer_arr[i]).addClass("panel-default").removeClass("panel-primary");
   }
   $('#'+this_layer).addClass("panel-primary").removeClass("panel-default");
}
function saveCheck(f)
{
    var l1 = f._perm_g_list;
    var n1 = l1.length;
    var l2 = f._perm_g_view;
    var n2 = l2.length;
    var l3 = f._perm_g_write;
    var n3 = l3.length;
    var l4 = f._perm_g_down;
    var n4 = l4.length;
    var i;
	var s1 = '';
	var s2 = '';
	var s3 = '';
	var s4 = '';
	for	(i = 0; i < n1; i++)
	{
		if (l1[i].selected == true && l1[i].value != '')
		{
			s1 += '['+l1[i].value+']';
		}
	}
	for	(i = 0; i < n2; i++)
	{
		if (l2[i].selected == true && l2[i].value != '')
		{
			s2 += '['+l2[i].value+']';
		}
	}
	for	(i = 0; i < n3; i++)
	{
		if (l3[i].selected == true && l3[i].value != '')
		{
			s3 += '['+l3[i].value+']';
		}
	}
	for	(i = 0; i < n4; i++)
	{
		if (l4[i].selected == true && l4[i].value != '')
		{
			s4 += '['+l4[i].value+']';
		}
	}
	f.perm_g_list.value = s1;
	f.perm_g_view.value = s2;
	f.perm_g_write.value = s3;
	f.perm_g_down.value = s4;
	if (f.name.value == '')
	{
		alert('게시판이름을 입력해 주세요.     ');
		f.name.focus();
		return false;
	}
	if (f.bid.value == '')
	{
		if (f.id.value == '')
		{
			alert('게시판아이디를 입력해 주세요.      ');
			f.id.focus();
			return false;
		}
		if (!chkFnameValue(f.id.value))
		{
			alert('게시판아이디는 영문 대소문자/숫자/_ 만 사용가능합니다.      ');
			f.id.value = '';
			f.id.focus();
			return false;
		}
	}
   if (confirm('정말로 실행하시겠습니까?         '))
		{
			getIframeForAction(f);
			f.submit();
		}

}
//]]>
</script>