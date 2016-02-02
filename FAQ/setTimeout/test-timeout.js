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
        while (new Date - start < 1000) { };
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
        //  console.log('OPENED');
        // };
        console.log(ajaxRequest.responseText);
    });
    
    $('#count').click(function() {
        var fireCount = 0;
        var start = new Date;
        //如果使用 setInterval 调度事件且延迟设定为 0 毫秒,则会尽可能
        // 频繁地运行此事件,对吗?那么,在运行于高速英特尔 i7 处理器之
        // 上的现代浏览器中,此事件的触发频率到底如何呢?
        // 大约为 200 次/秒
        // 这是怎么回事?最后我们发现, setTimeout 和 setInterval 就是
        // 想设计成慢吞吞的!事实上,HTML 规范(这是所有主要浏览器都遵
        // 守的规范)推行的延时/时隔的最小值就是 4 毫秒! 1
        var timer = setInterval(function() {
            if (new Date-start > 1000) {
                clearInterval(timer);
                console.log('setInterval:' + fireCount);
                return;
            }
            fireCount++;
        }, 0);

        while(new Date-start <= 1000) {
            fireCount++;
        };
        console.log(fireCount);
    });

});