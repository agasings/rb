<!-- 5. 모달 : 설정 -->
<div id="modal-settings" class="modal">

  <div class="page center" id="page-settings-main">
    <header class="bar bar-nav bg-white px-0">
      <a class="icon icon-close pull-left px-3" data-history="back" role="button"></a>
      <h1 class="title" data-history="back">설정</h1>
    </header>

  	<main class="content bg-faded">

      <ul class="table-view bg-white m-t-0 border-top-0">
  			<li class="table-view-cell">
  		    <a class="navigate-right" data-toggle="page" data-start="#page-main" href="#page-profile">

  					<?php if($d['member']['form_settings_avatar']):?>
  					<img class="media-object pull-left img-circle bg-faded" data-role="avatar" src="<?php echo getAvatarSrc($my['uid'],'100') ?>" width="49">
  					<?php endif; ?>

  		      <div class="media-body">

  						<?php if (!$my['nic']): ?>
  						<span data-role="name"><?php echo $my['name'] ?></span>
  						<?php else: ?>
  						<span data-role="nic"><?php echo $my['nic'] ?></span>
  						<?php endif; ?>
  						<?php if ($my['admin']): ?><span class="badge badge-danger badge-outline">ADMIN</span><?php endif; ?>
  		        <p> <?php echo $d['member']['form_settings_nic']?'닉네임과 ':'' ?>사진을 변경해 보세요.</p>
  		      </div>
  		    </a>
  		  </li>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-account" data-start="#page-settings-main" data-title="회원계정">
  					<span class="badge badge-default badge-inverted"><?php echo $my['id'] ?></span>
  					<i class="fa fa-user fa-fw text-muted mr-1" aria-hidden="true"></i> 회원계정
  				</a>
  			</li>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-email" data-start="#page-settings-main" data-title="이메일 관리">
  					<span class="badge badge-default badge-inverted"><?php echo $my['email']?$my['email']:'미등록' ?></span>
  					<i class="fa fa-envelope fa-fw mr-1 text-muted" aria-hidden="true"></i> 이메일
  				</a>
  			</li>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-phone" data-start="#page-settings-main" data-title="휴대폰 관리">
  					<span class="badge badge-default badge-inverted"><?php echo $my['phone']?$my['phone']:'미등록' ?></span>
  					<i class="fa fa-mobile fa-lg fa-fw text-muted" aria-hidden="true"></i> 휴대폰
  				</a>
  			</li>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-noti" data-start="#page-settings-main" data-title="알림설정">
  					<?php if ($nt_web==''): ?>
  					<span class="badge badge-primary badge-pill">ON</span>
  					<?php else: ?>
  					<span class="badge badge-default badge-outline">OFF</span>
  					<?php endif; ?>
  					<i class="fa fa-bell fa-fw mr-1 text-muted" aria-hidden="true"></i> 알림설정
  				</a>
  			</li>
  			<!-- 소셜미디어 연결 -->
  			<?php if ($d['member']['login_social']): ?>
  			<?php $isSNSlogin = getDbData($table['s_mbrsns'],'memberuid='.$my['uid'],'*'); ?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-connect" data-start="#page-settings-main" data-title="연결계정 관리">
  					<span class="badge badge-inverted">
  						<?php if ($my_naver['uid']): ?><img class="rounded-circle" src="/_core/images/sns/naver.png" alt="네이버" width="22"><?php endif; ?>
  						<?php if ($my_kakao['uid']): ?><img class="rounded-circle" src="/_core/images/sns/kakao.png" alt="카카오" width="22"><?php endif; ?>
  						<?php if ($my_google['uid']): ?><img class="rounded-circle" src="/_core/images/sns/google.png" alt="구글" width="22"><?php endif; ?>
  						<?php if ($my_facebook['uid']): ?><img class="rounded-circle" src="/_core/images/sns/facebook.png" alt="페이스북" width="22"><?php endif; ?>
  						<?php if ($my_instagram['uid']): ?><img class="rounded-circle" src="/_core/images/sns/instagram.png" alt="인스타그램" width="22"><?php endif; ?>
  					</span>
  					<i class="fa fa-user-plus fa-fw mr-1 text-muted" aria-hidden="true"></i> 연결계정
  				</a>
  			</li>
  			<?php endif; ?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-shipping" data-start="#page-settings-main" data-title="배송지 관리">
  					<span class="badge badge-default badge-inverted">
  						<?php echo $my_shipping_num?number_format($my_shipping_num).' 곳':'미등록'?>
  					</span>
  					<i class="fa fa-truck fa-fw text-muted mr-1" aria-hidden="true"></i> 배송지 관리
  				</a>
  			</li>
  			<li class="table-view-divider">
  				<i class="fa fa-address-card-o fa-fw mr-1" aria-hidden="true"></i> 개인정보
  			</li>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" href="#page-settings-name" data-start="#page-settings-main" data-title="이름">
  					<span class="badge badge-default badge-inverted" data-role="name"><?php echo $my['name'] ?></span>
  					이름
  				</a>
  			</li>

  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-tel1" data-title="유선전화">
  					<?php if ($my['tel1']): ?>
  					<span class="badge badge-default badge-inverted" data-role="tel1"><?php echo $my['tel1'] ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="tel1">미등록</span>
  					<?php endif; ?>
  					유선전화
  				</a>
  			</li>

  			<?php if($d['member']['form_settings_birth']):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-birth" data-title="생년월일">
  					<?php if ($my['birth1']): ?>
  					<span class="badge badge-default badge-inverted" data-role="birth"><?php echo $my['birth1'] ?>.<?php echo substr($my['birth2'],0,2) ?>.<?php echo substr($my['birth2'],2,4) ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="birth">미등록</span>
  					<?php endif; ?>
  					생년월일
  				</a>
  			</li>
  			<?php endif?>

  			<?php if($d['member']['form_settings_sex']):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-sex" data-title="성별">
  					<?php if ($my['sex']): ?>
  					<span class="badge badge-default badge-inverted" data-role="sex"><?php echo $my['sex']==1?'남성':'여성' ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="sex">미등록</span>
  					<?php endif; ?>
  					성별
  				</a>
  			</li>
  			<?php endif?>

  			<?php if($d['member']['form_settings_bio']):?>
  			<li class="table-view-cell">
  		    <a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-bio" data-title="간단소개">
  		      <div class="media-body">
  		        간단소개
  		        <p data-role="bio"><?php echo $my['bio']?></p>
  		      </div>
  					<?php if (!$my['bio']): ?>
  					<span class="badge badge-default badge-inverted" data-role="_bio">미등록</span>
  					<?php endif; ?>
  		    </a>
  		  </li>
  			<?php endif?>

  			<?php if($d['member']['form_settings_home']):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-home">
  					<?php if ($my['home']): ?>
  					<span class="badge badge-default badge-inverted" data-role="home"><?php echo $my['home'] ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="home">미등록</span>
  					<?php endif; ?>
  					홈페이지
  				</a>
  			</li>
  			<?php endif?>

  			<?php if($d['member']['form_settings_job']):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-job">
  					<?php if ($my['job']): ?>
  					<span class="badge badge-default badge-inverted" data-role="job"><?php echo $my['job'] ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="job">미등록</span>
  					<?php endif; ?>
  					직업
  				</a>
  			</li>
  			<?php endif?>

  			<?php if($d['member']['form_settings_marr']):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-marr">
  					<?php if ($my['marr1']): ?>
  					<span class="badge badge-default badge-inverted" data-role="marr"><?php echo $my['marr1'] ?>.<?php echo substr($my['marr2'],0,2) ?>.<?php echo substr($my['marr2'],2,4) ?></span>
  					<?php else: ?>
  					<span class="badge badge-default badge-inverted" data-role="marr">미등록</span>
  					<?php endif; ?>
  					결혼기념일
  				</a>
  			</li>
  			<?php endif?>

  			<?php if($_add):?>
  			<li class="table-view-cell">
  				<a class="navigate-right" data-toggle="page" data-start="#page-settings-main" href="#page-settings-addfield">
  					추가정보
  				</a>
  			</li>
  			<?php endif?>
  		</ul>

      <ul class="table-view bg-white mb-2">
        <li class="table-view-cell">
          <a class="" href="#popup-logout" data-toggle="popup">
            로그아웃
          </a>
        </li>
      </ul>

  	</main>
  </div><!-- /.page -->


  <div class="page right" id="page-settings-account">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">회원계정</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-email">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">이메일 관리</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-phone">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">휴대폰 관리</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-noti">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">알림설정</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-connect">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">연결계정 관리</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-shipping">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">배송지 관리</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-name">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title">이름</span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-tel1">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title"></span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

  <div class="page right" id="page-settings-bio">
    <header class="bar bar-nav bar-light bg-white px-0">
      <a class="icon pull-left material-icons px-3" role="button" data-history="back">arrow_back</a>
      <span class="title title-left" data-history="back" data-role="title"></span>
    </header>
    <main class="center">

    </main>
  </div><!-- /.page -->

</div><!-- /.modal -->
