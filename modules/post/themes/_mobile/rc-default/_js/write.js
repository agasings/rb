function getPostWrite(settings) {
  var wrapper = settings.wrapper;
  var uid=settings.uid;

  wrapper.find('[data-uid]').attr('data-uid',uid);

  if (uid) {
    $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postWrite',{
      uid : uid
     },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var featured=result.featured;
          var time=result.time;
          var subject=result.subject;
          var nic=result.nic;
          var isperm=result.isperm;
          var article=result.article;
          var linkurl=result.linkurl;
          var listCollapse=result.listCollapse;
          var is_post_liked=result.is_post_liked;
          var is_post_disliked=result.is_post_disliked;
          var dis_like = result.dis_like;
          var dis_rating = result.dis_rating;
          var dis_comment = result.dis_comment;
          var dis_listadd = result.dis_listadd;
          var goods = result.goods;

          wrapper.find('[data-role="subject"]').val(subject);
          wrapper.find('[data-role="time"]').text(time);
          wrapper.find('[data-role="featured"]').attr('src',featured);
          wrapper.find('[data-role="nic"]').text(nic);

          if (goods) {
            wrapper.find('[data-role="goodsLink"]').removeClass('d-none');
          }

          if (is_post_liked) wrapper.find('[data-role="btn_post_like_'+uid+'"]').addClass('active');
          if (is_post_disliked) wrapper.find('[data-role="btn_post_dislike_'+uid+'"]').addClass('active');

          if (dis_like) wrapper.find('[data-role="opinion"]').hide();
          if (dis_listadd) wrapper.find('[data-role="listadd"]').hide();

          wrapper.find('.form-list.floating .input-row').addClass('active');


        } else {
          alert(status);
        }

    });

  }

  wrapper.find('.form-list.floating .input-row textarea').on('keyup', function(event) {
    if ($(this).val().length >= 1) {
      $(this).parents('.input-row').addClass('active');
    } else {
      $(this).parents('.input-row').removeClass('active');
    }
  })

} // getPostWrite
