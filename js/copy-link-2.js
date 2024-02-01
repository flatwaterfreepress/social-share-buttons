function CopyLink() {
	let url = document.location.href
	
	navigator.clipboard.writeText(url).then(function() {
		console.log('Copied link: ', url);
		document.getElementById('share-button-copy').innerHTML = "Link copied";
	}, function() {
		console.log('Copy error');
	});
};

