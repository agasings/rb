var modal_member_settings =  $('#modal-member-settings'); // 설정 모달
var page_settings_main =  $('#page-settings-main'); // 설정메인
var page_settings_account =  $('#page-settings-account'); //회원계정
var page_settings_email =  $('#page-settings-email'); //이메일 관리
var page_settings_phone =  $('#page-settings-phone'); //휴대폰 관리
var page_settings_noti =  $('#page-settings-noti'); //알림설정
var page_settings_connect =  $('#page-settings-connect'); //연결계정
var page_settings_shipping =  $('#page-settings-shipping'); //배송지관리
var page_settings_name =  $('#page-settings-name'); //이름변경
var page_settings_tel1 =  $('#page-settings-tel1'); //유선전화
var page_settings_bio =  $('#page-settings-bio'); //간단설명

modal_member_settings.on('show.rc.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  modal.attr('data-mbruid','');
})


page_settings_main.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

})

// 회원계정
page_settings_account.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('계정관리')

})

// 이메일 관리
page_settings_email.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('이메일 관리')

})


// 휴대폰 관리
page_settings_phone.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('휴대폰 관리')

})

// 알림설정
page_settings_noti.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('알림설정')

})

// 연결계정
page_settings_connect.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('연결계정')

})

// 배송지관리
page_settings_shipping.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('배송지관리')

})

// 이름변경
page_settings_name.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('이름변경')

})

// 유선전화
page_settings_tel1.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('유선전화')

})

// 간단설명
page_settings_bio.on('show.rc.page', function(event) {
  var button = $(event.relatedTarget);
  var page = $(this);

  console.log('간단설명')

})
