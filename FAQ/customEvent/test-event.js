$(function() {
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
})