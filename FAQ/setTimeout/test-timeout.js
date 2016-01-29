$(function() {

	//输出结果:4,4,4,4
	$('#run').click(function() {
		for (var i = 0; i <= 3; i++) {
			setTimeout(function() {
				console.log(i);
			}, 0)
		};
	});

	$('#block').click(function() {
		var start = new Date;
		setTimeout(function(){
			var end = new Date;
			console.log('Time elapsed:', end - start, 'ms');
		}, 500);
		while (new Date - start < 1000) {

		};
		var ajaxRequest = new XMLHttpRequest;
		ajaxRequest.open('GET', 'http://localhost:8040/FAQ/setTimeout/data.json', false);
		ajaxRequest.send(null);
		console.log(ajaxRequest.readyState + ' ' + XMLHttpRequest.UNSENT);
		while (ajaxRequest.readyState === XMLHttpRequest.UNSENT) {
		// readyState 在循环返回之前不会有更改。
			console.log('unsend');
		};
		while (ajaxRequest.readyState === XMLHttpRequest.LOADING) {
		// readyState 在循环返回之前不会有更改。
			console.log('loading');
		};
		while (ajaxRequest.readyState === XMLHttpRequest.HEADERS_RECEIVED) {
		// readyState 在循环返回之前不会有更改。
			console.log('HEADERS_RECEIVED');
		};
		// while (ajaxRequest.readyState === XMLHttpRequest.OPENED) {
		// // readyState 在循环返回之前不会有更改。
		// 	console.log('OPENED');
		// };
		console.log(ajaxRequest.responseText);
	});
	
});