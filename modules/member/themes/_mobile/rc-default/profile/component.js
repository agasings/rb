
$(document).on('click','[data-toggle="profile"]',function(){
  var button = $(this);
  var mbruid = button.attr('data-mbruid');
  var target = button.attr('data-target');
  var url = button.attr('data-url');
  var nic = button.attr('data-nic');
  var modal_id = 'modal-member-profile-'+mbruid;
  var modal = $('#'+modal_id);
  if (!modal.length) {
    var _modal = $(target).clone().appendTo('[data-role="profile-wapper"]');
    _modal.attr('id',modal_id);
    modal = _modal;
  }
  modal.attr('data-mbruid',mbruid);
  modal.find('.bar-header-secondary .nav-inline').empty();
  modal.modal({
    title: nic,
    url : url
  });
  modal.find('.content').loader({ position: 'inside' });
  getPofileView(modal,mbruid)
});
