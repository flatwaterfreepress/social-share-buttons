function add_social_share_buttons($content) {
	
	
	
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
	
	?>
	
	<li class="share-link meta-wrapper">
		<span class="meta-text">
			<a id="share-link">Share</a>
		</span>
	</li>
	
	<script>
		window.onload = function() {
			console.log("Loading...");
			var share_container = document.querySelector('.social-share-buttons');
			console.log("share_container: ", share_container);
			document.getElementById('share-link').addEventListener('click', function() {
				  share_container.style.display = (share_container.style.display === 'flex') ? 'none' : 'flex';
			});

			document.getElementById('close-button').addEventListener('click', function() {
				  share_container.style.display = 'none';
			});


		}
	</script>
	
	
	<script type="text/javascript">
		function CopyLink() {
			let url = document.location.href
			
			navigator.clipboard.writeText(url).then(function() {
				console.log('Copied link: ', url);
				document.getElementById('share-button-copy').innerHTML = "Link copied";

			}, function() {
				console.log('Copy error');
			});
		};
		
		

	</script>
		
	<?
	
	$share_buttons = '<div class="social-share-buttons"><div class="share-top"><p class="share-label">Share this story</p><p  id="close-button">Close</p></div><div class="share-buttons">';

	// Loop through the social networks and generate the share buttons HTML
	foreach ($social_networks as $network => $share_url) {
		if ($network == 'Copy Link'):
			$share_buttons .= '<a id="share-button-copy" onclick="CopyLink()">' . $network . '</a>';
		elseif ($network == 'Publish this story'):
			$download_link = get_field('download_link');
			$share_buttons .= '<a id="publish-this-story" href="' . $download_link . '" target="_blank">' . $network . '</a>';
		else:
			$share_buttons .= '<a class="share-button-text" href="' . $share_url . '" target="_blank" rel="noopener">' . $network . '</a>';
		endif;
	};
	// Close the share buttons HTML
	$share_buttons .= '</div></div>';

	// Append the share buttons HTML to the content
	$content .= $share_buttons;

	return $content;
}

add_filter('the_content', 'add_social_share_buttons', 10, 2);