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
  	  </a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-tag" data-role="tap-tag">
  	    <span class="icon fa fa-tag text-muted"></span>
  	    <span class="tab-label">태그</span>
  	  </a>
  		<a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-location" data-role="tap-location" hidden>
  			<span class="icon fa fa-map-marker text-muted"></span>
  			<span class="tab-label">위치</span>
  		</a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-bbs-write-main" href="#page-bbs-write-option" data-role="tap-option">
  	    <span class="icon icon-more text-muted"></span>
  	    <span class="tab-label">옵션</span>
  	  </a>
  	</nav>

  	<div class="content">

  		<form>

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
  					 <small class="form-text text-muted">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</small>
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

  		<?php if (!$R['upload']): ?>
  		<div class="content-padded text-muted guide text-center">
  			<div data-role="attach-handler-file" data-type="file" title="파일첨부" role="button" data-loading-text="업로드 중...">
  				<div class="display-3">
  					<i class="fa fa-paperclip" aria-hidden="true"></i>
  				</div>
  				<small>사진,비디오,오디오,문서,파일을<br>첨부할 수 있습니다.</small>
  			</div>
  		</div>
  		<?php endif; ?>

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

<!-- Popover : 게시물 관리 -->
<div id="popover-bbs-view" class="popover">
  <ul class="table-view">
    <!-- 저장,수정,삭제 항목 동적 추가 -->
    <li class="table-view-cell" data-toggle="linkCopy" data-history="back">URL 복사</li>
    <li class="table-view-cell" data-toggle="linkShare" data-history="back">공유하기...</li>
  </ul>
</div>

<!-- Sheet : 신규 댓글작성 -->
<div id="sheet-comment-write" class="sheet">
  <fieldset data-role="commentWrite-container">
    <div data-role="comment-input-wrapper">
      <div class="d-flex border-0 rounded-0 align-items-center" data-role="form">
        <img class="img-circle bg-faded ml-3" data-role="avatar" src="<?php echo getAvatarSrc($my['uid'],'100') ?>" style="width:2.25rem;height:2.25rem">
        <section class="w-100">
          <div data-role="editor">
        		<div data-role="comment-input" id="meta-description-content"  class="border-0"></div>
        	</div>
        </section>
        <div class="toolbar-container align-self-end"></div>
        <button class="btn btn-link rb-submit align-self-end" type="submit" data-kcact="regis">
          <i class="fa fa-paper-plane"></i>
        </button>
      </div>
    </div>
  </fieldset>
</div>

<!-- Popup : 댓글관리 -->
<div id="popup-comment-mypost" class="popup zoom">
  <div class="popup-content">
    <div class="content">
      <ul class="table-view table-view-full mt-0 text-xs-center">
        <li class="table-view-cell">
          <a data-toggle="edit">수정하기</a>
        </li>
        <li class="table-view-cell">
          <a data-kcact="delete">삭제하기</a>
        </li>
        <li class="table-view-cell">
          <a data-kcact="notice">상단고정</a>
        </li>
        <li class="table-view-cell">
          <a data-kcact="report">신고하기</a>
        </li>
        <li class="table-view-cell">
          <a data-toggle="commentWrite">댓글 답글쓰기</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<script>

var page_bbs_write_main = $('#page-bbs-write-main')
var page_bbs_view = $('#page-bbs-view')
var modal_bbs_write = $('#modal-bbs-write');
var sheet_comment_write = $('#sheet-comment-write');
var popup_bbs_cancelCheck = $('#popup-bbs-cancelCheck')
var popup_comment_mypost = $('#popup-comment-mypost')
var popover_bbs_view = $('#popover-bbs-view')

var editor_bbs;
var attach_file_saveDir = '<?php echo $g['path_file']?>bbs/';// 파일 업로드 폴더
var attach_module_theme = '_mobile/rc-default';// attach 모듈 테마


$(document).ready(function() {

  // Popover : 게시물 관리
  popover_bbs_view.on('show.rc.popover', function (e) {
    var button = $(e.relatedTarget)
    var uid =  button.attr('data-uid')
    $(this).find('.table-view-cell').attr('data-uid',uid)
    var subject = button.attr('data-subject')
    var popover = $(this)

    var origin = $(location).attr('origin');
    var path = button.attr('data-url')?button.attr('data-url'):'';

    popover.find('[data-toggle="linkCopy"]').attr('data-clipboard-text',origin+path)
    popover.find('[data-toggle="linkShare"]').attr('data-subject',subject).attr('data-url',origin+path)

  })

  // 글 등록
  modal_bbs_write.find('[data-act="submit"]').click(function(){
    var modal = modal_bbs_write;
    var bid = modal.find('[name="bid"]').val();
    var uid = modal.find('[name="uid"]').val();
    var theme = modal.find('[name="theme"]').val();
    var notice = modal.find('[name="notice"]').val();
    var hidden = modal.find('[name="hidden"]').val();
    var category = modal.find('[name="category"]').val();
    var upfiles = modal.find('[name="upfiles"]').val();
    var featured_img = modal.find('[name="featured_img"]').val();
    var backtype = modal.find('[name="backtype"]').val();
    var nlist = modal.find('[name="nlist"]').val();

    <?php if(!$my['uid']):?>
    var name_el = modal.find('[name="name"]');
    var name = name_el.val();
    var pw_el = modal.find('[name="pw"]');
    var pw = pw_el.val();
    <?php endif?>

    var subject_el = modal.find('[name="subject"]');
    var subject = subject_el.val();

    var editorData = editor_bbs.getData();

    if (!subject_el.val()) {
			alert('제목을 입력해 주세요.       ');
			setTimeout(function(){subject_el.focus()}, 100);
			return false;
		}

    if (editorData == '') {
      alert('내용을 입력해 주세요.       ');
      setTimeout(function(){editor_bbs.editing.view.focus();}, 100);
      return false;
    }

    if (notice && hidden) {
      if (notice == 1 && hidden == 1)
      {
        alert('공지글은 비밀글로 등록할 수 없습니다.  ');
        $('#page-bbs-write-option').page({ start: '#page-bbs-write-main' });
        return false;
      }
    }

    <?php if ($B['category']): ?>
		if (category && category == '')
		{
			alert('카테고리를 선택해 주세요. ');
			$('#page-bbs-write-category').page({ start: '#page-bbs-write-main' });
			return false;
		}
		<?php endif; ?>

    // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
    var featured_img_input = $('#page-bbs-write-main').find('input[name="featured_img"]'); // 대표이미지 input
    var featured_img_uid = $(featured_img_input).val();
    if(featured_img_uid ==''){ // 대표이미지로 지정된 값이 없는 경우
      var first_attach_img_li = $('#page-bbs-write-attach').find('[data-role="attach-preview-photo"] li:first'); // 첫번째 첨부된 이미지 리스트 li
      var first_attach_img_uid = $(first_attach_img_li).data('id');
      $(featured_img_input).val(first_attach_img_uid);
    }

    // 첨부파일 uid 를 upfiles 값에 추가하기
    var attachfiles=$('#page-bbs-write-attach').find('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
    var new_upfiles='';
    if(attachfiles){
      for(var i=0;i<attachfiles.length;i++) {
        new_upfiles+=attachfiles[i];
      }
      $('#modal-bbs-write').find('input[name="upfiles"]').val(new_upfiles);
    }

    // console.log(subject)
    // return false

    $(this).attr("disabled",true);

    setTimeout(function(){
      $.post(rooturl+'/?r='+raccount+'&m=bbs&a=write',{
          bid : bid,
          uid : uid,
          theme : theme,
          name : name,
          subject : subject,
          content : editorData,
          hidden : hidden,
          category : category,
          upfiles : upfiles,
          featured_img : featured_img,
          backtype : backtype
       },function(response){
          var result = $.parseJSON(response);
          var error = result.error

          if (!error) {
            location.reload();
          }

      });
    }, 300);

  });

	// 카테고리 항목 클릭에 글쓰기폼의 name="category" 에 값 적용하기
	$("#page-bbs-write-category").find('[type="radio"]').click(function() {
	   var radio_val = $(this).val()
     console.log('dfdf')
		 modal_bbs_write.find('[name="category"]').val(radio_val)
		 modal_bbs_write.find('[data-role="tab-category"] .icon').removeClass('text-muted')
		 modal_bbs_write.find('[data-role="tab-category"]').removeClass('text-muted').addClass('active')
	});

	// 태그 페이지가 닫힐때 태그폼의 내용을 추출하여 글쓰기폼의 name="tag" 에 값 적용하기
	$('#page-bbs-write-tag').on('hidden.rc.page', function () {
		var tag = $('#page-bbs-write-tag').find('[name="tag"]').val()
		modal_bbs_write.find('[name="tag"]').val(tag)
	})

	// 옵션 페이지의 항목 비밀글 항목에 클릭시에 글쓰기폼의 name="hidden" 에 값 적용하기
	$("#page-bbs-write-option").find('[name="hidden"]').click(function() {
		if ($(this).is(":checked")) {
			var check_val = 1
		} else {
			var check_val = 0
		}
		 modal_bbs_write.find('[name="hidden"]').val(check_val)
		 modal_bbs_write.find('[data-role="tap-option"] .icon').removeClass('text-muted')
		 modal_bbs_write.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
	});

	// 옵션 페이지의 항목 공지글 항목에 클릭시에 글쓰기폼의 name="notice" 에 값 적용하기
	$("#page-bbs-write-option").find('[name="notice"]').click(function() {
		if ($(this).is(":checked")) {
			var check_val = 1
		} else {
			var check_val = 0
		}
		 page_bbs_write_main.find('[name="notice"]').val(check_val)
		 page_bbs_write_main.find('[data-role="tap-option"] .icon').removeClass('text-muted')
		 page_bbs_write_main.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
	});

	// 위치지정 페이지가 호출되었을때
	$('#page-location').on('show.rc.page', function () {
		var width = $(document).width();
		var height = $(document).width();
		$('#location-map').css('width',width+'px')
		$('#location-map').css('height',height+'px')
	})

  //댓글쓰기 컴포넌트가 호출
  $(document).on('tap click','[data-toggle="commentWrite"]',function(){
    if (memberid) {
      var type = $(this).attr('data-type');
      var parent = $(this).attr('data-parent');
      sheet_comment_write.find('[data-kcact="regis"]').attr('data-type',type).attr('data-parent',parent);
      setTimeout(function(){sheet_comment_write.sheet()}, 10);
    } else {
      $('#modal-login').modal();
    }
    return false;
  });

  sheet_comment_write.find('[data-kcact="regis"]').click(function() {
    sheet_comment_write.find('fieldset').prop('disabled', true);
    $(this).addClass('fa-spin');

    var type = $(this).attr('data-type');
    var parent = $(this).attr('data-parent');

    setTimeout(function(){
      if (type=='comment') {
        $('[data-role="bbs-comment"] [data-role="comment-input-wrapper"]').find('[data-kcact="regis"]').click();
      } else {
        $('[data-role="oneline-input-wrapper-'+parent+'"]').find('[data-kcact="regis"]').click();
      }

    }, 700);

  });

  //댓글쓰기 컴포넌트가 호출될때
  sheet_comment_write.on('show.rc.sheet', function (e) {
    e.preventDefault();
    e.stopPropagation();
    $('[data-role="comment-box"] [data-role="commentWrite-container"]').css('opacity','.2');
    setTimeout(function(){ editor_comment.editing.view.focus(); },10);
  })

  sheet_comment_write.on('hidden.rc.sheet', function (e) {
    sheet_comment_write.find('fieldset').prop('disabled', false);
    sheet_comment_write.find('[data-kcact="regis"]').removeClass('fa-spin').attr('data-type','').attr('data-parent','');
    $('[data-role="comment-box"] [data-role="commentWrite-container"]').css('opacity','1')
  })

  //글쓰기 모달이 열릴때
  modal_bbs_write.on('show.rc.modal', function (e) {

    // 글쓰기 권한 체크
    var button = $(e.relatedTarget)
    var mod = button.attr('data-mod')
    var modal = modal_bbs_write;
    var bid = modal.find('[name="bid"]').val();
    var uid = modal.find('[name="uid"]').val();
    var subject =  page_bbs_view.find('[data-role="subject"]').text();

    // 새글 작성 일때
    if (mod=='new') {
      modal_bbs_write.find('[name="subject"]').val(''); //제목 초기화
      modal_bbs_write.find('[data-role="editor-body"]').empty() //본문내용 초기화
    }

    DecoupledEditor
        .create( document.querySelector( '#modal-bbs-write [data-role="editor-body"]' ),{
          placeholder: '내용',
            toolbar: [ 'alignment:left','alignment:center','bulletedList','blockQuote','imageUpload','insertTable','undo'],
          removePlugins: [ 'ImageToolbar', 'ImageCaption', 'ImageStyle',,'WordCount' ],
          image: {},
          language: 'ko',
          extraPlugins: [rbUploadAdapterPlugin],
          table: {
              contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
          },
          mediaEmbed: {
              extraProviders: [
                  {
                      name: 'other',
                      url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
                  },
                  {
                      name: 'another',
                      url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
                  }
              ]
          },
          typing: {
              transformations: {
                  include: [
                    'quotes',
                    'typography',
                  ],
                  extra: [
                      // Add some custom transformations – e.g. for emojis.
                      { from: ':)', to: '🙂' },
                      { from: ':+1:', to: '👍' },
                      { from: ':tada:', to: '🎉' }
                  ],
              }
          }
        } )
        .then( newEditor => {
          console.log('editor_bbs init');

          editor_bbs = newEditor;
          modal_bbs_write.find('.toolbar-container').html(editor_bbs.ui.view.toolbar.element)
          editor_bbs.editing.view.document.on( 'change:isFocused', ( evt, name, value ) => {
            if (value) {
              console.log('editor_bbs focus');
              modal_bbs_write.addClass('editor-focused');
            } else {
              console.log('editor_bbs blur');
              modal_bbs_write.removeClass('editor-focused');
            }
          } );


        })
        .catch( error => {
            console.error( error );
        } );

    if (uid) {
      modal.find('[data-act="submit"] .not-loading').text('수정');
      modal_bbs_write.find('[name="subject"]').val(subject);
      $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
           bid : bid,
           uid : uid,
           device : 'mobile'
        },function(response){
         var result = $.parseJSON(response);
         var content=result.content;
         var adddata=result.adddata;
         var photo=result.photo;
         var video=result.video;
         var audio=result.audio;
         var file=result.file;
         editor_bbs.setData(content);
      });

    } else {
      modal.find('[data-act="submit"] .not-loading').text('등록');
    }

  })

  //글쓰기 모달이 닫힐때
  modal_bbs_write.on('hidden.rc.modal', function (e) {
    $(this).find('[name="uid"]').val(''); // uid 초기화
    editor_bbs.destroy();  //에디터 제거
    console.log('editor_bbs.destroy');
    setTimeout(function(){
      popup_bbs_cancelCheck.popup({
        backdrop: 'static'
      });  // 글쓰기 취소확인 팝업 호출
    }, 200);
  })

  // 글쓰기 취소확인 처리
  popup_bbs_cancelCheck.find('[data-toggle="cancelCheck"]').tap(function() {
    var value = $(this).attr('data-value');
    if (value=='no') {
      history.back();
      setTimeout(function(){ modal_bbs_write.modal('show'); }, 10);
    } else {
      history.back();
      modal_bbs_write.find('[name="subject"]').val('') //제목 입력내용 초기화
      editor_bbs.setData('');  //에디터 본문내용 초기화
      console.log('editor_bbs 제목,본문입력사항 초기화');
    }
	});

  popup_comment_mypost.on('show.rc.popup', function (e) {
    var button = $(e.relatedTarget);
    var uid = button.attr('data-uid');
    var type = button.attr('data-type');
    var parent = button.attr('data-parent');
    var popup = $(this);
    console.log(uid)
    popup.find('.table-view-cell a').attr('data-uid',uid);
    popup.find('.table-view-cell a').attr('data-type',type)
  })

  $(document).on('tap','#popup-comment-mypost .table-view-cell a',function(){
    var button = $(this);
    var uid = button.attr('data-uid');
    var type = button.attr('data-type');
    var parent = button.attr('data-parent');
    var toggle = button.attr('data-toggle');
    var kcact = button.attr('data-kcact');
    history.back() // popup 닫기
    setTimeout(function() {
      if (toggle) {
        $('[data-role="bbs-comment"]').find('[data-role="'+type+'-item"][data-uid="'+uid+'"] [data-toggle="'+toggle+'"]').click()
      } else {
        $('[data-role="bbs-comment"]').find('[data-role="'+type+'-item"][data-uid="'+uid+'"] [data-kcact="'+kcact+'"]').click()
      }
    }, 100);
	});


});

</script>
