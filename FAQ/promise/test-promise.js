$(function() {
	/*
	简单总结一下,Promise 对象接受 3 种回调形式: done 、 fail 和
	progress 。执行 Promise 对象时,运行的是 done 回调;拒绝 Promise
	对象时,运行的是 fail 回调;对处于挂起状态的 Deferred 对象调用
	notify 时,运行的是 progress 回调。
	 */
	function checkWordCount() {
        var nanowrimoing = new $.Deferred();
        var wordGoal = 5;
        nanowrimoing.progress(function(wordCount) {
        var percentComplete = Math.floor(wordCount / wordGoal * 100);
            $('#showt').text(percentComplete + '% complete');
        });
        nanowrimoing.done(function(){
            $('#showt').text('Good job!');
        });
        $('#indicator').on('keypress', function(){
		var wordCount = $(this).val().length;
		if (wordCount >= wordGoal) {
			nanowrimoing.resolve();
		};
		nanowrimoing.notify(wordCount);
		console.log(wordCount);
		});
    };

	checkWordCount();
    /*
    再试着反复敲击 Y 键和 N 键。第一次做出选择之后,就再也没有反
    应了!这是因为 Promise 只能执行或拒绝一次,之后就失效了。

    Deferred 就是 Promise!更准确
	地说,Deferred 是 Promise 的超集,它比 Promise 多了一项关键特性:
	可以直接触发。纯 Promise 实例只允许添加多个调用,而且必须由其
	他什么东西来触发这些调用。
     */
    function promise() {
        var prompt = new $.Deferred();
        $('#playGame').focus().on('keypress', function(e) {
          var Y = 121, N = 110;
          if (e.keyCode === Y) {
            prompt.resolve(); // call prompt.done()
          } else if (e.keyCode === N) {
            prompt.reject(); // call prompt.fail()
          } else {
            return false;  // they must choose!
          }
        });
        prompt.always(function(){ console.log('A choice was made:'); });
        prompt.done(function(){ console.log('Starting game...'); });
        prompt.fail(function(){ console.log('No game today.');});
    }
    
    promise();

    function afterErrorShown() {
    	console.log('callback of fadeIn');
    }

    function afterErrorHide() {
    	console.log('callback of fadeOut');
    }

    $('#fadeIn').click(function() {
    	$('.error').fadeIn(afterErrorShown);
    	var errorPromis = $('.error').fadeOut().promise();
    	errorPromis.done(afterErrorHide);
    });
    
    $('#complex').click(function() {
    	$.get('http://localhost:8040/FAQ/promise/data1.json', {}, function(data){
		    console.log(data);
		},'text');
		$.get('http://localhost:8040/FAQ/promise/result.txt',{}, function(data){
		    console.log(data);
		},'text');
	    //$.when($.get('http://localhost:8040/FAQ/promise/data1', function(data, status) {console.log(data + " " + status)}), $.get('http://localhost:8040/FAQ/promise/data2', function(data, status) {console.log(data + " " + status)}));
		// .then(function() {console.log(data1)}, function() {console.log(data2)});
    });
})