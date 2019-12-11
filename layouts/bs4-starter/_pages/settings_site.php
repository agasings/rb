<?php
if (!$my['admin']) getLink('','','잘못된 접속입니다.','-1');

?>

<div class="mt-4 mb-2 border-bottom">
  <h3 class="pb-2">사이트 설정</h3>
</div>

<form name="settingForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>"  class="my-4" role="form">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="a" value="regissitecode">
  <input type="hidden" name="m" value="site">

  <div class="form-group row">
    <label for="" class="col-2 col-form-label text-right">추천 포스트</label>
    <div class="col-10">
      <input type="text" class="form-control" name="main_post_req" value="<?php echo $d['site']['main_post_req'] ?>" placeholder="고유번호 입력">
      <small class="form-text text-muted">
        콤마(,)로 구분하여 포스트 고유번호를 입력해주세요.중복출력을 피하기 위해 포스트의 공개설정을 '미등록' 으로 변경해주세요.
      </small>
    </div>
  </div>

  <div class="text-center mt-5">
    <button type="submit" class="btn btn-primary">저장</button>
  </div>


</form>
