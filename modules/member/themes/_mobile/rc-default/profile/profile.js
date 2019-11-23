function getPofileView(modal,mbruid) {
  $.post(rooturl+'/?r='+raccount+'&m=member&a=get_profileData',{
     mbruid : mbruid,
     type : 'modal'
  },function(response){
   var result = $.parseJSON(response);
   var profile=result.profile;
   var nic=result.nic;
   modal.find('[data-role="title"]').text(nic);
   modal.find('.content').html(profile);
   modal.find('.content [data-plugin="timeago"]').timeago();
   modal.find('.content').scroll({type:'updown'});
   var nav_control = modal.find('.profile-nav-control')
   var swiper_member_profile = new Swiper('#modal-member-profile-'+mbruid+' .swiper-container', {
     autoHeight: true,
     pagination: {
       el: '#modal-member-profile-'+mbruid+' .bar-header-secondary .nav-inline',
       clickable: true,
       autoHeight: true,
       effect : 'fade',
       spaceBetween: 30,
       slideActiveClass :'active',
       bulletClass : 'nav-link',
       bulletActiveClass : 'active' ,
       autoHeight : true,
       renderBullet: function (index, className) {
         var title;
         if (index === 0) title = '홈';
         if (index === 1) title = '동영상'
         if (index === 2) title = '재생목록'
         if (index === 3) title = '커뮤니티'
         if (index === 4) title = '채널'
         if (index === 5) title = '정보'
         return '<a class="' + className + '">'+title+'</a>';
       },
     },
     on: {
       init: function () {
         console.log('swiper 초기화');
       },
     }
   });

   swiper_member_profile.on('slideChange', function () {
     var index = swiper_member_profile.activeIndex
     nav_control.find('.nav-link').removeClass('active')
     nav_control.find('[data-index="'+index+'"]').addClass('active')
     setTimeout(function(){
       modal.find('.content').animate({scrollTop:0}, '400');
     }, 600);

     if (index==1) { // 포스트
       modal.find('[data-role="postList"] [data-role="list"]').loader({ position: 'inside' });
       $.post(rooturl+'/?r='+raccount+'&m=member&a=get_profilePost',{
          mbruid : mbruid,
          type : 'modal'
       },function(response){
        var result = $.parseJSON(response);
        var postlist=result.list;
        var postnum=result.num;
        modal.find('[data-role="postList"] [data-role="list"]').html(postlist);
        if (postnum) modal.find('[data-role="postList"] .btn').show();
        else modal.find('[data-role="postList"] .btn').hide();
        swiper_member_profile.updateAutoHeight(100);
        modal.find('[data-role="postList"] [data-role="list"] [data-plugin="timeago"]').timeago();
      });
     }

     if (index==2) { // 리스트
       modal.find('[data-role="listList"] [data-role="list"]').loader({ position: 'inside' });
       $.post(rooturl+'/?r='+raccount+'&m=member&a=get_profileList',{
          mbruid : mbruid,
          type : 'modal'
       },function(response){
        var result = $.parseJSON(response);
        var listlist=result.list;
        var listnum=result.num;
        modal.find('[data-role="listList"] [data-role="list"]').html(listlist);
        if (listnum) modal.find('[data-role="listList"] .btn').show();
        else modal.find('[data-role="listList"] .btn').hide();
        swiper_member_profile.updateAutoHeight(100);
        modal.find('[data-role="listList"] [data-role="list"] [data-plugin="timeago"]').timeago();
      });
     }

     if (index==3) { // 커뮤니티
       modal.find('[data-role="commList"] [data-role="list"]').loader({ position: 'inside' });
       $.post(rooturl+'/?r='+raccount+'&m=member&a=get_profileComm',{
          mbruid : mbruid,
          type : 'modal'
       },function(response){
        var result = $.parseJSON(response);
        var commlist=result.list;
        var commnum=result.num;
        modal.find('[data-role="commList"] [data-role="list"]').html(commlist);
        swiper_member_profile.updateAutoHeight(100);
        modal.find('[data-role="commList"] [data-role="list"] [data-plugin="timeago"]').timeago();
      });
     }

     if (index==4) {  // 채널
       modal.find('[data-role="followList"] [data-role="list"]').loader({ position: 'inside' });
       $.post(rooturl+'/?r='+raccount+'&m=member&a=get_profileFollow',{
          mbruid : mbruid,
          type : 'modal'
       },function(response){
        var result = $.parseJSON(response);
        var followlist=result.list;
        var follownum=result.num;
        modal.find('[data-role="followList"] [data-role="list"]').html(followlist);
        swiper_member_profile.updateAutoHeight(100);
        modal.find('[data-role="followList"] [data-role="list"] [data-plugin="timeago"]').timeago();
      });
     }

   });

   nav_control.find('.nav-link').click(function(){
     var index =  $(this).data('index')
     swiper_member_profile.slideTo(index);
   });
  });

} // getPofileView
