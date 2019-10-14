var submitFlag = false;

function listCheckedNum() {
  var checked_num = $('[data-role="list-selector"] :checkbox:checked').length;
  if(checked_num==0) checked_num='';
  $('[data-role="list_num"]').text(checked_num);
}

function doToc() {
  Toc.init({
    $nav: $("#toc"),
    $scope: $(".document-editor__editable-container h2, .document-editor__editable-container h3, .document-editor__editable-container h4")
  });
}

function showSaveButton(changed) {
  if (changed) {
    $('[data-role="postsubmit"]').removeClass('d-none');
    $('[data-role="library"]').addClass('d-none');
    $('[data-role="share"]').addClass('d-none');
  } else {
    $('[data-role="postsubmit"]').addClass('d-none');
    $('[data-role="library"]').removeClass('d-none');
    $('[data-role="share"]').removeClass('d-none');
  }
}

function writeCheck(f) {

  if (submitFlag == true) {
		alert('포스트를 등록하고 있습니다. 잠시만 기다려 주세요.');
		return false;
	}

	// if (f.subject.value == '') {
	// 	alert('제목 입력해 주세요.');
	// 	f.subject.focus();
	// 	return false;
	// }

  var editorData = editor.getData();

  if (editorData == '')
  {
    alert('내용을 입력해 주세요.       ');
    editor.editing.view.focus();
    return false;
  } else {
    $('[name="content"]').val(editorData)
  }

  // 카테고리 체크
	var cat_sel=$('input[name="tree_members[]"]');
	var cat_sel_n=cat_sel.length;
  var cat_arr=$('input[name="tree_members[]"]:checked').map(function(){return $(this).val();}).get();
	var cat_n=cat_arr.length;

	// if(cat_sel_n>0 && cat_arr==''){
	// 	alert('지정된 카테고리가 없습니다.\n적어도 하나이상의 카테고리를 지정해 주세요.');
  //   $('#advan').tab('show')
	// 	return false;
	// }

  var s='';
  for (var i=0;i <cat_n;i++) {
    if(cat_arr[i]!='')  s += '['+cat_arr[i]+']';
  }
  f.category_members.value = s;


  // 리스트 체크
  var list_sel=$('input[name="postlist_members[]"]');
  var list_arr=$('input[name="postlist_members[]"]:checked').map(function(){return $(this).val();}).get();
	var list_n=list_arr.length;
  var l='';
  for (var i=0;i <list_n;i++) {
    if(list_arr[i]!='')  l += '['+list_arr[i]+']';
  }
  $('input[name="list_members"]').val(l);

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

  checkUnload = false;
  $('[data-role="postsubmit"]').attr( 'disabled', true );

  var form = $('[name="writeForm"]')
  var uid = form.find('[name="uid"]').val();
  var category_members = form.find('[name="category_members"]').val();
  var list_members = form.find('[name="list_members"]').val();
  var upload = form.find('[name="upload"]').val();
  var featured_img = form.find('[name="featured_img"]').val();
  var html = form.find('[name="html"]').val();
  var subject = form.find('[name="subject"]').val();
  var review = form.find('[name="review"]').val();
  var tag = form.find('[name="tag"]').val();

  if (uid) {
    setTimeout(function(){

      $.post(rooturl+'/?r='+raccount+'&m=post&a=write',{
        content : editorData,
        uid : uid,
        category_members : category_members,
        list_members : list_members,
        upload : upload,
        featured_img : featured_img,
        html : html,
        subject : subject,
        review : review,
        tag : tag
        },function(response,status){
          if(status=='success'){
            var result = $.parseJSON(response);
            var d_modify=result.d_modify;
            form.find('[data-role="postsubmit"]').attr( 'disabled', false );
            form.find('[data-role="d_modify"]').attr('data-original-title',d_modify);
            form.find('[data-plugin="timeago"]').timeago("update", new Date());
            form.find('[data-role="postsubmit"]').addClass('d-none');
            form.find('[data-role="library"]').removeClass('d-none');
            form.find('[data-role="share"]').removeClass('d-none');
          } else {
            alert(status);
          }
      });
    }, 200);

  } else {
    setTimeout(function(){
      getIframeForAction(f);
      f.submit()
    }, 200);
  }
}
