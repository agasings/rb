<?php
checkAdmin(0);
include $g['dir_layout'].'_var/_var.config.php';
?>

<header class="bar bar-nav bar-light bg-white p-x-0">
  <a data-href="/" class="icon icon-home pull-left p-x-1" role="button"></a>
  <button class="btn btn-link btn-nav pull-right px-4" data-act="submit">
    <span class="not-loading">
      저장
    </span>
    <span class="is-loading">
      <div class="spinner-border spinner-border-sm text-primary" role="status">
        <span class="sr-only">저장중...</span>
      </div>
    </span>
  </button>
  <h1 class="title">
    <a data-location="reload" data-text="새로고침..">
      사이트 설정
    </a>
  </h1>
</header>

<div class="content">

  <form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_action_frame_<?php echo $m?>">
    <input type="hidden" name="r" value="<?php echo $r?>">
    <input type="hidden" name="m" value="<?php echo $m?>">
    <input type="hidden" name="a" value="regislayoutsite">

    <div class="card-group-collapse" id="layout-settings-panels">
      <?php $_i=1;foreach($d['layout']['dom'] as $_key => $_val):$__i=sprintf('%02d',$_i)?>
      <div class="card" id="layout-settings-<?php echo $__i?>">
        <div class="card-header bg-white" data-toggle="collapse" data-parent="#layout-settings-panels" data-target="#layout-settings-<?php echo $__i?>-body" aria-expanded="true">
          <?php echo $_val[0]?>
        </div>
        <div class="collapse" id="layout-settings-<?php echo $__i?>-body">

          <div class="card-block">

            <p class="mb-1"><?php echo $_val[1]?></p>

            <?php if(count($_val[2])):?>
            <?php foreach($_val[2] as $_v):?>
            <div class="form-group">
              <?php if($_v[1]!='hidden'):?>
              <label><?php echo $_v[2]?></label>
              <?php endif?>

              <?php if($_v[1]=='hidden'):?>
              <input type="hidden" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
              <?php endif?>

              <?php if($_v[1]=='input'):?>
              <input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo stripslashes($d['layout'][$_key.'_'.$_v[0]])?>">
              <?php endif?>

              <?php if($_v[1]=='color'):?>
              <div class="input-group">
                <input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
                <span class="input-group-append">
                  <button class="btn btn-light" type="button" data-toggle="modal" data-target=".bs-example-modal-sm" onclick="getColorLayer(getId('layout_<?php echo $_key?>_<?php echo $_v[0]?>').value.replace('#',''),'layout_<?php echo $_key?>_<?php echo $_v[0]?>');"><i class="fa fa-tint"></i></button>
                </span>
              </div>
              <?php endif?>

              <?php if($_v[1]=='date'):?>
              <div class="input-group input-daterange">
                <input type="text" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>">
                <span class="input-group-append">
                  <button class="btn btn-light" type="button" onclick="getCalCheck('<?php echo $_key?>_<?php echo $_v[0]?>');"><i class="fa fa-calendar"></i></button>
                </span>
              </div>
              <?php endif?>

              <?php if($_v[1]=='mediaset'):?>
              <div class="input-group">
                <input type="text" class="form-control rb-modal-photo-drop js-tooltip" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>&dfiles='+this.value;" title="선택된 사진" data-toggle="modal" data-target="#modal_window">
                <span class="input-group-append">
                  <button onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>';" class="btn btn-light rb-modal-photo-drop js-tooltip" type="button" title="포토셋" data-toggle="modal" data-target="#modal_window"><i class="fa fa-picture-o"></i></button>
                </span>
              </div>
              <?php endif?>

              <?php if($_v[1]=='videoset'):?>
              <div class="input-group">
                <input type="text" class="form-control rb-modal-video-drop js-tooltip" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>&dfiles='+this.value;" title="선택된 비디오" data-toggle="modal" data-target="#modal_window">
                <span class="input-group-append">
                  <button onmousedown="_mediasetField='layout_<?php echo $_key?>_<?php echo $_v[0]?>';" class="btn btn-light rb-modal-video-drop js-tooltip" type="button" title="비디오셋" data-toggle="modal" data-target="#modal_window"><i class="fa fa-video-camera"></i></button>
                </span>
              </div>
              <?php endif?>

              <?php if($_v[1]=='file'):?>
              <div class="input-group">
                <input type="text" class="form-control" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>_name" value="<?php echo $d['layout'][$_key.'_'.$_v[0]]?>" onclick="$('#layout_<?php echo $_key?>_<?php echo $_v[0]?>').click();">
                <input type="file" class="d-none" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" id="layout_<?php echo $_key?>_<?php echo $_v[0]?>" onchange="getId('layout_<?php echo $_key?>_<?php echo $_v[0]?>_name').value='파일 선택됨';">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button" onclick="$('#layout_<?php echo $_key?>_<?php echo $_v[0]?>').click();">
                    파일첨부
                  </button>
                </span>
              </div>
              <?php if($d['layout'][$_key.'_'.$_v[0]]):?>
              <div style="padding:3px 0 0 2px;"><input type="checkbox" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>_del" value="1"> 현재파일 삭제</div>
              <?php endif?>
              <?php endif?>

              <?php if($_v[1]=='textarea'):?>
              <textarea type="text" rows="<?php echo $_v[3]?>" class="form-control" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>"><?php echo stripslashes($d['layout'][$_key.'_'.$_v[0]])?></textarea>
              <?php endif?>

              <?php if($_v[1]=='select'):?>
              <select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
                <?php $_sk=explode(',',$_v[3])?>
                <?php foreach($_sk as $_sa):?>
                <?php $_sa1=explode('=',$_sa)?>
                <option value="<?php echo $_sa1[1]?>"<?php if($d['layout'][$_key.'_'.$_v[0]] == $_sa1[1]):?> selected<?php endif?>><?php echo $_sa1[0]?></option>
                <?php endforeach?>
              </select>
              <?php endif?>

              <?php if($_v[1]=='radio'):?>
              <?php $_sk=explode(',',$_v[3])?>
              <?php foreach($_sk as $_sa):?>
              <?php $_sa1=explode('=',$_sa)?>
              <label class="rb-rabel"><input type="radio" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" value="<?php echo $_sa1[1]?>"<?php if($d['layout'][$_key.'_'.$_v[0]] == $_sa1[1]):?> checked<?php endif?>> <?php echo $_sa1[0]?></label>
              <?php endforeach?>
              <?php endif?>

              <?php if($_v[1]=='checkbox'):?>
              <?php $_sk=explode(',',$_v[3])?>
              <?php foreach($_sk as $_sa):?>
              <?php $_sa1=explode('=',$_sa)?>
              <label class="rb-rabel"><input type="checkbox" name="layout_<?php echo $_key?>_<?php echo $_v[0]?>_chk[]" value="<?php echo $_sa1[1]?>"<?php if(strstr($d['layout'][$_key.'_'.$_v[0]],$_sa1[1])):?> checked<?php endif?>> <?php echo $_sa1[0]?></label>
              <?php endforeach?>
              <?php endif?>

              <?php if($_v[1]=='menu'):?>
              <select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
                <option value="">사용안함</option>
                <option value="" disabled>--------------------------------</option>
                <?php include_once $g['path_core'].'function/menu1.func.php'?>
                <?php $cat=$d['layout'][$_key.'_'.$_v[0]]?>
                <?php getMenuShowSelectCode($s,$table['s_menu'],0,0,0,0,0,'')?>
              </select>
              <?php endif?>

              <?php if($_v[1]=='bbs'):?>
              <select name="layout_<?php echo $_key?>_<?php echo $_v[0]?>" class="form-control custom-select">
                <option value="">사용안함</option>
                <option value="" disabled>----------------------------------</option>
                <?php $BBSLIST = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
                <?php while($R=db_fetch_array($BBSLIST)):?>
                <option value="<?php echo $R['id']?>"<?php if($d['layout'][$_key.'_'.$_v[0]]==$R['id']):?> selected="selected"<?php endif?>>
                  ㆍ<?php echo $R['name']?>(<?php echo $R['id']?>)
                </option>
                <?php endwhile?>
              </select>
              <?php endif?>

            </div>
            <?php endforeach?>
            <?php endif?>

          </div>

        </div>
      </div>
      <?php $_i++;endforeach?>

    </div>


  </form>

</div>

<script>

var form = $('form')

$('[data-act="submit"]').click(function(){

  $(this).attr( 'disabled', true );
  setTimeout(function(){
    form.submit()
  }, 500);

});



</script>
