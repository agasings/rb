function getPostMore(uid) {

  var wrapper = popup_post_postMore;
  wrapper.find('[data-role="list"]').html('<div data-role="loader"><div class="d-flex justify-content-center align-items-center text-muted" style="height:30vh"><div class="spinner-border mr-2" role="status"></div></div></div>');

  $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postOption',{
    uid: uid
    },function(response,status){
      if(status=='success'){
        var result = $.parseJSON(response);
        var list=result.list;
        wrapper.find('[data-role="list"]').html(list)
      } else {
        alert(status);
      }
  });

}


popup_post_postMore.on('click','[data-toggle="listAdd"]',function(){
  var button = $(this);
  var uid = popup_post_postMore.attr('data-uid');
  history.back();
  setTimeout(function(){
    if (memberid) {
      sheet_post_listadd.attr('data-uid',uid).css('top','20vh');
      sheet_post_listadd.sheet();
    } else {
      var title = button.attr('data-title')
      var subtext = button.attr('data-subtext')
      popup_login_guide.find('[data-role="title"]').text(title);
      popup_login_guide.find('[data-role="subtext"]').text(subtext);
      popup_login_guide.popup('show');
    }
  }, 200);
});

popup_post_postMore.on('click','[data-toggle="report"]',function(){
  var button = $(this);
  var uid = popup_post_postMore.attr('data-uid');
  history.back();
  setTimeout(function(){
    if (memberid) {
      popup_post_report.attr('data-uid',uid);
      popup_post_report.popup();
    } else {
      var title = button.attr('data-title')
      var subtext = button.attr('data-subtext')
      popup_login_guide.find('[data-role="title"]').text(title);
      popup_login_guide.find('[data-role="subtext"]').text(subtext);
      popup_login_guide.popup('show');
    }
  }, 200);
});

popup_post_postMore.on('click','[data-toggle="saved"]',function(){
  var button = $(this);
  var uid = popup_post_postMore.attr('data-uid');
  history.back();
  setTimeout(function(){
    if (memberid) {
      setTimeout(function(){
        $.post(rooturl+'/?r='+raccount+'&m=post&a=update_saved',{
          uid : uid
          },function(response,status){
            if(status=='success'){
              $.notify({message: '나중에 볼 동영상에 추가되었습니다.'},{type: 'default'});
            } else {
              alert(status);
            }
        });
      }, 100);
    } else {
      var title = button.attr('data-title')
      var subtext = button.attr('data-subtext')
      popup_login_guide.find('[data-role="title"]').text(title);
      popup_login_guide.find('[data-role="subtext"]').text(subtext);
      popup_login_guide.popup('show');
    }
  }, 200);
});


popup_post_postMore.on('click','[data-toggle="postedit"]',function(){
  var button = $(this);
  var uid = button.attr('data-uid');
  var title = button.attr('data-title');
  var url = button.attr('data-url');
  modal_post_write.attr('data-uid',uid);
  history.back();
  setTimeout(function(){
    modal_post_write.modal({
      title : title,
      url : url
    })
  }, 200);
});

popup_post_postMore.on('click','[data-toggle="analytics"]',function(){
  var button = $(this);
  var uid = button.attr('data-uid');
  modal_post_analytics.attr('data-uid',uid);
  history.back();
  setTimeout(function(){
    modal_post_analytics.modal()
  }, 200);
});
