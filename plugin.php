<?php

/*

Plugin Name: Flatwater Social Sharing Buttons
Description: Simple, junk-free way to get social media share buttons on your article pages.
Version: 0.2
Author: Hanscom Park Studio
Author URI: https://hanscompark.com


*/


function add_plugin_assets() {
	wp_enqueue_style( 'share_buttons', plugin_dir_url( __FILE__ ) . 'css/share-buttons-style.css', false, '1.0.0' );
	wp_enqueue_script( 'copy-scripts', plugin_dir_url( __FILE__ ) . 'js/copy-link.js', 2.5,null, false );

}
add_action('wp_enqueue_scripts', 'add_plugin_assets');



function bottom_share_buttons( ) {
	
	// Get the current page URL
		$url = esc_url(get_permalink());
	
		// Get the current page title
		$title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
	
		// Create an array of social networks and their respective sharing URLs
	$social_networks = array(
			'Copy Link' => 'link:' . $url . '&title=' . $title,
			'Email' => 'mailto:?subject=Story%20from%20the%20Flatwater%20Free%20Press%20📰' . '&body=From%20the%20Flatwater%20Free%20Press: ' . $url,
			'Facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
			'X' => 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title,
			'LinkedIn' => 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title,
			'Publish this story' => '',
		);
		
	$share_button_row = '<div id="bottom-share-buttons"><p style="margin: 0 25px 0 0;">Share this story</p>';
	
	foreach ($social_networks as $network => $share_url) {
		if ($network == 'Copy Link'):
			$share_button_row .= '<a id="share-button-copy" onclick="CopyLink()" title="' . $network . '"></a>';
		elseif ($network == 'Publish this story'):
			$download_link = get_field('download_link');
			$share_button_row .= '<a id="publish-this-story" href="' . $download_link . '" target="_blank" title="' . $network . '"></a>';
		else:
			$share_button_row .= '<a class="share-button-text" href="' . $share_url . '" target="_blank" rel="noopener" title="' . $network . '"></a>';
		endif;
	};
	
	$share_button_row .= '</div>';
	
	
	echo $share_button_row;
}
add_action( 'chaplin_entry_footer', 'bottom_share_buttons', 19 );

?>

