
$(document).on('click','[data-toggle="profile"]',function(){
  var button = $(this);
  var mbruid = button.attr('data-mbruid');
  var target = button.attr('data-target');
  var url = button.attr('data-url');
  var nic = button.attr('data-nic');
  var modal_id = 'modal-member-profile-'+mbruid;
  var modal = $('#'+modal_id);
  var delay = 10;
  if (!modal.length) {
    var _modal = $(target).clone().appendTo('[data-role="profile-wapper"]');
    _modal.attr('id',modal_id);
    modal = _modal;
  }
  if (button.attr('data-change')){
    history.back();
    delay = 250;
  }
  setTimeout(function(){
    modal.attr('data-mbruid',mbruid);
    modal.find('.bar-header-secondary .nav-inline').empty();
    modal.modal({
      title: nic,
      url : url
    });
    modal.find('.content').loader({ position: 'inside' });
    getPofileView(modal,mbruid)
  }, delay);
});


$(document).on('click','[data-toggle="follow"]',function(){
  var button = $(this);
  var mbruid = button.attr('data-mbruid');
  var url = '/?r='+raccount+'&m=member&a=profile_follow&mbruid='+mbruid;
  button.toggleClass('active');
  if (memberid) {
    getIframeForAction('');
    frames.__iframe_for_action__.location.href = url;
  } else {
    var title = button.attr('data-title')
    var subtext = button.attr('data-subtext')
    popup_login_guide.find('[data-role="title"]').text(title);
    popup_login_guide.find('[data-role="subtext"]').text(subtext);
    popup_login_guide.popup('show');
  }

});
