function setWidgetConfig(id,name,path,wdgvar,area) {
  $('[data-role="widgetConfig"] [data-role="form"]').html('');
  $.post(rooturl+'/?r='+raccount+'&m=site&a=get_widgetConfig',{
    name : name,
    widget : path,
    wdgvar : wdgvar,
    area : area
   },function(response,status){
      if(status=='success'){
        var result = $.parseJSON(response);
        var page=result.page;
        var widget=result.widget;
        if (!page) {
          $.notify({message: '위젯설정을 확인해주세요.'},{type: 'danger'});
          resetPage()
          return false
        }
        $('[data-role="widgetConfig"]').attr('data-id',id);
        $('[data-role="widgetConfig"]').attr('data-name',name);
        $('[data-role="widgetConfig"]').attr('data-path',path);
        $('[data-role="widgetConfig"] [data-role="form"]').html(page);
        $('[data-role="widgetConfig"]').removeClass('d-none');
        setTimeout(function(){
          $('[data-role="widgetConfig"] [data-role="form"]').find('.form-control')[0].focus();
        }, 100);

      } else {
        $.notify({message: '위젯설정을 확인해주세요.'},{type: 'danger'});
        return false
      }
    });
}

function resetPage() {
  $('[data-role="widgetConfig"]').addClass('d-none');
  $('[data-role="addWidget"]').removeClass('active');
  $('[name="widget_selector"]').prop('selectedIndex',0);
  $('[data-role="widgetPage"] [data-role="item"]').removeClass('active shadow-sm')
}

$( document ).ready(function() {

  $('#modal-widget-selector').find('[name="widget_selector"]').change(function(){
    var modal = $('#modal-widget-selector');
    var path =  $(this).val();
    var name = $(this).find('option:selected').text();
    var id = randomId();
    var area = $(this).attr('data-area');
    var wdgvar = '';
    var button = $('#modal-widget-selector').find('[data-act="submit"]');

    modal.find('[data-role="none"]').removeClass('d-none');
    modal.find('[data-role="thumb"]').attr('src','').addClass('d-none');
    modal.find('[data-role="readme"]').html('');

    button.attr('data-path',path);
    button.attr('data-name',name);
    button.attr('data-id',id);
    button.attr('data-area',area);

    $.post(rooturl+'/?r='+raccount+'&m=site&a=get_widgetGuide',{
      widget : path
     },function(response,status){
        if(status=='success'){
          var result = $.parseJSON(response);
          var readme=result.readme;
          var thumb=result.thumb;

          if (!thumb) {
            modal.find('[data-role="none"]').removeClass('d-none');
            modal.find('[data-role="thumb"]').addClass('d-none');
          } else {
            modal.find('[data-role="none"]').addClass('d-none');
            modal.find('[data-role="thumb"]').attr('src',thumb).removeClass('d-none');
            modal.find('[data-role="readme"]').html(readme);
          }

        } else {
          alert('위젯설정을 확인해주세요.')
          return false
        }
      });

  });

  $('#modal-widget-selector').find('[data-act="submit"]').click(function(){
    var button = $(this)
    var path =  button.attr('data-path');
    var name = button.attr('data-name');
    var id = button.attr('data-id');
    var area = button.attr('data-area');
    var wdgvar = '';
    var modal = $('#modal-widget-selector');

    if (!path) {
      modal.find('[name="widget_selector"]').focus();
      return false;
    }

    modal.modal('hide');

    $('[data-role="widgetConfig"] [data-role="form"]').html('');
    $('[data-role="widgetPage"] [data-role="item"]').removeClass('active shadow-sm')

    if (path) {
      setWidgetConfig(id,name,path,wdgvar,area)
      $('[data-role="widgetPage"][data-area="'+area+'"] [data-role="addWidget"]').addClass('active');
    } else {
      $('[data-role="widgetConfig"]').addClass('d-none');
    }

  });

  $('[data-role="widgetConfig"]').on('click','[data-act="save"]',function() {
    var name = $('[data-role="widgetConfig"]').attr('data-name');
    var title = $('[data-role="widgetConfig"] [name="title"]').val();
    var path = $('[data-role="widgetConfig"]').attr('data-path');
    var id = $('[data-role="widgetConfig"]').attr('data-id');
    var mod = $(this).attr('data-mod');
    var area = $(this).attr('data-area');

    $(this).attr('disabled', true);

    if (!title) title = name;

    $(document).find('[data-role="widgetPage"] .card').removeClass('animated fadeInUp')

    var widget_var = id+'^'+title+'^'+path+'^';

    $('[data-role="widgetConfig"] [name]').each(function(index){
      var _name =  $(this).attr('name');
      var _var =  $(this).val()?$(this).val():'';
      widget_var += _name+'='+_var+',';
    });

    setTimeout(function(){

      resetPage();

      if (mod=='add') {
        var box = '<li class="card round-0 mb-3 text-muted text-center animated fadeInUp dd-item" data-name="'+name+'" data-path="'+path+'" data-role="item" id="'+id+'">'+
                  '<a href="" data-act="remove" title="삭제" class="badge badge-light border-0"><i class="fa fa-times" aria-hidden="true"></i></a>'+
                  '<span data-act="move" class="badge badge-light border-0 dd-handle"><i class="fa fa-arrows" aria-hidden="true"></i></span>'+
                  '<input type="hidden" name="widget_members[]" value="['+widget_var+']">'+
                  '<div class="card-body"><a href="#" class="text-reset" data-role="title" data-act="edit">'+title+'</a></div>'+
                  '</li>';

        $('[data-role="widgetPage"][data-area="'+area+'"] .dd-list').append(box);
        $('[data-role="widgetPage"] [data-toggle="tooltip"]').tooltip();

      } else {

        $(document).find('#'+id+' [name="widget_members[]"]').val('['+widget_var+']');
        $(document).find('#'+id+'').addClass('animated fadeInUp');
        $(document).find('#'+id+' [data-role="title"]').text(title);
        $('[data-role="widgetPage"] [data-role="item"]').removeClass('active shadow-sm')
      }
    }, 600);

  });

  $('[data-role="widgetConfig"]').on('click','[data-act="cancel"]',function(e) {
    e.preventDefault();
    resetPage();
  });

  $('[data-role="widgetPage"]').on('click','[data-act="remove"]',function(e){
    e.preventDefault();
    $(this).closest('.card').remove();
    resetPage();
  });

  //순서변경
  $('[data-plugin="nestable"]').nestable({
    group: 1,
    maxDepth: 1
  });

  $('#modal-widget-selector').on('show.bs.modal', function (event) {
    var modal = $(this)
    var button = $(event.relatedTarget);
    var area = button.attr('data-area');
    resetPage();
    setTimeout(function(){ modal.find('[name="widget_selector"]').attr('data-area',area).trigger('focus'); }, 100);
  })

  $('#modal-widget-selector').on('hidden.bs.modal', function (event) {
    var modal = $(this)
    var button = modal.find('[data-act="submit"]');
    var selector =  modal.find('[name="widget_selector"]');
    button.removeAttr('data-path').removeAttr('data-id').removeAttr('data-area').removeAttr('data-name');
    selector.removeAttr('data-area');
    modal.find('[name="widget_selector"]').prop('selectedIndex',0);
    modal.find('[data-role="readme"]').html('');
    modal.find('[data-role="thumb"]').attr('src','')

    $('[data-role="addWidget"]').removeClass('active');
  })

});
