<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Seo -->
<meta name="robots" content="<?php echo strip_tags($g['meta_bot'])?>">
<meta name="title" content="<?php echo strip_tags($g['meta_tit'])?>">
<meta name="keywords" content="<?php echo strip_tags($g['meta_key'])?>">
<meta name="description" content="<?php echo strip_tags($g['meta_des'])?>">
<link rel="image_src" href="<?php echo strip_tags($g['meta_img'])?>">

<title><?php echo $g['browtitle']?></title>

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $g['s']?>/_core/images/ico/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo $g['s']?>/_core/images/ico/favicon.ico">


<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- bootstrap css -->
<?php getImport('bootstrap','css/bootstrap.min','4.0.0-beta.3','css')?>

<!-- jQuery -->
<?php getImport('jquery','jquery.min','3.2.1','js')?>

<?php getImport('popper.js','umd/popper.min','1.12.3','js')?>

<!-- bootstrap js -->
<?php getImport('bootstrap','js/bootstrap.min','4.0.0-beta.3','js')?>

<!-- 시스템 폰트 -->
<?php getImport('font-awesome','css/font-awesome','4.7.0','css')?>

<!-- is-loading : https://github.com/hekigan/is-loading-->
<?php getImport('is-loading','jquery.isloading.min','1.0.6','js')?>

<!-- js-cookie : https://github.com/js-cookie/js-cookie -->
<?php getImport('js-cookie','js.cookie.min','2.2.0','js')?>

<!-- bootstrap-notify : https://github.com/mouse0270/bootstrap-notify  -->
<?php getImport('bootstrap-notify','bootstrap-notify.min','3.1.3','js')?>

<!-- global css -->
<link href="<?php echo $g['url_layout']?>/_css/_style.css<?php echo $g['wcache']?>" rel="stylesheet">

<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/cssjs.engine.php' ?>

<script type="text/javascript">
// 알림 기본 셋팅값 정의
$.notifyDefaults({
  placement: {
    from: "bottom",
    align: "center"
  },
  allow_dismiss: false,
  offset: 20,
  type: "dark",
  timer: 100,
  delay: 1500,
  animate: {
    enter: "animated fadeInUp",
    exit: "animated fadeOutDown"
  }
});
</script>
