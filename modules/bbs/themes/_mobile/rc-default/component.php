<!-- 게시판 글쓰기 -->
<div id="modal-bbs-write" class="modal zoom">
  <section id="page-main" class="page center">
  	<header class="bar bar-nav bar-dark bg-primary p-x-0" data-role="write-nav">
  		<button class="btn btn-link btn-nav pull-left p-x-1" type="button" onclick="cancelCheck();">
  			취소
  	  </button>
  		<button class="btn btn-link btn-nav pull-right js-submit p-x-1" type="button">
  			<?php echo $uid?'수정':'등록' ?>
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
  	  <a class="tab-item<?php echo $R['category']?' active':' text-muted' ?>" role="button" data-toggle="page" data-start="#page-main" href="#page-category" data-role="tap-category">
  	    <span class="icon fa fa-folder-o text-muted"></span>
  	    <span class="tab-label">카테고리</span>
  	  </a>
  		<?php endif?>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-main" href="#page-attach" data-role="tap-attach">
  	    <span class="icon fa fa-paperclip text-muted"></span>
  	    <span class="tab-label">파일첨부</span>
  	  </a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-main" href="#page-tag" data-role="tap-tag">
  	    <span class="icon fa fa-tag text-muted"></span>
  	    <span class="tab-label">태그</span>
  	  </a>
  		<a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-main" href="#page-location" data-role="tap-location" hidden>
  			<span class="icon fa fa-map-marker text-muted"></span>
  			<span class="tab-label">위치</span>
  		</a>
  	  <a class="tab-item text-muted" role="button" data-toggle="page" data-start="#page-main" href="#page-option" data-role="tap-option">
  	    <span class="icon icon-more text-muted"></span>
  	    <span class="tab-label">옵션</span>
  	  </a>
  	</nav>

  	<div class="content">

  		<form id="writeForm" method="post" action="<?php echo $g['s']?>/"  enctype="multipart/form-data">
  			<input type="hidden" name="r" value="<?php echo $r?>">
  			<input type="hidden" name="a" value="write">
  			<input type="hidden" name="c" value="<?php echo $c?>">
  			<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>">
  			<input type="hidden" name="m" value="<?php echo $m?>">
  			<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>">
  			<input type="hidden" name="uid" value="<?php echo $R['uid']?>">
  			<input type="hidden" name="reply" value="<?php echo $reply?>">
  			<input type="hidden" name="nlist" value="<?php echo $g['bbs_list']?>">
  			<input type="hidden" name="pcode" value="<?php echo $date['totime']?>">
  			<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>">
  			<input type="hidden" name="html" value="TEXT">
  		  <input type="hidden" name="backtype" value="list">
  			<input type="hidden" name="notice" value="<?php echo $R['notice'] ?>">
  			<input type="hidden" name="hidden" value="<?php echo $R['hidden'] ?>">
  			<input type="hidden" name="category" value="<?php echo $R['category'] ?>">
  			<input type="hidden" name="tag" value="<?php echo $R['tag'] ?>">
  			<input type="hidden" name="featured_img" value="<?php echo $R['featured_img'] ?>">

  			<div class="form-list m-b-0">
  				<?php if(!$my['id']):?>
  		     <div class="input-row">
  		       <label>이름</label>
  		       <input type="text" name="name" placeholder="이름을 입력해 주세요." value="<?php echo $R['name']?>" class="form-control" autocomplete="off">
  		     </div>
  				 <?php if(!$R['uid']||$reply=='Y'):?>
  				 <div class="input-row">
  					 <label>암호</label>
  					 <input type="password" name="pw" placeholder="암호는 게시글 수정 및 삭제에 필요합니다." value="<?php echo $R['pw']?>" class="form-control" autocomplete="off">
  					 <small class="form-text text-muted">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</small>
  				 </div>
  				 <?php endif?>
  				 <?php endif?>

  					<input type="text" name="subject" placeholder="제목" value="" autocomplete="off">

  			 </div><!-- /.form-list -->

  			 <div class="mt-0">
  				 <script>
  				 var attach_file_saveDir = '<?php echo $g['path_file']?>bbs/';// 파일 업로드 폴더
  				 var attach_module_theme = '_mobile/rc-default';// attach 모듈 테마
  				 </script>
           <div class="rb-article">
           	<div data-role="editor">
           		<input type="hidden" name="content" value="">
           		<div data-role="editor-body" class="editable-container"></div>
           	</div>
           </div>
  			 </div>

  		</form>

  	</div>
  </section>

  <section id="page-category" class="page right">
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
  		      <input id="radio1" name="radio" type="radio" class="custom-control-input" value="<?php echo $_catexp[$i]?>" <?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> checked<?php endif?>>
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

  <section id="page-attach" class="page right">
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

  <section id="page-tag" class="page right">
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

  <section id="page-location" class="page right">
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

  <section id="page-option" class="page right">
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

<script>

var f = document.getElementById("writeForm");
var page_main = $('#page-main')
var writeForm = $('#writeForm')
var submitFlag = false;
var loadingMsg = '<?php echo $uid?'수정중..':'등록중..' ?>'

var bbs_editor;
var modal_bbs_write = $('#modal-bbs-write');

function cancelCheck(){
	if (confirm('정말 취소하시겠습니까?    ')){
		history.back();
	}
}

$(function() {

	// 카테고리 항목 클릭에 글쓰기폼의 name="category" 에 값 적용하기
	$("#page-category").find('[type="radio"]').click(function() {
	   var radio_val = $(this).val()
		 writeForm.find('[name="category"]').val(radio_val)
		 page_main.find('[data-role="tap-category"] .icon').removeClass('text-muted')
		 page_main.find('[data-role="tap-category"]').removeClass('text-muted').addClass('active')
	});

	// 태그 페이지가 닫힐때 태그폼의 내용을 추출하여 글쓰기폼의 name="tag" 에 값 적용하기
	$('#page-tag').on('hidden.rc.page', function () {
		var tag = $('#page-tag').find('[name="tag"]').val()
		page_main.find('[name="tag"]').val(tag)
	})

	// 옵션 페이지의 항목 비밀글 항목에 클릭시에 글쓰기폼의 name="hidden" 에 값 적용하기
	$("#page-option").find('[name="hidden"]').click(function() {
		if ($(this).is(":checked")) {
			var check_val = 1
		} else {
			var check_val = 0
		}
		 writeForm.find('[name="hidden"]').val(check_val)
		 page_main.find('[data-role="tap-option"] .icon').removeClass('text-muted')
		 page_main.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
	});

	// 옵션 페이지의 항목 공지글 항목에 클릭시에 글쓰기폼의 name="notice" 에 값 적용하기
	$("#page-option").find('[name="notice"]').click(function() {
		if ($(this).is(":checked")) {
			var check_val = 1
		} else {
			var check_val = 0
		}
		 writeForm.find('[name="notice"]').val(check_val)
		 page_main.find('[data-role="tap-option"] .icon').removeClass('text-muted')
		 page_main.find('[data-role="tap-option"]').removeClass('text-muted').addClass('active')
	});

	$('#writeForm').submit( function(event){

		if (submitFlag == true)
		{
			alert('게시물을 등록하고 있습니다. 잠시만 기다려 주세요.');
			return false;
		}
		if (f.name && f.name.value == '')
		{
			alert('이름을 입력해 주세요. ');
			setTimeout(function(){f.name.focus()}, 100);
			return false;
		}
		if (f.pw && f.pw.value == '')
		{
			alert('비밀번호를 입력해 주세요. ');
			setTimeout(function(){f.pw.focus()}, 100);
			return false;
		}
		if (f.subject.value == '')
		{
			alert('제목을 입력해 주세요.       ');
			setTimeout(function(){f.subject.focus()}, 100);
			return false;
		}
		if (f.notice && f.hidden)
		{
			if (f.notice.value == 1 && f.hidden.value == 1)
			{
				alert('공지글은 비밀글로 등록할 수 없습니다.  ');
				$('#page-option').page({ start: '#page-main' });
				return false;
			}
		}

		<?php if ($B['category']): ?>
		if (f.category && f.category.value == '')
		{
			alert('카테고리를 선택해 주세요. ');
			$('#page-category').page({ start: '#page-main' });
			return false;
		}
		<?php endif; ?>

    var editorData = editor.getData();

    if (editorData == '') {
			alert('내용을 입력해 주세요.       ');
			setTimeout(function(){editor.editing.view.focus();}, 100);
			return false;
		} else {
      $('[name="content"]').val(editorData);
    }

		// 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
	  var featured_img_input = $('#page-main').find('input[name="featured_img"]'); // 대표이미지 input
	  var featured_img_uid = $(featured_img_input).val();
	  if(featured_img_uid ==''){ // 대표이미지로 지정된 값이 없는 경우
	    var first_attach_img_li = $('#page-attach').find('[data-role="attach-preview-photo"] li:first'); // 첫번째 첨부된 이미지 리스트 li
	    var first_attach_img_uid = $(first_attach_img_li).data('id');
	    $(featured_img_input).val(first_attach_img_uid);
	  }

	  // 첨부파일 uid 를 upfiles 값에 추가하기
	  var attachfiles=$('#page-attach').find('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
	  var new_upfiles='';
	  if(attachfiles){
	    for(var i=0;i<attachfiles.length;i++) {
   			new_upfiles+=attachfiles[i];
	    }
	    $('#page-main').find('input[name="upfiles"]').val(new_upfiles);
	  }

		submitFlag = true;

	  $('.js-submit').attr("disabled",true);
		$('.form-control').focusout()
		setTimeout(function(){ // 스마트폰 가상키보드가 내려갈때까지 대기
			$.loader({
			  text: loadingMsg
			});
		}, 500);

		setTimeout(function(){
			getIframeForAction(f);
			f.submit();
		}, 700);

		event.preventDefault();
	  event.stopPropagation();
	  }
	);

	$(".js-submit").tap(function() {
		$('#writeForm').submit()
	});

	// 위치지정 페이지가 호출되었을때
	$('#page-location').on('show.rc.page', function () {
		var width = $(document).width();
		var height = $(document).width();
		$('#location-map').css('width',width+'px')
		$('#location-map').css('height',height+'px')
	})



  DecoupledEditor
    .create( document.querySelector( '#modal-bbs-write [data-role="editor-body"]' ),{
      placeholder: '내용',
        toolbar: [ 'alignment:left','alignment:center','bulletedList','blockQuote','imageUpload','insertTable','undo'],
      removePlugins: [ 'ImageToolbar', 'ImageCaption', 'ImageStyle' ],
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
      console.log('글쓰기 에디터가 초기화 되었습니다.');

      bbs_editor = newEditor;

      // console.log(bbs_editor.ui.view.toolbar.element)

      modal_bbs_write.find('.toolbar-container').html(bbs_editor.ui.view.toolbar.element)

      // document.querySelector( '.toolbar-container' ).appendChild( bbs_editor.ui.view.toolbar.element );

      bbs_editor.editing.view.document.on( 'change:isFocused', ( evt, name, value ) => {
        if (value) {
          console.log('본문입력 에디터에 포커스 되었습니다.');
          modal_bbs_write.addClass('editor-focused');
        } else {
          console.log('본문입력 에디터에 포커스 되지 않았습니다..');
          modal_bbs_write.removeClass('editor-focused');
        }
      } );


    })
    .catch( error => {
        console.error( error );
    } );

  $('#modal-bbs-write').on('show.rc.modal', function (e) {
    // 글쓰기 권한 체크
    var modal = $(this)
  })

  $('#modal-bbs-write').on('hidden.rc.modal', function (e) {
    var modal = $(this)
    modal.find('[name="subject"]').val(''); //제목 초기화
    bbs_editor.setData( '' );  //본문내용 초기화
  })

});

</script>
