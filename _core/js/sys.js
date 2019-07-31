//객체얻기
function getId(id)
{
	return document.getElementById(id);
}
//리다이렉트
function goHref(url)
{
	location.href = url;
}
//아이디형식체크
function chkIdValue(id)
{
	if (id == '') return false;
	if (!getTypeCheck(id,"abcdefghijklmnopqrstuvwxyz1234567890_-")) return false;
	return true;
}
//파일명형식체크
function chkFnameValue(file)
{
	if (file == '') return false;
	if (!getTypeCheck(file,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-")) return false;
	return true;
}
//이메일체크
function chkEmailAddr(email)
{
	if (email == '') return false;
	if (email.indexOf('\@') == -1 || email.indexOf('.') == -1) return false;
	return true;
}
//휴대폰체크
function chkPhoneNumber(phone)
{
	if (phone == '') return false;
	phone = phone.split('-').join('');
	var regPhone = /^((01[1|6|7|8|9])[1-9]+[0-9]{6,7})|(010[1-9][0-9]{7})$/;
	return regPhone.test(phone);
}
//오픈윈도우
function OpenWindow(url)
{
	setCookie('TmpCode','',1);
	window.open(url,'','width=100px,height=100px,status=no,scrollbars=no,toolbar=no');
}
//로그인체크
function isLogin()
{
	if (memberid == '')
	{
		alert('로그인이 필요합니다.  ');
		return false;
	}
	return true;
}
//쿠키세팅
function setCookie(name,value,expiredays)
{
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
//쿠키추출
function getCookie( name )
{
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length )
	{
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie )
		{
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 ) break;
	}
	return "";
}
//이벤트좌표값
function getEventXY(e)
{
	var obj = new Object();
	obj.x = e.clientX + (document.documentElement.scrollLeft || document.body.scrollLeft) - (document.documentElement.clientLeft || document.body.clientLeft);
	obj.y = e.clientY + (document.documentElement.scrollTop || document.body.scrollTop)  - (document.documentElement.clientTop || document.body.clientTop);
	return obj;
}
//파일확장자
function getFileExt(file)
{
	var arr = file.split('.');
	return arr[arr.length-1];
}
function getOfs(id)
{
    var obj = new Object();
	var box = id.getBoundingClientRect();
	obj.left = box.left + (document.documentElement.scrollLeft || document.body.scrollLeft);
	obj.top = box.top + (document.documentElement.scrollTop || document.body.scrollTop);
	obj.width = box.right - box.left;
	obj.height = box.bottom - box.top;
    return obj;
}
//은,는,이,가 - getJosa(str,"은는")
function getJosa(str, tail)
{
    strTemp = str.substr(str.length - 1);
    return ((strTemp.charCodeAt(0) - 16) % 28 != 0) ? str + tail.substr(0, 1) : str + tail.substr(1, 1);
}
//타입비교 (비교문자 , 비교형식 ; ex: getTypeCheck(string , "1234567890") )
function getTypeCheck(s, spc)
{
	var i;
	for(i=0; i< s.length; i++)
	if (spc.indexOf(s.substring(i, i+1)) < 0) return false;

	return true;
}
//콤마삽입 (number_format)
function commaSplit(srcNumber)
{
	var txtNumber = '' + srcNumber;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	while (rxSplit.test(arrNumber[0]));
	if (arrNumber.length > 1) return arrNumber.join('');
	else return arrNumber[0].split('.')[0];
}
function priceFormat(obj)
{
	if (!getTypeCheck(filterNum(obj.value),'0123456789'))
	{
		alert('Please input number only.');
		obj.value = obj.defaultValue;
		obj.focus();
		return false;
	}
	else obj.value = commaSplit(filterNum(obj.value));
}
function numFormat(obj)
{
	if (!getTypeCheck(obj.value,'0123456789'))
	{
		alert('Please input number only.');
		obj.value = obj.defaultValue;
		obj.focus();
		return false;
	}
}
function getJeolsa(price,_round)
{
	return price - (price%(_round*10));
}
function filterNum(str)
{
	return str.replace(/^\$|,/g, "");
}
//페이징처리
function getPageLink(lnum,p,tpage,img)
{
	var wp = '';
	var g_q  = p > 1 ? '<li class="page-item"><a class="page-link" href="'+getPageGo(1,wp)+'" data-toggle="tooltip" title="First Page"><i class="fa fa-angle-double-left"></i></a></li>' : '<li class="page-item disabled"><a class="page-link"  href="#." data-toggle="tooltip" title="First page"><i class="fa fa-angle-double-left"></i></a></li>';

	if(p < lnum+1) { g_q += '<li class="page-item disabled"><a class="page-link" href="#." data-toggle="tooltip" title="Previous"><i class="fa fa-angle-left"></i></a></li>'; }
	else{ var pp = parseInt((p-1)/lnum)*lnum; g_q += '<li class="page-item"><a class="page-link" href="'+getPageGo(pp,wp)+'" data-toggle="tooltip" title="Previous"><i class="fa fa-angle-left"></i></a></li>';}

	var st1 = parseInt((p-1)/lnum)*lnum + 1;
	var st2 = st1 + lnum;

	for(var jn = st1; jn < st2; jn++)
	if ( jn <= tpage)
	(jn == p)? g_q += '<li class="page-item active"><span class="page-link">'+jn+'</span></li>' : g_q += '<li class="page-item"><a class="page-link" href="'+getPageGo(jn,wp)+'">'+jn+'</a></li>';

	if(tpage < lnum || tpage < jn) { g_q += '<li class="page-item disabled"><a class="page-link" href="#." data-toggle="tooltip" title="Next"><i class="fa fa-angle-right"></i></a></li>'; }
	else{var np = jn; g_q += '<li><a class="page-link" href="'+getPageGo(np,wp)+'" data-toggle="tooltip" title="Next"><i class="fa fa-angle-right"></i></a></li>'; }
	g_q  += tpage > p ? '<li><a class="page-link" href="'+getPageGo(tpage,wp)+'" data-toggle="tooltip" title="Last pages ('+tpage+')"><i class="fa fa-angle-double-right"></i></a></li>' : '<li class="page-item disabled"><a class="page-link" href="#." data-toggle="tooltip" title="Last pages ('+tpage+')"><i class="fa fa-angle-double-right"></i></a></li>';
	document.write(g_q);
}
//페이지클릭
function getPageGo(n,wp)
{
	var v   = wp != '' ? wp : 'p';
	var p   = getUriString(v);
	var que = location.href.replace('&'+v+'='+p,'');
		que = que.indexOf('?') != -1 ? que : que + '?';
		que = que.replace('&mod=view&uid=' + getUriString('uid') , '');
	var xurl = que.split('#');
	return xurl[0].indexOf('?') != -1 ?  xurl[0] + '&'+v+'=' + n : xurl[0] + '?'+v+'=' + n;
}
//파라미터값
function getUriString(param)
{
	var QuerySplit = location.href.split('?');
	var ResultQuer = QuerySplit[1] ? QuerySplit[1].split('&') : '';

	for (var i = 0; i < ResultQuer.length; i++)
	{
		var keyval = ResultQuer[i].split('=');
		if (param == keyval[0]) return keyval[1];
	}
	return '';
}
function getUrlParam(url,param)
{
	var QuerySplit = url.split('&');
	for (var i = 0; i < QuerySplit.length; i++)
	{
		var keyval = QuerySplit[i].split('=');
		if (param == keyval[0]) return keyval[1];
	}
	return '';
}
// getDateFormat('yyyymmddhhiiss','xxxx.xx.xx xx:xx:xx')
var dateFormat = 0;
function getDateFormat(date , type)
{
	var ck;
	var rtstr = "";
	var j = 0;
	for(var i = 0; i < type.length; i++)
	{
		if(type.substring(i,i+1) == 'x')
		{
			rtstr += date.substring(j,j+1);
		}
		else {
			j--;
			rtstr += type.substring(i,i+1);
		}
		j++;
	}
	if(dateFormat == 0)
	{
		document.write(rtstr);
	}
	else {
		dateFormat = 0;
		return rtstr;
	}
}
//선택반전
function chkFlag(f)
{
    var l = document.getElementsByName(f);
    var n = l.length;
    var i;
    for (i = 0; i < n; i++) l[i].checked = !l[i].checked;
}
function checkboxChoice(f,type)
{
    var l = document.getElementsByName(f);
    var n = l.length;
    var i;
    for (i = 0; i < n; i++) l[i].checked = type;
}
//keycode
function checkKeycode(e)
{
	if (window.event) return window.event.keyCode;
	else if (e) return e.which;
}
//AJAX-Request
function getHttprequest(URL,f)
{
	var xmlhttp = null;
	if(window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
	else {try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(e1){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(e2){return false;}}}
	if (xmlhttp)
	{
		if (f)
		{
			var i;
			var iParam = "";
			for (i=1;i<f.length;i++)
			{
				if ((f[i].type=='radio'||f[i].type=='checkbox')&&f[i].checked==false) continue;
				iParam += '&' + f[i].name + '=' + encodeURIComponent(f[i].value);
			}
			xmlhttp.open("POST", URL, false);
			xmlhttp.setRequestHeader("Content-Type","multipart/form-data;application/x-www-form-urlencoded;charset=utf-8");
			xmlhttp.send(iParam);
		}
		else {
			xmlhttp.open("GET", URL, false);
			xmlhttp.send(null);
		}
		if (xmlhttp.readyState==4 && xmlhttp.status == 200 && xmlhttp.statusText=='OK') return xmlhttp.responseText;
		xmlhttp = null;
	}
}
function getAjaxFilterString(str,code)
{
	var arr1 = str.split('['+code+':');
	var arr2 = arr1[1].split(':'+code+']');
	return arr2[0];
}
function getAjaxData(url)
{
	var result = getHttprequest(url);
	return getAjaxFilterString(result,'RESULT');
}
//iframe_for_action
function getIframeForAction(f)
{
	getId('_hidden_layer_').style.display = 'none';
	getId('_hidden_layer_').innerHTML = '<iframe name="__iframe_for_action__"></iframe>';
	if(f) f.target = '__iframe_for_action__';
}
//confirm
function hrefCheck(obj,target,msg)
{
	if(target) getIframeForAction(obj);
	if(msg) return confirm(msg);
}
//모달셋팅
function modalSetting(mid,url)
{
	if (mid == '.rb-modal-x') frames._modal_iframe_sub_.location.href = url;
	else {
		var modalTag = '';
		modalTag += '<div class="modal fade" id="'+mid+'" tabindex="-1" role="dialog" aria-hidden="true"><div id="modal_window_dialog_'+mid+'" class="modal-dialog"><div class="modal-content"><div id="_modal_header_'+mid+'"></div><div id="_modal_body_'+mid+'" class="modal-body"><iframe id="_modal_iframe_'+mid+'" name="_modal_iframe_'+mid+'" src="'+url+'" width="100%" height="100%" frameborder="0" scrolling="no"></iframe></div><div id="_modal_footer_'+mid+'"></div></div></div></div>';
		modalTag += '<div class="modal fade rb-modal-x" tabindex="-1" role="dialog" aria-hidden="true"><div id="_modal_dialog_top_" class="modal-dialog"><div class="modal-content"><iframe id="_modal_iframe_sub_" name="_modal_iframe_sub_" src="" width="100%" height="100%" frameborder="0" scrolling="no"></iframe></div></div></div>';
		getId('_box_layer_').innerHTML = modalTag;
	}
}

//모달셋팅(iframe 방식)
function setModalIframe(mid,size,height,src)
{
	var modalTag = '';
	modalTag += '<div class="modal fade" id="'+mid+'" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog '+size+'"><div class="modal-content"><div class="modal-header"></div><div class="modal-body" style="height:'+height+'"><iframe id="_modal_iframe_'+mid+'" name="_modal_iframe_'+mid+'" src="'+src+'" width="100%" height="100%" seamless frameborder="0" scrolling="no"></iframe></div><div class="modal-footer"></div></div></div></div>';

	setTimeout( function(){
	  $('#_box_layer_').append(modalTag)
	}, 500 );
}

//서브레이아웃셀렉트
function getSubLayout(layout,sid,sname,sclass)
{
	getIframeForAction('');
	frames.__iframe_for_action__.location.href = rooturl + '/?r=' + raccount + '&m=site&a=getsublayout&layout=' + layout.value + '&sid=' + sid + '&sname=' + sname + '&sclass=' + sclass;
}
//세션셋팅
function sessionSetting(name,value,target,check)
{
	getIframeForAction('');
	frames.__iframe_for_action__.location.href = rooturl + '/?a=sessionsetting&target='+target+'&name='+name+'&value=' + value + '&check=' + check;
}
//버튼서브밋
function btnFormSubmit(obj)
{
	obj.children[0].checked = true;
	obj.children[0].form.submit();
}
//popOver
function getPopover(type,val,id)
{
	if (type == 'member')
	{
		getId(id).innerHTML = '<iframe src="'+rooturl +'/?system=popup.popover&iframe=Y&mbruid='+val+'&layer='+id+'" width="250" height="100" frameborder="0" scrolling="no"></iframe>';
	}
}
//콘텍스트
function getContext(context,event)
{
	var xy = getEventXY(event);
	getId('rb-context-menu').children[1].innerHTML = context;
	getId('rb-context-menu').style.position = 'absolute';
	getId('rb-context-menu').style.top = xy.y + 'px';
	getId('rb-context-menu').style.left = xy.x + 'px';
	getId('rb-context-menu').children[0].click();
}
// 알림 출력 (쿠키 활용, js-cookie, bootstrap-notify 플러그인 필요)
function putCookieAlert(name)
{
	var actionResult = Cookies.get(name)
	if (actionResult) {
	var _actionResult = actionResult.split("|")
	 setTimeout(function(){
		 $.notify({
		 	message: _actionResult[0]
		 },{
		 	type: _actionResult[1]
		 });
	 }, 300);
	}
	Cookies.remove(name);  // 결과 초기화
}

//스마트폰 키보드 활성화 여부체크
function chkMobileKeyboard()
{
	var _originalSize = $(window).width() + $(window).height()
  $(window).resize(function(){
    if($(window).width() + $(window).height() != _originalSize){
      console.log("keyboard show up");
			return true;
    }
		return false;
  });
}

// editable 영역 마지막에 커서배치
function placeCaretAtEnd(el) {
  el.focus();
  if (typeof window.getSelection != "undefined"
        && typeof document.createRange != "undefined") {
    var range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
  } else if (typeof document.body.createTextRange != "undefined") {
    var textRange = document.body.createTextRange();
    textRange.moveToElementText(el);
    textRange.collapse(false);
    textRange.select();
  }
}

//로그인
function siteLogin(form) {
	var formID = form.attr('id')
	var f = document.getElementById(formID);
	form.find('[name="form"]').val('#'+formID);
	form.find('[type="submit"]').attr("disabled",true);
	form.find('.form-control').removeClass('is-invalid')  //에러이력 초기화
	setTimeout(function(){
		getIframeForAction(f);
		f.submit();
	}, 300);
}

function isInstallToDevice() {
  return window.localStorage.getItem('installToDevice') == 1;
}

// oembed 미디어 변환
function Iframely(ele) {
	$(ele).each(function(index) {
    var url = $(this).attr('url');
		var _url = encodeURI(url);

		$.getJSON('//embed.kimsq.com/oembed?url=' + _url, {
				format: "json"
			},
			function(data) {
				var type = data.type;
				var title = data.title;
				var url = data.url;
				var author = data.author;
				var description = data.description;
				var thumbnail_url = data.thumbnail_url;
				var author = data.author?data.author:'';
				var provider_name =  data.provider_name?data.provider_name:'';
				var thumbnail_width = data.thumbnail_width;

				if (type=='link') {
					var link_url_parse = $('<a>', {href: url});
					var provider_url = link_url_parse.prop('protocol')+'//'+link_url_parse.prop('hostname');
					var thumbnail_url_parse = $('<a>', {href: thumbnail_url});
					var thumbnail_protocol =  thumbnail_url_parse.prop('protocol')=='https'?'thumb-ssl':'thumb';
					var thumbnail__url = thumbnail_url_parse.prop('hostname')+thumbnail_url_parse.prop('pathname')+thumbnail_url_parse.prop('search')+thumbnail_url_parse.prop('hash')
					var thumbnail___url = '/'+thumbnail_protocol+'/165x165/u/'+thumbnail__url

					$.getJSON('//embed.kimsq.com/iframely?uri=' + _url, {
							format: "json"
						},
						function(data) {
							var title = data.meta.title;
							var icon = data.links.icon[0].href;

							if (thumbnail__url) {
								var thumbnail_markup = '<a href="'+url+'" target="_blank" class="align-self-center"><img src="'+thumbnail___url+'"></a>';
							} else {
								var thumbnail_markup = '';
							}

							if (thumbnail_width>500 && thumbnail_width) {
								var html = '<div class="card shadow-sm"><a href="'+url+'" target="_blank"><img class="card-img-top" src="'+thumbnail_url+'"></a><div class="card-body"><h5 class="card-title"><a href="'+url+'" class="text-reset" target="_blank">'+title+'</a></h5><p class="card-text line-clamp-3 text-muted">'+description+'</p><a href="'+provider_url+'" target="_blank"  class="btn btn-link text-reset pl-0"><img src="'+icon+'" class="mr-2" style="width:16px"><small class="text-muted">'+author+'</small><small class="text-muted">'+provider_name+'</small></a><small class="text-muted">'+link_url_parse.prop('hostname')+'</small></div></div>';
							}
							else {
								var html = '<div class="media border shadow-sm text-reset">'+thumbnail_markup+'<div class="media-body p-3"><h5 class="mt-0"><a href="'+url+'" class="text-reset" target="_blank">'+title+'</a></h5><p class="line-clamp-3 mb-1">'+description+'</p><a href="'+provider_url+'" target="_blank" class="btn btn-link text-reset pl-0"><img src="'+icon+'" class="mr-2" style="width:16px"><small class="text-muted">'+author+'</small><small class="text-muted">'+provider_name+'</small></a><small class="text-muted">'+link_url_parse.prop('hostname')+'</small></div></div>';
							}

							$(ele+'[url="' + _url + '"]').html(html);
					});
				} else {
					var html = data.html;
					if (!html) {
						$.getJSON('//embed.kimsq.com/iframely?uri=' + _url, {
								format: "json"
							},
							function(data) {
								var html = data.html;
								$(ele+'[url="' + _url + '"]').html(html);
						});
					} else {
						$(ele+'[url="' + _url + '"]').html(html);
					}
				}
			})
			.fail(function() {
				$(ele+'[url="' + url + '"]').html('<p><a href="'+url+'" target="_blank">'+url+'</a></p>');
			});

		});
}
