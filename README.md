# kimsQ Rb2

## 개요

## 설치환경

- PHP 7 이상
- MySQL 5.5 이상 또는 mariadb-10.0.x 이상

### 웹서버 설정
- CGI 사용안함
- htaccess 사용
- git 클라이언트


### PHP 확장모듈
- CURL
- ZEND 2.2.0
- GD 2.0.34
- ICONV
- dom/xml

### PHP 설정
- allow_url_fopen : 허용안함
- register_globals : 허용안함
- magic_quotes_gpc : 허용


## 설치하기

### SSH를 통한 설치
1. <code>git init</code>
1. <code>git remote add origin https://github.com/kimsQ/rb.git</code>
1. <code>git pull origin master</code>
1. <code>chmod 707  _var</code>
1. 브라우저를 통해 index.php 를 호출합니다.

### 인스톨러를 통한 설치
1. rb-installer.zip 을 [다운](https://github.com/kimsQ/rb/archive/installer.zip) 받습니다.
1. 압축해제 후, rb-installer 폴더 내부의 index.php 를 FTP를 이용하여 서버계정 폴더에 업로드 합니다.
1. 브라우저를 통해 index.php 를 호출합니다.

## 최신패치

최신패치를 위해서는 SSH 접속히 필요하며 형상관리 git의 적용 여부에 따라 패치방법이 다릅니다. SSH를 통해 설치한 경우에는 git을 통한 형상관리가 적용된 경우이며, 인스톨러를 통해 설치한 경우에는 git이 적용되어 있지 않습니다.

1. <code>git reset --hard</code>
1. <code>git pull origin master</code>

인스톨러를 통해 설치한 경우, 형상관리 git이 적용되지 않아서 처음에 git 설치과정이 필요합니다.
1. <code>git init</code>
1. <code>git remote add origin https://github.com/kimsQ/rb.git</code>
1. <code>git add -A</code>
1. <code>git pull origin master</code>

## 메뉴얼


## 라이센스
RBL 라이선스
