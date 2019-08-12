<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="mobile-web-app-capable" content="yes">
<meta name="theme-color" content="#333">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Seo -->
<meta name="robots" content="<?php echo strip_tags($g['meta_bot'])?>">
<meta name="title" content="<?php echo strip_tags($g['meta_tit'])?>">
<meta name="keywords" content="<?php echo strip_tags($g['meta_key'])?>">
<meta name="description" content="<?php echo strip_tags($g['meta_des'])?>">
<link rel="image_src" href="<?php echo strip_tags($g['meta_img'])?>">

<title><?php echo $g['browtitle']?></title>

<!-- 웹앱 매니페스트 -->
<link rel="manifest" href="<?php echo $manifestForSite?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $touchIconForSite ?>">

<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- rc css -->
<?php getImport('rc','css/rc','1.0.0','css')?>
<?php getImport('rc','css/rc-add','1.0.0','css')?>

<!-- jQuery -->
<?php getImport('jquery','jquery.min','1.12.4','js')?>

<!-- rc js -->
<?php getImport('rc','js/rc','1.0.0','js')?>

<!-- 시스템 폰트 -->
<?php getImport('font-awesome','css/font-awesome','4.7.0','css')?>
<?php getImport('font-kimsq','css/font-kimsq',false,'css')?>

<!-- swiper : http://idangero.us/swiper/ -->
<?php getImport('swiper','css/swiper','4.5.0','css')?>
<?php getImport('swiper','js/swiper.min','4.5.0','js')?>

<!-- 소셜공유시 URL 클립보드저장 : clipboard.js  : https://github.com/zenorocha/clipboard.js-->
<?php getImport('clipboard','clipboard.min','2.0.4','js') ?>

<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/cssjs.engine.php' ?>

<!-- global css -->
<link href="<?php echo $g['url_layout']?>/_css/style.css<?php echo $g['wcache']?>" rel="stylesheet">
