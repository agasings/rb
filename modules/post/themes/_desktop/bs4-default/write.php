<form name="writeForm" method="post" action="<?php echo $g['s']?>/" role="form" class="rb-post-write">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="m" value="<?php echo $m?>">
  <input type="hidden" name="a" value="write">
  <input type="hidden" name="uid" value="<?php echo $R['uid']?>">
  <input type="hidden" name="category_members" value="">
  <input type="hidden" name="list_members" value="">
  <input type="hidden" name="upload" id="upfilesValue" value="<?php echo $R['upload']?>">
  <input type="hidden" name="featured_img" value="<?php echo $R['featured_img'] ?>">
  <input type="hidden" name="html" value="HTML">
  <input type="hidden" name="display">

  <header class="d-flex align-items-center py-3 px-4">

    <a href="<?php echo RW('mod=dashboard&page=post')?>" title="포스트 관리" class="mr-2" data-toggle="tooltip">
      <i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i>
    </a>

    <div class="form-group mb-0" style="width:71.5%">
      <label class="sr-only">제목</label>
      <input type="text" name="subject" value="<?php echo $R['subject']?>" class="form-control form-control-lg" <?php echo !$cid?' autofocus':'' ?> placeholder="제목없는 포스트">
    </div>
  </header>

  <main>

    <?php
      $d['theme']['show_edittoolbar'] = true;
      $__SRC__ = getContents($R['content'],$R['html']);
      include $g['path_plugin'].'ckeditor5/import.desktop.post.php';
    ?>

  </main><!-- /.col -->

  <aside class="border-top">
    <div class="inner">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">기본</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#advan" role="tab" aria-controls="info" aria-selected="true">고급</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="attach-tab" data-toggle="tab" href="#attach" role="tab" aria-controls="attach" aria-selected="false">첨부</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#link" role="tab" aria-controls="link" aria-selected="false">링크</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#index" role="tab" aria-controls="index" aria-selected="false">목차</a>
        </li>

      </ul>
      <div class="tab-content p-3">
        <div class="tab-pane show active" id="basic" role="tabpanel" aria-labelledby="home-basic">

          <div class="form-group">
            <label class="sr-only">요약설명</label>
            <textarea class="form-control" rows="3" name="review" placeholder="요약설명을 입력하세요"><?php echo $R['review']?></textarea>
            <small class="form-text text-muted">100자 이내로 등록할 수 있으며 태그를 사용할 수 있습니다.</small>
          </div>

          <div class="form-group mt-4">
            <label class="sr-only">태그</label>
            <textarea class="form-control" rows="2" name="tag" placeholder="태그를 입력하세요"><?php echo $R['tag']?></textarea>
            <small class="form-text text-muted">콤마(,)로 구분하여 입력해 주세요.</small>
          </div>

          <?php if ($cid): ?>

          <div class="form-group">
            <label class="sr-only">리스트</label>

            <div class="dropdown dropdown-filter" data-role="list-selector">
              <button class="btn btn-white btn-block dropdown-toggle d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                리스트 선택
                <div class="mr-4"><span class="badge badge-primary" data-role="list_num"></span></div>
              </button>
              <div class="dropdown-menu shadow pt-0" style="width: 320px">

                <div class="dropdown-body p-3" style="max-height: 300px;overflow:auto">

                  <?php
                    $listque	= 'mbruid='.$my['uid'];
                    $_RCD = getDbArray($table['postlist'],$listque,'*','gid','asc',30,1);
                    $NUM = getDbRows($table['postlist'],$listque);
                  ?>
                  <?php foreach($_RCD as $_R):?>
                  <?php $is_list =  getDbRows($table[$m.'list_index'],'data='.$R['uid'].' and list='.$_R['uid'])  ?>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="listRadio<?php echo $_R['uid'] ?>" name="postlist_members[]" value="<?php echo $_R['uid'] ?>" class="custom-control-input" <?php echo $is_list?' checked':'' ?>>
                    <label class="custom-control-label" for="listRadio<?php echo $_R['uid'] ?>"><?php echo $_R['name'] ?></label>
                  </div>
                  <?php endforeach?>

                  <?php if(!$NUM):?>
                  <div class="text-center text-muted p-5">리스트가 없습니다.</div>
                  <?php endif?>

                </div><!-- /.dropdown-body -->

                <div class="dropdown-footer px-2">
                  <button type="button" class="btn btn-white btn-block mt-3" data-role="list-add-button">+ 리스트 추가</button>
                  <div class="input-group mt-3 d-none" data-role="list-add-input">
                    <input type="text" class="form-control" placeholder="리스트명 입력" name="list_name">
                    <div class="input-group-append">
                      <button class="btn btn-white" type="button" data-act="list-add-submit">
                        <span class="not-loading">
                          추가
                        </span>
                        <span class="is-loading">
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                      </button>
                      <button class="btn btn-white" type="button" data-act="list-add-cancel">취소</button>
                    </div>
                  </div><!-- /.input-group -->
                </div><!-- /.dropdown-footer -->
              </div>
            </div>

          </div>

          <div class="form-group">
            <label class="small text-muted">포스트 URL</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" value="<?php echo $g['url_root'].getPostLink($R,0) ?>" readonly id="_url_">
              <div class="input-group-append">
                <button type="button" class="btn btn-white js-clipboard js-tooltip" title="클립보드에 복사" data-clipboard-target="#_url_">
                  <i class="fa fa-clone" aria-hidden="true"></i>
                </button>
                <a class="btn btn-white" href="<?php echo getPostLink($R,0) ?>" target="_blank" data-toggle="tooltip" title="최종화면">
                  <i class="fa fa-share" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>

          <div data-role="display" class="d-none">
            <span class="d-block mt-4 small text-muted">공유 설정</span>
            <ul class="list-group list-group-flush f13 mt-1 border-bottom">
              <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-0">

                <div class="media">
                  <span class="fa-stack fa-lg mr-2">
                    <i class="fa fa-square fa-stack-2x"></i>
                    <i class="" data-role="icon"></i>
                  </span>

                  <div class="media-body align-self-center">
                    <span data-role="heading"></span> <br><span data-role="description"></span>
                  </div>
                </div>

                <div class="dropdown">
                  <button type="button" class="btn btn-link btn-sm text-nowrap" data-toggle="dropdown">
                    변경...
                  </button>

                  <div class="dropdown-menu dropdown-menu-right shadow py-0" style="width:260px;line-height: 1.2">

                    <div class="list-group list-group-flush">
                      <button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==4?' active':'' ?>" data-icon="globe" data-display="4">
                        <div class="media align-items-center">
                          <i class="fa fa-globe fa-2x mr-3"></i>
                          <div class="media-body">
                            <span data-heading>전체공개</span><br>
                            <small data-description>모든 사용자가 검색하고 볼 수 있음</small>
                          </div>
                        </div>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==3?' active':'' ?>" data-icon="link" data-display="3">
                        <div class="media align-items-center">
                          <i class="fa fa-link fa-2x mr-3" aria-hidden="true"></i>
                          <div class="media-body">
                            <span data-heading>미등록</span><br>
                            <small data-description>링크 있는 사용자만 볼 수 있음.<br>로그인 불필요</small>
                          </div>
                        </div>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==2?' active':'' ?>" data-icon="users" data-display="2">
                        <div class="media align-items-center">
                          <i class="fa fa-users fa-2x mr-3" aria-hidden="true"></i>
                          <div class="media-body">
                            <span data-heading>회원공개</span><br>
                            <small data-description>사이트 회원만 볼수 있음. 로그인 필요</small>
                          </div>
                        </div>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action<?php echo $R['display']==1?' active':'' ?>" data-icon="user-secret" data-display="1">
                        <div class="media align-items-center">
                          <i class="fa fa-user-secret fa-2x ml-1 mr-3" aria-hidden="true"></i>
                          <div class="media-body">
                            <span data-heading>지정공개</span><br>
                            <small data-description>초대된 회원만 볼수 있음</small>
                          </div>
                        </div>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action<?php echo !$R['display']?' active':'' ?>" data-icon="lock" data-display="0">
                        <div class="media align-items-center">
                          <i class="fa fa-lock fa-2x ml-1 mr-4" aria-hidden="true"></i>
                          <div class="media-body">
                            <span data-heading>비공개</span><br>
                            <small data-description>나만 볼수 있음</small>
                          </div>
                        </div>
                      </button>
                    </div>

                  </div>
                </div>

              </li>
            </ul>

            <div class="d-none" data-role="postmember">
              <ul class="list-group list-group-flush f13 mt-1">

                <?php foreach($MBR_RCD as $MBR): ?>
                <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-0">

                  <div class="media">
                    <img class="rounded ml-1 mr-2" src="<?php echo getAvatarSrc($MBR['memberuid'],'31') ?>" width="31" height="31" alt="<?php echo $MBR['name'] ?>">

                    <div class="media-body align-self-center">
                      <?php echo $MBR[$_HS['nametype']] ?>님 <?php echo $my['uid']==$MBR['memberuid']?'(나)':'' ?>     <br>
                      <span class="text-muted"><?php echo $MBR['email'] ?></span>
                    </div>
                  </div>

                  <div class="pr-3">
                    <span class="f12 text-muted">소유자</span>
                  </div>

                </li>
                <?php endforeach?>

              </ul>

              <div class="text-right mt-2">
                <button type="button" class="btn btn-white btn-sm" data-toggle="modal" data-target="#modal-post-share" data-backdrop="static" disabled>
                  사용자 초대
                </button>
              </div>
            </div><!-- /data-role="postmember" -->

          </div><!-- /data-role="display" -->

          <?php endif; ?>

        </div>
        <div class="tab-pane fade" id="attach" role="tabpanel" aria-labelledby="attach-tab">

          <div class="form-group mt-4 mb-5">
            <label class="sr-only">첨부파일</label>
            <?php include $g['dir_module_skin'].'_uploader.php'?>
          </div>


        </div>
        <div class="tab-pane" id="advan" role="tabpanel" aria-labelledby="link-tab">

          <ul class="list-group mb-4">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              댓글 허용
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="dis_comment" value="1" id="dis_comment" checked>
                <label class="custom-control-label" for="dis_comment"></label>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              좋아요 허용
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="dis_like" value="1" id="dis_like" checked>
                <label class="custom-control-label" for="dis_like"></label>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              평점 허용
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="dis_rating" value="1" id="dis_rating" checked>
                <label class="custom-control-label" for="dis_rating"></label>
              </div>
            </li>
          </ul>

          <div class="card mb-4">
            <div class="card-header">
              카테고리
            </div>
            <div class="card-body pt-2 pb-0">
              <?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>true,'allOpen'=>true)?>
              <?php echo getTreePostCategoryCheck($_treeOptions,$R['uid'],0,0,'')?>
            </div>
          </div>

          <?php if ($cid): ?>
          <dl class="row mt-5 f13">
            <dt class="col-3">생성일시 :</dt>
            <dd class="col-9"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></dd>
          </dl>
          <?php endif; ?>

        </div>
        <div class="tab-pane" id="link" role="tabpanel" aria-labelledby="link-tab">

          <?php getWidget('_default/attach',array('parent_module'=>'post','theme'=>'_desktop/bs4-default-link','attach_handler_photo'=>'[data-role="attach-handler-photo"]','parent_data'=>$R,'wysiwyg'=>'Y'));?>

        </div>
        <div class="tab-pane" id="index" role="tabpanel" aria-labelledby="index-tab">

          <nav id="toc" class="ml-3"></nav>

        </div>
      </div>
    </div>
  </aside><!-- /.col -->

  <div class="position-absolute" style="top:15px;right:30px">

    <?php if (!$cid): ?>
    <button type="button" class="btn btn-link" data-history="back">취소</button>
    <?php else: ?>

    <span class="mr-2 f13 align-middle font-italic d-inline-block animated fadeIn delay-1" data-toggle="tooltip" title="<?php echo getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'Y.m.d H:i')?>" data-role="d_modify">
      <time data-plugin="timeago" datetime="<?php echo getDateFormat($R['d_modify']?$R['d_modify']:$R['d_regis'],'c')?>"></time>
      저장 되었습니다.
    </span>

    <a class="btn btn-white" href="<?php echo RW('mod=dashboard&page=post')?>" data-role="library">포스트 관리</a>

    <?php endif; ?>

    <button type="button" class="btn btn-primary<?php echo $cid?' d-none':'' ?>" data-role="postsubmit" data-toggle="tooltip" title="단축키 (ctl+m)">
      <span class="not-loading">
        저장하기
      </span>
      <span class="is-loading">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        저장중
      </span>
    </button>

    <div class="d-inline-block dropdown">
      <a class="d-block ml-3" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-role="tooltip" title="프로필보기 및 회원계정관리">
        <img src="<?php echo getAvatarSrc($my['uid'],'30') ?>" width="30" height="30" alt="" class="rounded-circle">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <h6 class="dropdown-header"><?php echo $my['nic'] ?> 님</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo RW('m=post&mod=write')?>">
          새 포스트
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo RW('mod=dashboard')?>">
          대시보드
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo getProfileLink($my['uid'])?>">
          프로필
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo RW('mod=settings')?>">
          설정
        </a>
        <button class="dropdown-item" type="button" data-act="logout" role="button">
          로그아웃
        </button>
        <?php if ($my['admin']): ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" href="/admin" target="_top">관리자모드</a>
        <?php endif; ?>
      </div>
    </div>


  </div>

</form>

<!-- Modal -->
<div class="modal" id="modal-post-share" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title">공유 설정</h5>
      </div>
      <div class="modal-body">

        <label class="small text-muted">액세스 권한이 있는 사용자</label>
        <ul class="list-group list-group-flush f13">
          <?php foreach($MBR_RCD as $MBR): ?>
          <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-0">

            <div class="media">
              <img class="rounded ml-1 mr-2" src="<?php echo getAvatarSrc($MBR['memberuid'],'31') ?>" width="31" height="31" alt="<?php echo $MBR['name'] ?>">

              <div class="media-body align-self-center">
                <?php echo $MBR[$_HS['nametype']] ?>님 <?php echo $my['uid']==$MBR['memberuid']?'(나)':'' ?>     <br>
                <span class="text-muted"><?php echo $MBR['email'] ?></span>
              </div>
            </div>

            <div class="pr-3">
              <span class="f12 text-muted">소유자</span>
            </div>

          </li>
          <?php endforeach?>
        </ul>

        <div class="form-group mt-5">
          <label class="small text-muted">초대할 사용자</label>
          <div class="input-group">
            <input type="text" class="form-control" placeholder="닉네임 또는 이메일 주소 입력">
            <div class="input-group-append">
              <button class="btn btn-white dropdown-toggle" data-toggle="dropdown" type="button">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">수정가능</a>
                <a class="dropdown-item" href="#">보기가능</a>
              </div>
            </div>
          </div>

        </div>


      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-primary" data-dismiss="modal">완료</button>
      </div>
    </div>
  </div>
</div>

<!-- bootstrap-toc : https://github.com/afeld/bootstrap-toc -->
<?php getImport('bootstrap-toc','bootstrap-toc','1.0.1','css')?>
<?php getImport('bootstrap-toc','bootstrap-toc.min','1.0.1','js')?>

<?php getImport('smooth-scroll','smooth-scroll.min','16.1.0','js') ?>

<!-- 클립보드저장 : clipboard.js  : https://github.com/zenorocha/clipboard.js-->
<?php getImport('clipboard','clipboard.min','2.0.4','js') ?>

<script>

// 내용 변경 감지
var content = editor.getData();
var changed_meta = false;  //부가정보 수정여부
var changed_content =  false;  // 본문수정 여부
var checkUnload = false;  // 페이지 이탈시 경고창 출력여부 (기본값 : 출력안함)

document.title = '글쓰기 | <?php echo $g['browtitle']?>';

putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력

function setPostDisplay(display) {
  var section = $('[data-role="display"]');
  var button = section.find('.list-group-item[data-display="'+display+'"]')
  var input = $('[name="display"]');
  var icon = button.attr('data-icon');
  var heading = button.find('[data-heading]').text();
  var description = button.find('[data-description]').html();

  section.find('.list-group-item').removeClass('active'); // 상태초기화
  section.find('[data-role="postmember"]').addClass('d-none');

  button.addClass('active');
  input.val(display);
  section.find('[data-role="icon"]').removeAttr('class').addClass('fa fa-'+icon+' fa-stack-1x fa-inverse');
  section.find('[data-role="heading"]').text(heading);
  section.find('[data-role="description"]').html(description);
  section.removeClass('d-none')
  if (display==1) section.find('[data-role="postmember"]').removeClass('d-none');
}

$(document).ready(function() {

  var clipboard = new ClipboardJS('.js-clipboard');

  clipboard.on('success', function (e) {
    $(e.trigger)
      .attr('title', '복사완료!')
      .tooltip('_fixTitle')
      .tooltip('show')
      .attr('title', '클립보드 복사')
      .tooltip('_fixTitle')

    e.clearSelection()
  })

  // smoothScroll : https://github.com/cferdinandi/smooth-scroll
  var scroll_content = new SmoothScroll('[data-toggle="toc"] a[href*="#"]',{
  	ignore: '[data-scroll-ignore]'
  });

  $("#toc").empty();
  listCheckedNum()
  doToc();

  // dropdown 내부클릭시 dropdown 유지
	$('[data-role="list-selector"] .dropdown-menu').on('click', function(e) {
		e.stopPropagation();
	});

  $('[data-role="list-add-button"]').click( function() {
    $(this).addClass('d-none');
    $('[data-role="list-add-input"]').removeClass('d-none')
    $('[data-role="list-add-input"]').find('.form-control').val('').focus();
  } );
  $('[data-act="list-add-cancel"]').click( function() {
    $('[data-role="list-add-button"]').removeClass('d-none');
    $('[data-role="list-add-input"]').addClass('d-none')
  } );

  $(document).on('change','[data-role="list-selector"] [type="checkbox"]',function(){
    listCheckedNum()
  });

  $('.rb-post-write').find('.form-control, .form-check-input, .custom-control-input').change(function(){
    showSaveButton(true); // 저장버튼 출력
    checkUnload = true //페이지 이탈시 경고창 출력
  });

  editor.model.document.on( 'change:data', () => {
    if (content!=editor.getData()) {
      showSaveButton(true); // 저장버튼 출력
      checkUnload = true; //페이지 이탈시 경고창 출력
    } else {
      showSaveButton(false); // 저장버튼 숨김
      checkUnload = false; //페이지 이탈시 경고창 미출력
    }
  });

  $(window).on("beforeunload", function(){
      if(checkUnload) return "이 페이지를 벗어나면 작성된 내용은 저장되지 않습니다.";
  });

  $('[data-role="postsubmit"]').click(function(){
    checkUnload = false; //페이지 이탈시 경고창 미출력
    $('[data-toggle="tooltip"]').tooltip('hide');
    var f = document.writeForm;
    writeCheck(f)
  });

  $('[data-act="list-add-submit"]').click(function(e){
    var button = $(this)
    var input = $('[name="list_name"]');
    var list = $('[data-role="list-selector"]');
    var checked_num = list.find('[data-role="list_num"]');
    var checked_num_val = Number(checked_num.text());
    var name = input.val();

    if (!name) {
      input.focus();
      return false
    }
    button.attr( 'disabled', true );

    setTimeout(function(){

      $.post(rooturl+'/?r='+raccount+'&m=post&a=regis_list',{
        name : name,
        send_mod : 'ajax'
        },function(response,status){
          if(status=='success'){
            var result = $.parseJSON(response);
            var uid=result.uid;
            var item = '<div class="custom-control custom-checkbox">'+
                          '<input type="checkbox" id="listRadio'+uid+'" name="postlist_members[]" value="'+uid+'" class="custom-control-input" checked>'+
                          '<label class="custom-control-label" for="listRadio'+uid+'">'+name+'</label>'+
                        '</div>';
            button.attr( 'disabled', false );
            input.val('');
            $('[data-role="list-add-button"]').removeClass('d-none');
            $('[data-role="list-add-input"]').addClass('d-none')
            list.find('.dropdown-body').append(item);
            checked_num.text(checked_num_val+1);
          } else {
            alert(status);
          }
      });
    }, 200);
  });

  setPostDisplay(<?php echo $R['display'] ?>) // 현재 공개상태 셋팅

  $('[data-role="display"] .dropdown-menu .list-group-item').click(function(){
    var button = $(this)
    var display = button.attr('data-display');
    showSaveButton(true); // 저장버튼 출력
    setPostDisplay(display) // 공개상태 변경
  });

  // 퀵메뉴 단축키 지원
  $(document).on('keydown', function ( e ) {
    if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'm') ) {
      $('[data-role="postsubmit"]').removeClass('d-none');
      $('[data-role="library"]').addClass('d-none');
      $('[data-role="postsubmit"]').click(); // 저장 (ctl+k)
    }
  });

});

</script>
