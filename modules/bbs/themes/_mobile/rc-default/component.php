<!--
게시판 테마 컴포넌트 모음

1. Modal : 게시판 글쓰기
2. Popup : 글쓰기 취소확인
3. Popup : 댓글관리
4. Popover : 게시물 관리
5. Popover : 게시물 관리
6. Sheet : 신규 댓글작성

-->

<!-- Modal : 게시판 글쓰기 -->
<div id="modal-bbs-write" class="modal<?php echo $g['mobile']=='iphone' || $g['mobile']=='ipad'?' zoom':'' ?>">
  <input type="hidden" name="c" value="<?php echo $c?>">
  <input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>">
  <input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>">
  <input type="hidden" name="name" value="<?php echo $my['name']?>">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="reply" value="">
  <input type="hidden" name="notice" value="">
  <input type="hidden" name="hidden" value="">
  <input type="hidden" name="category" value="">
  <input type="hidden" name="tag" value="">
  <input type="hidden" name="featured_img" value="">
  <input type="hidden" name="upfiles" id="upfilesValue" value="">
  <input type="hidden" name="pcode" value="">
  <input type="hidden" name="backtype" value="ajax">

  <section id="page-bbs-write-main" class="page center">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0" data-role="write-nav">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			취소
  	  </button>
  		<button class="btn btn-link btn-nav pull-right p-x-1" type="button" data-act="submit">
        <span class="not-loading"></span>
        <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i></span>
  	  </button>
  		<h1 class="title">
  			글쓰기
  		</h1>
  	</header>

    <header class="bar bar-nav bar-light bg-faded p-x-0 border-top" data-role="editor-nav">
      <div class="d-flex align-items-center">
        <div class="toolbar-container w-100"></div>
        <?php if ($g['mobile']!='iphone' && $g['mobile']!='ipad'): ?>
        <div class="flex-shrink-1 border-left text-xs-center" style="min-width:4rem">
          <button class="btn btn-link" type="button">완료</button>
        </div>
      <?php endif; ?>
      </div>
    </header>

  	<nav class="bar bar-tab bar-light bg-faded" data-role="write-nav">
  	  <a class="tab-item active" role="button">
  	    <span class="icon fa fa-keyboard-o"></span>
  	    <span class="tab-label">본문작성</span>
  	  </a>
  		<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
  	  <a class="tab-item<?php echo $R['category']?' active':' text-muted' ?>" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-category" data-role="tab-category">
  	    <span class="icon fa fa-folder-o text-muted"></span>
  	    <span class="tab-label">카테고리</span>
  	  </a>
  		<?php endif?>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-attach" data-role="tap-attach">
  	    <span class="icon fa fa-paperclip text-muted"></span>
  	    <span class="tab-label">파일첨부</span>
        <span class="badge badge-primary"></span>
  	  </a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-tag" data-role="tap-tag">
  	    <span class="icon fa fa-tag text-muted"></span>
  	    <span class="tab-label">태그</span>
  	  </a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-option" data-role="tap-option">
  	    <span class="icon icon-more text-muted"></span>
  	    <span class="tab-label">옵션</span>
  	  </a>
  	</nav>

  	<div class="content">
      <div data-role="loader">
        <div class="d-flex justify-content-center align-items-center text-muted" style="height:70vh">
          <div class="spinner-border mr-2" role="status"></div>
        </div>
      </div>
  		<form class="d-none">

  			<div class="form-list m-b-0">
  				<?php if(!$my['id']):?>
  		     <div class="input-row">
  		       <label>이름</label>
  		       <input type="text" name="name" placeholder="이름을 입력해 주세요." value="" class="form-control" autocomplete="off">
  		     </div>
  				 <?php if(!$R['uid']||$reply=='Y'):?>
  				 <div class="input-row">
  					 <label>암호</label>
  					 <input type="password" name="pw" placeholder="암호는 게시글 수정 및 삭제에 필요합니다." value="" class="form-control" autocomplete="off">
            <?php if($R['hidden']&&$reply=='Y'):?>
            <small class="form-text text-muted">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</small>
            <?php endif?>
  				 </div>
  				 <?php endif?>
  				 <?php endif?>

  					<input type="text" name="subject" placeholder="제목" value="" autocomplete="off">

  			 </div><!-- /.form-list -->

  			 <div class="mt-0">
           <div class="rb-article">
           	<div data-role="editor">
           		<div data-role="editor-body" class="editable-container"></div>
           	</div>
           </div>
  			 </div>

  		</form>

  	</div>
  </section>

  <section id="page-bbs-write-category" class="page right">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			<span class="icon icon-left-nav"></span>
  			본문작성
  	  </button>
  		<h1 class="title">
  			<i class="fa fa-folder-o fa-fw" aria-hidden="true"></i> 카테고리
  		</h1>
  	</header>
  	<div class="content bg-faded">
  		<ul class="table-view m-t-0 bg-white">
  			<li class="table-view-divider"><?php echo $_catexp[0]?></li>
  			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
  		  <li class="table-view-cell radio" >
  		    <label class="custom-control custom-radio">
  		      <input id="radio-<?php echo $_catexp[$i]?>" name="radio" type="radio" class="custom-control-input" value="<?php echo $_catexp[$i]?>" <?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> checked<?php endif?>>
  		      <span class="custom-control-indicator"></span>
  		      <span class="custom-control-description">
  						<?php echo $_catexp[$i]?>
  					</span>
  		    </label>
  				<?php if($d['theme']['show_catnum']):?>
  				<span class="badge badge-pill"><?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?></span>
  				<?php endif?>
  		  </li>
  			<?php endfor?>
  		</ul>
  	</div>
  </section>

  <section id="page-bbs-write-attach" class="page right">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			<span class="icon icon-left-nav"></span>
  			본문작성
  	  </button>
  		<h1 class="title">
  			파일첨부
  		</h1>
  	</header>
  	<div class="bar bar-standard bar-footer bar-light bg-white">
  		<button class="btn btn btn-outline-primary btn-block" data-role="attach-handler-file" data-type="file" title="파일첨부" role="button" data-loading-text="업로드 중...">
  			<i class="fa fa-upload" aria-hidden="true"></i> 파일 불러오기
  		</button>
  	</div>
  	<div class="content bg-faded">

  		<!-- 첨부파일 업로드 -->
  		<?php include $g['dir_module_skin'].'_uploader.php'?>

  	</div><!-- /.content -->

  </section>

  <section id="page-bbs-write-tag" class="page right">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			<span class="icon icon-left-nav"></span>
  			본문작성
  	  </button>
  		<h1 class="title">
  			<i class="fa fa-tag fa-fw" aria-hidden="true"></i> 태그
  		</h1>
  	</header>
  	<div class="content bg-faded">
  		<textarea class="form-control border-0" rows="5" name="tag" placeholder="콤마(,)로 구분하여 입력해주세요."><?php echo htmlspecialchars($R['tag'])?></textarea>
  		<div class="content-padded text-muted">
  			<small>이 게시물을 가장 잘 표현할 수 있는 단어를 콤마(,)로 구분해서 입력해 주세요. 통합검색시에 검색어 추천시에 활용됩니다.</small>
  		</div>
  	</div>
  </section>

  <section id="page-bbs-write-location" class="page right">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			<span class="icon icon-left-nav"></span>
  			본문작성
  	  </button>
  		<h1 class="title">
  			위치 지정
  		</h1>
  	</header>
  	<div class="bar bar-standard bar-footer bar-light bg-white">
  		<button class="btn btn btn-outline-primary btn-block" id="execDaumPostcode">
  			<i class="fa fa-search" aria-hidden="true"></i> 주소 검색하기
  		</button>
  	</div>
  	<div class="content bg-faded">
  		<div class="form-list m-b-0" id="location-form" style="display:none">
  			<input type="hidden" name="pin" id="location-pin" value="<?php echo $R['pin']?$R['pin']:'(37.537187, 127.005476)' ?>">
  			<input type="text" name="location1" id="location1" value="" autocomplete="off" readonly>
  			<input type="text" name="location2" id="location2" placeholder="상세 위치를 입력해 주세요." value="" autocomplete="off">
  	 </div><!-- /.form-list -->
  		<div class="content-padded text-muted guide text-center" id="location-guide">
  			<div>
  				<div class="display-2"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
  				<small>주소를 검색하여 위치를 지정해주세요.</small>
  			</div>
  		</div>
  		<div id="location-map" style="display:none"></div>
  	</div>
  </section>

  <section id="page-bbs-write-option" class="page right">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" data-history="back">
  			<span class="icon icon-left-nav"></span>
  			본문작성
  	  </button>
  		<h1 class="title">
  			게시물 옵션
  		</h1>
  	</header>
  	<div class="content bg-faded">
  		<ul class="table-view m-t-0 bg-white">
  			<?php if($my['admin']):?>
  			<li class="table-view-cell checkbox">
  		    <label class="custom-control custom-checkbox" data-option="notice">
  		      <input type="checkbox" class="custom-control-input" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?>>
  		      <span class="custom-control-indicator"></span>
  		      <span class="custom-control-description">
  						공지글
  						<p>공지글로 지정되면 게시물 목록에서 공지탭에 별도분류 됩니다.</p>
  					</span>
  		    </label>
  		  </li>
  			<?php endif?>
  			<?php if($d['theme']['use_hidden']==1):?>
  		  <li class="table-view-cell checkbox">
  		    <label class="custom-control custom-checkbox" data-option="hidden">
  		      <input type="checkbox" class="custom-control-input" name="hidden" value="1"<?php if($R['hidden']):?> checked<?php endif?>>
  		      <span class="custom-control-indicator"></span>
  		      <span class="custom-control-description">
  						비밀글
  						<p>등록자와 관리자만 본 게시물을 조회할 수 있습니다.</p>
  					</span>
  		    </label>
  		  </li>
  			<?php endif?>
  		</ul>
  	</div>
  </section>

</div>

<!-- Popup : 글쓰기 취소확인 -->
<div id="popup-bbs-cancelCheck" class="popup zoom">
  <div class="popup-content">
    <nav class="bar bar-tab">
      <a class="tab-item" role="button" data-toggle="cancelCheck" data-value="no">
        아니요
      </a>
      <a class="tab-item border-left text-primary" role="button" data-toggle="cancelCheck" data-value="yes">
        예
      </a>
    </nav>
    <div class="content" style="min-height: 115px;">
      <div class="p-a-2 text-xs-center">글쓰기를 취소 하시겠습니까?</div>
    </div>
  </div>
</div>

<!-- Popup : 댓글관리 -->
<div id="popup-comment-mypost" class="popup zoom">
  <div class="popup-content">
    <div class="content" style="min-height: 80px;">
      <ul class="table-view table-view-full mt-0 text-xs-center">
        <li class="table-view-cell">
          <a data-toggle="commentWrite" data-act="edit">수정하기</a>
        </li>
        <li class="table-view-cell">
          <a data-kcact="delete">삭제하기</a>
        </li>
        <?php if ($my['admin'] || strstr(','.($d['bbs']['admin']?$d['bbs']['admin']:'.').',',','.$my['id'].',')): ?>
        <li class="table-view-cell" data-role="comment">
          <a data-kcact="notice">상단고정 <span></span></a>
        </li>
        <?php endif; ?>
        <li class="table-view-cell d-none">
          <a data-kcact="report">신고하기</a>
        </li>
        <li class="table-view-cell" data-role="comment">
          <a data-toggle="commentWrite">댓글 답글쓰기</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- Popover : 게시물 관리 -->
<div id="popover-bbs-view" class="popover">
  <ul class="table-view">
    <!-- 저장,수정,삭제 항목 동적 추가 -->
    <li class="table-view-cell" data-toggle="linkCopy" data-history="back">URL 복사</li>
    <li class="table-view-cell" data-toggle="linkShare" data-history="back">공유하기...</li>
  </ul>
</div>

<!-- Popover : 게시물 관리 -->
<div id="popover-bbs-listMarkup" class="popover">
  <ul class="table-view">
    <li class="table-view-divider"><small>목록타입 변경</small></li>
    <li class="table-view-cell" data-toggle="listMarkup" data-markup="media" data-bid="">
      <i class="fa fa-th-list fa-fw mr-1" aria-hidden="true"></i>
      섬네일형
    </li>
    <li class="table-view-cell" data-toggle="listMarkup" data-markup="avatar" data-bid="">
      <i class="fa fa-list fa-fw mr-1" aria-hidden="true"></i>
      아바타형
    </li>
    <li class="table-view-cell" data-toggle="listMarkup" data-markup="card" data-bid="">
      <i class="fa fa-square-o fa-lg mr-1" aria-hidden="true"></i>
      카드형
    </li>
    <li class="table-view-cell" data-toggle="listMarkup" data-markup="gallery" data-bid="">
      <i class="fa fa-th fa-fw mr-1" aria-hidden="true"></i>
      갤러리형
    </li>
  </ul>
</div>

<!-- Sheet : 신규 댓글작성 -->
<div id="sheet-comment-write" class="sheet">
  <fieldset data-role="commentWrite-container">

    <div data-role="comment-input-wrapper">
      <ul class="table-view mb-0 collapse" id="sheet-comment-write-toolbar">
        <li class="table-view-cell text-muted bg-faded">
          비밀글
          <small class="ml-1">운영자에게만 공개</small>
          <div data-toggle="switch" data-role="comment-hidden" class="switch">
            <div class="switch-handle"></div>
          </div>
        </li>
        <li class="table-view-cell py-0 px-2 bg-faded">
          <div class="toolbar-container align-self-end"></div>
        </li>
      </ul>
      <div class="d-flex border-0 rounded-0 align-items-center" data-role="form">
        <img class="img-circle bg-faded ml-3" data-role="avatar" src="<?php echo getAvatarSrc($my['uid'],'100') ?>" style="width:2.25rem;height:2.25rem">
        <section class="w-100">
          <div data-role="editor">
        		<div data-role="comment-input" id="meta-description-content"  class="border-0"></div>
        	</div>
        </section>
        <button class="btn btn-link align-self-end" type="submit" data-kcact="regis">
          <i class="fa fa-paper-plane"></i>
        </button>
        <button class="btn btn-link align-self-end" type="button" data-toggle="collapse" data-target="#sheet-comment-write-toolbar">
          <i class="fa fa-ellipsis-v"></i>
        </button>
      </div>
    </div>
  </fieldset>
</div>
