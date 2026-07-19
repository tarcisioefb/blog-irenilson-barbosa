/* Elite Notícias — seletor de imagem (biblioteca de mídia) na página de ajustes. */
jQuery(function ($) {
	var frame;
	$('#elite-promo-pick').on('click', function (e) {
		e.preventDefault();
		if (frame) { frame.open(); return; }
		frame = wp.media({ title: 'Selecionar imagem do banner', button: { text: 'Usar esta imagem' }, multiple: false });
		frame.on('select', function () {
			var att = frame.state().get('selection').first().toJSON();
			$('#elite-promo-image').val(att.url);
			$('#elite-promo-preview').attr('src', att.url).show();
		});
		frame.open();
	});
	$('#elite-promo-clear').on('click', function (e) {
		e.preventDefault();
		$('#elite-promo-image').val('');
		$('#elite-promo-preview').hide().attr('src', '');
	});
});
