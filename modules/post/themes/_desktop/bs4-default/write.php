<form name="writeForm" method="post" action="<?php echo $g['s']?>/" onsubmit="return writeCheck(this);" role="form" class="rb-post-write">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="m" value="<?php echo $m?>">
  <input type="hidden" name="a" value="write">
  <input type="hidden" name="uid" value="<?php echo $R['uid']?>">
  <input type="hidden" name="category_members">
  <input type="hidden" name="upload" id="upfilesValue" value="<?php echo $R['upload']?>">
  <input type="hidden" name="featured_img" value="<?php echo $R['featured_img'] ?>">
  <input type="hidden" name="html" value="HTML">

  <header class="d-flex align-items-center py-3 px-4">

    <a href="<?php echo RW('mod=library')?>" title="내 보관함" class="muted-link mr-2" data-toggle="tooltip">
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
            <small class="form-text text-muted">500자 이내로 등록할 수 있으며 태그를 사용할 수 있습니다.</small>
          </div>

          <div class="form-group mt-4">
            <label class="sr-only">태그</label>
            <input type="text" name="tag" value="<?php echo $R['tag']?>" class="form-control"  placeholder="태그를 입력하세요">
            <small class="form-text text-muted">콤마(,)로 구분하여 입력해 주세요.</small>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">리스트</label>
            <select class="form-control custom-select">
              <option>선택하세요.</option>
              <option>리스트 2</option>
              <option>리스트 3</option>
              <option>리스트 4</option>
              <option>리스트 5</option>
              <option>리스트 5</option>
              <option>리스트 만들기</option>
            </select>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              카테고리
            </div>
            <div class="card-body pt-2 pb-0">
              <?php $_treeOptions=array('site'=>$s,'table'=>$table[$m.'category'],'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>true,'allOpen'=>true)?>
              <?php echo getTreePostCategoryCheck($_treeOptions,$R['uid'],0,0,'')?>
            </div>
          </div>



        </div>
        <div class="tab-pane fade" id="attach" role="tabpanel" aria-labelledby="attach-tab">

          <div class="form-group mt-4 mb-5">
            <label class="sr-only">첨부파일</label>
            <?php include $g['dir_module_skin'].'_uploader.php'?>
          </div>


        </div>
        <div class="tab-pane" id="advan" role="tabpanel" aria-labelledby="link-tab">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="hidden"  value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              공개
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="hidden"  value="option1" <?php if($R['hidden']):?> checked<?php endif?>>
            <label class="form-check-label" for="exampleRadios1">
              미등록
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="hidden"  value="option2">
            <label class="form-check-label" for="exampleRadios2">
              비공개 - 나만 액세스할 수 있습니다.
            </label>
          </div>

          최초작성자

          <div class="">
            소유자
          </div>

          <div class="">
            참여자
          </div>

        </div>
        <div class="tab-pane" id="link" role="tabpanel" aria-labelledby="link-tab">
          링크 추가
        </div>
        <div class="tab-pane" id="index" role="tabpanel" aria-labelledby="index-tab">
          목차
        </div>
      </div>
    </div>
  </aside><!-- /.col -->

  <div class="position-absolute" style="top:65px;right:30px">

    <?php if ($uid): ?>
    <a class="btn btn btn-outline-success" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;uid=<?php echo $R['uid']?>" target="_blank">
      보기
    </a>
    <?php endif; ?>

    <button type="submit" class="btn btn-outline-primary">
      <span class="not-loading">
        저장하기
      </span>
      <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i>저장 중 ...</span>
    </button>

    <button type="button" class="btn btn-light text-primary" data-history="back">취소</button>

  </div>

</form>

<script>
  putCookieAlert('post_action_result') // 실행결과 알림 메시지 출력
</script>
