var submitFlag = false;

function writeCheck(f) {

  if (submitFlag == true) {
		alert('포스트를 등록하고 있습니다. 잠시만 기다려 주세요.');
		return false;
	}

	if (f.subject.value == '') {
		alert('제목 입력해 주세요.');
		f.subject.focus();
		return false;
	}

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

	if(cat_sel_n>0 && cat_arr==''){
		alert('지정된 카테고리가 없습니다.\n적어도 하나이상의 카테고리를 지정해 주세요.');
    $('#basic').tab('show')
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

  $('[type="submit"]').attr( 'disabled', true );
  setTimeout(function(){
  	getIframeForAction(f);
  }, 600);

  submitFlag = true;
  return submitFlag;
}
