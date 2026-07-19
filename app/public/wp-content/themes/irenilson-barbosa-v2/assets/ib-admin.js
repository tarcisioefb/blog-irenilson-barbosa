/* IRENILSON BARBOSA — Admin: seletor de mídia */
jQuery(function($){
	var frame;
	$('#ib-promo-pick').on('click',function(e){
		e.preventDefault();
		if(frame){frame.open();return}
		frame=wp.media({title:'Selecionar imagem',library:{type:'image'},multiple:false});
		frame.on('select',function(){
			var url=frame.state().get('selection').first().toJSON().url;
			$('#promo_image').val(url);
			$('#ib-promo-preview').attr('src',url).show();
		});
		frame.open();
	});
	$('#ib-promo-clear').on('click',function(){
		$('#promo_image').val('');
		$('#ib-promo-preview').hide();
	});
});
