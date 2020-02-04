<header class="bar bar-nav bar-light bg-white px-0 border-bottom-0">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-right p-x-1" role="button" data-toggle="modal" href="#modal-settings-general"></a>
  <h1 class="title">
    <img class="mt-2 mr-2 pull-left img-circle bg-faded" data-role="avatar" src="<?php echo getAvatarSrc($my['uid'],'56') ?>" width="28">
    <small><?php echo $my['nic']?$my['nic']:$my['name'] ?></small>
    <?php if ($my['admin']): ?><span class="badge badge-pill badge-danger">ADMIN</span><?php endif; ?>
  </h1>
  <?php else: ?>
  <a class="icon icon icon-close pull-right p-x-1" role="button" data-toggle="drawer-close" title="드로어닫기"></a>
  <h1 class="title" role="button" data-toggle="modal" href="#modal-login" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
    로그인 하세요
  </h1>
  <?php endif; ?>
</header>

<nav class="bar bar-tab bg-white">
  <?php if ($my['uid']): ?>
  <a class="tab-item active bg-primary" role="button" data-open="newPost" data-url="/post/write">
    새 포스트
  </a>
  <?php else: ?>
  <a class="tab-item" role="button" href="#modal-join" data-toggle="modal" data-url="">
    <span class="icon material-icons">account_circle</span>
    <span class="tab-label">회원가입</span>
  </a>
  <a class="tab-item" role="button" href="#modal-login" data-toggle="modal" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
    <span class="icon material-icons">input</span>
    <span class="tab-label">로그인</span>
  </a>
  <?php endif; ?>
</nav>

<div class="content bg-faded">
  <!-- 관리자모드 > 위젯코드 추출기를 활용하세요. -->
  <?php getWidget('menu/rc-drawer-menu',array('smenu'=>'0','limit'=>'2','link'=>'link','collid'=>'drawer-menu','accordion'=>'1','collapse'=>'1',))?>


  <?php if ($my['uid']): ?>
  <ul class="table-view bg-white mb-2">
    <li class="table-view-cell">
      <a data-toggle="goMypage" data-target="#page-post-mypost" data-start="#page-main" data-title="내 포스트"  data-url="<?php echo RW('mod=dashboard&page=post')?>">
        <span class="badge badge-default badge-inverted"><?php echo $my['num_post']?number_format($my['num_post']):'' ?></span>
        <div class="media-body">
          내 포스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a data-toggle="goMypage" data-target="#page-post-mylist" data-start="#page-main" data-title="내 리스트" data-url="<?php echo RW('mod=dashboard&page=list')?>">
        <span class="badge badge-default badge-inverted"><?php echo $my['num_list']?number_format($my['num_list']):'' ?></span>
        <div class="media-body">
          내 리스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a data-toggle="goMypage" data-target="#page-post-saved" data-start="#page-main" data-title="나중에 볼 포스트" data-url="<?php echo RW('mod=dashboard&page=saved')?>">
        <span class="badge badge-default badge-inverted"></span>
        <div class="media-body">
          나중에 볼 포스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a data-toggle="goMypage" data-target="#page-post-liked" data-start="#page-main" data-title="좋아요 한 포스트">
        <span class="badge badge-default badge-inverted"></span>
        <div class="media-body">
          좋아요 한 포스트
        </div>
      </a>
    </li>
  </ul>
  <?php endif; ?>


</div>
