var btn = undefined;
var btn1 = undefined;
window.onload = function() {
    var elts = document.getElementsByTagName('input');
    btn = document.getElementById('btn');
    btn1 = document.getElementById('btn1');
    // var nick = prompt('Enter you nickName');
    // var input = document.getElementById('input');
    // var chat = new EventSource('/chat');
    // chat.onmessage = function(event) {
    //     var msg = event.data;
    //     var node = document.createTextNode(msg);
    //     var div = document.createElement('div');
    //     div.appendChild(node);
    //     document.body.insertBefore(div, input);
    //     input.scrollIntoView();
    // }
    // input.onchange = function() {

    //     var msg = nick + ": " + input.value;
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', '/chat');
    //     xhr.setRequestHeader('Content-Type', 'text/plain;charset=UTF-8');
    //     xhr.send(msg);
    //     input.value = '';
    // }
    for (var i = 0; i< elts.length; i++)  {
        var input = elts[i];
        if (input.type !== 'file') {
            continue;
        }
        //获取上传文件ＵＲＬ
        var url = input.getAttribute('data-uploadto');
        if (!url) {
            continue;
        }
        input.addEventListener('change', function() {
            var file = this.files[0];
            if (!file) {
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;
            xhr.open('POST', url);
            xhr.setRequestHeader('cross-domain',true);
            xhr.send(file);
            xhr.onprogress = function(event) {
                if (event.lengthComputable) {
                    progress.innerHTML = Math.round(100*e.loaded/e.total) + '% Complete';
                } 
            }
            console.log(xhr.getResponseHeader('Content-Length'));
            console.log(xhr.getResponseHeader('Content-Type'));
            console.log(xhr.getResponseHeader('cross-domain'));
            console.log(xhr.readyState);
        }, false);     
    };
    btn.onclick = function() {
            var supportsCORS = (new XMLHttpRequest()).withCredentials !== undefined;
            var links = document.getElementsByTagName('a');
            for(var i = 0; i<links.length; i++) {
                var link = links[i];
                if (!link.href) {
                    continue;
                }
                if (link.title) {
                    continue;
                }
                if (link.host !== location.host || link.protocol !== location.protocol) {
                    link.title = '站外链接';
                    if (!supportsCORS) {
                        continue;
                    }
                }
                if (link.addEventListener) {
                                link.addEventListener('mouseover', mouseoverHandler,false);
                }else {
                    link.attachEvent('onmouseover', mouseoverHandler);
                }
                
                function mouseoverHandler(e) {
                    var link = e.target || e.srcElement;
                    var url = link.href;
                    var req = new XMLHttpRequest();
                    req.open('HEAD', url);
                    req.onreadystatechange = function() {
                        if (req.readyState !== 4) {
                            return;
                        }
                        if (req.status === 200) {
                            var type = req.getResponseHeader('Content-Type');
                            var size = req.getResponseHeader('Content-Length');
                            var date = req.getResponseHeader('Last-Modified');
                        
                            link.title = '类型:' + type + '\n' + '大小: ' + size + '\n' + '时间: ' + date;
                        } else {
                            if (!link.title) {
                                link.title = "Culdn't tetch detials:\n" + req.status + " " + req.statusText;
                            }
                        }
                    }
                    req.send(null);
                };
                if (link.removeEventListener) {
                    link.removeEventListener('mouseover', mouseoverHandler,false)
                } else {
                    link.detachEvent('onmouseover', mouseoverHandler);
                }
            }
    }

    btn1.onclick = function() {
        var callback = function(response) {
            alert(1111);
            alert(response);
        }
        var url = 'http://localhost:8040/test.js';
        getJSONP(url, callback);
    }


}
var getJSONP = function(url, callback) {
    var cbnum = 'cb' + getJSONP.counter++;
    var cbname = 'getJSONP.' + cbnum;
    if (url.indexOf('?') === -1) {
        url += '?jsonp=' + cbname;
    } else {
        url += "&jsonp=" + cbname;
    }
    var script = document.createElement('script');
    getJSONP[cbnum] = function(response) {
        try {
            callback(response);
        } finally {
            delete getJSONP[cbnum];
            script.parentNode.removeChild(script);
        }
    }
    script.src = url;
    document.body.appendChild(script);
    // getJSONP[cbnum]();
}
getJSONP.counter = 0;



