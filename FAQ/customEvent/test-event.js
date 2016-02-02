$(function() {
    //============================================================================================================================
    function pubSub() {
        /*
        PubSub 模式的实现如此简单,以至于用十几行代码就能建立自己的
        PubSub 实现。对于支持的每种事件类型,唯一需要存储的状态值就
        是一个事件处理器清单。
         */
        PubSub = {handlers: {}};
        /*
        需要添加事件监听器时,只要将监听器推入数组末尾即可(这意味着
        总是会按照添加监听器的次序来调用监听器)。
         */
        PubSub.on = function(eventType, handler) {
            if (!(eventType in this.handlers)) {
                this.handlers[eventType] = [];
            }
            this.handlers[eventType].push(handler);
            return this;
        };

        /*
        接着,等到触发事件的时候,再循环遍历所有的事件处理器。
        就是这么简单!现在只实现了 Node 之 EventEmitter 对象的核心部分。
        (还没实现的重要部分只剩下移除事件处理器及附加一次性事件处理
        器等功能。)
         */
        PubSub.emit = function(eventType) {
            var handlerArgs = Array.prototype.slice.call(arguments, 1);
            for (var i = 0; i < this.handlers[eventType].length; i++) {
                this.handlers[eventType][i].apply(this, handlerArgs);
            }
            return this;
        }
    }
    pubSub();

    // document.getElementById("msgbox").addEventListener("submit", function(e) {
    //     e.preventDefault();
    //     console.log(e.target);
    //     var msg = document.getElementById("msg").value.trim();
    //         if (msg) {
    //             alert(msg);
    //         }
    //     }, false);
    //============================================================================================================================

    
    //============================================================================================================================
    /**
     * use javascript to define custom event.
     */
    var msgbox = document.getElementById("msgbox");
    msgbox.addEventListener("submit", SendMessage, false);
    // new message: raise newMessage event
    function SendMessage(e) {
        e.preventDefault();
        var msg = document.getElementById("msg").value.trim();
        if (msg && window.CustomEvent) {
            /*
            detail: 包含了自定义事件的具体信息，这里仅仅就包括了一个message与一个time
            bubbles: 如果是true，则事件会一直传递给自身的父对象元素，接着父对象也会触发此类事件
            cancelable: 如果是true, 事件可以被事件触发元素的 stopPropagation( ) 方法停止
            */
            var event = new CustomEvent("newMessage", {
                detail: {
                    message: msg,
                    time: new Date(),
                },
                bubbles: true,
                cancelable: true
            });
            e.currentTarget.dispatchEvent(event);
        }
    }
    // listen for newMessage event
    document.addEventListener("newMessage", newMessageHandler, false);
    // newMessage event handler
    function newMessageHandler(e) {
        console.log(
            "Event subscriber on "+e.currentTarget.nodeName+", "
            +e.detail.time.toLocaleString()+": "+e.detail.message
        );
    }
    //============================================================================================================================
    // // 创建自定义事件
    // var e = document.createEvent("HTMLEvents");
    // // 初始化wangmeijian事件
    // e.initEvent("wangmeijian", false, true);
    // // 监听document的wangmeijian事件
    // document.addEventListener("wangmeijian", function(){
    //     alert("触发成功！");
    // })
    // // 触发自定义事件
    // document.dispatchEvent(e); 
    //============================================================================================================================

    //============================================================================================================================
    Array.prototype.insert = function (index, value) {
        /// <summary>插入项</summary>
        ///<param name="index" type="Number">索引
        ///<param name="value" type="Object">元素
        /// <returns type="Array">
     
        if (index > this.length) index = this.length;
        if (index < -this.length) index = 0;
        if (index < 0) index = this.length + index;
        for (var i = this.length; i > index; i--) {
            this[i] = this[i - 1];
        }
        this[index] = value;
        return this;
    };
     
    Array.prototype.remove = function (index) {
        /// <summary>移除项</summary>
        ///<param name="index" type="Number">索引
        /// <returns type="Array">
     
        if (isNaN(index) || index > this.length) return;
        this.splice(index, 1);
    }; 

    function CursomObject(table) {
        /// <summary>这是一个自定义对象类型</summary>
        ///<param name="table" optional="true" type="Object">要添加的函数及属性表
     
        // 这里要存放我们的自定义事件
        // 因为是一个表，所以我们使用Object类型
        this._events = {};
     
        // 得到函数及属性表中的内容
        for (var i in table) this[i] = table[i];
    }
     
    CursomObject.prototype.addEventListener = function (type, listener, capture) {
        /// <summary>添加事件侦听器</summary>
        ///<param name="type" type="String">事件类型
        ///<param name="listener" type="Function">触发的函数
        ///<param name="capture" optional="true" type="Boolean">是否在捕获阶段触发(这里只是做了顺序排列)
     
        // 判断一下传入的参数是否符合规格
        if (typeof type !== 'string' || typeof listener !== 'function') {return;};
     
        // 缓存符合条件的事件列表
        var list = this._events[type] = [];
     
        // 判断是否已经有该类型事件，若没有则添加一个新数组
        if (typeof list === undefined) list = (this._events[type] = []);
     
        /* 判断插入函数的位置 */
        if (capture) list.push(listener);
        else list.push(listener);
     
        return this;
    };
     
    CursomObject.prototype.removeEventListener = function (type, listener, capture) {
        /// <summary>移除事件侦听器</summary>
        ///<param name="type" type="String">事件名称
        ///<param name="listener" type="Function">触发的函数
        ///<param name="capture" type="Boolean">是否在捕获阶段触发
     
        // 判断一下传入的参数是否符合规格
        if (typeof type !== 'string' || typeof listener !== 'function') {
            return this;
        }
     
        // 缓存符合条件的事件列表
        var list = this._events[type];
     
        // 若没有绑定过此类事件则不需要做处理
        if (typeof list === undefined) return this;
     
        for (var i = 0, len = list.length; i < len; i++) {
            // 通过循环判断来确定事件列表中存在要移除的事件侦听函数
            if (list[i] == listener) {
                // 找到后将此侦听函数从事件列表中移除
                list.remove(i);
                break;
            }
        }
        return this;
    };
     
    CursomObject.prototype.fireEvent = function (type, e) {
        /// <summary>触发事件</summary>
        ///<param name="type" type="String">事件名称
        ///<param name="e" type="Object">附加参数对象
     
        // 若存在DOM0用法的函数，则触发
        this['on' + type.toLowerCase()] && this['on' + type.toLowerCase()].call(this, e);
     
        // 缓存符合条件的事件列表
        var list = this._events[type];
     
        // 若事件列表中没有内容则不需要做处理
        if (!list || list.length <= 0) {
            return this;
        };
     
        // 阻止事件冒泡开关
        var isStop = false;
     
        // 模拟事件对象
        window.event = { stopPropagation: function () { isStop = true; } };
        e.stopPropagation = window.event.stopPropagation;
     
        for (var i = 0, len = list.length; i < len; i++) {
            // 通过循环触发符条件的事件列表中存在的所有事件侦听函数
            // 若函数内返回false或事件内调用了event.stopPropagation函数则阻止接下来的所有调用
            if (list[i].call(this, e) === false || isStop) break;
        }
        return this;
    };   

    function Test() {
        /// <summary>这是一个自定义类型</summary>
     
        // 继承CursomObject中的属性
        CursomObject.apply(this);
    }
    // 继承CursomObject中的函数
    Test.prototype = new CursomObject();
     
    // 定义一个从Test类型中派生出来的对象
    var a = new Test();
     
    // 绑定一个message事件的侦听器
    a.addEventListener('message', function (e) {
        alert(e);
    }, false);
     
    // 再绑定一个message事件的侦听器
    a.addEventListener('message', function (e) {
        alert('内容:' + e);
    }, false);
     
    // 触发message事件
    a.fireEvent('message', '这是参数……');
    //============================================================================================================================
})