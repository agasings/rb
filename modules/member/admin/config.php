<?php include_once $g['path_module'].$module.'/var/var.join.php';?>

<div class="">

	<form name="procForm" class="container-fluid" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="">
		<input type="hidden" name="_join_menu" value="<?php echo $_SESSION['_join_menu']?$_SESSION['_join_menu']:1?>">
		<input type="hidden" name="_join_tab" value="<?php echo $_SESSION['_join_tab']?$_SESSION['_join_tab']:'terms-1'?>">

	<div class="row">
		<div class="col-sm-3 col-md-3 col-xl-3 d-none d-sm-block sidebar">

			<div class="card">
				<div class="card-header">
					메뉴
				</div>

				<div class="list-group" id="list-tab" role="tablist">
		      <a class="list-group-item list-group-item-action<?php if(!$_SESSION['member_config_nav'] || $_SESSION['member_config_nav']=='signup-config'):?> active<?php endif?>" data-toggle="list" href="#signup-config" role="tab" onclick="sessionSetting('member_config_nav','signup-config','','');">
						<i class="fa fa-cog fa-lg pull-right"></i> 회원가입 설정
					</a>
		      <a class="list-group-item list-group-item-action<?php if($_SESSION['member_config_nav']=='signup-form-config'):?> active<?php endif?>" data-toggle="list" href="#signup-form-config" role="tab" onclick="sessionSetting('member_config_nav','signup-form-config','','');">
						<i class="fa fa-file-text-o fa-lg pull-right"></i> 가입양식 관리
					</a>
		      <a class="list-group-item list-group-item-action<?php if($_SESSION['member_config_nav']=='signup-form-add'):?> active<?php endif?>" data-toggle="list" href="#signup-form-add" role="tab" onclick="sessionSetting('member_config_nav','signup-form-add','','');">
						<i class="fa fa-plus-circle fa-lg pull-right"></i> 가입항목 추가
					</a>
		      <a class="list-group-item list-group-item-action<?php if($_SESSION['member_config_nav']=='settings'):?> active<?php endif?>" data-toggle="list" href="#settings" role="tab" onclick="sessionSetting('member_config_nav','settings','','');">
						<i class="fa fa-sign-in fa-lg pull-right"></i> 개인정보 설정
					</a>
					<a class="list-group-item list-group-item-action<?php if($_SESSION['member_config_nav']=='terms'):?> active<?php endif?>" data-toggle="list" href="#terms" role="tab" onclick="sessionSetting('member_config_nav','terms','','');">
						<i class="fa fa-bullhorn fa-lg pull-right"></i> 약관/안내메시지
					</a>
		    </div>


			</div>




		</div>
		<div class="col-sm-9 col-md-9 ml-sm-auto col-xl-9 pt-3">


				<!-- Tab panes -->
				<div class="tab-content" id="setting-content">
					 <div class="tab-pane fade<?php if(!$_SESSION['member_config_nav'] || $_SESSION['member_config_nav']=='signup-config'):?>  show active<?php endif?>" id="signup-config">
						<!-- 회원가입 설정 -->
							<h3>회원가입 설정</h3>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>회원가입 작동상태</label>
										<div class="">
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<label class="btn btn-light <?php if($d['member']['join_enable']):?>active<?php endif?>">
													<input type="radio" name="join_enable" value="1" id="option1" <?php if($d['member']['join_enable']):?>checked<?php endif?>/> 작동
												</label>
												<label class="btn btn-light <?php if(!$d['member']['join_enable']):?>active<?php endif?>">
													<input type="radio" name="join_enable" value="0" <?php if(!$d['member']['join_enable']):?>checke<?php endif?> id="option2" /> 중단
												</label>
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>모바일 회원가입</label>
										<div>
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<label class="btn btn-light <?php if($d['member']['join_mobile']):?>active<?php endif?>">
													<input type="radio" name="join_mobile" value="1"  <?php if($d['member']['join_mobile']):?>checked<?php endif?> id="option3" /> 지원함
												</label>
												<label class="btn btn-light <?php if(!$d['member']['join_mobile']):?>active<?php endif?>">
													<input type="radio" name="join_mobile" value="0" <?php if(!$d['member']['join_mobile']):?>checked<?php endif?> id="option4" /> 지원 안함
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>가입시 소속그룹</label>
										<select name="join_group" class="form-control custom-select">
												<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
													<?php while($_S=db_fetch_array($_SOSOK)):?>
															<option value="<?php echo $_S['uid']?>"<?php if($_S['uid']==$d['member']['join_group']):?> selected="selected"<?php endif?>><?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
													<?php endwhile?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group error">
										<label>가입시 회원등급</label>
										<select name="join_level" class="form-control custom-select">
															<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
											<?php while($_L=db_fetch_array($_LEVEL)):?>
											<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['member']['join_level']):?> selected="selected"<?php endif?>><?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>)</option>
											<?php if($_L['gid'])break; endwhile?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>탈퇴데이터 처리</label>
										<div>


											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" class="custom-control-input" id="join_out_1"  name="join_out" value="1" <?php if($d['member']['join_out']==1):?>checked<?php endif?>>
												<label class="custom-control-label" for="join_out_1">즉시삭제</label>
											</div>

											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" class="custom-control-input" id="join_out_2" name="join_out" value="2" <?php if($d['member']['join_out']==2):?>checked<?php endif?>>
												<label class="custom-control-label" for="join_out_2">관리자 확인 후 삭제</label>
											</div>


										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group error">
										<label>탈퇴후 재가입</label>
										<div>

											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" class="custom-control-input" id="join_rejoin_1" name="join_rejoin" value="1" <?php if($d['member']['join_rejoin']):?>checked<?php endif?>>
												<label class="custom-control-label" for="join_rejoin_1">허용함</label>
											</div>

											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" class="custom-control-input" id="join_rejoin_0" name="join_rejoin" value="0" <?php if(!$d['member']['join_rejoin']):?>checked<?php endif?>>
												<label class="custom-control-label" for="join_rejoin_0">허용 안함</label>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>가입시 승인처리</label>
										<select name="join_auth" class="form-control custom-select">
											<option value="1"<?php if($d['member']['join_auth']==1):?> selected="selected"<?php endif?>>즉시승인</option>
											<option value="2"<?php if($d['member']['join_auth']==2):?> selected="selected"<?php endif?>>관리자확인 후 승인</option>
											<option value="3"<?php if($d['member']['join_auth']==3):?> selected="selected"<?php endif?>>이메일인증 후 승인</option>
										 </select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group error">
										<label>가입시 지급포인트</label>
										<input type="number" name="join_point" value="<?php echo $d['member']['join_point']?>" class="form-control" placeholder="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>대표 이메일</label>
										<input type="email" name="join_email" value="<?php echo $d['member']['join_email']?>" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>가입 이메일</label>
										<div>

											<div class="custom-control custom-checkbox">
											  <input type="checkbox" class="custom-control-input" id="join_email_send" name="join_email_send" value="1"<?php if($d['member']['join_email_send']):?> checked="checked"<?php endif?>>
											  <label class="custom-control-label" for="join_email_send">가입안내 이메일 발송</label>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>회원가입 레이아웃</label>
										<select name="layout_join" class="form-control custom-select" id="" tabindex="-1">
											<option value="">사이트 대표레이아웃</option>
											<?php $dirs = opendir($g['path_layout'])?>
											<?php while(false !== ($tpl = readdir($dirs))):?>
											<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
											<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
												<optgroup label="<?php echo $tpl?>">
													<?php while(false !== ($tpl1 = readdir($dirs1))):?>
													<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
													 <option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['member']['layout_join']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>-<?php echo str_replace('.php','',$tpl1)?></option>
													<?php endwhile?>
											 </optgroup>
											<?php closedir($dirs1)?>
											<?php endwhile?>
											<?php closedir($dirs)?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group error">
										<label>로그인 레이아웃</label>
										<select name="layout_login" class="form-control custom-select" id="" tabindex="-1">
											<option value="">사이트 대표레이아웃</option>
											<?php $dirs = opendir($g['path_layout'])?>
											<?php while(false !== ($tpl = readdir($dirs))):?>
											<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
											<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
												<optgroup label="<?php echo $tpl?>">
													<?php while(false !== ($tpl1 = readdir($dirs1))):?>
													<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
													 <option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['member']['layout_login']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>-<?php echo str_replace('.php','',$tpl1)?></option>
													<?php endwhile?>
											 </optgroup>
											<?php closedir($dirs1)?>
											<?php endwhile?>
											<?php closedir($dirs)?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>마이페이지 레이아웃</label>
										<select name="layout_mypage" class="form-control custom-select" id="" tabindex="-1">
											<option value="">사이트 대표레이아웃</option>
											<?php $dirs = opendir($g['path_layout'])?>
											<?php while(false !== ($tpl = readdir($dirs))):?>
											<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
											<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
												<optgroup label="<?php echo $tpl?>">
													<?php while(false !== ($tpl1 = readdir($dirs1))):?>
													<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
													 <option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['member']['layout_mypage']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>-<?php echo str_replace('.php','',$tpl1)?></option>
													<?php endwhile?>
											 </optgroup>
											<?php closedir($dirs1)?>
											<?php endwhile?>
											<?php closedir($dirs)?>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>소속메뉴</label>
										<select name="sosokmenu" class="form-control custom-select">
											<option value="">&nbsp;+ 사용안함</option>
											<?php include_once $g['path_core'].'function/menu1.func.php'?>
											<?php $cat=$d['member']['sosokmenu']?>
											<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
										<div class="col-sm-12">
									<div class="form-group">
										<label>사용제한 닉네임</label>
										<textarea class="form-control" name="join_cutnic" rows="3"><?php echo $d['member']['join_cutnic']?></textarea>
										<small class="form-text text-muted">사용을 제한하려는 닉네임을 콤마(,)로 구분해서 입력해 주세요.</small>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group error">
										<label>가입제한 아이디</label>
										<textarea class="form-control" name="join_cutid" rows="4"><?php echo $d['member']['join_cutid']?></textarea>
										<small class="form-text text-muted">사용을 제한하려는 아이디를 콤마(,)로 구분해서 입력해 주세요.</small>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group error">
										<label>가입제한 이메일</label>
										<textarea class="form-control" name="join_cutemail" rows="4"><?php echo $d['member']['join_cutemail']?></textarea>
										<small class="form-text text-muted">사용을 제한하려는 이메일을 콤마(,)로 구분해서 @URL형식 입력해 주세요.(예: @email.com,@myhome.com)</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>포인트지급 메세지</label>
										<input type="text" name="join_pointmsg" value="<?php echo $d['member']['join_pointmsg']?>" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
								</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4"><i class="fa fa-check"></i> 정보저장</button>
							</div>
					</div>
					<!-- /회원가입 설정 -->

					 <!-- 가입양식 관리 -->
					<div class="tab-pane fade<?php if($_SESSION['member_config_nav']=='signup-form-config'):?> show active<?php endif?>" id="signup-form-config">
						<h3>가입양식 관리</h3>
							<div class="row">
								<div class="col-sm-4">

									<div class="form-group">
										<label>이용약관/개인정보</label>
										<div class="">
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<label class="btn btn-light <?php if(!$d['member']['form_agree']):?>active<?php endif?>">
													<input type="radio" name="form_agree" value="0"  <?php if(!$d['member']['form_agree']):?>checked<?php endif?> id="fa-0"> 생략
												</label>
												<label class="btn btn-light <?php if($d['member']['form_agree']):?>active<?php endif?>">
												<input type="radio" name="form_agree" value="1" <?php if($d['member']['form_agree']):?>checked<?php endif?> id="fa-1"> 동의얻음
												</label>
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label>회원가입 연령제한</label>
										<div>
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<label class="btn btn-light <?php if(!$d['member']['form_age']):?>active<?php endif?>">
													<input type="radio" name="form_age" value="0" <?php if(!$d['member']['form_age']):?>checked<?php endif?> id="age-0"> 연령 제한없음
												</label>
												 <label class="btn btn-light <?php if($d['member']['form_age']):?>active<?php endif?>">
													<input type="radio" name="form_age" value="1" <?php if($d['member']['form_age']):?>checked<?php endif?> id="age-1"> 14세이하 제한
												</label>
											</div>
										</div>
									</div>
								 </div>

								<div class="col-sm-4">
									<div class="form-group">
										<label>외국인가입</label>
										<div class="">
											<div class="btn-group btn-group-toggle" data-toggle="buttons">
												<label class="btn btn-light <?php if(!$d['member']['form_foreign']):?>active<?php endif?>">
													<input type="radio" name="form_foreign" value="0" <?php if(!$d['member']['form_foreign']):?>checked<?php endif?> id="en-0"> 허용안함
												</label>
												<label class="btn btn-light <?php if($d['member']['form_foreign']):?>active<?php endif?>">
													<input type="radio" name="form_foreign" value="1" <?php if($d['member']['form_foreign']):?>checked<?php endif?> id="en-1"> 허용함
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>직업군</label>
								<textarea name="job" class="form-control" rows="5"><?php readfile($g['path_module'].$module.'/var/job.txt')?></textarea>
							</div>

							<div class="card mt-3">
								<div class="card-header">
									노출항목 및 옵션
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<?php $opset = array('id'=>'아이디','email'=>'이메일','password'=>'패스워드','name'=>'이름','nic'=>'닉네임','birth'=>'생년월일','sex'=>'성별')?>
											<?php $i=0;foreach($opset as $_key => $_val):?>
										   <fieldset <?php echo $i<4?'disabled':''?>>
											 <?php if($i<4):?>
											<div class="custom-control custom-checkbox custom-control-inline" style="min-width: 80px">
												<input type="checkbox" class="custom-control-input" id="customCheck1" checked>
												<label class="custom-control-label" for="customCheck1"><?php echo $_val?></label>
											</div>
											 <i class="fa fa-long-arrow-right fa-lg text-muted pr-3"></i>
											 <div class="custom-control custom-checkbox custom-control-inline" style="min-width: 80px">
 												<input type="checkbox" class="custom-control-input" id="customCheck2" checked>
 												<label class="custom-control-label" for="customCheck2">필수입력</label>
 											 </div>

											 <?php else:?>
												 <div class="custom-control custom-checkbox custom-control-inline" style="min-width: 80px">
	 												<input type="checkbox" class="custom-control-input" id="form_<?php echo $_key?>" name="form_<?php echo $_key?>" value="1"<?php if($d['member']['form_'.$_key]):?> checked<?php endif?>>
	 												<label class="custom-control-label" for="form_<?php echo $_key?>"><?php echo $_val?></label>
	 											 </div>
												 <i class="fa fa-long-arrow-right fa-lg text-muted pr-3"></i>
												 <div class="custom-control custom-checkbox custom-control-inline" style="min-width: 80px">
	 												<input type="checkbox" class="custom-control-input" id="form_<?php echo $_key?>_p" name="form_<?php echo $_key?>_p" value="1"<?php if($d['member']['form_'.$_key.'_p']):?> checked<?php endif?>>
	 												<label class="custom-control-label" for="form_<?php echo $_key?>_p">필수입력</label>
	 											 </div>

											 <?php endif?>
										 		</fieldset>
										 <?php $i++;endforeach?>
										</div>
										<div class="col-sm-6">
											<?php $opset = array('qa'=>'패스워드찾기 질답','home'=>'홈페이지','tel1'=>'집전화','tel2'=>'휴대폰','job'=>'직업','marr'=>'결혼기념일','addr'=>'주소')?>
											<?php foreach($opset as $_key => $_val):?>
											<fieldset>

												<div class="custom-control custom-checkbox custom-control-inline" style="min-width: 100px">
		 											<input type="checkbox" class="custom-control-input" id="form_<?php echo $_key?>" name="form_<?php echo $_key?>" value="1"<?php if($d['member']['form_'.$_key]):?> checked<?php endif?>>
		 											<label class="custom-control-label" for="form_<?php echo $_key?>"><?php echo $_val?></label>
		 										 </div>

			 								 <i class="fa fa-long-arrow-right fa-lg text-muted pr-3"></i>

											 <div class="custom-control custom-checkbox custom-control-inline">
	 											<input type="checkbox" class="custom-control-input" id="form_<?php echo $_key?>_p" name="form_<?php echo $_key?>_p" value="1"<?php if($d['member']['form_'.$_key.'_p']):?> checked<?php endif?>>
	 											<label class="custom-control-label" for="form_<?php echo $_key?>_p">필수입력</label>
	 										 </div>

											</fieldset>
											<?php endforeach?>
										</div>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-outline-primary btn-block btn-lg mb-4"><i class="fa fa-check"></i> 정보저장</button>
					</div>
					 <!-- /가입양식 관리 -->

					 <!-- 가입항목 추가 -->
					 <div class="tab-pane fade<?php if($_SESSION['member_config_nav']=='signup-form-add'):?> show active<?php endif?>" id="signup-form-add">
						 <h3>가입항목 추가</h3>
						 <div class="mb-4">
								<ul class="text-muted small pl-3">
									<li>회원가입 폼에 기본양식외의 필요한 입력양식이 있을 경우 추가해 주세요.</li>
									<li>입력양식 추가는 반드시 회원가입 서비스를 정식으로 오픈하기 전에 셋팅해 주세요.</li>
									<li>서비스도중 양식을 추가하면 이미 가입한 회원에 대해서는 반영되지 않습니다.</li>
									<li>회원검색용도로 양식을 추가하는 것은 권장하지 않습니다.</li>
								 </ul>
						 </div>
						 <div class="table-responsive">
							 <table class="table">
								<thead>
									<tr>
										<th colspan="2" class="text-center">명칭</th>
										<th class="text-center">형식</th>
										<th class="text-center">값/속성 <a href="#value-guide" data-toggle="collapse" class="muted-link"><i class="fa fa-question-circle"></i></a></th>
										<th class="text-center">필수</th>
										<th class="text-center">숨김</th>
									</tr>
								</thead>
								<tbody>
									<?php $_add = file($g['path_module'].$module.'/var/add_field.txt')?>
									<?php foreach($_add as $_key):?>
									<?php $_val = explode('|',trim($_key))?>

									<tr>
									<td><input type="button" value="삭제" class="btn btn-danger" onclick="delField(this.form,'<?php echo $_val[0]?>');"></td>
									<td><input type="text" name="add_name_<?php echo $_val[0]?>" size="13" value="<?php echo $_val[1]?>" class="form-control"></td>
									<td>
										<input type="checkbox" name="addFieldMembers[]" value="<?php echo $_val[0]?>" checked="checked" class="d-none">
										<select name="add_type_<?php echo $_val[0]?>" class="form-control custom-select">
											<option value="text"<?php if($_val[2]=='text'):?> selected="selected"<?php endif?>>TEXT</option>
											<option value="password"<?php if($_val[2]=='password'):?> selected="selected"<?php endif?>>PASSWORD</option>
											<option value="select"<?php if($_val[2]=='select'):?> selected="selected"<?php endif?>>SELECT</option>
											<option value="radio"<?php if($_val[2]=='radio'):?> selected="selected"<?php endif?>>RADIO</option>
											<option value="checkbox"<?php if($_val[2]=='checkbox'):?> selected="selected"<?php endif?>>CHECKBOX</option>
											<option value="textarea"<?php if($_val[2]=='textarea'):?> selected="selected"<?php endif?>>TEXTAREA</option>
										</select>
									</td>
									<td><input type="text" name="add_value_<?php echo $_val[0]?>" size="30" value="<?php echo $_val[3]?>" class="form-control"/></td>
								<!-- 	<td><input type="text" name="add_size_<?php echo $_val[0]?>" size="4" value="<?php echo $_val[4]?>" class="form-control" /></td>
								 필요할 경우 주석제거-->	<td>
									 <label class="custom-control custom-checkbox">
										 <input type="checkbox" class="custom-control-input" name="add_pilsu_<?php echo $_val[0]?>" value="1"<?php if($_val[5]):?> checked="checked"<?php endif?>>
										 <span class="custom-control-indicator"></span>
									 </label>
									<td>
										<div class="checkbox add-field-chk">
											<label>
												 <input type="checkbox" name="add_hidden_<?php echo $_val[0]?>" value="1"<?php if($_val[6]):?> checked="checked"<?php endif?>></td>
												</label>
										 </div>
									</tr>
									<?php endforeach?>
									<tr class="active">
										<td><button type="button" class="btn btn-outline-secondary"  onclick="addField(this.form);">추가</button></td>
										<td><input type="text" name="add_name" class="form-control" placeholder=""></td>
										<td>
											<select name="add_type" class="form-control custom-select">
												<option value="text">TEXT</option>
												<option value="password">PASSWORD</option>
												<option value="select">SELECT</option>
												<option value="radio">RADIO</option>
												<option value="checkbox">CHECKBOX</option>
												<option value="textarea">TEXTAREA</option>
											</select>
										</td>
										<td><input type="text" name="add_value" class="form-control" placeholder=""></td>
										<!-- <td><input type="text" name="add_size" class="form-control" placeholder=""></td>  필요할 경우 주석제거-->
										<td class="text-center align-middle">

											<div class="custom-control custom-checkbox">
											  <input type="checkbox" class="custom-control-input" id="add_pilsu" name="add_pilsu">
											  <label class="custom-control-label" for="add_pilsu"></label>
											</div>

										</td>
										<td class="text-center align-middle">

											<div class="custom-control custom-checkbox">
											  <input type="checkbox" class="custom-control-input" id="add_hidden" name="add_hidden">
											  <label class="custom-control-label" for="add_hidden"></label>
											</div>


										</td>
									</tr>
								</tbody>
							 </table>
							 <p class="collapse bg-light p-3 text-muted border-light small" id="value-guide">
									<code>input</code> 의 경우 해당 값이 되므로 입력하지 않는 것이 일반적입니다. <br>
									<code>select</code><code>radio</code><code>checkbox</code> 의 경우 선택항목이 되며 콤마(,)로 구분하시면 됩니다.
							 </p>
						 </div>

						 <h4 class="mt-4">미리보기</h4>
						 <div id="preview">



								<!-- 추가필드 시작 -->
									 <?php foreach($_add as $_key):?>
									 <?php $_val = explode('|',trim($_key))?>
									 <?php if(!$_val[0]) continue?>
											 <div class="form-group">
													 <label  for="<?php echo $_val[0]?>" class="col-sm-3 control-label"><?php echo $_val[1]?></label>
													<div class="col-sm-8">
																<!-- 일반 input=text -->
															<?php if($_val[2]=='text'):?>
																	<input type="text" id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" value="<?php echo $_val[3]?>" class="form-control"/>
															<?php endif?>

															<!-- password input=text -->
															<?php if($_val[2]=='password'):?>
																	 <input type="password" id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" value="<?php echo $_val[3]?>" class="form-control" />
															<?php endif?>

																			 <!-- select box -->
															<?php if($_val[2]=='select'): $_skey=explode(',',$_val[3])?>
																<select name="add_<?php echo $_val[0]?>" id="<?php echo $_val[0]?>" class="form-control">
																	<option value="">&nbsp;+ 선택하세요</option>
																	<?php foreach($_skey as $_sval):?>
																	<option value="<?php echo trim($_sval)?>">ㆍ<?php echo trim($_sval)?></option>
																	<?php endforeach?>
																</select>
															<?php endif?>

															<!-- input=radio -->
															<?php if($_val[2]=='radio'): $_skey=explode(',',$_val[3])?>
																<?php foreach($_skey as $_sval):?>
																		<label class="radio-inline">
																			<input type="radio" name="add_<?php echo $_val[0]?>" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
																			 </label>
																 <?php endforeach?>
															<?php endif?>

															<!-- input=checkbox -->
															<?php if($_val[2]=='checkbox'): $_skey=explode(',',$_val[3])?>
																	<?php foreach($_skey as $_sval):?>
																		 <label class="checkbox-inline">
																				 <input type="checkbox" name="add_<?php echo $_val[0]?>[]" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
																		 </label>
																		<?php endforeach?>
															<?php endif?>

															<!-- textarea -->
															<?php if($_val[2]=='textarea'):?>
															<textarea id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" rows="5" class="form-control"><?php echo $_val[3]?></textarea>
															<?php endif?>

																	 </div> <!-- .col-sm-8 -->
													</div> <!-- .form-group -->
													<?php endforeach?>


							<p class="text-muted small">
							* 숨김처리한 것은 실제 가입폼에서는 안보입니다.
							</p>
						 </div>  <!-- #preview -->
							<hr>
							<div class="text-center">
								<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4"><i class="fa fa-check"></i> 정보저장</button>
							</div>
					</div>
					 <!-- /가입항목 추가 -->

					 <!-- 개인정보 설정 -->

					<div class="tab-pane fade<?php if($_SESSION['member_config_nav']=='settings'):?> show active<?php endif?>" id="settings">
						<h3>개인정보 설정</h3>

							<div class="form-group">
								<label>로그인 페이지 옵션</label>
								<div class="">

									<div class="custom-control custom-checkbox custom-control-inline">
									  <input type="checkbox" class="custom-control-input" id="login_emailid" name="login_emailid" value="1"<?php if($d['member']['login_emailid']):?> checked="checked"<?php endif?>>
									  <label class="custom-control-label" for="login_emailid">이메일 아이디 사용</label>
									</div>

									<div class="custom-control custom-checkbox custom-control-inline">
									  <input type="checkbox" class="custom-control-input" id="use_login_cookie" name="use_login_cookie" value="1" <?php if($d['member']['use_login_cookie']):?> checked="checked"<?php endif?>>
									  <label class="custom-control-label" for="use_login_cookie">로그인 유지 기능 사용</label>
									</div>

								</div>
							</div>

							<div class="form-group">
							 <label>로그인 유지기간</label>
							 <div class="input-group w-25">
								 <input type="text" name="login_expire" value="<?php echo $d['member']['login_expire']?>" size="5" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text">일</span>
									</div>
							 </div>
						 </div>


							<hr>
							<div class="text-center">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4"><i class="fa fa-check"></i> 정보저장</button>
								</div>
							</div>
					</div>
					 <!-- /로그인/프로필 -->

					 <!-- 약관/안내메시지 -->
					<div class="tab-pane fade<?php if($_SESSION['member_config_nav']=='terms'):?> show active<?php endif?>" id="terms">
						<h3>약관/안내 메시지</h3>
							<div id="accordion">
								<div class="card mb-2">
									<div class="card-header" role="tab">
							      <h5 class="h6 mb-0">
							        <a class="d-block muted-link" data-toggle="collapse" href="#terms-1" aria-expanded="true">
							          홈페이지 이용약관
							        </a>
							      </h5>
							    </div>

									<div class="collapse show" id="terms-1" data-parent="#accordion">
										<div class="card-body">
											 <textarea name="agree1" class="form-control" rows="15"><?php readfile($g['path_module'].$module.'/var/agree1.txt')?></textarea>
										</div>
									</div>
								</div>
								<div class="card mb-2">

									<div class="card-header" role="tab">
							      <h5 class="h6 mb-0">
							        <a class="d-block muted-link collapsed" data-toggle="collapse" href="#terms-2" aria-expanded="false">
							          정보수집/이용목적
							        </a>
							      </h5>
							    </div>

									<div class="collapse" id="terms-2" data-parent="#accordion">
										<div class="card-body">
											<textarea name="agree2" class="form-control" rows="15"><?php readfile($g['path_module'].$module.'/var/agree2.txt')?></textarea>
										</div>
									</div>
								</div>
								<div class="card mb-2">

									<div class="card-header" role="tab">
							      <h5 class="h6 mb-0">
							        <a class="d-block muted-link collapsed" data-toggle="collapse" href="#terms-3" aria-expanded="false">
							          개인정보수집항목
							        </a>
							      </h5>
							    </div>

									<div class="collapse" id="terms-3" data-parent="#accordion">
										<div class="card-body">
													 <textarea name="agree3" class="form-control" rows="8"><?php readfile($g['path_module'].$module.'/var/agree3.txt')?></textarea>
										</div>
									</div>
								</div>
								<div class="card mb-2">

									<div class="card-header" role="tab">
							      <h5 class="h6 mb-0">
							        <a class="d-block muted-link collapsed" data-toggle="collapse" href="#terms-4" aria-expanded="false">
							          정보보유/이용기간
							        </a>
							      </h5>
							    </div>

									<div class="collapse" id="terms-4" data-parent="#accordion">
										<div class="card-body">
											 <textarea name="agree4" class="form-control" rows="15"><?php readfile($g['path_module'].$module.'/var/agree4.txt')?></textarea>
										</div>
									</div>
								</div>

								<div class="card mb-2">

									<div class="card-header" role="tab">
							      <h5 class="h6 mb-0">
							        <a class="d-block muted-link collapsed" data-toggle="collapse" href="#terms-5" aria-expanded="false">
							          개인정보위탁처리
							        </a>
							      </h5>
							    </div>

									<div class="collapse" id="terms-5" data-parent="#accordion">
										<div class="card-body">
											<textarea name="agree5" class="form-control" rows="15"><?php readfile($g['path_module'].$module.'/var/agree5.txt')?></textarea>
										</div>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-outline-primary btn-block btn-lg my-4"><i class="fa fa-check"></i> 정보저장</button>

					</div>
					<!-- 약관/안내메시지 -->

				</div>


		</div>

	</div><!-- /.row -->
	</form>


</div>





<script type="text/javascript">

var notify_result = Cookies.get('member_config_result')  // 결과 가져오기
if (notify_result == 'success') {
	setTimeout(function(){
		$.notify('설정이 변경 되었습니다.');
	}, 500);
}
Cookies.remove('member_config_result');  // 결과 초기화


function addField(f)
{
	if (f.add_name.value == '')
	{
		alert('명칭을 입력해 주세요.  ');
		f.add_name.focus();
		return false;
	}
	saveCheck(f);
}
function delField(f,dval)
{
	if (confirm('정말로 삭제하시겠습니까?   '))
	{
		var l = document.getElementsByName('addFieldMembers[]');
		var n = l.length;
		var i;

		for (i = 0; i < n; i++)
		{
			if (dval == l[i].value)
			{
				l[i].checked = false;
			}
		}
		saveCheck(f);
	}
}

// 환경설정 탭 클릭시 이베트 _join_menu 값을 변경한다.
$('.list-group-item-action').on('click',function(){
	 var id=$(this).attr('id');
	 var id_arr=id.split('_');
	 var _join_menu=id_arr[1];
	 $('input[name="_join_menu"]').val(_join_menu);
});

// 약관/안내메세지 클릭시 이벤트 _join_tab 값을 변경한다.
$('.agree-tab').on('click',function(){
    var href=$(this).attr('href');
    var _join_tab=href.replace('#','');
	 $('input[name="_join_tab"]').val(_join_tab);
});

function saveCheck(f)
{

	if (f.join_auth && f.join_auth.value == '3')
	{
		if (f.join_email.value == '')
		{
			alert('이메일 인증을 설정하시려면 대표이메일을 반드시 등록해야 합니다.   ');
			f.join_email.focus();
			return false;
		}
	}
	if (f.join_email_send && f.join_email_send.checked == true)
	{
		if (f.join_email.value == '')
		{
			alert('가입 이메일을 발송 하시려면 대표 이메일을 반드시 등록해야 합니다.   ');
			f.join_email.focus();
			return false;
		}
	}
	var _join_menu=$('input[name="_join_menu"]').val();
	if(_join_menu==5) f.a.value='agreesave';
	else f.a.value='member_config';
	getIframeForAction(f);
	f.submit();
}

// 폼 전송 환경설정 탭/컨텐츠 보여주기  & 약관/안내메시지 탭/컨텐츠 보여주기
$(document).ready(function() {
  var _join_menu='<?php echo $_SESSION['_join_menu']?>'; // 환경설정 메뉴 값
  var _join_tab='<?php echo $_SESSION['_join_tab']?>'; // 약관/안내메세지 값
  var tab_arr={"1":"signup-config","2":"signup-form-config","3":"signup-form-add","4":"profile","5":"terms"}; // 환경설정 메뉴탭 배열

  // 환경설정 메뉴탭
  $('.tab-div a').each(function(){
       $(this).removeClass('active'); // 모든 탭 active 초기화
  });
  $('.tab-div a[href="#'+tab_arr[_join_menu]+'"]').addClass('active'); // 해당 탭 active 추가
  $('.tab-div a[href="#'+tab_arr[_join_menu]+'"]').tab('show'); // 해당 탭 컨텐츠 보여주기

  // 약관/안내 메세지 탭
   $('.agree-tab').each(function(){
   	    var content=$(this).attr('href');
        $(this).addClass('collapsed'); // 전체 탭 초기화
        $(content).removeClass('show'); // 전체 탭 컨텐츠 초기화
   });
  $('#'+_join_tab).removeClass('collapsed'); // 해당 탭 활성화
  $('#'+_join_tab).addClass('show'); // 해당 탭 컨텐츠 보여주기

});


//]]>
</script>