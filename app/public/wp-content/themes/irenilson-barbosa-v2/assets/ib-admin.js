/* IRENILSON BARBOSA — Admin: seletor de mídia */
jQuery(function($){
  $(document).on('click', '[data-media-pick]', function(e){
    e.preventDefault();
    var input = $('#' + $(this).data('media-pick'));
    var preview = $('#preview-' + $(this).data('media-pick'));
    var frame = wp.media({title:'Selecionar imagem',library:{type:'image'},multiple:false});
    frame.on('select',function(){
      var url = frame.state().get('selection').first().toJSON().url;
      input.val(url);
      if(preview.length) preview.attr('src',url).show();
    });
    frame.open();
  });
  $(document).on('click', '[data-media-clear]', function(){
    var input = $('#' + $(this).data('media-clear'));
    var preview = $('#preview-' + $(this).data('media-clear'));
    input.val('');
    if(preview.length) preview.hide();
  });
});
