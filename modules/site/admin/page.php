<?php
$R = array();
$SITES   = getDbArray($table['s_site'],'','*','gid','asc',0,$p);
$SITEN   = db_num_rows($SITES);
$recnum  = $recnum ? $recnum : 15;
$sendsql = 'site='.$_HS['uid'];
$sendsql.= $cat ? " and category='".$cat."'" : '';
if ($keyw)
{
	$sendsql .= " and (id like '%".$keyw."%' or name like '%".$keyw."%' or category like '%".$keyw."%')";
}
$PAGES = getDbArray($table['s_page'],$sendsql,'*','d_update','desc',$recnum,$p);
$NUM = getDbRows($table['s_page'],$sendsql);
$TPG = getTotalPage($NUM,$recnum);

if ($uid)
{
	$R = getUidData($table['s_page'],$uid);
	$_SEO = getDbData($table['s_seo'],'rel=2 and parent='.$R['uid'],'*');
}
$pageType = array('','모듈연결','위젯전시','직접편집');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar">
			<div class="card">
				<div class="card-header p-1 d-flex justify-content-between">
					<div class="dropdown">
						<a class="btn btn-link muted-link dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-file-text-o fa-lg fa-fw"></i> <?php echo $cat?$cat:'전체페이지'?>
						</a>
						<div class="dropdown-menu">
							<h6 class="dropdown-header">페이지 분류</h6>
							<a class="dropdown-item<?php if(!$cat):?> active<?php endif?>" href="<?php echo $g['adm_href']?>">전체페이지</a>
							<?php $_cats=array()?>
							<?php $CATS=db_query("select *,count(*) as cnt from ".$table['s_page']." group by category",$DB_CONNECT)?>
							<?php while($C=db_fetch_array($CATS)):$_cats[]=$C['category']?>
							<a class="dropdown-item<?php if($C['category']==$cat):?> active<?php endif?>" href="<?php echo $g['adm_href']?>&amp;cat=<?php echo urlencode($C['category'])?>">
								<?php echo $C['category']?> <small>(<?php echo $C['cnt']?>)</small>
							</a>
							<?php endwhile?>
						</div>
					</div>
					<button type="button" class="btn btn-link muted-link btn-sm<?php if(!$_SESSION['sh_site_page_search']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#panel-search" data-tooltip="tooltip" title="검색필터" onclick="sessionSetting('sh_site_page_search','1','','1');getSearchFocus();">
						<i class="fa fa-cog" aria-hidden="true"></i>
					</button>
				</div>

				<?php if($SITEN>1):?>
				<div class="">
					<select class="form-control custom-select border-0" onchange="goHref('<?php echo $g['s']?>/?m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $front?>&r='+this.value);">
						<?php while($S = db_fetch_array($SITES)):?>
						<option value="<?php echo $S['id']?>"<?php if($r==$S['id']):?> selected<?php endif?>><?php echo $S['name']?> (<?php echo $S['id']?>)</option>
						<?php endwhile?>
					</select>
				</div>
				<?php endif?>



				<div  style="height: calc(100vh - 16.8rem);">

					<div id="panel-search" class="collapse<?php if($_SESSION['sh_site_page_search']):?> show<?php endif?>">
						<form role="form" action="<?php echo $g['s']?>/" method="get">
							<input type="hidden" name="r" value="<?php echo $r?>">
							<input type="hidden" name="m" value="<?php echo $m?>">
							<input type="hidden" name="module" value="<?php echo $module?>">
							<input type="hidden" name="front" value="<?php echo $front?>">
							<input type="hidden" name="cat" value="<?php echo $cat?>">

							<div class="card-body p-0">
								<div class="input-group">
									<span class="input-group-addon border-0 bg-white">출력수</span>
									<select class="form-control border-0" name="recnum" onchange="this.form.submit();">
										<option value="15"<?php if($recnum==15):?> selected<?php endif?>>15</option>
										<option value="30"<?php if($recnum==30):?> selected<?php endif?>>30</option>
										<option value="60"<?php if($recnum==60):?> selected<?php endif?>>60</option>
										<option value="100"<?php if($recnum==100):?> selected<?php endif?>>100</option>
									</select>
								</div>
							</div>
							<div class="rb-keyword-search">
								<input type="text" name="keyw" class="form-control" value="<?php echo $keyw?>" placeholder="페이지명,코드,분류명 검색">
							</div>
						</form>
					</div>

					<table id="page-list" class="table mb-0">
						<thead>
							<tr>
								<td class="rb-pagename"><span>페이지명</span></td>
								<td class="rb-time"><span>최종수정</span></td>
							</tr>
						</thead>
						<tbody>
							<?php $pageTypeIcon=array('','fa-link','fa-puzzle-piece','fa-pencil')?>
							<?php while($PR = db_fetch_array($PAGES)):?>
							<tr<?php if($uid==$PR['uid']):?> class="table-active"<?php endif?> data-tooltip="tooltip" title="[<?php echo $PR['category']?>] <?php echo $PR['name']?>">
								<td onclick="goHref('<?php echo $g['adm_href']?>&amp;uid=<?php echo $PR['uid']?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;cat=<?php echo urlencode($cat)?>&amp;keyw=<?php echo urlencode($keyw)?>#site-page-info');">
									<a href="#.">
										<span class="badge badge-dark badge-pill">
											<i class="fa <?php echo $pageTypeIcon[$PR['pagetype']]?> fa-lg"></i>
										</span>
										<?php echo getStrCut($PR['name'],14,'..')?>
									</a>
									<small><i><?php echo $PR['id']?></i></small>
								</td>
								<td class="rb-time">
									<?php echo getDateFormat($PR['d_update'],'Y.m.d')?>
								</td>
							</tr>
							<?php endwhile?>
						</tbody>
					</table>
				</div>


				<nav>
					<ul class="pagination justify-content-center mb-0">
						<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
						<?php //echo getPageLink(5,$p,$TPG,'')?>
					</ul>
				</nav>
				<div class="card-footer">
					<a class="btn btn-light btn-block" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=dumpmenu&amp;type=package_page" target="_action_frame_<?php echo $m?>"><i class="fa fa-download fa-lg"></i> 패키지용 데이터 받기</a>
				</div>
			</div>
		</div>

		<div id="tab-content-view" class="col-sm-8 col-md-8 ml-sm-auto col-xl-9 pt-3">
			<?php if($g['device']):?><a name="site-page-info"></a><?php endif?>
			<form name="procForm" class="form-horizontal rb-form" role="form" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="regispage">
				<input type="hidden" name="uid" value="<?php echo $R['uid']?>">
				<input type="hidden" name="orign_id" value="<?php echo $R['id']?>">
				<input type="hidden" name="perm_g" value="<?php echo $R['perm_g']?>">
				<input type="hidden" name="seouid" value="<?php echo $_SEO['uid']?>">
				<input type="hidden" name="layout" value="">
				<input type="hidden" name="cat" value="<?php echo $cat?>">
				<input type="hidden" name="recnum" value="<?php echo $recnum?>">
				<input type="hidden" name="keyw" value="<?php echo $keyw?>">
				<input type="hidden" name="p" value="<?php echo $p?>">
				<input type="hidden" name="pagetype" value="<?php echo $R['uid']?$R['pagetype']:3?>">

				<div class="page-header mt-2">
					<h4>
						<?php if($R['uid']):?>
						페이지 등록정보
						<div class="pull-right rb-top-btnbox hidden-xs">
							<a href="<?php echo $g['adm_href']?>" class="btn btn-light"><i class="fa fa-plus"></i> 새 페이지</a>
							<div class="btn-group rb-btn-view">
								<a href="<?php echo RW('mod='.$R['id'])?>" class="btn btn-light">접속하기</a>
								<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
									<span class="caret"></span>
								</button>
								<div class="dropdown-menu dropdown-menu-right" role="menu">
									<a class="dropdown-item" href="<?php echo RW('mod='.$R['id'])?>" target="_blank">
										<i class="fa fa-external-link"></i> 새창으로 보기
									</a>
								</div>
							</div>
						</div>
						<?php else:?>
						새 페이지 만들기
						<?php endif?>
					</h4>
				</div>

				<div class="form-group row rb-outside">
					<label class="col-lg-2 col-form-label text-lg-right">페이지명</label>
					<div class="col-lg-10 col-xl-9">
						<div class="input-group input-group-lg">
							<?php if($R['uid']):?>
							<span class="input-group-btn">
								<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" data-tooltip="tooltip" title="문서의 형식">
									<span id="rb-document-type"><?php echo $pageType[$R['pagetype']]?></span> <span class="caret"></span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="#" onclick="docType(3,'<?php echo $pageType[3]?>');"><i class="fa fa-code"></i> <?php echo $pageType[3]?></a>
									<a class="dropdown-item" href="#" onclick="docType(2,'<?php echo $pageType[2]?>');"><i class="fa fa-puzzle-piece fa-lg"></i> <?php echo $pageType[2]?></a>
									<a class="dropdown-item" href="#" onclick="docType(1,'<?php echo $pageType[1]?>');"><i class="kf kf-module"></i> <?php echo $pageType[1]?></a>
								</div>
							</span>
							<?php endif?>
							<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $R['name']?>"<?php if(!$R['uid'] && !$g['device']):?> autofocus<?php endif?>>
							<span class="input-group-btn">
								<button class="btn btn-light rb-help-btn" type="button" data-toggle="collapse" data-target="#guide_startpage" data-tooltip="tooltip" title="페이지 형식지정"><i class="fa fa-cog fa-lg"></i></button>
							</span>
							<?php if($R['uid']):?>
							<span class="input-group-btn">
								<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletepage&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" class="btn btn-light" data-tooltip="tooltip" title="삭제">
								<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</span>
							<?php endif?>
						</div>
					</div>
				</div>

				<div id="guide_startpage" class="collapse">
					<div class="row">
						<div class="col-lg-10 col-xl-9 offset-lg-2">


							<label class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" name="ismain" value="1"<?php if($R['ismain']):?> checked<?php endif?>>
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description"><span class="fa fa-home"></span> 메인 페이지</span>
							</label>
							<label class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" name="mobile" value="1"<?php if($R['mobile']):?> checked<?php endif?>>
							  <span class="custom-control-indicator"></span>
							  <span class="custom-control-description"><span class="fa fa-mobile"></span> 모바일 페이지</span>
							</label>

							<small class="form-text text-muted mb-3">
								보기) 메인화면,로그인,회원가입,마이페이지,통합검색,이용약관,고객센터<br>
								메인 페이지는 사이트 속성중 메인 페이지로 지정할 수 있습니다.<br>
								메인화면으로 사용할 페이지일 경우 메인 페이지에 체크해 주세요.
							</small>
						</div>
					</div>

					<div class="form-group row rb-outside">
						<label class="col-lg-2 col-form-label text-lg-right">코드</label>
						<div class="col-lg-10 col-xl-9">
							<div class="input-group">
								<input class="form-control" type="text" name="id" value="<?php echo $R['id']?$R['id']:'p'.$date['tohour']?>" maxlength="20" placeholder="">
								<span class="input-group-btn">
									<button class="btn btn-light rb-help-btn" type="button" data-toggle="collapse" data-target="#guide_pagecode" data-tooltip="tooltip" title="도움말"><i class="fa fa-question fa-lg"></i></button>
								</span>
							</div>
							<div id="guide_pagecode" class="collapse">
								<small class="form-text text-muted">
									페이지 호출시에 사용되는 코드이므로 가급적 페이지명을 잘 표현할 수 있는 영어로 입력해주세요.<br>
									영문대소문자/숫자/_/- 조합으로 등록할 수 있습니다.<br>
									보기) 페이지호출주소 : <code>./?mod=페이지코드</code>
								</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group tab-content<?php if(!$R['uid']):?> d-none<?php endif?>">
					<div class="form-group row<?php if($R['pagetype']!=3):?> d-none<?php endif?>" id="editBox3">
						<div class="col-lg-10 col-xl-9 offset-lg-2">
							<fieldset<?php if($R['pagetype']!=3):?> disabled<?php endif?>>
								<div class="btn-group btn-group-justified" data-toggle="buttons">
									<a class="btn btn-light rb-modal-code">
										<i class="fa fa-code fa-lg"></i> 소스코드
									</a>
									<a class="btn btn-light rb-modal-wysiwyg">
										<i class="fa fa-edit fa-lg"></i> 위지위그
									</a>
								</div>
							</fieldset>
							<span class="form-text text-muted mt-2">
								<ul class="list-unstyled">
									<li><small>직접꾸미기는 소스코드를 직접 편집하거나 위지위그 에디터를 이용할 수 있습니다.</small></li>
									<li><small>소스코드로 작성한 페이지를 위지위그로 편집하면 소스코드가 변형될 수 있으니 유의하세요.</small></li>
									<?php if($R['pagetype']!=3):?><li><small>페이지 속성을 변경한 후에 활성화 됩니다.</small></li><?php endif?>
								</ul>
							</span>
						</div>
					</div>
					<div class="form-group row<?php if($R['pagetype']!=2):?> d-none<?php endif?>" id="editBox2">
						<div class="col-lg-10 col-xl-9 offset-lg-2">
							<?php if($R['pagetype']==2):?>
							<fieldset>
								<a href="#." class="btn btn-light btn-block rb-modal-widget"><i class="fa fa-puzzle-piece fa-lg"></i> 위젯으로 꾸미기</a>
							</fieldset>
							<?php else:?>
							<fieldset disabled>
								<a href="#." class="btn btn-light btn-block"><i class="fa fa-puzzle-piece fa-lg"></i>
									위젯으로 꾸미기
									<small class="text-muted">( 페이지 속성을 변경한 후에 활성화 됩니다. )</small>
								</a>
							</fieldset>
							<?php endif?>
						</div>
					</div>
					<div class="form-group row<?php if($R['pagetype']!=1):?> d-none<?php endif?>" id="editBox1">
						<div class="col-lg-10 col-xl-9 offset-lg-2">
							<fieldset>
								<div class="input-group">
									<input type="text" name="joint" id="jointf" value="<?php echo $R['joint']?>" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-light rb-modal-module" type="button" title="모듈연결" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window"><i class="fa fa-link fa-lg"></i></button>
										<button class="btn btn-light" type="button" title="미리보기" data-tooltip="tooltip" onclick="getId('jointf').value!=''?window.open(getId('jointf').value):alert('모듈연결 주소를 등록해 주세요.');">Go!</button>
									</span>
								</div>
							</fieldset>
							<small class="form-text text-muted mt-2">
								<ul class="list-unstyled">
									<li>이 페이지에 연결시킬 모듈이 있을 경우 모듈연결을 클릭한 후 선택해 주세요.</li>
									<li>모듈 연결주소가 지정되면 이 메뉴를 호출시 해당 연결주소의 모듈이 출력됩니다.</li>
									<li>접근권한은 연결된 모듈의 권한설정을 따릅니다.</li>
								</ul>
							</small>
						</div>
					</div>
				</div>

				<div class="panel-group" id="page-settings">
					<div class="card" id="page-settings-meta">
						<div class="card-header px-2">
							<a class="muted-link d-block" data-toggle="collapse" data-parent="#page-settings" href="#page-settings-meta-body" onclick="sessionSetting('sh_site_page_1',getId('page-settings-meta').className.indexOf('default')==-1?'':'1','','');">
								<i class="fa fa-caret-right fa-fw"></i>메타설정
							</a>
						</div>
						<div id="page-settings-meta-body" class="panel-collapse collapse<?php if($_SESSION['sh_site_page_1']==1):?> show<?php endif?>">
							<div class="card-body">
								<div class="form-group row rb-outside">
									<label class="col-lg-2 col-form-label text-lg-right">타이틀</label>
									<div class="col-lg-10 col-xl-9">
										<div class="input-group">
											<input type="text" class="form-control rb-title" name="title" value="<?php echo $_SEO['title']?>" maxlength="60" placeholder="50-60자 내에서 작성해 주세요.">
											<span class="input-group-btn">
												<button class="btn btn-light rb-help-btn" type="button" data-toggle="collapse" data-target="#guide_title" data-tooltip="tooltip" title="도움말"><i class="fa fa-question fa-lg text-muted"></i></button>
											</span>
										</div>
										<div class="help-block collapse" id="guide_title">
											<small>
												<code>&lt;meta name=&quot;title&quot; content=&quot;&quot;&gt;</code> 내부에 삽입됩니다.
											</small>
										</div>
									</div>
								</div>
								<div class="form-group row rb-outside">
									<label class="col-lg-2 col-form-label text-lg-right">설명</label>
									<div class="col-lg-10 col-xl-9">
										<textarea name="description" class="form-control rb-description_" rows="5" placeholder="150-160자 내에서 작성해 주세요."><?php echo $_SEO['description']?></textarea>
										<a class="badge badge-pill badge-dark mt-2" href="#guide_description" data-toggle="collapse" ><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<div class="collapse" id="guide_description">
											<small class="help-block">
												<code>&lt;meta name=&quot;description&quot; content=&quot;&quot;&gt;</code> 내부에 삽입됩니다.<br>
												검색 결과에 표시되는 문자를 지정합니다.<br>설명글은 엔터없이 입력해 주세요.<br>
												보기)웹 프레임워크의 혁신 - 킴스큐 Rb 에 대한 다운로드,팁 공유등을 제공합니다. <a href=&quot;http://moz.com/learn/seo/meta-description&quot; target=&quot;_blank&quot;>참고</a><br>
											</small>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">키워드</label>
									<div class="col-lg-10 col-xl-9">
										<input name="keywords" class="form-control" placeholder="콤마(,)로 구분하여 입력해 주세요." value="<?php echo $_SEO['keywords']?>">
										<a class="badge badge-pill badge-dark mt-2" href="#guide_keywords" data-toggle="collapse" ><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<div class="help-block collapse" id="guide_keywords">
											<small>
												<code>&lt;meta name=&quot;keywords&quot; content=&quot;&quot;&gt;</code> 내부에 삽입됩니다.<br>
												핵심 키워드를 콤마로 구분하여 20개 미만으로 엔터없이 입력해 주세요.<br>
												보기)킴스큐,킴스큐Rb,CMS,웹프레임워크,큐마켓<br>
											</small>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">크롤링</label>
									<div class="col-lg-10 col-xl-9">
										<input name="classification" class="form-control" placeholder="" value="<?php echo $_SEO['uid']?$_SEO['classification']:'ALL'?>">
										<a class="badge badge-pill badge-dark mt-2" href="#guide_classification" data-toggle="collapse" ><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<div class="help-block collapse" id="guide_classification">
											<small class="help-block">
												<code>&lt;meta name=&quot;robots&quot; content=&quot;&quot;&gt;</code> 내부에 삽입됩니다.<br>
												all,noindex,nofollow,none 등으로 지정할 수 있습니다.<br>
											</small>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">메타이미지</label>
									<div class="col-lg-10 col-xl-9">
										<div class="input-group">
											<input class="form-control rb-modal-photo-drop" onmousedown="_mediasetField='meta_image_src&dfiles='+this.value;" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window" type="text" name="image_src" id="meta_image_src" value="<?php echo $_SEO['image_src']?$_SEO['image_src']:''?>">
											<div class="input-group-btn">
												<button class="btn btn-light rb-modal-photo1" type="button" title="포토셋" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window">
													<i class="fa fa-photo fa-lg"></i>
												</button>
											</div>
										</div>

										<a class="badge badge-pill badge-dark mt-2" href="#guide_image_src" data-toggle="collapse" ><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<div class="help-block collapse" id="guide_image_src">
											<small class="help-block">
												이미지를 등록하시면 소셜미디어에 이 이미지를 포함하여 전송할 수 있습니다.<br>
												이미지를 직접 지정하려면 이미지의 URL을 입력해 주세요.<br>
											</small>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<small class="text-muted">
									<i class="fa fa-info-circle fa-lg fa-fw"></i> meta 정보 설정은 검색엔진최적화, 소셜미디어 최적화와 직접 관련이 있습니다.
								</small>
							</div>
						</div>
					</div>

					<div class="card" id="page-settings-advance">
						<div class="card-header px-2">
							<a class="muted-link d-block" data-toggle="collapse" data-parent="#page-settings" href="#page-settings-advance-body" onclick="sessionSetting('sh_site_page_1',getId('page-settings-advance').className.indexOf('default')==-1?'':'2','','');">
								<i class="fa fa-caret-right fa-fw"></i>고급설정
							</a>
						</div>
						<div id="page-settings-advance-body" class="panel-collapse collapse<?php if($_SESSION['sh_site_page_1']==2):?> show<?php endif?>">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">레이아웃</label>
									<div class="col-lg-10 col-xl-9">

										<div class="form-row">
											<div class="col-sm-6" id="rb-layout-select">
												<select class="form-control custom-select" name="layout_1" required onchange="getSubLayout(this,'rb-layout-select2','layout_1_sub','');">
													<?php $_layoutHexp=explode('/',$_HS['layout'])?>
													<option value="0">사이트 레이아웃(<?php echo $_layoutHexp[0]?>)</option>
													<?php $_layoutExp1=explode('/',$R['layout'])?>
													<?php $dirs = opendir($g['path_layout'])?>
													<?php while(false !== ($tpl = readdir($dirs))):?>
													<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
													<option value="<?php echo $tpl?>"<?php if($_layoutExp1[0]==$tpl):?> selected<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo $tpl?>)</option>
													<?php endwhile?>
													<?php closedir($dirs)?>
												</select>
											</div>
											<div class="col-sm-6" id="rb-layout-select2">
												<select class="form-control custom-select" name="layout_1_sub"<?php if(!$CINFO['layout']):?> disabled<?php endif?>>
													<?php if(!$R['m_layout']):?><option>서브 레이아웃</option><?php endif?>
													<?php $dirs1 = opendir($g['path_layout'].$_layoutExp1[0])?>
													<?php while(false !== ($tpl1 = readdir($dirs1))):?>
													<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
													<option value="<?php echo $tpl1?>"<?php if($_layoutExp1[1]==$tpl1):?> selected<?php endif?>><?php echo str_replace('.php','',$tpl1)?></option>
													<?php endwhile?>
													<?php closedir($dirs1)?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">분류</label>
									<div class="col-lg-10 col-xl-9">
										<div class="input-group">
											<input class="form-control" type="text" name="category" value="<?php echo $R['category']?$R['category']:$_cats[0]?>">
											<div class="input-group-btn">
												<button class="btn btn-light dropdown-toggle" data-toggle="dropdown" type="button">
													<span class="caret"></span>
												</button>
												<div class="dropdown-menu dropdown-menu-right">
													<?php foreach($_cats as $_val):?>
													<a class="dropdown-item" href="#." onclick="document.procForm.category.value=this.innerHTML;"><?php echo $_val?></a>
													<?php endforeach?>
													<?php if(count($_cats)):?>
													<div class="dropdown-divider"></div>
													<?php endif?>
													<a class="dropdown-item" href="#." onclick="document.procForm.category.value='';document.procForm.category.focus();">직접입력</a>
												</div>
											</div>
										</div>
										<ul class="rb-guide" style="border-top:0;">
										<li>관리가 편하도록 페이지분류를 적절히 지정하여 등록해 주세요.</li>
										<li>페이지 분류는 직접 입력하거나 이미 등록된 분류를 선택할 수 있습니다.</li>
										<li>분류를 직접입력하면 분류선택기에 자동으로 추가됩니다.</li>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">소속메뉴</label>
									<div class="col-lg-10 col-xl-9">
										<select class="form-control custom-select" name="linkedmenu">
										<option value="">사용안함</option>
										<?php include $g['path_core'].'function/menu1.func.php'?>
										<?php $cat=$R['linkedmenu']?>
										<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
										</select>
										<a class="badge badge-pill badge-dark mt-2" data-toggle="collapse" href="#guide_sosok"><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<ul id="guide_sosok" class="collapse">
											<li>이 페이지의 소속메뉴가 종종 필요할 수 있습니다.</li>
											<li>특정메뉴의 서브페이지로 사용되기를 원할경우 지정해 주세요.</li>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">허용등급</label>
									<div class="col-lg-10 col-xl-9">
										<select class="form-control custom-select" name="perm_l">
										<option value="">전체허용</option>
										<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
										<?php while($_L=db_fetch_array($_LEVEL)):?>
										<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$R['perm_l']):?> selected<?php endif?>><?php echo sprintf('%s 이상',$_L['name'].'('.number_format($_L['num']).')')?></option>
										<?php if($_L['gid'])break; endwhile?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">차단그룹</label>
									<div class="col-lg-10 col-xl-9">
										<select class="form-control custom-select" name="_perm_g" multiple size="5">
										<option value=""<?php if(!$R['perm_g']):?> selected="selected"<?php endif?>>차단안함</option>
										<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
										<?php while($_S=db_fetch_array($_SOSOK)):?>
										<option value="<?php echo $_S['uid']?>"<?php if(strstr($R['perm_g'],'['.$_S['uid'].']')):?> selected<?php endif?>><?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
										<?php endwhile?>
										</select>
										<a class="badge badge-pill badge-dark mt-2" data-toggle="collapse" href="#guide_permg"><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<ul id="guide_permg" class="collapse">
											<li>복수의 그룹을 선택하려면 드래그하거나 <kbd>Ctrl</kbd> 를 누른다음 클릭해 주세요.</li>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">캐시적용</label>
									<div class="col-lg-10 col-xl-9">
										<?php $cachefile = $g['path_page'].$r.'-pages/'.$R['id'].'.txt'?>
										<?php $cachetime = file_exists($cachefile) ? implode('',file($cachefile)) : 0?>
										<select name="cachetime" class="form-control custom-select">
										<option value="">적용안함</option>
										<?php for($i = 1; $i < 61; $i++):?>
										<option value="<?php echo $i?>"<?php if($cachetime==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d 분',$i)?></option>
										<?php endfor?>
										</select>
										<a class="badge badge-pill badge-dark mt-2" data-toggle="collapse" href="#guide_cache"><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<ul id="guide_cache" class="collapse">
											<li>DB접속이 많거나 위젯을 많이 사용하는 메뉴일 경우 캐시를 적용하면 서버부하를 줄 일 수 있으며 속도를 높일 수 있습니다.</li>
											<li class="text-danger">실시간 처리가 요구되는 메뉴일 경우 적용하지 마세요.</li>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">미디어</label>
									<div class="col-lg-10 col-xl-9">
										<div class="input-group">
											<input class="form-control" type="text" name="mediaset" id="mediaset" value="<?php echo $R['mediaset']?$R['mediaset']:''?>">
											<div class="input-group-btn">
												<button class="btn btn-light rb-modal-photo" type="button" title="포토셋" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window">
													<i class="fa fa-photo fa-lg"></i>
												</button>
												<button class="btn btn-light rb-modal-video" type="button" title="비디오셋" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window">
													<i class="fa fa-video-camera fa-lg" aria-hidden="true"></i>
												</button>
											</div>
										</div>
										<a class="badge badge-pill badge-dark mt-2" data-toggle="collapse" href="#guide_mediaset"><i class="fa fa-question-circle fa-fw"></i>도움말</a>
										<ul id="guide_mediaset" class="collapse">
											<li>여기에 연결시킬 미디어 파일을 지정할 수 있습니다.</li>
											<li>지정된 미디어는 필요에 따라 사용될 수 있습니다.</li>
										</ul>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">부가필드</label>
									<div class="col-lg-10 col-xl-9">
										<textarea name="extra" class="form-control" rows="3"><?php echo htmlspecialchars($R['extra'])?></textarea>
									</div>
								</div>
								<?php if($R['uid']):?>
								<?php $_url_1 = $g['s'].'/index.php?r='.$r.'&mod='.$R['id']?>
								<?php $_url_2 = $g['s'].'/'.$r.'/p/'.$R['id']?>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label text-lg-right">주소</label>
									<div class="col-lg-10 col-xl-9">
										<div class="input-group" style="margin-bottom: 5px">
											<span class="input-group-addon">물리주소</span>
											<input type="text" id="_url_m_1_" class="form-control" value="<?php echo $_url_1?>">
											<span class="input-group-btn">
												<a href="#." class="btn btn-light rb-clipboard hidden-xs" data-tooltip="tooltip" title="클립보드에 복사" data-clipboard-target="_url_m_1_"><i class="fa fa-clipboard"></i></a>
												<a href="<?php echo $_url_1?>" target="_blank" class="btn btn-light" data-tooltip="tooltip" title="접속">Go!</a>
											</span>
										</div>
										<div class="input-group">
											<span class="input-group-addon">고유주소</span>
											<input type="text" id="_url_m_2_" class="form-control" value="<?php echo $_url_2?>">
											<span class="input-group-btn">
												<a href="#." class="btn btn-light rb-clipboard hidden-xs" data-tooltip="tooltip" title="클립보드에 복사" data-clipboard-target="_url_m_2_"><i class="fa fa-clipboard"></i></a>
												<a href="<?php echo $_url_2?>" target="_blank" class="btn btn-light" data-tooltip="tooltip" title="접속">Go!</a>
											</span>
										</div>
									</div>
								</div>
								<?php endif?>
							</div>
						</div>
					</div>
				</div>
				<button class="btn btn-outline-primary btn-block btn-lg my-4" id="rb-submit-button" type="submit">
					<?php echo $R['uid']?'속성변경':'신규페이지 등록' ?>
				</button>
			</form>
		</div>
	</div>
</div>


<!-- zero-clipboard -->
<?php getImport('zero-clipboard','ZeroClipboard.min',false,'js') ?>
<script>
var client = new ZeroClipboard($(".rb-clipboard"));
client.on( "ready", function( readyEvent ) {
	client.on( "aftercopy", function( event ) {
		$('.tooltip .tooltip-inner').text('복사되었습니다');
	});
});
</script>

<!-- bootstrap-maxlength -->
<?php getImport('bootstrap-maxlength','bootstrap-maxlength.min',false,'js')?>
<script>
	$('input.rb-title').maxlength({
	  alwaysShow: true,
	  threshold: 10,
	  warningClass: "label label-success",
	  limitReachedClass: "label label-danger"
  });

	$('textarea.rb-description').maxlength({
	  alwaysShow: true,
	  threshold: 10,
	  warningClass: "label label-success",
	  limitReachedClass: "label label-danger"
  });
</script>

<!-- modal -->
<script>
var _mediasetField='';
$(document).ready(function() {
	$('.rb-modal-code').on('click',function() {
		goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=page&uid=<?php echo $R['uid']?>&type=source&cat=<?php echo urlencode($cat)?>&p=<?php echo $p?>&recnum=<?php echo $recnum?>&keyw=<?php echo urlencode($keyw)?>');
	});
	$('.rb-modal-wysiwyg').on('click',function() {
		goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=page&uid=<?php echo $R['uid']?>&type=source&wysiwyg=Y&cat=<?php echo urlencode($cat)?>&p=<?php echo $p?>&recnum=<?php echo $recnum?>&keyw=<?php echo urlencode($keyw)?>');
	});
	$('.rb-modal-widget').on('click',function() {
		goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=site&front=_edit&_mtype=page&uid=<?php echo $R['uid']?>&type=widget&cat=<?php echo urlencode($cat)?>&p=<?php echo $p?>&recnum=<?php echo $recnum?>&keyw=<?php echo urlencode($keyw)?>');
	});
	$('.rb-modal-module').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;system=popup.joint&amp;dropfield=jointf&amp;cmodule=[site]')?>');
	});
	$('.rb-modal-photo').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=mediaset')?>');
	});
	$('.rb-modal-photo1').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=meta_image_src')?>');
	});
	$('.rb-modal-video').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.video.media&amp;dropfield=mediaset')?>');
	});
	$('.rb-modal-photo-drop').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=mediaset&amp;mdfile=modal.photo.media&amp;dropfield=')?>'+_mediasetField);
	});
});
</script>

<!-- bootstrap Validator -->
<?php getImport('bootstrap-validator','dist/css/bootstrapValidator.min',false,'css')?>
<?php getImport('bootstrap-validator','dist/js/bootstrapValidator.min',false,'js')?>
<script>
$('.form-horizontal').bootstrapValidator({
	message: 'This value is not valid',
	<?php if(!$g['device']):?>
	feedbackIcons: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
	<?php endif?>
	fields: {
		name: {
			message: 'The username is not valid',
			validators: {
				notEmpty: {
					message: '페이지명을 입력해 주세요.'
				}
			}
		},
		id: {
			validators: {
				notEmpty: {
					message: '페이지 코드를 입력해 주세요.'
				},
				regexp: {
					regexp: /^[a-zA-Z0-9\_\-]+$/,
					message: '페이지 코드는 영문대소문자/숫자/_/- 만 사용할 수 있습니다.'
				}
			}
		},
	}
});
</script>

<!-- basic -->
<script>
function saveCheck(f)
{
    var l1 = f._perm_g;
    var n1 = l1.length;
    var i;
	var s1 = '';

	for	(i = 0; i < n1; i++)
	{
		if (l1[i].selected == true && l1[i].value != '')
		{
			s1 += '['+l1[i].value+']';
		}
	}

	f.perm_g.value = s1;


	<?php if($R['pagetype']=='1'):?>
	if (f.pagetype.value == '1')
	{
		if (f.joint.value == '')
		{
			alert('모듈을 연결해 주세요.');
			f.joint.focus();
			return false;
		}
	}
	<?php endif?>

	if(f.layout_1.value != '0') f.layout.value = f.layout_1.value + '/' + f.layout_1_sub.value;
	else f.layout.value = '';

	getIframeForAction(f);
	//return confirm('정말로 실행하시겠습니까? ');
}
function boxDeco(layer1,layer2)
{
	if(getId(layer1).className.indexOf('default') == -1) $("#"+layer1).addClass("border-light").removeClass("border-primary");
	else $("#"+layer1).addClass("border-primary").removeClass("border-light");
	$("#"+layer2).addClass("border-light").removeClass("border-primary");
}
function getSearchFocus()
{
	if(getId('panel-search').className.indexOf('in') == -1) setTimeout("document.forms[0].keyw.focus();",100);
}
function docType(n,str)
{
	if (confirm('정말로 변경하시겠습니까?'))
	{
		getId('rb-document-type').innerHTML = str;
		$('#editBox1').addClass('d-none');
		$('#editBox2').addClass('d-none');
		$('#editBox3').addClass('d-none');
		$('#editBox'+n).removeClass('d-none');
		getIframeForAction(document.procForm);
		document.procForm.pagetype.value = n;
		document.procForm.submit();
	}
}
<?php if($d['admin']['dblclick']):?>
document.ondblclick = function(event)
{
	getContext('<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?><?php if($R['id']):?>&mod=<?php echo $R['id']?><?php endif?>">사용자모드 보기</a></li><li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=page">새 페이지 만들기</a></li><li class="divider"></li><li><a href="#." onclick="getId(\'rb-submit-button\').click();">실행하기</a></li>',event);
}
<?php endif?>
</script>
