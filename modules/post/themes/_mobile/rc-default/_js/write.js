function setPostWrite(settings) {
  var wrapper = settings.wrapper;
  var uid=settings.uid;
  if (!uid) var uid=wrapper.attr('data-uid');

  // 상태 초기화
  wrapper.find('[name="uid"]').val('');


  wrapper.find('[data-role="display_label"]').text(uid?'':'비공개');

  popover_post_display.find('[data-toggle="display"] .badge').empty();
  popover_post_display.find('[data-toggle="display"][data-display="1"] .badge').html('<span class="icon icon-check"></span>');
  wrapper.find('[name="display"]').val(1);
  wrapper.find('[name="category_members"]').val('');
  wrapper.find('[name="list_members"]').val('');
  wrapper.find('[name="upload"]').val('');
  wrapper.find('[name="member"]').val('');
  wrapper.find('[name="featured_img"]').val('');
  wrapper.find('[name="review"]').val('');
  wrapper.find('[name="format"]').val(1);
  wrapper.find('[name="dis_rating"]').val(0);
  wrapper.find('[name="dis_like"]').val(0);
  wrapper.find('[name="dis_comment"]').val(0);
  wrapper.find('[name="dis_listadd"]').val(0);
  wrapper.find('[name="goods"]').val('');

  wrapper.find('[name="uid"]').val(uid);
  autosize.destroy(wrapper.find('[data-plugin="autosize"]'));

  setTimeout(function(){

    DecoupledEditor
      .create( document.querySelector( '[data-role="write"] [data-role="editor-body"]' ),{
        placeholder: '본문 입력...',
        toolbar: [ 'alignment:left','alignment:center','bulletedList','blockQuote','imageUpload','insertTable','undo'],
        removePlugins: [ 'ImageToolbar', 'ImageCaption', 'ImageStyle',,'WordCount' ],
        image: {},
        language: 'ko',
        extraPlugins: [rbUploadAdapterPlugin],
        table: {
          contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
        },
        mediaEmbed: {
          extraProviders: [
            {
              name: 'other',
              url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
            },
            {
              name: 'another',
              url: /^([a-zA-Z0-9_\-]+)\.([a-zA-Z0-9_\-]+)/
            }
          ]
        },
        typing: {
          transformations: {
            include: [
            'quotes',
            'typography',
            ],
            extra: [
              // Add some custom transformations – e.g. for emojis.
              { from: ':)', to: '🙂' },
              { from: ':+1:', to: '👍' },
              { from: ':tada:', to: '🎉' }
            ],
          }
        }
      } )
      .then( newEditor => {
        console.log('editor_post init');

        editor_post = newEditor;
        wrapper.find('.toolbar-container').html(editor_post.ui.view.toolbar.element)
        editor_post.editing.view.document.on( 'change:isFocused', ( evt, name, value ) => {
          if (value) {
            console.log('editor_post focus');
            wrapper.addClass('editor-focused');
          } else {
            console.log('editor_post blur');
            wrapper.removeClass('editor-focused');
          }
        } );

        if (uid) {
          $.post(rooturl+'/?r='+raccount+'&m=post&a=get_postWrite',{
            uid : uid
           },function(response,status){
              if(status=='success'){
                var result = $.parseJSON(response);
                var featured=result.featured;
                var featured_img=result.featured_img;
                var upload=result.upload;
                var display=result.display;
                var display_label=result.display_label;
                var format=result.format;
                var time=result.time;
                var subject=result.subject;
                var review=result.review;
                var content=result.content;
                var nic=result.nic;
                var isperm=result.isperm;
                var linkurl=result.linkurl;
                var listCollapse=result.listCollapse;
                var is_post_liked=result.is_post_liked;
                var is_post_disliked=result.is_post_disliked;
                var dis_like = result.dis_like;
                var dis_rating = result.dis_rating;
                var dis_comment = result.dis_comment;
                var dis_listadd = result.dis_listadd;
                var goods = result.goods;


                wrapper.find('[data-role="display_label"]').text(display_label);
                popover_post_display.find('[data-toggle="display"] .badge').empty();
                popover_post_display.find('[data-toggle="display"][data-display="'+display+'"] .badge').html('<span class="icon icon-check"></span>');
                wrapper.find('[name="display"]').val(display);

                wrapper.find('[data-role="subject"]').val(subject);
                wrapper.find('[data-role="time"]').text(time);
                wrapper.find('[data-role="featured"]').attr('src',featured);
                wrapper.find('[name="featured_img"]').val(featured_img);
                wrapper.find('[name="upload"]').val(upload);
                wrapper.find('[data-role="nic"]').text(nic);

                wrapper.find('[name="dis_rating"]').val(dis_rating);
                wrapper.find('[name="dis_like"]').val(dis_like);
                wrapper.find('[name="dis_comment"]').val(dis_comment);
                wrapper.find('[name="dis_listadd"]').val(dis_listadd);
                wrapper.find('[name="goods"]').val(goods);

                editor_post.setData(content);
                wrapper.find('[name="format"] [value="'+format+'"]').attr('selected',true);

                wrapper.find('[data-role="loader"]').addClass('d-none') //로더 제거
                wrapper.find('form').removeClass('d-none')

                if (display==5) {
                  wrapper.find('[data-toggle="switch"][data-role="public"]').addClass('active');
                } else {
                  wrapper.find('[data-toggle="switch"][data-role="public"]').removeClass('active');
                }

                if (goods) {
                  wrapper.find('[data-role="goodsLink"]').removeClass('d-none');
                }

                if (is_post_liked) wrapper.find('[data-role="btn_post_like_'+uid+'"]').addClass('active');
                if (is_post_disliked) wrapper.find('[data-role="btn_post_dislike_'+uid+'"]').addClass('active');

                if (dis_like) wrapper.find('[data-role="opinion"]').hide();
                if (dis_listadd) wrapper.find('[data-role="listadd"]').hide();

                wrapper.find('.form-list.floating .input-row').addClass('active');

                autosize(wrapper.find('[data-plugin="autosize"]'));

              } else {
                alert(status);
              }

          });
        } else {
          wrapper.find('[data-role="loader"]').addClass('d-none') //로더 제거
          wrapper.find('form').removeClass('d-none')

          autosize(wrapper.find('[data-plugin="autosize"]'));
        }

      })
      .catch( error => {
          console.error( error );
      } );

  }, 10);

  wrapper.find('.form-list.floating .input-row textarea').on('keyup', function(event) {
    if ($(this).val().length >= 1) {
      $(this).parents('.input-row').addClass('active');
    } else {
      $(this).parents('.input-row').removeClass('active');
    }
  })

  wrapper.find('.switch').on('changed.rc.switch', function () {
    var _switch = $(this);
    if (_switch.hasClass('active')) {
      wrapper.find('[name="display"]').val(5);
    } else {
      wrapper.find('[name="display"]').val(1);
    }
  })

} // getPostWrite

function savePost(f) {

  var editorData = editor_post.getData();

  // 카테고리 체크
	var cat_sel=$('input[name="tree_members[]"]');
	var cat_sel_n=cat_sel.length;
  var cat_arr=$('input[name="tree_members[]"]:checked').map(function(){return $(this).val();}).get();
	var cat_n=cat_arr.length;

	// if(cat_sel_n>0 && cat_arr==''){
	// 	alert('지정된 카테고리가 없습니다.\n적어도 하나이상의 카테고리를 지정해 주세요.');
  //   $('#advan').tab('show')
	// 	return false;
	// }

  var s='';
  for (var i=0;i <cat_n;i++) {
    if(cat_arr[i]!='')  s += '['+cat_arr[i]+']';
  }
  f.category_members.value = s;


  // 리스트 체크
  var list_sel=$('input[name="postlist_members[]"]');
  var list_arr=$('input[name="postlist_members[]"]:checked').map(function(){return $(this).val();}).get();
	var list_n=list_arr.length;
  var l='';
  for (var i=0;i <list_n;i++) {
    if(list_arr[i]!='')  l += '['+list_arr[i]+']';
  }
  $('input[name="list_members"]').val(l);

  // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
  var featured_img_input = $('input[name="featured_img"]'); // 대표이미지 input
  var featured_img_uid = $(featured_img_input).val();
  if(featured_img_uid ==0){ // 대표이미지로 지정된 값이 없는 경우
    var first_attach_img_li = $('.rb-attach-featured li:first'); // 첫번째 첨부된 이미지 리스트 li
    var first_attach_img_uid = $(first_attach_img_li).attr('data-id');
    featured_img_input.val(first_attach_img_uid);
  }

  // 첨부파일 uid 를 upfiles 값에 추가하기
  var attachfiles=$('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
  var new_upfiles='';
  if(attachfiles){
    for(var i=0;i<attachfiles.length;i++) {
      new_upfiles+=attachfiles[i];
    }
    $('input[name="upload"]').val(new_upfiles);
  }

  // 공유회원 uid 를 members 값에 추가하기
  var postmembers=$('input[name="postmembers[]"]').map(function(){return $(this).val()}).get();
  var new_members='';
  if(postmembers){
    for(var i=0;i<postmembers.length;i++) {
      new_members+=postmembers[i];
    }
    $('input[name="member"]').val(new_members);
  }

  checkUnload = false;
  $('[data-role="postsubmit"]').attr( 'disabled', true );

  var form = $('[name="writeForm"]')
  var uid = form.find('[name="uid"]').val();
  var category_members = form.find('[name="category_members"]').val();
  var list_members = form.find('[name="list_members"]').val();
  var member = form.find('[name="member"]').val();
  var upload = form.find('[name="upload"]').val();
  var featured_img = form.find('[name="featured_img"]').val();
  var html = form.find('[name="html"]').val();
  var subject = form.find('[name="subject"]').val();
  var review = form.find('[name="review"]').val();
  var tag = form.find('[name="tag"]').val();
  var display = form.find('[name="display"]').val();
  var format = form.find('[name="format"]').val();
  var goods = form.find('[name="goods"]').val();

  var dis_rating = form.find('[name="dis_rating"]').val();
  var dis_like = form.find('[name="dis_like"]').val();
  var dis_comment = form.find('[name="dis_comment"]').val();
  var dis_listadd = form.find('[name="dis_listadd"]').val();

  if (!subject) {
    $.notify({message: '제목 입력후 저장해 주세요.'},{type: 'default'});
    form.find('[name="subject"]').focus();
    modal_post_write.find('[data-act="submit"]').attr('disabled',false);
    return false;
  }

  if (editorData == '') {
    $.notify({message: '본문 입력후 저장해 주세요.'},{type: 'default'});
    modal_post_write.find('[data-act="submit"]').attr('disabled',false);
    return false;
  }

  setTimeout(function(){

    $.post(rooturl+'/?r='+raccount+'&m=post&a=write',{
      send_mod : 'ajax',
      content : editorData,
      uid : uid,
      category_members : category_members,
      list_members : list_members,
      member : member,
      upload : upload,
      featured_img : featured_img,
      html : html,
      subject : subject,
      review : review,
      tag : tag,
      format : format,
      goods : goods,
      display : display,
      dis_rating : dis_rating,
      dis_like : dis_like,
      dis_comment : dis_comment,
      dis_listadd : dis_listadd
      },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var d_modify=result.d_modify;

          history.back();
          form.find('[data-role="postsubmit"]').attr( 'disabled', false );
          setTimeout(function(){ $.notify({message: '저장 되었습니다.'},{type: 'default'}); }, 300);

        } else {
          alert(status);
        }
    });
  }, 200);
}

function savePostByLink(url) {

  $.get('//embed.kimsq.com/oembed',{
      url: url
  }).done(function(response) {
      var type = response.type;
      var title = response.title;
      var description = response.description?response.description:'.';
      var thumbnail_url = response.thumbnail_url;
      var author = response.author;
      var provider = response.provider_name;
      var url = response.url;
      var width = response.thumbnail_width;
      var height = response.thumbnail_height;
      var embed = response.html;
      $('[name="subject"]').val(title);

      if (type=='video') {

        $.get('//embed.kimsq.com/iframely',{
            url: url
        }).done(function(response) {
            var duration = response.meta.duration;
            var _duration = moment.duration(duration, 's');
            var formatted_duration = _duration.format("h:*m:ss");

            $.post(rooturl+'/?r='+raccount+'&m=mediaset&a=saveLink',{
               type : 9,
               title : title,
               theme : '_desktop/bs4-default-link',
               description : description,
               thumbnail_url : thumbnail_url,
               author: author,
               provider : provider,
               url : url,
               duration : duration?duration:'',
               time :  duration?formatted_duration:'',
               width : width,
               height : height,
               embed : embed
            },function(response){
                var result=$.parseJSON(response);
                var uid = result.last_uid
                if(!result.error){

                  // 새 포스트 저장
                  var subject = title;
                  var content = description;
                  var upload = '['+uid+']';
                  var featured_img = uid;
                  var format = 2; //비디오 타입
                  var html = 'HTML';

                  $.post(rooturl+'/?r='+raccount+'&m=post&a=write',{
                    send_mod : 'ajax',
                    content : content,
                    upload : upload,
                    featured_img : featured_img,
                    html : html,
                    subject : subject,
                    format : format
                    },function(response,status){
                      if(status=='success'){
                        var result = $.parseJSON(response);
                        var uid=result.last_uid;
                        var cid=result.last_cid;

                        history.back();
                        modal_post_write.attr('data-uid',uid);

                        setTimeout(function(){
                          modal_post_write.modal({
                            title : '포스트 수정',
                            url : '/post/write/'+cid
                          });
                        }, 300);

                      } else {
                        alert(status);
                      }
                  });

                }
            });

        });

      } else {

        $.post(rooturl+'/?r='+raccount+'&m=mediaset&a=saveLink',{
          type : 8,
          title : title,
          theme : '_desktop/bs4-default-link',
          description : description,
          thumbnail_url : thumbnail_url,
          author: author,
          provider : provider,
          url : url,
          width : width,
          height : height,
          embed : embed
        },function(response){
          var result=$.parseJSON(response);
          var uid = result.last_uid
          if(!result.error){

            // 새 포스트 저장
            var subject = title;
            var content = '<p>'+description+'</p><figure class="media"><oembed url="'+url+'"></oembed></figure>';
            var upload = '['+uid+']';
            var featured_img = uid;
            var format = 1; //문서 타입
            var html = 'HTML';

            $.post(rooturl+'/?r='+raccount+'&m=post&a=write',{
              send_mod : 'ajax',
              content : content,
              upload : upload,
              featured_img : featured_img,
              html : html,
              subject : subject,
              format : format
              },function(response,status){
                if(status=='success'){
                  var result = $.parseJSON(response);
                  var uid=result.last_uid;
                  var cid=result.last_cid;

                  history.back();
                  modal_post_write.attr('data-uid',uid);

                  setTimeout(function(){
                    modal_post_write.modal({
                      title : '포스트 수정',
                      url : '/post/write/'+cid
                    });

                  }, 300);

                } else {
                  alert(status);
                }
            });

          }
        });
      }

  }).fail(function() {
    $.notify({message: 'URL을 확인해주세요.'},{type: 'default'});
    sheet_post_linkadd.find('[data-act="submit"]').attr('disabled',false );
    textarea.attr('disabled',false).focus()
  }).always(function() {
  });

} // savePostByLink()
