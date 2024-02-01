// Show the hidden container when the link is clicked
var share_container = document.querySelector('.social-share-buttons');
document.getElementById('share-link').addEventListener('click', function() {
	  share_container.style.display = (container.style.display === 'flex') ? 'none' : 'flex';
});


// Close button
document.getElementById('close-button').addEventListener('click', function() {
	  share_container.style.display === 'none';
});

 
function CopyLink() {
	let url = document.location.href
	
	navigator.clipboard.writeText(url).then(function() {
		console.log('Copied link: ', url);
		document.getElementById('share-button-copy').innerHTML = "Link copied";
	}, function() {
		console.log('Copy error');
	});
};
