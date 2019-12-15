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
  wrapper.find('[data-role="linkNum"]').text('');
  //wrapper.find('[data-role="attach-preview-photo"]').html('');
  wrapper.find('[data-role="attach-preview-link"]').html('');
  wrapper.find('[data-role="linkadd_input"]').val('');
  wrapper.find('[data-toggle="switch"][data-role="dis_like"]').addClass('active');
  wrapper.find('[data-toggle="switch"][data-role="dis_comment"]').addClass('active');
  wrapper.find('[data-toggle="switch"][data-role="dis_listadd"]').addClass('active');
  wrapper.find('.switch-handle').removeAttr("style");
  wrapper.find('[data-toggle="collapse"]').addClass('collapsed');
  wrapper.find('.collapse').removeClass('in');

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

        $.post(rooturl+'/?r='+raccount+'&m=post&a=get_category',{
          uid : uid
        },function(response,status){
           if(status=='success'){
             var result = $.parseJSON(response);
             var category_tree=result.category_tree;
             page_post_edit_category.find('[data-role="box"]').html(category_tree);
           } else {
             alert(status);
           }
        });

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
                var tag=result.tag;
                var content=result.content;
                var nic=result.nic;
                var isperm=result.isperm;
                var linkurl=result.linkurl;
                var listCollapse=result.listCollapse;
                var dis_like = result.dis_like;
                var dis_comment = result.dis_comment;
                var dis_listadd = result.dis_listadd;
                var goods = result.goods;
                var linkNum = result.linkNum;
                var attachNum = result.attachNum;
                var photo=result.photo;
                var video=result.video;
                var audio=result.audio;
                var file=result.file;
                var link=result.link;

                wrapper.find('[data-role="display_label"]').text(display_label);
                popover_post_display.find('[data-toggle="display"] .badge').empty();
                popover_post_display.find('[data-toggle="display"][data-display="'+display+'"] .badge').html('<span class="icon icon-check"></span>');
                wrapper.find('[name="display"]').val(display);

                wrapper.find('[data-role="subject"]').val(subject);
                wrapper.find('[data-role="time"]').text(time);
                wrapper.find('[data-role="featured"]').attr('src',featured);
                wrapper.find('[name="featured_img"]').val(featured_img);
                wrapper.find('[name="upload"]').val(upload);
                wrapper.find('[name="review"]').val(review);
                wrapper.find('[name="tag"]').val(tag);
                wrapper.find('[name="goods"]').val(goods);
                wrapper.find('[name="dis_like"]').val(dis_like);
                wrapper.find('[name="dis_comment"]').val(dis_comment);
                wrapper.find('[name="dis_listadd"]').val(dis_listadd);

                if (featured_img) wrapper.find('.media-left').removeClass('d-none');
                else wrapper.find('.media-left').addClass('d-none');

                if (linkNum) {
                  wrapper.find('[data-role="addlink_guide"]').addClass('d-none');
                  wrapper.find('[data-role="linkNum"]').text(linkNum);
                  wrapper.find('[data-role="attach-preview-link"]').removeClass('hidden').html(link)
                }

                if (attachNum) {
                  wrapper.find('[data-role="attach_guide"]').addClass('d-none');
                  wrapper.find('[data-role="attachNum"]').text(attachNum);
                  if (photo) {  // 첨부 이미지가 있을 경우
                    wrapper.find('[data-role="attach-preview-photo"]').removeClass('hidden').html(photo)
                  }

                  if (file) {  // 첨부 기타파일이 있을 경우
                    wrapper.find('[data-role="attach-file"]').removeClass('hidden').html(file)
                  }
                } else {
                  $('[data-role="attach_guide"]').removeClass('d-none');
                  wrapper.find('[data-role="attachNum"]').text('');
                }

                editor_post.setData(content);
                wrapper.find('[name="format"] [value="'+format+'"]').attr('selected',true);

                wrapper.find('[data-role="loader"]').addClass('d-none') //로더 제거
                wrapper.find('form').removeClass('d-none')

                if (dis_like) {
                  wrapper.find('[data-toggle="switch"][data-role="dis_like"]').removeClass('active');
                } else {
                  wrapper.find('[data-toggle="switch"][data-role="dis_like"]').addClass('active');
                }

                if (dis_comment) {
                  wrapper.find('[data-toggle="switch"][data-role="dis_comment"]').removeClass('active');
                } else {
                  wrapper.find('[data-toggle="switch"][data-role="dis_comment"]').addClass('active');
                }

                if (dis_listadd) {
                  wrapper.find('[data-toggle="switch"][data-role="dis_listadd"]').removeClass('active');
                } else {
                  wrapper.find('[data-toggle="switch"][data-role="dis_listadd"]').addClass('active');
                }

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


  wrapper.find('.switch[data-role="dis_comment"]').on('changed.rc.switch', function () {
    var _switch = $(this);
    if (_switch.hasClass('active')) {
      wrapper.find('[name="dis_comment"]').val(0);
    } else {
      wrapper.find('[name="dis_comment"]').val(1);
    }
  })

  wrapper.find('.switch[data-role="dis_like"]').on('changed.rc.switch', function () {
    var _switch = $(this);
    if (_switch.hasClass('active')) {
      wrapper.find('[name="dis_like"]').val(0);
    } else {
      wrapper.find('[name="dis_like"]').val(1);
    }
  })

  wrapper.find('.switch[data-role="dis_listadd"]').on('changed.rc.switch', function () {
    var _switch = $(this);
    if (_switch.hasClass('active')) {
      wrapper.find('[name="dis_listadd"]').val(0);
    } else {
      wrapper.find('[name="dis_listadd"]').val(1);
    }
  })

} // getPostWrite

function savePost(f) {

  var editorData = editor_post.getData();
  var after = modal_post_write.attr('data-after');

  // 카테고리 체크
	var cat_sel=page_post_edit_category.find('input[name="tree_members[]"]');
	var cat_sel_n=cat_sel.length;
  var cat_arr=page_post_edit_category.find('input[name="tree_members[]"]:checked').map(function(){return $(this).val();}).get();
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
  var list_sel=modal_post_write.find('input[name="postlist_members[]"]');
  var list_arr=modal_post_write.find('input[name="postlist_members[]"]:checked').map(function(){return $(this).val();}).get();
	var list_n=list_arr.length;
  var l='';
  for (var i=0;i <list_n;i++) {
    if(list_arr[i]!='')  l += '['+list_arr[i]+']';
  }
  modal_post_write.find('input[name="list_members"]').val(l);

  // 대표이미지가 없을 경우, 첫번째 업로드 사진을 지정함
  var featured_img_input = modal_post_write.find('input[name="featured_img"]'); // 대표이미지 input
  var featured_img_uid = $(featured_img_input).val();
  if(featured_img_uid ==0){ // 대표이미지로 지정된 값이 없는 경우
    var first_attach_img_li = modal_post_write.find('[data-role="attach-preview-photo"] li:first'); // 첫번째 첨부된 이미지 리스트 li
    var first_attach_img_uid = modal_post_write.find(first_attach_img_li).attr('data-id');
    featured_img_input.val(first_attach_img_uid);
  }

  // 첨부파일 uid 를 upfiles 값에 추가하기
  var attachfiles=modal_post_write.find('input[name="attachfiles[]"]').map(function(){return $(this).val()}).get();
  var new_upfiles='';
  if(attachfiles){
    for(var i=0;i<attachfiles.length;i++) {
      new_upfiles+=attachfiles[i];
    }
    modal_post_write.find('input[name="upload"]').val(new_upfiles);
  }

  // 공유회원 uid 를 members 값에 추가하기
  var postmembers=modal_post_write.find('input[name="postmembers[]"]').map(function(){return $(this).val()}).get();
  var new_members='';
  if(postmembers){
    for(var i=0;i<postmembers.length;i++) {
      new_members+=postmembers[i];
    }
    modal_post_write.find('input[name="member"]').val(new_members);
  }

  checkUnload = false;
  $('[data-role="postsubmit"]').attr( 'disabled', true );

  var form = modal_post_write.find('[name="writeForm"]')
  var uid = form.find('[name="uid"]').val();
  var category_members = form.find('[name="category_members"]').val();
  var list_members = form.find('[name="list_members"]').val();
  var member = form.find('[name="member"]').val();
  var upload = form.find('[name="upload"]').val();
  var featured_img = form.find('[name="featured_img"]').val();
  var html = form.find('[name="html"]').val();
  var subject = form.find('[name="subject"]').val();
  var display = form.find('[name="display"]').val();
  var format = modal_post_write.find('[name="format"]').val();

  var review = page_post_edit_review.find('[name="review"]').val();
  var tag = page_post_edit_tag.find('[name="tag"]').val();
  var goods = page_post_edit_advan.find('[name="goods"]').val();

  var dis_like = form.find('[name="dis_like"]').val();
  var dis_comment = form.find('[name="dis_comment"]').val();
  var dis_listadd = form.find('[name="dis_listadd"]').val();

  if (!subject) {
    $.notify({message: '제목 입력후 저장해 주세요.'},{type: 'default'});
    modal_post_write.find('[data-act="submit"]').attr('disabled',false);
    return false;
  }

  // if (editorData == '') {
  //   $.notify({message: '본문 입력후 저장해 주세요.'},{type: 'default'});
  //   modal_post_write.find('[data-act="submit"]').attr('disabled',false);
  //   return false;
  // }

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
      dis_like : dis_like,
      dis_comment : dis_comment,
      dis_listadd : dis_listadd
      },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var d_modify=result.d_modify;

          history.back();
          form.find('[data-role="postsubmit"]').attr( 'disabled', false );
          setTimeout(function(){
            if (uid && !after) {
              $.notify({message: '저장 되었습니다.'},{type: 'default'});
            } else {
              if (display==5 || display==4) {
                history.back();

                // 메인화면 목록 새로불러오기
                getPostAll({
                  wrapper : $('[data-role="postAll"] [data-role="list"]'),
                  start : '#page-main',
                  markup    : 'post-row',  // 테마 > _html > post-row-***.html
                  recnum    : 5,
                  sort      : 'gid',
                  none : '',
                  paging : 'infinit'
                })

              } else {
                $('#page-post-mypost').page({ start: '#page-main' });
              }
            }
           }, 300);

        } else {
          alert(status);
        }
    });
  }, 200);
}

function saveTwit(display,content) {

  setTimeout(function(){

    $.post(rooturl+'/?r='+raccount+'&m=post&a=write',{
      send_mod : 'ajax',
      content : '',
      subject : content,
      display : display,
      html : 'TEXT'
      },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          history.back(); // 작성모달 내리고
          setTimeout(function(){
            if (display==5) {

              // 메인화면 목록 새로불러오기
              getPostAll({
                wrapper : $('[data-role="postAll"] [data-role="list"]'),
                start : '#page-main',
                markup    : 'post-row',  // 테마 > _html > post-row-***.html
                recnum    : 5,
                sort      : 'gid',
                none : '',
                paging : 'infinit'
              })

            } else {
              $('#page-post-mypost').page({ start: '#page-main' });
            }
           }, 300);

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
                        modal_post_write.attr('data-uid',uid).attr('data-after','mypost');

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
                  modal_post_write.attr('data-uid',uid).attr('data-after','mypost');

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

page_post_edit_review.on('shown.rc.page', function(event) {
  var page = $(this)
  var textarea = page.find('textarea')
  setTimeout(function(){ textarea.focus() }, 300);
})

page_post_edit_review.on('hidden.rc.page', function(event) {
  var page = $(this)
  var textarea = page.find('textarea')
  textarea.blur()
})

page_post_edit_tag.on('shown.rc.page', function(event) {
  var page = $(this)
  var textarea = page.find('textarea')
  setTimeout(function(){ textarea.focus() }, 300);
})

page_post_edit_tag.on('hidden.rc.page', function(event) {
  var page = $(this)
  var textarea = page.find('textarea')
  textarea.blur()
})
