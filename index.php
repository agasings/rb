<?php

function getUrlData($url,$sec) {
	$URL_parsed = parse_url($url);
	$host = $URL_parsed['host'];
	$port = $URL_parsed['port'];
	$path = $URL_parsed['path'];
	$query= $URL_parsed['query'];

	if (!$host) $host = $_SERVER['HTTP_HOST'];
	if (!$port) $port = 80;

    $out = "GET ".$path.'?'.$query." HTTP/1.1\r\n";
    $out .= "Host: ".$host."\r\n";
    $out .= "Connection: Close\r\n\r\n";

	$fp = fsockopen($host,$port,$errno,$errstr,$sec);

	if (!$fp)
	{
		return false;
	}
	else
	{
		fputs($fp, $out);
		$body = false;
		while (!feof($fp)) {
			$s = fgets($fp, 128);
			if ( $body )
				$in .= $s;
			if ( $s == "\r\n" )
				$body = true;
		}

		fclose($fp);
		return $in;
	}
}

$_rb2list = getUrlData('https://kimsq.github.io/rb/releases.v2.txt',10);
$_rb2list = explode("\n",$_rb2list);
$_rb2listlength = count($_rb2list)-1;

$url = $_POST['url'];

if ($url) {
  // code...





  
}

?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="//kimsq.github.io/rb/images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//kimsq.github.io/rb/stylesheets/install.css">
    <title>킴스큐 설치 - Rb2</title>
  </head>
  <body>

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="masthead mb-auto"><?php echo $url ?></header>
      <main role="main" class="inner cover">
        <h1 class="cover-heading">무한한 가능성!<br>킴스큐Rb2 설치를 시작합니다.</h1>
        <p class="lead">별도의 서버작업(패키지 다운로드,압축해제,퍼미션 조정 등) 절차없이 쉽고 빠르게 설치를 진행할 것입니다.
      		준비가 되셨으면 설치하기 버튼을 클릭해 주십시오.</p>
        <form action="./index.php" method="post">
          <div class="form-group">
            <label class="sr-only">패키지 버전</label>
            <select name="url" class="form-control custom-select custom-select-lg rounded-0" <?php echo $url?'disabled':'' ?>>
              <option value="">설치버전을 선택하세요.</option>
              <?php for($i = 0; $i < $_rb2listlength; $i++):?>
              <?php $_list=trim($_rb2list[$i]);if(!$_list)continue?>
              <?php $var1=explode(',',$_list)?>
              <option value="<?php echo $var1[1]?>" <?php echo ($url==$var1[1])?'selected':'' ?> >
                <?php echo $var1[0]?>
              </option>
              <?php endfor?>
            </select>
          </div>
        </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner text-center">
          <p>Copyright Redblock inc.</p>
        </div>
      </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script>

      $('[name="url"]').change(function() {
        var url = $(this).val();
        var form = $('form');
        if (!url) {
          $(this).focus();
          return false
        }
        form.submit()
      });

    </script>

  </body>
</html>
