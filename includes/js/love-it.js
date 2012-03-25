jQuery(document).ready( function($) {	
	$('.love-it').on('click', function() {	
		if($(this).hasClass('loved')) {
			alert(love_it_vars.already_loved_message);
			return false;
		}	
		var post_id = $(this).data('post-id');
		var user_id = $(this).data('user-id');
		var post_data = {
			action: 'love_it',
			item_id: post_id,
			user_id: user_id,
			love_it_nonce: love_it_vars.nonce
		};
		$.post(love_it_vars.ajaxurl, post_data, function(response) {
			if(response == 'loved') {
				$('.love-it').addClass('loved');
				var count_wrap = $('.love-count');
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);		
			} else {
				alert(love_it_vars.error_message);
			}
		});
		return false;
	});	
});