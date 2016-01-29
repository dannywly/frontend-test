$(function() {
    //======================== localStorage and sessionStorage ============================//
    function searchStorage() {
        var name = localStorage.username;
        if (!name) {
            name = prompt('What is your name?')
            localStorage.username = name;
        };
        for(var name in localStorage) {
            var value = localStorage[name];
            console.log(value);
        }
    }

    function storageOrigin(data) {
        localStorage.x = 10;
        var x = parseInt(localStorage.x);

        localStorage.lastRead = (new Date()).toUTCString();
        var lastRead = new Date(Date.parse(localStorage.lastRead))

        localStorage.data = JSON.stringify(data);
        var data = JSON.parse(localStorage.data);

        console.log(localStorage);
    }

    $('#show').click(function() {
        searchStorage();
        // localStorage.setItem('x', 1);
        // localStorage.getItem('x');
    });
    $('#attr').click(function() {
        var data = {
            name: 'simon',
            sex: 'male',
            age: '33'
        };
        storageOrigin(data);
    });

    $('#clear').click(function() {
        localStorage.clear();
        console.log(localStorage);
    });

    $('#removeItem').click(function() {
        for(var name in localStorage) {
            localStorage.removeItem(name);
        }
        console.log(localStorage);
    });

    function recognize() {
        var storage = window.localStorage || 
                    (window.UserDataStorage && new UserDataStorage()) ||
                    new cookieStorage();
        return storage;
    }
    window.recognize = recognize;
    //========================================================================//
    

    //========================cookie======================================//
    
    function setcookie(name, value, daysToLive, path, domain, secure) {
        var cookie = name + '=' + encodeURIComponent(value);
        if (typeof daysToLive === 'number') {
            cookie += '; max-age =' + (daysToLive*60*60*24);
        }

        if (path != undefined && path != '' && path !=null) {
            cookie += '; path =' + path;
        }

        if (domain != undefined && domain != '' && domain !=null) {
            cookie += '; domain =' + domain;
        }

        document.cookie = cookie;
    }

    $('#setcookie').click(function() {
        setcookie('danny', '123abc', 1);
        setcookie('hello', '123abc', 1);
        console.log(document.cookie);
    }); 

    function getcookie() {
        var cookie = {};
        var all = document.cookie;
        if (all === '') {
            return cookie;
        }
        var list = all.split('; ');
        for (var i = 0; i < list.length; i++) {
            var item = list[i];
            var index = item.indexOf('=');
            var name = item.substring(0, index);
            var value = item.substring(index+1);
            value = decodeURIComponent(value);
            cookie[name] = value;
        };
        return cookie;
    }
    $('#getcookie').click(function() {
        console.log(getcookie());
    });

    function cookieStorage(maxage, path) {
        var cookie = (function() {
            var cookie = {};
            var all = document.cookie;
            if (all === '') {
                return cookie;
            }
            var list = all.split('; ');
            for (var i = 0; i < list.length; i++) {
                var item = list[i];
                var index = item.indexOf('=');
                var name = item.substring(0, index);
                var value = item.substring(index+1);
                value = decodeURIComponent(value);
                cookie[name] = value;
            };
            return cookie;
        }());
        var keys = [];
        for (var key in cookie) {
            keys.push(key);
        };
        this.length = keys.length;
        this.key = function(n) {
            if (n < 0 || n > keys.length) {
                return null;
            }
            return keys[n];
        };

        this.getItem = function(name) {
            return cookie[name] || null;
        };

        this.setItem = function(key, value) {
            if (! (key in cookie)) {
                keys.push(key);
                this.length++;
            }
            cookie[key] = value;
            var cookie = key + '=' + encodeURIComponent(value);
            if(maxage) {
                cookie += '; max-age=' + maxage;
            }
            if (path) {
                cookie += '; path' + path;
            };
            document.cookie = cookie;
        };

        this.removeItem = function(key) {
            if (!(key in cookie)) {
                return;
            }
            delete cookie[key];
            for (var i = 0; i < keys.length; i++) {
                if (keys[i] === key) {
                    keys.splice(i, 1);
                    break;
                };
            };
            this.length--;
            document.cookie = key + '=; max-age=0'
        }

        this.clear = function() {
            for (var i = 0; i < keys.length; i++) {
                document.cookie = keys[i] + '=; max-age=0';
            };
            cookie = {};
            keys = [];
            this.length = 0;
        }
    }
    $('#clearcookie').click(function() {
        var clear = new cookieStorage();
        clear.clear();
    });
    //========================================================================//
})