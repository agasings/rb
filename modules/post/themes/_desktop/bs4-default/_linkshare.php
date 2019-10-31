<?php
$_WTIT=strip_tags($g['meta_tit']);
$_link_url=$g['url_root'].$_SERVER['REQUEST_URI'];

?>

<ul class="list-inline" data-role="linkshare">
  <li data-toggle="tooltip" title="페이스북" class="list-inline-item">
    <a href="" role="button" onclick="snsWin('f');">
      <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="rounded-circle" width="50">
    </a>
  </li>
  <li data-toggle="tooltip" title="카카오스토리" class="list-inline-item">
    <a  href="" role="button"  onclick="snsWin('ks');">
      <img src="<?php echo $g['img_core']?>/sns/kakaostory.png" alt="카카오스토리" class="rounded-circle" width="50">
    </a>
  </li>
  <li data-toggle="tooltip" title="네이버" class="list-inline-item">
    <a  href="" role="button" onclick="snsWin('n');">
      <img src="<?php echo $g['img_core']?>/sns/naver.png" alt="네이버" class="rounded-circle" width="50">
    </a>
  </li>
  <li data-toggle="tooltip" title="트위터" class="list-inline-item">
    <a href="" role="button" onclick="snsWin('t');">
      <img src="<?php echo $g['img_core']?>/sns/twitter.png" alt="트위터" class="rounded-circle" width="50">
    </a>
  </li>
</ul>

<div class="mt-5 mb-4 text-left">
  <div class="input-group mt-3">
    <div class="input-group-prepend">
      <button class="btn btn-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        선택
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#" data-ref="kt">카카오톡</a>
        <a class="dropdown-item" href="#" data-ref="yt">유튜브</a>
        <a class="dropdown-item" href="#" data-ref="fb">페이스북</a>
        <a class="dropdown-item" href="#" data-ref="ig">인스타그램</a>
        <a class="dropdown-item" href="#" data-ref="nb">네이버 블로그</a>
        <a class="dropdown-item" href="#" data-ref="ks">카카오스토리</a>
        <a class="dropdown-item" href="#" data-ref="tt">트위터</a>
        <div role="separator" class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-ref="em">이메일</a>
        <a class="dropdown-item" href="#" data-ref="sm">SMS</a>
        <a class="dropdown-item" href="#">기타</a>
      </div>
    </div>
    <input type="text" class="form-control" readonly value="<?php echo $_link_url?>">
    <div class="input-group-append">
      <button class="btn btn-white text-primary" type="button">
        복사
      </button>
    </div>
  </div>
  <small class="form-text text-muted">공유할 미디어를 선택해주세요.</small>
</div>

<script type="text/javascript">
// sns 이벤트
function snsWin(sns) {
    var snsset = new Array();
    var enc_sbj = "<?php echo urlencode($_WTIT)?>";
    var enc_url = "<?php echo urlencode($_link_url)?>";
    var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";
    snsset['t'] = 'https://twitter.com/intent/tweet?url=' + enc_url + '&text=' + enc_sbj;
    snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url;
    snsset['n'] = 'http://share.naver.com/web/shareView.nhn?url=' + enc_url + '&title=' + enc_sbj;
    snsset['ks'] = 'https://story.kakao.com/share?url=' + enc_url + '&title=' + enc_sbj;
    window.open(snsset[sns]);
}
</script>
