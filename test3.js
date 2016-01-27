window.addEventListener('load', function() {
	var ve = document.getElementById('music');
	var au = document.getElementById('video');
	au.playbackRate = 1;
	au.poster = 'temp/Desert.jpg';
	// ve.muted = true;
	ve.play();
	setTimeout(function() {
		ve.playbackRate=1;
		ve.loop = true;
		console.log(ve.currentTime);
		console.log(ve.duration);
		console.log(ve.initialTime);
		console.log(au.duration);
	}, 1000);
	
}, false);

$(function() {
	$('div').each(function(idx) {
		setTimeout(function() {
			var time = $('#music');
			console.log();
			// console.log(document.readyState);
		}, idx * 1000);
		console.log(document.readyState);
		$(this).prepend(idx + ": ");
		if (this.id === 'last') {
	    	return false;
	    }	

	});

	console.log($('script').jquery);
	console.log(document.readyState);
	$('#change').mouseover(function() {
		this.src = 'test.gif';
	});
	$('#change').mouseout(function() {
		this.src = 'love.gif';
	})

	var audio = new Audio();
	console.log(audio.canPlayType('audio/wav'));


});

$(document).ready(function() {
	var elt = $('#input');
	var position = elt.offset();
	// position.top += 100;
	elt.offset(position);

	$('h1').offset(function(index, curpos) {
		return {left: curpos.left + 25*index, top: curpos.top};
	});
	console.log(position);
});

jQuery(function() {
	$('div').data('x', 1);
	// $('div').attr('draggable', true);
	console.log('div value:' + $('div').data('x'));
	console.log($('div'));
	console.log(document.readyState);
});