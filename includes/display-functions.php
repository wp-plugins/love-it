<?php

// adds the Love It link and count to post/page content
function li_display_love_link($content) {

	global $user_ID, $post;

	// only show the link when user is logged in and on a singular page
	if(is_user_logged_in() && is_singular()) {

		ob_start();
	
		// retrieve the total love count for this item
		$love_count = li_get_love_count($post->ID);
		
		// our wrapper DIV
		echo '<div class="love-it-wrapper">';
		
			// only show the Love It link if the user has NOT previously loved this item
			if(!li_user_has_loved_post($user_ID, get_the_ID())) {
				echo '<a href="#" class="love-it" data-post-id="' . get_the_ID() . '" data-user-id="' .  $user_ID . '">' . __('Love It', 'love_it') . '</a> (<span class="love-count">' . $love_count . '</span>)';
			} else {
				// show a message to users who have already loved this item
				echo '<span class="loved">' . __('You have loved this', 'love_it') . ' (<span class="love-count">' . $love_count . '</span>)</span>';
			}
		
		// close our wrapper DIV
		echo '</div>';
		
		// append our "Love It" link to the item content.
		$content = $content . ob_get_clean();
	}
	return $content;
}
add_filter('the_content', 'li_display_love_link', 100);