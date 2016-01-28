$(function() {
	function drawPicture() {
		//获取画布元素
		var canvas = document.getElementById('square');
		//获取2D绘制上下文
		var context = canvas.getContext('2d');
		context.fillStyle = '#f00';
		context.fillRect(0, 0, 10, 10); 			//填充一个正方形

		canvas = document.getElementById('circle');	
		context = canvas.getContext('2d');
		context.beginPath();						//开始一条新的路径
		context.arc(5, 5, 5, 0, 2*Math.PI, true);	//将圆形添加到该路径中
		context.fillStyle = '#00f';
		context.fill();								//填充路径
	}
	drawPicture();
	/**
	 * 定义一个以(x, y)为中心,半径为r的规则n边形
	 * 每个定点都是均匀分布在圆周上
	 * 将第一个定点放置在最上面,或者指定一定角度
	 * 除非最后一个参数时true,否则顺时针旋转
	 */
	function polygon(c, n, x, y, r, angle, counterclockwise) {
		angle = angle || 0;
		counterclockwise = counterclockwise || false;
		c.moveTo(x + r*Math.sin(angle),
				y - r*Math.cos(angle));
		var delta = 2*Math.PI/n;						//两个定点之间的夹角
		for (var i = 0; i < n; i++) {
			angle += counterclockwise?-delta:delta;
			c.lineTo(x + r*Math.sin(angle),
					y - r*Math.cos(angle));
		};
		c.closePath();	//将最后一个顶点和起点连接起来
	}

	$('#btn').click(function() {
		var canvas = document.getElementById('can');
		var c = canvas.getContext('2d');
		c.beginPath();
		polygon(c, 3, 50, 70, 50);
		polygon(c, 4, 150, 60, 50, Math.PI/4);
		polygon(c, 5, 255, 55, 50);
		polygon(c, 6, 365, 53, 50, Math.PI/6);
		polygon(c, 4, 365, 53, 20, Math.PI/4, true);
		c.fillStyle = '#ccc';
		c.strokeStyle = '#008';
		c.lineWidth = 5;
		c.fill();
		c.stroke();
	});

	$('#reset').click(function() {
		var canvas = document.getElementById('can');
		canvas.setAttribute('width', '500');
		canvas.setAttribute('height', '100');
	});


	CanvasRenderingContext2D.prototype.revert = function() {
		this.restore();	//恢复最后一次保存的图形状态
		this.save();	//再次保存它以便后续使用
		return this;	//允许方法链
	}

	/**
	 * 通过o对象的属性来设置图形属性
	 * 或者,如果没有提供参数,就以对象的方式的方式返回当前属性
	 * 要注意的是,它不处理变化和剪裁区域
	 */
	CanvasRenderingContext2D.prototype.attrs = function(o) {
		if (o) {
			for (var a in o) {
				this[a] = o[a];
			}
			return this;	//允许方法链
		} else {
			return {
				fillStyle: this.fillStyle, font:this.font,
				globalAlpha: this.globalAlpha,
				globalCompositeOperation: this.globalCompositeOperation,
				lineCap: this.lineCap, lineJoin: this.lineJoin,
				lineWidth: this.lineWidth, miterLimit: this.miterLimit,
				textAlign: this.textAlign, textBaseline: this.textBaseline,
				shadowBlur: this.shadowBlur, shadowColor: this.shadowColor,
				shadowOffsetX: this.shadowOffsetX, shadowOffsetY: this.shadowOffsetY,
				strokeStyle: this.strokeStyle
			};
		}
	}

	var deg = Math.PI/180;
	function snow(c, n, x, y, len) {
		c.save();
		c.translate(x, y);
		c.moveTo(0, 0);
		leg(n);
		c.rotate(-120*deg);
		leg(n);
		c.rotate(-120*deg);
		leg(n);
		c.closePath();
		c.restore();
		function leg(n) {
			c.save();
			if (n == 0) {
				c.lineTo(len, 0);
			} else {
				c.scale(1/3, 1/3);
				leg(n-1);
				c.rotate(60*deg);
				leg(n-1);
				c.rotate(-120*deg);
				leg(n-1);
				c.rotate(60*deg);
				leg(n-1);
			}
			c.restore();
			c.translate(len, 0);
		}
	}

	$('#btn1').click(function() {
		var c = document.getElementById('snow').getContext('2d');
		snow(c, 0, 5, 115, 125);
		snow(c, 1, 145, 115, 125);
		snow(c, 2, 285, 115, 125);
		snow(c, 3, 425, 115, 125);
		snow(c, 4, 565, 115, 125);
		snow(c, 4, 705, 115, 125); 
		c.stroke();
	});

	function rads(x) {
		return Math.PI*x/180;
	}

	function addCurve(c) {
		c.beginPath();
		c.arc(75, 100, 50, 0, rads(360), false);
		c.moveTo(200, 100);
		c.arc(200, 100, 50, rads(-60), rads(0), false);
		c.closePath();

		c.moveTo(325, 100);
		c.arc(325, 100, 50, rads(-60), rads(0), true);
		c.closePath();

		c.moveTo(450, 50);
		c.arcTo(500, 50, 500, 150, 30);
		c.arcTo(500, 150, 400, 150, 20);
		c.arcTo(400, 150, 400, 50, 10);
		c.arcTo(400, 50, 500, 50, 0);
		c.closePath();

		c.moveTo(75, 250);
		c.quadraticCurveTo(100, 200, 175, 250);
		c.fillRect(100-3, 200-3, 6, 6);

		c.moveTo(200, 250);
		c.bezierCurveTo(220, 220, 280, 280, 300, 250);
		c.fillRect(220-3, 220-3, 6, 6);
		c.fillRect(280-3, 280-3, 6, 6);

		c.fillStyle = '#aaa';
		c.lineWidth = 5;
		c.fill();
		c.stroke();
	}

	$('#btn2').click(function() {
		var c = document.getElementById('curve').getContext('2d');
		addCurve(c);
	});

});