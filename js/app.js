(function($){
	$('#form_add').on('submit', function(e){
		e.preventDefault();
		var $form = $(this);
		$.post($form.attr('action'), $form.serializeArray())
			.done(function(data, text, jqxhr){
				$div = $(jqxhr.responseText);
				$('#commentaire').prepend($div);
				$div.hide().fadeIn();
			})
			.fail(function(jqxhr){
				alert(jqxhr.responseText);
			})
			.always(function(){
				$form.find('button').text('Commenter');
			});
	});
})(jQuery);