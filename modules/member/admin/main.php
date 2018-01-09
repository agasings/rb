<?php
function getMDname($id)
{
	global $typeset;
	if ($typeset[$id]) return $typeset[$id].' ('.$id.')';
	else return $id;
}
$typeset = array
(
	'_join'=>'회원가입축하 양식',
	'_auth'=>'이메일인증 양식',
	'_pw'=>'비밀번호요청 양식',
);

$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$SITEN   = db_num_rows($SITES);

$sort	= $sort ? $sort : 'memberuid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;

//사이트선택적용
//$accountQue = $account ? 'a.site='.$account.' and ':'';
$_WHERE ='memberuid>0';
if ($account) $_WHERE .= ' and site='.$account;
if ($d_start) $_WHERE .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $_WHERE .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($auth) $_WHERE .= ' and auth='.$auth;
if ($mygroup) $_WHERE .= ' and mygroup='.$mygroup;
if ($level) $_WHERE .= ' and level='.$level;
if ($now_log) $_WHERE .= ' and now_log='.($now_log-1);
if ($sex) $_WHERE .= ' and sex='.$sex;
if ($comp) $_WHERE .= ' and comp='.$comp;

if ($marr1)
{
	if ($marr1==1) $_WHERE .= ' and marr1=0';
	else $_WHERE .= ' and marr1>0';
}
if ($mailing) $_WHERE .= ' and mailing='.($mailing-1);
if ($sms) $_WHERE .= ' and sms='.($sms-1);

if ($addr0)
{
	$_WHERE .= $addr0!='NULL'?" and addr0='".$addr0."'":" and addr0=''";
}
if ($where && $keyw) $_WHERE .= " and ".$where." like '%".trim($keyw)."%'";

//사이트선택적용
//$RCD = getDbArray($table['s_mbrdata'].' AS a left join '.$table['s_mbrid'].' AS b on memberuid=uid',$_WHERE,'a.*,b.uid,b.id,b.pw',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'].' AS a left join '.$table['s_mbrid'].' AS b on memberuid=uid',$_WHERE);

$RCD = getDbArray($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE);

//$RCD = getDbArray($table['s_mbrdata'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
//$NUM = getDbRows($table['s_mbrdata'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
$autharr = array('','승인','보류','대기','탈퇴');

$xyear1	= substr($date['totime'],0,4);
$xmonth1= substr($date['totime'],4,2);
$xday1	= substr($date['totime'],6,2);
$xhour1	= substr($date['totime'],8,2);
$xmin1	= substr($date['totime'],10,2);
?>

<div class="row no-gutters">

	<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar sidebar-right">

		<!-- 검색폼 -->
		<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="">
			 <input type="hidden" name="r" value="<?php echo $r?>" />
			 <input type="hidden" name="m" value="<?php echo $m?>" />
			 <input type="hidden" name="module" value="<?php echo $module?>" />
			 <input type="hidden" name="front" value="<?php echo $front?>" />

			 <?php if($SITEN>1):?>
			 <div class="border border-primary">
				 <select name="account" class="form-control custom-select border-0" onchange="this.form.submit();">
					 <option value="">전체사이트</option>
					 <?php while($S = db_fetch_array($SITES)):?>
					 <option value="<?php echo $S['uid']?>"<?php if($account==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
					 <?php endwhile?>
					 <?php if(!db_num_rows($SITES)):?>
					 <option value="">등록된 사이트가 없습니다.</option>
					 <?php endif?>
				 </select>
			 </div>
			 <?php endif?>

			 <div id="accordion" role="tablist">
				<div class="card">
					<div class="card-header p-0" role="tab">
						<a class="d-block muted-link<?php if($_SESSION['member_main_collapse']!='search'):?> collapsed<?php endif?>" data-toggle="collapse" href="#collapse_search" aria-expanded="true" aria-controls="collapse_search" onclick="sessionSetting('member_main_collapse','search','','');">
							검색
							<span class="badge badge-pill badge-info pull-right"><?php echo stripslashes($keyw)?></span>
						</a>
					</div>

					<div id="collapse_search" class="collapse<?php if($_SESSION['member_main_collapse']=='search'):?> show<?php endif?>" role="tabpanel" data-parent="#accordion">
						<div class="card-body">

							<div class="form-group">
								<label class="sr-only">검색범위</label>
								<select name="where" class="form-control custom-select">
									<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
									<option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
									<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
								</select>
							</div>
							<div class="form-group">
								<label class="sr-only">검색어</label>
								<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="form-control" placeholder="검색어 입력">
							</div>
							<button class="btn btn-outline-primary btn-block btn-lg" type="submit">검색</button>


						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header p-0" role="tab">
						<a class="d-block muted-link<?php if($_SESSION['member_main_collapse']!='sort'):?> collapsed<?php endif?>" data-toggle="collapse" href="#collapse_sort" aria-expanded="false" aria-controls="collapse_sort" onclick="sessionSetting('member_main_collapse','sort','','');">
							정렬

							<span class="badge badge-pill badge-dark pull-right">
								<?php echo $orderby=='desc'?'내림차순':'오름차순'?>
							</span>

							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='mygroup'): ?>그룹순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='level'): ?>등급순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='point'): ?>보유 포인트순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='usepoint'): ?>사용 포인트순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='cash'): ?>보유 적립금순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='money'): ?>보유 예치금순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='last_log'): ?>최근 접속순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='birth1'): ?>나이순<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sort=='birth2'): ?>생년월일순<?php endif; ?></span>

						</a>
					</div>
					<div id="collapse_sort" class="collapse<?php if($_SESSION['member_main_collapse']=='sort'):?> show<?php endif?>" role="tabpanel" data-parent="#accordion">
						<div class="card-body btn-group-toggle">

							<label class="btn btn-light mb-1<?php if($sort=='memberuid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="memberuid" name="sort"<?php if($sort=='memberuid'):?> checked<?php endif?>> 가입일
							</label>
							 <label class="btn btn-light mb-1<?php if($sort=='mygroup'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="mygroup" name="sort"<?php if($sort=='mygroup'):?> checked<?php endif?>>그룹
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='level'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="level" name="sort"<?php if($sort=='level'):?> checked<?php endif?>>등급
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='point'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="point" name="sort"<?php if($sort=='point'):?> checked<?php endif?>> 보유포인트
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='usepoint'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="usepoint" name="sort"<?php if($sort=='usepoint'):?> checked<?php endif?>> 사용포인트
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='cash'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="cash" name="sort"<?php if($sort=='cash'):?> checked<?php endif?>> 보유적립금
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='money'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="money" name="sort"<?php if($sort=='money'):?> checked<?php endif?>> 보유예치금
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='last_log'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="last_log" name="sort"<?php if($sort=='last_log'):?> checked<?php endif?>> 최근접속
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='birth1'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="birth1" name="sort"<?php if($sort=='birth1'):?> checked<?php endif?>> 나이
							</label>
							<label class="btn btn-light mb-1<?php if($sort=='birth2'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
								<input type="radio" value="birth2" name="sort"<?php if($sort=='birth2'):?> checked<?php endif?>> 생년월일
							</label>

							<div class="btn-group btn-group-sm btn-group-toggle w-100 mt-2" data-toggle="buttons">
								<label class="btn btn-light mb-0 w-50<?php if($orderby=='desc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="desc" name="orderby"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i>내림차순
								</label>
								<label class="btn btn-light mb-0 w-50<?php if($orderby=='asc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="asc" name="orderby"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i>오름차순
								</label>
							</div>


						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header p-0" role="tab">
						<a class="d-block muted-link<?php if($_SESSION['member_main_collapse']!='filter'):?> collapsed<?php endif?>" data-toggle="collapse" href="#collapse_filter" aria-expanded="false" aria-controls="collapse_filter" onclick="sessionSetting('member_main_collapse','filter','','');">
							필터링
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($now_log): ?>현재접속<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($auth): ?>인증<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($mygroup): ?>그룹<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($level): ?>등급<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sex): ?>성별<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($addr0): ?>지역<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($mailing): ?>메일<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($sms): ?>문자<?php endif; ?></span>
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($marr1): ?>결혼<?php endif; ?></span>
						</a>
					</div>
					<div id="collapse_filter" class="collapse<?php if($_SESSION['member_main_collapse']=='filter'):?> show<?php endif?>" role="tabpanel" data-parent="#accordion">
						<div class="card-body">

							<div class="form-row">
								<div class="col-sm-6 mb-2">
									<select name="now_log" class="form-control custom-select" onchange="this.form.submit();">
										<option value="">현재접속</option>
										<option value="2"<?php if($now_log == 2):?> selected="selected"<?php endif?>>온라인</option>
										<option value="1"<?php if($now_log == 1):?> selected="selected"<?php endif?>>오프라인</option>
									</select>
								</div>
								<div class="col-sm-6 mb-2">
									<select name="auth" class="form-control custom-select" onchange="this.form.submit();">
										<option value="">회원인증</option>
										<option value="1"<?php if($auth == 1):?> selected="selected"<?php endif?>><?php echo $autharr[1]?></option>
										<option value="2"<?php if($auth == 2):?> selected="selected"<?php endif?>><?php echo $autharr[2]?></option>
										<option value="3"<?php if($auth == 3):?> selected="selected"<?php endif?>><?php echo $autharr[3]?></option>
										<option value="4"<?php if($auth == 4):?> selected="selected"<?php endif?>><?php echo $autharr[4]?></option>
									</select>
								</div>
								<div class="col-sm-6 mb-2">
									<select name="mygroup"  class="form-control custom-select" onchange="this.form.submit();">
									 <option value="">회원그룹</option>
									 <?php $_GRPARR = array()?>
									 <?php $GRP = getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
									 <?php while($_G=db_fetch_array($GRP)):$_GRPARR[$_G['uid']] = $_G['name']?>
									 <option value="<?php echo $_G['uid']?>"<?php if($_G['uid']==$mygroup):?> selected="selected"<?php endif?>><?php echo $_G['name']?> (<?php echo number_format($_G['num'])?>)</option>
									 <?php endwhile?>
								 </select>
								</div>
								<div class="col-sm-6 mb-2">
									<select name="level"  class="form-control custom-select" onchange="this.form.submit();">
										<option value="">회원등급</option>
										<?php $_LVLARR = array()?>
										<?php $levelnum = getDbData($table['s_mbrlevel'],'gid=1','*')?>
										<?php $LVL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',$levelnum['uid'],1)?>
										<?php while($_L=db_fetch_array($LVL)):$_LVLARR[$_L['uid']] = $_L['name']?>
										<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$level):?> selected="selected"<?php endif?>><?php echo $_L['name']?> (<?php echo number_format($_L['num'])?>)</option>
										<?php endwhile?>
									</select>
								</div>
								<div class="col-sm-6 mb-2">
									<select name="sex"  class="form-control custom-select" onchange="this.form.submit();">
									 <option value="">회원성별</option>
									 <option value="1"<?php if($sex == 1):?> selected="selected"<?php endif?>>남성</option>
									 <option value="2"<?php if($sex == 2):?> selected="selected"<?php endif?>>여성</option>
								 </select>
								</div>

								<div class="col-sm-6 mb-2">
									<?php $addr_arr=array('서울','경기','인천','강원','충남','충북','대전','전남','전북','광주','경남','경북','부산','대구','울산','제주','해외','없음')?>
									<?php $last_i=count($addr_arr)-1;?>
									<select name="addr0"  class="form-control custom-select" onchange="this.form.submit();">
										<option value="">가입지역</option>
										<?php for($i=0;$i<count($addr_arr);$i++):?>
										<option value="<?php echo $i==$last_i?'NULL':$addr_arr[$i]?>"<?php if($addr0 == $addr_arr[$i]):?> selected="selected"<?php endif?>><?php echo $addr_arr[$i]?></option>
										<?php endfor?>
									</select>
								</div>

								<div class="col-sm-6 mb-2">
									<select name="mailing"  class="form-control custom-select" onchange="this.form.submit();">
										<option value="">메일수신</option>
										<option value="2"<?php if($mailing == 2):?> selected="selected"<?php endif?>>동의</option>
										<option value="1"<?php if($mailing == 1):?> selected="selected"<?php endif?>>동의안함</option>
									</select>
								</div>

								<div class="col-sm-6 mb-2">
									<select name="sms"  class="form-control custom-select" onchange="this.form.submit();">
										<option value="">문자수신</option>
										<option value="2"<?php if($sms == 2):?> selected="selected"<?php endif?>>동의</option>
										<option value="1"<?php if($sms == 1):?> selected="selected"<?php endif?>>동의안함</option>
									</select>
								</div>

								<div class="col-sm-6 mb-2">
									<select name="marr1"  class="form-control custom-select" onchange="this.form.submit();">
										<option value="">결혼여부</option>
										<option value="1"<?php if($marr1 == 1):?> selected="selected"<?php endif?>>미혼</option>
										<option value="2"<?php if($marr1 == 2):?> selected="selected"<?php endif?>>기혼</option>
									</select>
								</div>

							</div>


						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header p-0" role="tab">
						<a class="d-block muted-link<?php if($_SESSION['member_main_collapse']!='term'):?> collapsed<?php endif?>" data-toggle="collapse" href="#collapse_term" aria-expanded="false" aria-controls="collapse_term" onclick="sessionSetting('member_main_collapse','term','','');">
							기간별 보기
							<span class="badge badge-pill badge-info pull-right mr-1"><?php if($d_start || $d_finish): ?>설정됨<?php endif; ?></span>
						</a>
					</div>
					<div id="collapse_term" class="collapse<?php if($_SESSION['member_main_collapse']=='term'):?> show<?php endif?>" role="tabpanel" data-parent="#accordion">
						<div class="card-body">


							<div class="input-daterange mb-2" id="datepicker">
								<div class="input-group input-group-sm mb-1">
									<div class="input-group-prepend">
										<span class="input-group-text">시작일</span>
									</div>
									<input type="text" class="form-control" name="d_start" placeholder="선택" value="<?php echo $d_start?>">
								</div>
								<div class="input-group input-group-sm mb-2">
									<div class="input-group-prepend">
										<span class="input-group-text">종료일</span>
									</div>
									<input type="text" class="form-control" name="d_finish" placeholder="선택" value="<?php echo $d_finish?>">
								</div>
								<button class="btn btn-outline-primary btn-block btn-lg" type="submit">검색</button>
							</div>


							<hr>
							<div class="btn-group mb-1">
								<button class="btn btn-light" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>','<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>');">어제</button>
								<button class="btn btn-light" onclick="dropDate('<?php echo getDateFormat($date['today'],'Y/m/d')?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">오늘</button>
								<button class="btn btn-light" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">일주</button>
							</div>

							<div class="btn-group mb-1">
								<button class="btn btn-light" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">한달</button>
								<button class="btn btn-light" onclick="dropDate('<?php echo getDateFormat(substr($date['today'],0,6).'01','Y/m/d')?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">당월</button>
								<button class="btn btn-light" onclick="dropDate('<?php echo date('Y/m/',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>01','<?php echo date('Y/m/',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>31');">전월</button>
								<button class="btn btn-light" onclick="dropDate('','');">전체</button>
							</div>

						</div>
					</div>
				</div>


			<div class="py-4 px-2">
				<a href="<?php echo $g['adm_href']?>" class="btn btn-light btn-block">검색조건 초기화</a>
			</div>


			</div>

		</form>
		<!-- //검색폼 -->


	</div><!-- /.sidebar -->
	<div class="col-sm-8 col-md-8 mr-sm-auto col-xl-9">

		<?php if($NUM):?>
		<div class="card rounded-0 ">
			<div class="card-header d-flex justify-content-between align-items-center border-0">
				<span class="text-muted">
					 총 <?php echo number_format($NUM)?>명
				</span>
				<span class="badge badge-dark"><?php echo $p?>/<?php echo $TPG?>페이지</span>
			</div>
			<!-- //.card-heading -->

			 <form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="">
				<input type="hidden" name="act" value="">
				<input type="hidden" name="auth" value=""> <!-- 승인값 추가 -->
				<input type="hidden" name="pointType" value=""> <!-- 포인트 타입값 추가 -->

				<input type="hidden" name="_WHERE" value="<?php echo $_WHERE?>">
				<input type="hidden" name="_num" value="<?php echo $NUM?>">

				 <!-- 리스트 테이블 시작-->
				 <div class="table-responsive">
					 <table class="table table-hover mb-0 text-center">
	 					<thead>
	 						<tr>
	 							<th class="text-center py-0">
	 								<div class="custom-control custom-checkbox js-tooltip checkAll-member" title="전체선택" style="top: -3px;">
	 									<input type="checkbox" class="custom-control-input" id="checkAll-member">
	 									<label class="custom-control-label" for="checkAll-member"></label>
	 								</div>
	 							</th>
	 							<th class="text-center">번호</th>
	 							<th class="text-center">인증</th>
	 							<th class="text-center">접속</th>
	 							<th>이름</th>
	 							<th>닉네임</th>
	 							<th>아이디</th>
	 							<th class="text-center">등급</th>
	 							<th class="text-center">그룹</th>
								<th>가입일</th>
								<th>최근접속</th>

	 						<?php if($wideview == 'Y'):?>
								<th class="text-center">성별</th>
								<th class="text-center">나이</th>
	 							<th>지역</th>
	 							<th>연락처</th>
	 							<th>이메일</th>
	 							 <th>생년월일</th>
	 							<th>직업</th>
	 							<th>메일</th>
	 							<th>SMS</th>
	 							<th class="text-center">보유P</th>
	 							<th class="text-center">사용P</th>
	 							<th>결혼기념일</th>
	 						<?php endif?>
	 							 </tr>
	 					</thead>
	 					<tbody>
	 						<?php while($R=db_fetch_array($RCD)):?>
	 					  <?php $_R=getUidData($table['s_mbrid'],$R['memberuid'])?>
	 						<tr>	<!-- 라인이 체크된 경우 warning 처리됨  -->
	 							<td class="text-center">

	 								<div class="custom-control custom-checkbox checkAll-member">
	 									<input type="checkbox" class="custom-control-input" id="mbrmembers_<?php echo $R['memberuid']?>" name="mbrmembers[]" onclick="checkboxCheck();"  value="<?php echo $R['memberuid']?>">
	 									<label class="custom-control-label" for="mbrmembers_<?php echo $R['memberuid']?>"></label>
	 								</div>

	 							</td>
	 							<td class="text-center"><?php echo ($NUM-((($p-1)*$recnum)+$_recnum++))?></td>
	 							<td class="text-center"><?php echo $autharr[$R['auth']]?></td>
	 							<td class="text-center"><?php echo $R['now_log']?'<i class="fa fa-circle text-success" title="온라인" data-toggle="tooltip"></i>':'<i class="fa fa-circle text-muted" title="오프라인" data-toggle="tooltip"></i>'?></td>
	 							<td><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-mbrinfo" onmousedown="mbrIdDrop('<?php echo $R['memberuid']?>','profile');"><?php echo $R['name']?></a></td><!-- main -->
	 							<td><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-mbrinfo" onmousedown="mbrIdDrop('<?php echo $R['memberuid']?>','post');"><?php echo $R['nic']?></a></td><!-- post -->
	 							<td><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-mbrinfo" onmousedown="mbrIdDrop('<?php echo $R['memberuid']?>','info');"><?php echo $_R['id']?></a></td><!-- info -->
	 							<td class="text-center"><?php echo $R['level']?></td>
	 							<td class="text-center"><?php echo $_GRPARR[$R['mygroup']]?></td>
	 							 <td><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
	 							 <td title="<?php echo getDateFormat($R['last_log'],'Y.m.d')?>"><?php echo -getRemainDate($R['last_log'])?>일</td>
	 						<?php if($wideview == 'Y'):?>
								<td class="text-center"><?php if($R['sex']) echo getSex($R['sex'])?></td>
								<td class="text-center"><?php if($R['birth1']) echo getAge($R['birth1'])?></td>
	 							<td><?php echo $R['addr0']?></td>
	 							<td><?php echo $R['tel2']?$R['tel2']:$R['tel1']?></td>
	 							<td><?php echo $R['email']?></td>
	 								<td><?php if($R['birth1']):?><?php echo substr($R['birth1'],2,2)?>/<?php echo substr($R['birth2'],0,2)?>/<?php echo substr($R['birth2'],2,2)?><?php endif?></td>
	 							<td><?php echo $R['job']?></td>
	 							<td><?php echo $R['mailing']?'Y':'N'?></td>
	 							<td><?php echo $R['sms']?'Y':'N'?></td>
	 							<td class="text-center"><a href="" data-toggle="modal" data-target="#modal-member-info"><?php echo number_format($R['point'])?></a></td> <!-- 포인트 획득내용 -->
	 							<td class="text-center"><a href="" data-toggle="modal" data-target="#modal-member-info"><?php echo number_format($R['usepoint'])?></a></td> <!-- 포인트 사용내역 -->
	 							<td><?php echo $R['marr1']&&$R['marr2']?getDateFormat($R['marr1'].$R['marr2'],'Y.m.d'):''?></td>
	 							<?php endif?>
	 							 </tr>
	 							 <?php endwhile?>
	 					</tbody>
	 				</table>
				 </div>


					<!-- 리스트 테이블 끝 -->


			 <!--목록에 체크된 항목이 없을 경우  fieldset이 disabled 됨-->
			<div class="card-footer d-flex justify-content-between align-items-center">
				<fieldset id="list-bottom-fset" disabled> <!--목록에 체크된 항목이 없을 경우  fieldset이 disabled 됨-->
					<div class="btn-toolbar">
						<div class="btn-group mr-2">
							<button type="button" class="btn btn-light dropdown-toggle act-btn" data-toggle="dropdown">
								<i class="fa fa-wrench"></i> 관리
							</button>
							<div class="dropdown-menu" role="menu">
								<h6 class="dropdown-header">회원승인 상태변경</h6>
								<a href="#" class="dropdown-item adm-act" id="auth_1">승인</a>
								<a href="#" class="dropdown-item adm-act" id="auth_2">보류</a>
								<a href="#" class="dropdown-item adm-act" id="auth_3">대기</a>
								<a href="#" class="dropdown-item adm-act" id="auth_4">탈퇴</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item adm-act" id="tool_mygroup">그룹 변경</a>
								<a href="#" class="dropdown-item adm-act" id="tool_level">등급 변경</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item adm-act" id="tool_delete"><span class="text-danger">데이터 삭제</span></a>
							</div>
						</div>
						<div class="btn-group mr-2">
							<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-won"></i> 지급/차감
							</button>
							<div class="dropdown-menu" role="menu">
								<a href="#" class="dropdown-item adm-act" id="point_point">포인트</a>
								<a href="#" class="dropdown-item adm-act" id="point_cash">적립금</a>
								<a href="#" class="dropdown-item adm-act" id="point_money">예치금</a>
							</div>
						</div>
						<div class="btn-group mr-2" role="group">
							<a href="#" class="btn btn-light adm-act" id="send_paper"><i class="fa fa-comment"></i> 쪽지</a>
							<a href="#" class="btn btn-light adm-act" id="send_notice"><i class="fa fa-bell"></i> 알림</a>
							<a href="#" class="btn btn-light adm-act" id="send_email"><i class="fa fa-envelope"></i> 메일</a>
						</div>
						<div class="btn-group">
							<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-download"></i> 자료추출
							</button>
							<div class="dropdown-menu dropdown-menu-right" role="menu">
								<a href="#" class="dropdown-item adm-act" id="dump_email">이메일</a>
								<a href="#" class="dropdown-item adm-act" id="dump_tel">연락처</a>
								<a href="#" class="dropdown-item adm-act" id="dump_address">DM주소</a>
								<div class="dropdown-divider"></div>
								<a href="#" class="dropdown-item adm-act" id="dump_alldata">전체 데이터</a>
							</div>
						</div>
					</div>
				</fieldset>
				<button type="button" class="btn btn-light" data-toggle="modal" data-target="#modal-member-add"><i class="fa fa-plus-circle"></i> 회원 추가</button>
			</div> <!-- // .card-footer-->

			<?php include $g['path_module'].$module.'/admin/_tool_modal.php';?>  <!-- 쪽지, 메일, 포인트 지급 모달 인클루드 : form 전에 위치해야 한다. -->
		</form>

		</div>  <!-- // .card-->

		<nav class="d-flex px-3 align-items-center">
			<ul class="pagination mb-0">
				<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
			</ul>

			<div class="ml-auto">

				<div class="btn-group">
					<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-list"></i> <?php echo $recnum?>개씩
					 </button>
					<div class="dropdown-menu dropdown-menu-right" role="menu">
						<a class="dropdown-item<?php $recnum=='20'?' active':''?>" href="<?php echo $g['adm_href']?>&amp;recnum=20">20개 출력</a>
						<a class="dropdown-item<?php $recnum=='35'?' active':''?>" href="<?php echo $g['adm_href']?>&amp;recnum=35">35개 출력</a>
						<a class="dropdown-item<?php $recnum=='50'?' active':''?>" href="<?php echo $g['adm_href']?>&amp;recnum=50">50개 출력</a>
						<a class="dropdown-item<?php $recnum=='75'?' active':''?>" href="<?php echo $g['adm_href']?>&amp;recnum=75">75개 출력</a>
						<a class="dropdown-item<?php $recnum=='90'?' active':''?>" href="<?php echo $g['adm_href']?>&amp;recnum=90">90개 출력</a>
					</div>
				</div>

				<div class="btn-group mb-0">
					<a href="<?php echo '/?'.$_SERVER['QUERY_STRING']?>&amp;p=<?php echo $p-1?>" class="btn btn-light btn-page" <?php echo $p>1?'':'disabled'?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="이전">
						<i class="fa fa-chevron-left fa-lg"></i>
					</a>
					<a href="<?php echo '/?'.$_SERVER['QUERY_STRING']?>&amp;p=<?php echo $p+1?>" class="btn btn-light btn-page" <?php echo $NUM>($p*$recnum)?'':'disabled'?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="다음">
						<i class="fa fa-chevron-right fa-lg"></i>
					</a>
				</div>

			</div>

		</nav>

	<?php else:?>

		<div class="text-center text-muted d-flex align-items-center justify-content-center" style="height: calc(100vh - 10rem);">
			 <div><i class="fa fa-exclamation-circle fa-3x mb-3" aria-hidden="true"></i>
				 <p>조건에 해당하는 회원이 없습니다.</p>
				 <a href="<?php echo $g['adm_href']?>" class="btn btn-light btn-block mt-2">
			 	 	검색조건 초기화
			 	 </a>
			 </div>
		 </div>
	<?php endif?>

	</div>
</div><!-- /.row -->



<?php include $g['path_module'].$module.'/admin/_modal.php';?>
<!-- 코드미러를 먼저 호출하고 난 후에 summernote 호출해야 코드미러가 적용이 됨-->
<!-- include summernote codemirror-->
 <style>
.CodeMirror {
	font-size: 13px;
	font-family: Menlo,Monaco,Consolas,"Courier New",monospace !important;
}
/* 첨부파일 : input-file*/
.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}

</style>
<?php getImport('codemirror','codemirror',false,'css')?>
<?php getImport('codemirror','codemirror',false,'js')?>
<?php getImport('codemirror','theme/monokai',false,'css')?>
<?php getImport('codemirror','mode/htmlmixed/htmlmixed',false,'js')?>
<?php getImport('codemirror','mode/xml/xml',false,'js')?>

<!-- include summernote css/js-->
<?php getImport('summernote','dist/summernote.min',false,'js')?>
<?php getImport('summernote','lang/summernote-ko-KR',false,'js')?>
 <?php getImport('summernote','dist/summernote',false,'css')?>


<!-- bootstrap-datepicker,  http://eternicode.github.io/bootstrap-datepicker/  -->
<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
<!-- bootstrap Validator : 회원추가시 필요-->
<?php getImport('bootstrap-validator','dist/css/bootstrapValidator.min',false,'css')?>
<?php getImport('bootstrap-validator','dist/js/bootstrapValidator.min',false,'js')?>
<script>
$(document).ready(function() {


	$('#collapse_search').on('shown.bs.collapse', function () {
	  $('[name="keyw"]').focus()
	})

    $('#add-form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            id: {
                validators: {
                    notEmpty: {
                        message: '아이디를 입력해주세요.'
                    },
                    regexp: {
                        regexp: /^[a-z0-9]+$/,
                        message: '4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.'
                    }
                }
            },
            pw1: {
                message: 'The password is not valid',
                validators: {
                    notEmpty: {
                        message: '비밀번호를 입력해주세요.'
                    }
                }
            },

            pw2: {
                message: 'The password is not valid',
                validators: {
                    notEmpty: {
                        message: '비밀번호를 다시 입력해주세요.'
                    }
                }
            },
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: '이름(실명)을 입력해주세요.'
                    }
                }
            },
            nic: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: '닉네임을 입력해주세요.'
                    }
                }
            },
            email: {
                message: '',
                validators: {
                    notEmpty: {
                        message: '이메일을 입력해주세요.'
                    }
                }
            },
        }
    });
});
</script>
<script>
 // 관리자 액션버튼 클릭 이벤트
 $('.adm-act').on('click',function(e){
          e.preventDefault();
          var act=$(this).attr('id');
          var act_arr=act.split('_');
          var act_type=act_arr[0];
          var act_sbj=act_arr[1];
          // 액션 타입 분기
          if(act_type=='auth'){
          	var auth=act_sbj; // 승인값 얻고
          	 $('input[name="auth"]').val(auth); // 승인값 입력후
          	 actQue('tool_auth');
          }else if(act_type=='point'){
             var pointType=act_sbj; // 포인트 타입 얻고
             var ptype_arr={"point":"포인트","cash":"적립금","money":"예치금"};
             $('input[name="pointType"]').val(pointType); // 포인트 타입값 입력후
             $('#point_type').text(ptype_arr[pointType]);
             $('#modal-give_point').modal(); // modal 창 출력
          }else if(act_type=='dump'){
          	 actQue(act);  // dump 인 경우 바로 진행
          }else if(act_type=='tool'){  // 등급/그룹/데이터 삭제
             if(act_sbj=='delete') actQue(act); // 데이타 삭제인 경우 바로 실행
             else $('#modal-tool_'+act_sbj).modal(); // 등급/그룹 변경인 경우 modal 창 출력
          }else if(act_type=='send'){
          	  $('#modal-'+act).modal();
          }
 });

  // 모달창에서 최종 폼전송
 function modal_act(obj){
 	   var act=$(obj).attr('id'); // 해당 액션 타입
 	   $(obj).modal('hide'); // 모달 닫고...
         actQue(act);
 }

</script>

<!-- basic -->
<script>

$('.input-daterange').datepicker({
	format: "yyyy/mm/dd",
	todayBtn: "linked",
	language: "kr",
	calendarWeeks: true,
	todayHighlight: true,
	autoclose: true
});
</script>
<script type="text/javascript">
//<![CDATA[
// 툴팁 이벤트
$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
});

// 선택박스 체크 이벤트 핸들러
$(".checkAll-member").click(function(){
	$(".rb-member").prop("checked",$(".checkAll-member").prop("checked"));
	checkboxCheck();
});

// 선택박스 체크시 액션버튼 활성화 함수
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true){
          $(l[i]).parent().parent().addClass('warning'); // 선택된 체크박스 tr 강조표시
			j++;
		}else{
			$(l[i]).parent().parent().removeClass('warning');
		}
	}
	// 하단 회원관리 액션 버튼 상태 변경
	if (j) $('#list-bottom-fset').prop("disabled",false);
	else $('#list-bottom-fset').prop("disabled",true);
}

// 회원 이름,닉네임 클릭시 uid & mod( 탭 정보 : info, main, post 등) 지정하는 함수
var _mbrModalUid;
var _mbrModalMod;
function mbrIdDrop(uid,mod)
{
	_mbrModalUid = uid;
	_mbrModalMod = mod;
}

// 회원정보 modal 호출하는 함수 : 위에서 지정한 회원 uid & mod 로 호출한다 .
$('.rb-modal-mbrinfo').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=member&amp;front=modal.mbrinfo&amp;uid=')?>'+_mbrModalUid+'&amp;tab='+_mbrModalMod);
});

// 회원가입시 유효성 체크
var submitFlag = false;
function sendCheck(id,t)
{
	var f = document.actionform;
	var f1 = document.addForm;

	// if (submitFlag == true)
	// {
	// 	alert('응답을 기다리는 중입니다. 잠시 기다려 주세요      ');
	// 	return false;
	// }
	if (eval("f1."+t).value == '')
	{
		eval("f1."+t).focus();
		return false;
	}
	f.type.value = t;
	f.fvalue.value = eval("f1."+t).value;
	getId(id).innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
	getIframeForAction(f);
	f.submit();
	//submitFlag = true;
}
function saveCheck(f)
{
   if(f.check_id.value==0) {alert('아이디가 유효하지 않습니다.  ');return false;}
   if(f.check_nic.value==0) {alert('닉네임이 유효하지 않습니다.  ');return false;}
   if(f.check_email.value==0) {alert('이메일이 유효하지 않습니다.  ');return false;}

	if (f.pw1.value != f.pw2.value)
	{
		alert('비밀번호가 서로 일치하지 않습니다');
		return false;
	}
	getIframeForAction(f);
	return true;
}
function actQue(flag,ah)
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;

	if (flag == 'admin_delete')
	{
		for	(i = 0; i < n; i++)
		{
			if (l[i].checked == true)
			{
				j++;
			}
		}
		if (!j)
		{
			alert('회원을 선택해주세요.     ');
			return false;
		}

		if (confirm('정말로 실행하시겠습니까?     '))
		{
			getIframeForAction(f);
			f.a.value = flag;
			f.auth.value = ah;
			f.submit();
		}
	}
	return false;
}

function ToolCheck(compo)
{
	frames.editFrame.showCompo();
	frames.editFrame.EditBox(compo);
}
function maildocLoad(obj)
{

}

// 기간 검색 적용 함수
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.d_start.value = date1;
	f.d_finish.value = date2;
	f.submit();
}

//**********************************************  summernote 관련

// 에디터 입력내용 소스창에 적용
function InserHTMLtoEditor(sHTML)
{
	var nHTML = $('#summernote').code();
	$('#summernote').code(nHTML+sHTML);
}

// 에디터 호출
$(document).ready(function() {

      $('#summernote').summernote({
        tabsize: 2,
        styleWithSpan: false,
        height:400,  //  에디터 높이
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true,
        lang : 'ko-KR', // 언어 설정
        toolbar: [
		   //[groupname, [button list]]  : 툴바 그룹 [버튼 id ]  참조 페이지 ==> http://summernote.org/#/features  : 아래 순서대로 노출된다.
	       ['style', ['style']],
	       ['fontstyle', ['fontname','bold','strikethrough','italic','underline', 'clear']],
	       ['fontsize', ['fontsize']],
	       ['color', ['color']],
	       ['height', ['height']],
	       ['Layout', ['ul','ol','paragraph']],
	       ['picture', ['picture']],
	       ['insert', ['link', 'video', 'table','hr']],
		    ['Misc', ['fullscreen','codeview','help']]
		  ],

       // 소스 편집창
		 codemirror: {
			mode: "text/html",
			indentUnit: 4,
			lineNumbers: true,
			matchBrackets: true,
			indentWithTabs: true,
			theme: 'monokai'
	    },
		  // 이미지 바로 넣기
		  onImageUpload: function(files, editor, welEditable) {
          Upload_file('img',files[0],editor,welEditable);
       }

     });
 });

// 첨부파일 업로드 이벤트
$('.file-upload').on('change',function(){
    var file=$(this)[0].files[0];
    Upload_file('',file,'',''); // 아래 파일 업로두 함수 호출
});

/* 파일 업로드 함수
     type : 파일 타입(이미지, 워드,엑셀 등)
*/
 function Upload_file(type,file,editor,welEditable)
 {
 	 data = new FormData();
	 data.append("file",file); // 가상의 "file" 이라는 오브젝트를 만들어서 전송한다.
	 data.append("mbruid","<?php echo $my['uid']?>");
	 data.append("s","<?php echo $s?>");
	 $.ajax({
	     type: "POST",
	     url : rooturl+'/modules/<?php echo $module?>/action/a.upload.php',
	     data:data,
	     cache: false,
		  contentType: false,
		  processData: false,
		  success: function(result) {
	  	   var val = $.parseJSON(result);
	  	   var code=val[0];
	  	   if(code=='100') // code 값이 100 일때만 실행
	  	   {
	  	      var source=val[1];// path + tempname
		  	   // 파일 타입이 이미지인 경우에만 에디터에 이미지 삽입
		  	   if(type=='img') {
		  	       editor.insertImage(welEditable, source);
		      }
	  	   }else{
            var msg=val[1];
            alert(msg);
            return false;
	  	   }

	     } // success
    }); // ajax
 } // function

 //**********************************************  summernote 관련
var submitFlag = false;
function actQue(flag)
{
	var act_arr=flag.split('_');
	var act_type=act_arr[0];
	if (act_type!='dump' && submitFlag == true)
	{
		alert('요청하신 작업을 실행중에 있습니다. 완료될때까지 기다려 주세요.  ');
		return false;
	}

	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;
	var s='';

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true)
		{
			j++;
			s += l[i].value +',';
		}
	}


	//회원인증
	if (flag == 'tool_auth')
	{
		if (f.auth.value == '')
		{
			alert('변경할 회원인증 상태를 선택해 주세요.   ');
			f.auth.focus();
			return false;
		}
	}
	//회원그룹
	if (flag == 'tool_mygroup')
	{
		if (f.mygroup.value == '')
		{
			alert('변경할 회원그룹을 선택해 주세요.   ');
			f.mygroup.focus();
			return false;
		}
	}
	//회원등급
	if (flag == 'tool_level')
	{
		if (f.level.value == '')
		{
			alert('변경할 회원등급을 선택해 주세요.   ');
			f.level.focus();
			return false;
		}
	}
	//회원삭제
	if (flag == 'tool_delete')
	{

	}
	//회원탈퇴
	if (flag == 'tool_out')
	{

	}
	//포인트지급
	if (flag == 'give_point')
	{
      if (f.how.value == '')
		{
			alert('지급 or 차감을 구분해주세요.   ');
			return false;
		}

		if (f.price.value == '')
		{
			alert('금액을 입력해 주세요.   ');
			f.price.focus();
			return false;
		}else{
			// 콤마 제거
         var price=f.price.value;
			price=price.replace(/,/gi,'');
         f.price.value=price;
		}
		if (f.comment.value == '')
		{
			alert('지급사유를 입력해 주세요.   ');
			f.comment.focus();
			return false;
		}

	}
	//쪽지전송
	if (flag == 'send_paper')
	{
		if (parseInt(f._num.value) > 5000)
		{
			alert('쪽지는 한번에 최대 5000명까지만 전송할 수 있습니다.     ');
			return false;
		}
		if (f.memo.value == '')
		{
			alert('내용을 입력해 주세요.   ');
			f.memo.focus();
			return false;
		}
	}
	// 알림전송
	if (flag == 'send_notice')
	{
		if (parseInt(f._num.value) > 5000)
		{
			alert('알림은 한번에 최대 5000명까지만 전송할 수 있습니다.     ');
			return false;
		}
		if (f.notice.value == '')
		{
			alert('내용을 입력해 주세요.   ');
			f.memo.focus();
			return false;
		}
	}
	//메일전송
	if (flag == 'send_email')
	{
		if (parseInt(f._num.value) > 1000)
		{
				alert('이메일은 한번에 최대 1000명까지만 전송할 수 있습니다.     ');
				return false;
		}

		if (f.subject.value == '')
		{
			alert('제목을 입력해 주세요.   ');
			f.subject.focus();
			return false;
		}

      if (f.content.value ==' ')
    	{
			$('.note-editable').focus();
	      alert('내용을 입력해 주세요.       ');
	      return false;
		}
	}
	//이메일추출
	if (flag == 'dump_email')
	{

	}
	//연락처추출
	if (flag == 'dump_tel')
	{

	}
	//DM추출
	if (flag == 'dump_address')
	{

	}
	//전체데이터추출
	if (flag == 'dump_alldata')
	{

	}

	if (confirm('정말로 실행하시겠습니까?        '))
	{
		submitFlag = true;
		f.a.value = 'admin_action';
		f.act.value = flag;
		f.submit();
	}
	else
	{
		return false;
	}
}
//************************   숫자 입력 체크 *******************************************
function RemoveRougeChar(convertString){
    if(convertString.substring(0,1) == ","){
        return convertString.substring(1, convertString.length)
    }
    return convertString;
}

$('.numOnly').on("keyup",function(e){
    // skip for arrow keys
    if(e.which >= 37 && e.which <= 40){
        e.preventDefault();
    }
    var rgx = /[^0-9,]/; // 숫자 체크 정규식
   var han =/[ㄱ-ㅎ가-힣]/; // 한글 체크 정규식
   var num_val=$(this).val(); // 콤마 없는 숫자
    if (num_val.search(rgx) !==-1 || num_val.search(han) ===0)
   {
      alert('숫자로 입력해주세요.');
       $(this).val('');
       $(this).focus();
       return false;
    }
    var $this = $(this);
    var num = $this.val().replace(/[^0-9]+/g, '').replace(/,/gi, "").split("").reverse().join("");
    var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
    $this.val(num2); // 콤마 숫자
});
//************************   숫자 입력 체크 *******************************************


//]]>
</script>
