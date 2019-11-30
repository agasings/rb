<div id="tab-main" class="tab-content active bg-faded">

  <section class="widget" id="widget-post-req">
    <?php getWidget('post/rc-post-req-card',array('wrapper'=>'#widget-post-req','title'=>'추천 포스트','markup'=>'post-row','start'=>'#page-main','posts'=>$d['layout']['main_post_req']))?>
  </section>

  <section class="widget border-top border-bottom" id="widget-post-all">
    <?php getWidget('post/rc-post-all-scroll',array('wrapper'=>'#widget-post-all','start'=>'#page-main','recnum'=>5,'link'=>'/post'))?>
  </section>

  <div class="card d-none">
    <div class="card-header">
      페이지로 보기
    </div>
    <ul class="table-view">
      <li class="table-view-cell">
        <a class="navigate-right" data-toggle="page" href="#page-post-category" data-start="#page-main" data-title="전체 카테고리" href="/post/category">
          전체 카테고리
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" data-toggle="page" href="#page-post-category-view" data-start="#page-main" data-category="11" data-title="여성의류" data-url="/post/category/11?code=1/11">
          여성의류
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" data-toggle="page" href="#page-post-keyword" data-start="#page-main" data-keyword="소방헬기추락" data-title="#소방헬기추락" data-url="/post/search?keyword=소방헬기추락">
          키워드
        </a>
      </li>
    </ul>
  </div>

  <div class="card d-none">
    <div class="card-header">
      랜딩 페이지 보기
    </div>
    <ul class="table-view">
      <li class="table-view-cell">
        <a class="navigate-right" href="/@564390154/post/5000998?list=4517103">
          포스트 보기
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" href="/post">
          전체 포스트
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" href="/list">
          전체 리스트
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" href="/@564390154/list/9626123">
          특정 리스트
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" href="/post/category/11?code=1/11">
          여성의류
        </a>
      </li>
      <li class="table-view-cell">
        <a class="navigate-right" href="/post/search?keyword=소방헬기추락">
          키워드
        </a>
      </li>
    </ul>
  </div>

</div>

<div id="tab-best" class="tab-content">

  <section data-role="list-best" style="min-height: 650px"></section>

  <section class="mt-2 widget bg-white border-top border-bottom">
    <?php getWidget('post/rc-list-req-list',array('title'=>'추천 리스트','start'=>'#page-main','markup'=>'list-row','lists'=>$d['layout']['main_list_req']))?>
  </section>

  <section class="widget">
    <?php getWidget('post/rc-list-req-banner',array('id'=>'8213818'))?>
  </section>

</div>

<div id="tab-feed" class="tab-content">

  <?php if (!$my['uid']): ?>
  <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
    <div class="text-xs-center">
      <div class="material-icons mb-4" style="font-size: 100px;color:#ccc">
        subscriptions
      </div>
      <h5>새로운 동영상을 놓치지 마세요.</h5>
      <small class="text-muted">즐겨찾는 채널의 업데이트를 확인하려면 로그인 하세요.</small>
      <div class="mt-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">
          로그인
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>

<div id="tab-noti" class="tab-content">
  <?php if (!$my['uid']): ?>
  <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
    <div class="text-xs-center">
      <div class="material-icons mb-4" style="font-size: 100px;color:#ccc">
        notifications
      </div>
      <h5>여기에 알림이 표시됩니다.</h5>
      <small class="text-muted">좋아하는 채널의 최신 동영상과 콘텐츠를 놓치치 마세요.</small>

      <div class="mt-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">
          로그인
        </button>
      </div>
    </div>
  </div>
  <?php else: ?>
  <ul class="table-view table-view-full my-0 bg-white" data-role="noti-list"></ul>
  <?php endif; ?>
</div>

<div id="tab-libary" class="tab-content">

  <?php if (!$my['uid']): ?>
  <div class="d-flex justify-content-center align-items-center" style="height: 40vh">
    <div class="text-xs-center">
      <div class="material-icons mb-3" style="font-size: 90px;color:#ccc">
        folder
      </div>
      <h6>좋아하는 동영상을 감상해 보세요.</h6>
      <small class="text-muted f12">저장하거나 좋아요 표시한 동영상을 보려면 로그인 하세요.</small>
      <div class="mt-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">
          로그인
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php if ($my['uid']): ?>
  <ul class="table-view bg-white mt-3">
    <li class="table-view-cell">
      <a class="" href="#page-post-mypost" data-start="#page-main" data-toggle="page" data-title="내 포스트">
        <span class="media-object pull-left icon material-icons text-muted mr-2">play_circle_outline</span>
        <span class="badge badge-default badge-inverted"><?php echo number_format($my['num_post']) ?></span>
        <div class="media-body">
          내 포스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a class="" href="#page-post-mylist" data-start="#page-main" data-toggle="page" data-title="내 리스트">
        <span class="media-object pull-left icon material-icons text-muted mr-2">playlist_play</span>
        <span class="badge badge-default badge-inverted"><?php echo number_format($my['num_list']) ?></span>
        <div class="media-body">
          내 리스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a class="" href="#page-post-saved" data-start="#page-main" data-toggle="page" data-title="나중에 볼 포스트">
        <span class="media-object pull-left icon material-icons text-muted mr-2">schedule</span>
        <span class="badge badge-default badge-inverted"></span>
        <div class="media-body">
          나중에 볼 포스트
        </div>
      </a>
    </li>
    <li class="table-view-cell">
      <a class="" href="#page-post-liked" data-start="#page-main" data-toggle="page" data-title="좋아요 한 포스트">
        <span class="media-object pull-left icon material-icons text-muted mr-2">thumb_up</span>
        <span class="badge badge-default badge-inverted"></span>
        <div class="media-body">
          좋아요 한 포스트
        </div>
      </a>
    </li>
  </ul>
  <?php endif; ?>

  <ul class="table-view bg-white mt-0 mb-2">
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-site-page" data-start="#page-main" data-toggle="page" data-title="소개" data-id="about" data-type="page" data-url="<?php echo RW('mod=about')?>">
        소개
      </a>
    </li>
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-site-page" data-start="#page-main" data-toggle="page" data-title="고객센터" data-id="cscenter" data-type="page" data-url="<?php echo RW('mod=cscenter')?>">
        고객센터
      </a>
    </li>
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-bbs-list" data-start="#page-main" data-toggle="page" data-title="공지사항" data-id="notice" data-url="<?php echo RW('m=bbs&bid=notice')?>">
        공지사항
      </a>
    </li>
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-site-page" data-start="#page-main" data-toggle="page" data-title="배송 안내" data-id="delivery" data-type="page" data-url="<?php echo RW('mod=delivery')?>">
        배송 안내
      </a>
    </li>

    <li class="table-view-cell">
      <a class="navigate-right" href="#page-bbs-list" data-start="#page-main" data-toggle="page" data-title="자주하는 질문" data-id="faq" data-category="자주하는 질문 베스트 10" data-collapse="true" data-url="<?php echo RW('m=bbs&bid=faq')?>">
        자주하는 질문
      </a>
    </li>

    <li class="table-view-cell">
      <a class="navigate-right" href="#page-site-page" data-start="#page-main" data-toggle="page" data-title="이용안내" data-id="guide" data-type="page" data-url="<?php echo RW('mod=guide') ?>">
        이용안내
      </a>
    </li>
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-site-page" data-start="#page-main" data-toggle="page" data-title="개인정보취급방침" data-id="privacy" data-type="page" data-url="<?php echo RW('mod=privacy') ?>">
        개인정보취급방침
      </a>
    </li>

  </ul>

  <?php if ($my['uid']): ?>
  <ul class="table-view bg-white mb-2">
    <li class="table-view-cell">
      <a class="navigate-right" href="#page-shop-myPoint" data-start="#page-main" data-toggle="page" data-title="배송 안내">
        포인트
      </a>
      <span class="badge badge-primary badge-inverted" style="right: 2rem;">
        0 원
      </span>
    </li>
  </ul>

  <ul class="table-view bg-white mb-2">
    <li class="table-view-cell">
      <a class="" href="#modal-settings-general" data-toggle="modal" data-title="설정">
        설정
      </a>
    </li>
  </ul>

  <ul class="table-view bg-white mb-2">
    <li class="table-view-cell">
      <a class="" href="#popup-logout" data-toggle="popup">
        로그아웃
      </a>
    </li>
  </ul>
  <?php endif; ?>

</div>
