<nav class="navbar navbar-default rb-navbar<?php if($g['device']):?> navbar-fixed-top<?php endif?>" role="navigation">	<div class="container-fluid">		<div id="_navbar_header_" class="navbar-header">			<button type="button" id="navbar-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">				<span class="sr-only">Toggle navigation</span>				<span class="icon-bar"></span>				<span class="icon-bar"></span>				<span class="icon-bar"></span>			</button>			<?php if($g['device'] && $module == 'dashboard'):?>			<h2>				<a class="navbar-brand" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.shortcut" style="margin-left:0;">					<i class="kf kf-bi-01 fa-lg" style="color:#000;"></i>				</a>			</h2>			<?php else:?>			<h2>				<a class="navbar-brand visible-xs-inline" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard<?php if($g['mobile']&&$_SESSION['pcmode']!='Y'):?>&amp;front=mobile.shortcut<?php endif?>">					<strong><i class="fa <?php echo $module=='dashboard'?'fa-info-circle':'fa-angle-left'?> fa-lg fa-fw"></i><?php echo $MD['id']?></strong>					<small class="text-muted hidden-xs"><?php echo $MD['name']?></small>				</a>			</h2>			<h2>				<a class="navbar-brand hidden-xs" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard<?php if($g['mobile']&&$_SESSION['pcmode']!='Y'):?>&amp;front=mobile.shortcut<?php endif?>">					<strong></i><?php echo $MD[$d['admin']['syslang']=='DEFAULT'?'id':'name']?></strong>					<small class="text-muted hidden-xs<?php if($d['admin']['syslang']=='english'):?> hidden<?php endif?>"><?php echo $MD['name']?></small>				</a>				<?php if($module == 'dashboard' && ($front == 'main' || $front == 'mobile.dashboard')):?>				<i class="glyphicon glyphicon-cog rb-modal-dashboard" title="대시보드 꾸미기" data-tooltip="tooltip" data-toggle="modal" data-target="#modal_window"></i>				<?php endif?>			</h2>			<?php endif?>		</div>		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">			<ul class="nav navbar-nav navbar-right<?php if($g['device']):?> rb-device-margin<?php endif?>">			<?php $exists_bookmark=getDbRows($table['s_admpage'],'memberuid='.$my['uid']." and url='".$g['s'].'/?r='.$r.'&m='.$m.'&module='.$module.'&front='.$front."'")?>			<li class="dropdown">				<a href="#." class="navbar-right navbar-link dropdown-toggle" data-toggle="dropdown">					<i id="_bookmark_star_" class="fa fa-lg fa-star<?php if($exists_bookmark):?> rb-star-fill<?php else:?>-o<?php endif?>"></i> <span class="visible-xs-inline">북마크</span>				</a>				<div class="dropdown-menu rb-toggle-layer rb-notifications-layer">					<div class="panel panel-default">						<div class="panel-heading clearfix">							<h3 class="pull-left panel-title">북마크</h3>							<div class="pull-right">								<div id="_bookmark_notyet_" class="btn-group btn-group-sm dropdown<?php if($exists_bookmark):?> hidden<?php endif?>">									<button type="button" class="btn btn-default rb-bookmark-add">북마크에 추가</button>									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">									<span class="caret"></span>									<span class="sr-only">Toggle Dropdown</span>									</button>									<ul id="rb-bookmark-dropdown1" class="dropdown-menu">									<li><a href="#." class="rb-bookmark-add">북마크에 추가</a></li>									<li class="divider"></li>									<li><a href="#." data-toggle="modal" data-target="#modal_window" class="rb-modal-bookmark">북마크 관리</a></li>									</ul>								</div>								<div id="_bookmark_already_" class="btn-group btn-group-sm dropdown<?php if(!$exists_bookmark):?> hidden<?php endif?>">									<button type="button" class="btn btn-default disabled">추가됨</button>									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">									<span class="caret"></span>									<span class="sr-only">Toggle Dropdown</span>									</button>									<ul id="rb-bookmark-dropdown2" class="dropdown-menu">									<li><a href="#." class="rb-bookmark-del">북마크에서 삭제</a></li>									<li class="divider"></li>									<li><a href="#." data-toggle="modal" data-target="#modal_window" class="rb-modal-bookmark">북마크 관리</a></li>									</ul>								</div>							</div>						</div>						<div id="_add_bookmark_" class="list-group rb-scrollbar">							<?php $ADMPAGE = getDbArray($table['s_admpage'],'memberuid='.$my['uid'],'*','gid','asc',0,1)?>							<?php while($R=db_fetch_array($ADMPAGE)):?>							<a href="<?php echo $R['url']?>" class="list-group-item" id="_now_bookmark_<?php echo $R['uid']?>"><i class="fa fa-fw fa-file-text-o"></i><?php echo $R['name']?></a>							<?php endwhile?>							<?php if(!db_num_rows($ADMPAGE)):?><a class="list-group-item"><i class="fa fa-fw fa-file-text-o"></i>등록된 북마크가 없습니다</a><?php endif?>						</div>						<div class="panel-footer"><a href="#." data-toggle="modal" data-target="#modal_window" class="rb-modal-bookmark">북마크 관리</a></div>					</div>				</div>			</li>			<?php if($module!='dashboard'):?>			<?php @include $g['path_module'].$module.'/var/var.moduleinfo.php' ?>			<li class="dropdown">				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question-circle fa-lg"></i> <span class="visible-xs-inline">모듈정보 <span class="caret"></span></span></a>				<ul class="dropdown-menu" role="menu">				<li role="presentation" class="dropdown-header"><?php echo sprintf('%s 모듈정보',ucfirst($MD['name']))?></li>				<li<?php if($d['moduleinfo']['market']):?>><a href="<?php echo $d['moduleinfo']['market']?>" target="_blank"<?php else:?> class="disabled"><a disabled<?php endif?>><i class="fa fa-shopping-cart fa-fw fa-lg"></i> 마켓보기</a></li>				<li<?php if($d['moduleinfo']['github']):?>><a href="<?php echo $d['moduleinfo']['github']?>" target="_blank"<?php else:?> class="disabled"><a disabled<?php endif?>><i class="fa fa-github fa-fw fa-lg"></i> 저장소 보기</a></li>				<li<?php if($d['moduleinfo']['issue']):?>><a href="<?php echo $d['moduleinfo']['issue']?>" target="_blank"<?php else:?> class="disabled"><a disabled<?php endif?>><i class="fa fa-bug fa-fw fa-lg"></i> 이슈 접수</a></li>				<li<?php if($d['moduleinfo']['website']):?>><a href="<?php echo $d['moduleinfo']['website']?>" target="_blank"<?php else:?> class="disabled"><a disabled<?php endif?>><i class="fa fa-home fa-fw fa-lg"></i> 웹사이트</a></li>				<li class="divider"></li>				<li<?php if($d['moduleinfo']['help']):?>><a href="<?php echo $d['moduleinfo']['help']?>" target="_blank"<?php else:?> class="disabled"><a disabled<?php endif?>><i class="fa fa-question-circle fa-fw fa-lg"></i> 도움말</a></li>				</ul>			</li>			<?php endif?>			<?php if($g['device']):?>			<?php if($module == 'dashboard' && ($front == 'main' || $front == 'mobile.dashboard')):?>			<li><a href="#." data-toggle="modal" data-target="#modal_window" class="navbar-right navbar-link rb-modal-dashboard"><i class="kf kf-admin fa-lg"></i> <span>대시보드 설정</span></a></li>			<?php endif?>			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&panel=Y" class="navbar-right navbar-link" target="_parent"><i class="fa fa-home fa-lg"></i> <span>홈으로</span></a></li>			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout" class="navbar-right navbar-link" target="_parent"><i class="fa fa-sign-out fa-lg"></i> <span>로그아웃</span></a></li>			<?php endif?>			</ul>		</div>	</div></nav><?php if($g['device']&&$module=='dashboard'):?><ul class="nav nav-tabs rb-nav-tabs mobile-tabs"><li<?php if($front=='mobile.shortcut'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.shortcut">바로가기</a></li><li<?php if($front=='mobile.dashboard'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.dashboard">대시보드</a></li><li<?php if($front=='mobile.site'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.site">사이트</a></li></ul><?php else:?><ul class="nav nav-tabs rb-nav-tabs" id="rb-admin-ul-tabs"><?php $_menuCount=count($d['amenu']);if(!$nosite&&$_menuCount):?><?php $_i=1;foreach($d['amenu'] as $_k => $_v):?><li id="rb-more-tab-<?php echo $_i?>"<?php if($front == $_k):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $_k?>"><?php echo $_v?></a></li><?php $_i++;endforeach?><?php if($_i>4):?><li class="rb-more-tabs hidden">	<a href="#." data-toggle="dropdown">더보기 <span class="caret"></span></a>	<ul class="dropdown-menu" style="left:-73px;">		<?php $_i=1;foreach($d['amenu'] as $_k => $_v):?>		<li id="rb-more-tabs-<?php echo $_i?>"<?php if($front == $_k):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $_k?>"><?php echo $_v?></a></li>		<?php $_i++;endforeach?>	</ul></li><?php endif?><?php endif?></ul><?php endif?><div id="rb-admin-page-content" class="tab-content"><?php include $g['adm_module'] ?></div><footer class="rb-admin-footer" role="contentinfo">	<ul class="list-inline">	<li><a href="http://www.kimsq.com/" target="_blank" rel="nofollow">킴스큐</a>를 사용해 주셔서 감사 드립니다.</li>	<li class="muted">·</li>	<li><a href="https://github.com/kimsQ/rb" target="_blank" rel="nofollow">GitHub project</a> </li>	<li class="muted">·</li>	<li><a href="http://blog.kimsq.com" target="_blank" rel="nofollow">Blog</a></li>	<li class="muted">·</li>	<li><a href="https://github.com/kimsQ/rb/issues" target="_blank" rel="nofollow">Issues</a></li>	<li class="muted">·</li>	<li><a href="https://github.com/kimsQ/rb/releases" target="_blank" rel="nofollow">Releases</a></li>	</ul>	<?php if(!$g['device']):?>	<p>		Maintained by the <a href="https://github.com/orgs/kimsq/people" target="_blank" rel="nofollow">core team</a> with the help of		<a href="https://github.com/kimsq/rb/graphs/contributors" target="_blank" rel="nofollow">our contributors</a>.</p>		<p>Code licensed under <a href="http://www.gnu.org/copyleft/lesser.html" target="_blank" rel="nofollow">LGPL</a>,		documentation under <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank" rel="nofollow">CC BY 3.0</a>.	</p>	<?php endif?></footer><script>$(document).ready(function(){	document.body.onload = tabSetting;	document.body.onresize = tabSetting;	<?php if($g['device']):?>	$('#bs-example-navbar-collapse-1').on('show.bs.collapse', function () {		$("#_navbar_header_").addClass('rb-header-bottom-line');	});	$('#bs-example-navbar-collapse-1').on('hide.bs.collapse', function () {		$("#_navbar_header_").removeClass('rb-header-bottom-line');	});	getId('_add_bookmark_').style.maxHeight = '205px';	<?php endif?>	$('#bs-example-navbar-collapse-1 [data-toggle=dropdown]').on('click', function(event) {		event.preventDefault();		event.stopPropagation();		$(this).parent().siblings().removeClass('open');		$(this).parent().toggleClass('open');	});	$(".rb-help-btn").click(function(){		$(this).button('toggle');	});	$('.rb-modal-bookmark').on('click',function() {		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=admin&amp;front=modal.bookmark')?>');	});	$('.rb-bookmark-add').on('click',function() {		frames._action_frame_admin.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=bookmark&_addmodule=<?php echo $module?>&_addfront=<?php echo $front?>';	});	$('.rb-bookmark-del').on('click',function() {		frames._action_frame_admin.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=bookmark_delete&deltype=hidden&_addmodule=<?php echo $module?>&_addfront=<?php echo $front?>';	});});function tabSetting(){	<?php if($g['device']):?>	$('#bs-example-navbar-collapse-1').removeClass('navbar-collapse');	if(document.body.scrollWidth > 750) $('#bs-example-navbar-collapse-1').addClass('navbar-collapse');	else $('#bs-example-navbar-collapse-1').removeClass('navbar-collapse');	<?php endif?>	var i;	var bodyWidth = document.body.scrollWidth;	var allTabnum = <?php echo (int)$_menuCount?>;	var showTabnum = allTabnum;	var showTabMore = false;	if (allTabnum > 3)	{		if (bodyWidth >= 0 && bodyWidth < 360)		{			showTabnum = 2;			showTabMore = true;		}		else if (bodyWidth >= 360 && bodyWidth < 523)		{			showTabnum = 3;			showTabMore = true;		}		else if (bodyWidth >= 523 && bodyWidth < 640)		{			showTabnum = 4;			showTabMore = true;		}		else if (bodyWidth >= 640 && bodyWidth < 750)		{			showTabnum = 5;			showTabMore = true;		}		else if (bodyWidth >= 750 && bodyWidth < 1100)		{			showTabnum = 8;			showTabMore = true;		}		else if (bodyWidth >= 1100 && bodyWidth < 1400)		{			showTabnum = 10;			showTabMore = true;		}		else if (bodyWidth >= 1400)		{			showTabnum = allTabnum;			showTabMore = false;			getId('rb-more-tab-'+showTabnum).style.borderRight = '#ccc solid 1px';		}	}	for (i = 1; i <= allTabnum; i++)	{		$('#rb-more-tab-'+i).removeClass('hidden');		$('#rb-more-tabs-'+i).removeClass('hidden');	}	for (i = showTabnum+1; i <= allTabnum; i++) $('#rb-more-tab-'+i).addClass('hidden');	for (i = 0; i <= showTabnum; i++) $('#rb-more-tabs-'+i).addClass('hidden');	if (showTabMore == true) $('.rb-more-tabs').removeClass('hidden');	else $('.rb-more-tabs').addClass('hidden');}</script>