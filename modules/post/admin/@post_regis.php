<?php

$R=array();
$upfile = '';

if ($uid) {
	$R=getUidData($table[$module.'data'],$uid);

  $u_arr = getArrayString($R['upfiles']);
  $_tmp=array();
  $i=0;
  foreach ($u_arr['data'] as $val) {
     $U=getUidData($table['s_upload'],$val);
     if(!$U['fileonly']) $_tmp[$i]=$val;
     $i++;
  }

  $insert_array='';
  // 중괄로로 재조립
  foreach ($_tmp as $uid) {
    $insert_array.='['.$uid.']';
  }
}

?>

<div id="regisbox" class="p-4">
	<form name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="regis_post">
		<input type="hidden" name="uid" value="<?php echo $R['uid']?>">
    <input type="hidden" name="category_members">
    <input type="hidden" name="upload" id="upfilesValue" value="<?php echo $R['upload']?>">
    <input type="hidden" name="featured_img" value="<?php echo $R['featured_img'] ?>">
		<input type="hidden" name="html" value="HTML">

    <div class="d-flex justify-content-between">
      <h3>
        포스트 <?php echo $R['uid']?'수정':'등록'?>하기
      </h3>
      <div class="mb-3">
        <a class="btn btn-light" href="<?php echo $g['adm_href'] ?>&front=main" title="매장보기">
          포스트 목록
        </a>

        <?php if ($uid): ?>
        <a class="btn btn btn-outline-success" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;uid=<?php echo $R['uid']?>" target="_blank">
          보기
        </a>
        <?php endif; ?>

      </div>
    </div>

    <div class="row mt-4">
      <div class="col-8">

				<div class="form-group">
		      <label class="sr-only">제목</label>
		      <input type="text" name="subject" value="<?php echo $R['subject']?>" class="form-control" <?php echo !$uid?' autofocus':'' ?> placeholder="제목을 입력하세요">
		    </div>

				<div class="form-group">
					<label class="sr-only">요약설명</label>
					<textarea class="form-control" rows="2" name="review" placeholder="요약설명을 입력하세요"><?php echo $R['review']?></textarea>
					<small class="form-text text-muted">500자 이내로 등록할 수 있으며 태그를 사용할 수 있습니다.</small>
				</div>

        <?php
          $d['theme']['show_edittoolbar'] = true;
          $__SRC__ = htmlspecialchars($R['content']);
          include $g['path_plugin'].'ckeditor/import.desktop.php';
        ?>

				<div class="form-group mt-4">
					<label class="sr-only">태그</label>
					<input type="text" name="tag" value="<?php echo $R['tag']?>" class="form-control"  placeholder="태그를 입력하세요">
					<small class="form-text text-muted">콤마(,)로 구분하여 입력해 주세요.</small>
				</div>

      </div>
      <div class="col-4">

        <div class="card">
          <div class="card-header">
            카테고리
          </div>
          <div class="card-body">
            <?php $_treeOptions=array('site'=>$s,'table'=>$table[$module.'category'],'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>true,'allOpen'=>true,'bookmark'=>'site-menu-info')?>
            <?php $_treeOptions['link'] = $g['adm_href'].'&amp;cat='?>
            <?php echo getTreePostCategoryCheck($_treeOptions,$uid,0,0,'')?>
          </div>
        </div>

				<div class="card">
          <div class="card-header">
            연결메뉴
          </div>
          <div class="card-body">

						<select name="linkedmenu" class="form-control custom-select">
							<option value="">사용 안함</option>
							<option disabled>--------------------</option>
							<?php include_once $g['path_core'].'function/menu1.func.php'?>
							<?php $cat=$R['linkedmenu']?>
							<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
						</select>
						<small class="form-text text-muted">
							이 포스트를 메뉴에 연결하였을 경우 해당메뉴를 지정해 주세요.<br>
							연결메뉴를 지정하면 로케이션이 동기화 됩니다.
						</small>

          </div>
        </div>

				<div class="card">
					<div class="card-header">
						연결 상품
					</div>
					<div class="card-body">
						<input class="form-control" name="linkedshop" type="text" placeholder="연결할 상품" value="<?php echo $R['linkedshop']?>">
						<small class="form-text text-muted">
							[상품고유번호][상품고유번호].. 형식으로 입력해주세요
						</small>
					</div>
				</div>

        <?php include_once $g['path_module'].$module.'/admin/_uploader.php'; ?>

        <small class="form-text text-muted">
          jpg/gif/png 파일만 등록가능합니다.
        </small>

        <div class="my-3">
          <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
            <i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i> <?php if($R['uid']):?>포스트 수정<?php else:?>새 포스트 등록<?php endif?>
          </button>

        </div>

      </div>
    </div><!-- /.row -->

	</form>
</div>


<!-- 요약부분 글자수 체크 -->
<?php getImport('bootstrap-maxlength','bootstrap-maxlength.min',false,'js') ?>


<script type="text/javascript">

//사이트 셀렉터 출력
$('[data-role="siteSelector"]').removeClass('d-none')

putCookieAlert('result_post_regis') // 실행결과 알림 메시지 출력

function saveCheck(f) {
	if (f.subject.value == '')
	{
		alert('제목 입력해 주세요.');
		f.subject.focus();
		return false;
	}

  // 카테고리 체크
	var cat_sel=$('input[name="tree_members[]"]');
	var cat_sel_n=cat_sel.length;
  var cat_arr=$('input[name="tree_members[]"]:checked').map(function(){return $(this).val();}).get();
	var cat_n=cat_arr.length;

	if(cat_sel_n>0 && cat_arr==''){
		alert('지정된 카테고리가 없습니다.\n적어도 하나이상의 카테고리를 지정해 주세요.');
		return false;
	} else {
    var s='';
    for (var i=0;i <cat_n;i++) {
      if(cat_arr[i]!='')  s += '['+cat_arr[i]+']';
    }
    f.category_members.value = s;
	}

  // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
  var featured_img_input = $('input[name="featured_img"]'); // 대표이미지 input
  var featured_img_uid = $(featured_img_input).val();
  if(featured_img_uid ==0){ // 대표이미지로 지정된 값이 없는 경우
    var first_attach_img_li = $('.rb-attach-photo li:first'); // 첫번째 첨부된 이미지 리스트 li
    var first_attach_img_uid = $(first_attach_img_li).attr('data-id');
    featured_img_input.val(first_attach_img_uid);
  }

  // 첨부파일 uid 를 upfiles 값에 추가하기
  var attachfiles=$('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
  var new_upfiles='';
  if(attachfiles){
    for(var i=0;i<attachfiles.length;i++) {
      new_upfiles+=attachfiles[i];
    }
    $('input[name="upload"]').val(new_upfiles);
  }

	getIframeForAction(f);
}


</script>
