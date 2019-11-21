<!--
회원 모듈 프로필 포론트 컴포넌트 모음

1. 페이지 : 프로필 메인
1. 모달 : 프로필 메인

-->

<div id="modal-member-profile" class="modal fast" data-mbruid="" data-role="profile">
  <header class="bar bar-nav bar-dark bg-inverse px-0 border-bottom-0" data-snap-ignore="true">
    <a class="icon material-icons pull-left text-white px-3" role="button" data-history="back">arrow_back</a>
    <a class="icon material-icons pull-right pl-2 pr-3 text-white" role="button" data-toggle="modal" data-target="#modal-post-search">search</a>
    <h1 class="title title-left" data-history="back">
      <span data-role="title"></span>
    </h1>
  </header>
  <div class="bar bar-standard bar-header-secondary bar-dark bg-inverse border-bottom-0 p-x-0 shadow-sm">
    <nav class="nav nav-inline" style="margin-top: 3px;"></nav>
  </div>
  <div class="content bg-white" data-control="scroll" data-type="updown" data-defaultHeight="180"></div>
</div><!-- /.modal -->


<script src="/modules/member/themes/<?php echo $d['member']['theme_mobile']?>/profile/component.js<?php echo $g['wcache']?>" ></script>
