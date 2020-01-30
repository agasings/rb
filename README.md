# kimsQ Rb2

## 개요

## 설치환경

- PHP 7 이상
- MySQL 5.5 이상 또는 mariadb-10.0.x 이상

### 웹서버 설정
- CGI 사용안함
- htaccess 사용


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

### 이미 형상관리 git이 적용된 경우에 최근 패치
1. <code>git reset --hard</code>
1. <code>git pull origin master</code>

### 형상관리 git이 적용되지 않는 경우에  최신패치를 적용할 경우
1. <code>git init</code>
1. <code>git remote add origin https://github.com/kimsQ/rb.git</code>
1. <code>git add -A</code>
1. <code>git pull origin master</code>

## 메뉴얼


## 라이센스
RBL 라이선스
