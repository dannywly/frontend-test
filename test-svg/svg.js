$(function() {
	function pieChart(data, width, height, cx, cy, r, colors, labels, lx, ly) {
		//这是表示svg元素的XML命名空间
		var svgns = 'http://www.w3.org/2000/svg';
		//创建一个<svg>元素,同时指定像素大小和用户坐标
		var chart = document.createElementNS(svgns, 'svg:svg');
		chart.setAttribute('width', width);
		chart.setAttribute('height', height);
		chart.setAttribute('viewBox', '0 0 ' + width + ' ' + height);
		
		//累加data的值,以便于知道饼状图的大小
		var total = 0;
		for (var i = 0; i < data.length; i++) {
			total += data[i];
		};
		//现在计算出饼状图每个分片的大小,其中角度以及弧度制计算
		var angles = [];
		for (var i = 0; i < data.length; i++) {
			angles[i] = data[i]/total*Math.PI*2;
		};
		//遍历饼状图的每个分片
		startangle = 0;
		for (var i = 0; i < data.length; i++) {
			//这里表示锲的结束位置
			var endangle = startangle + angles[i];

			//计算出锲和圆相交的两个点
			//这些计算公式都是以12点中方向为0°
			//顺时针方向角度递增
			var x1 = cx + r*Math.sin(startangle);
			var y1 = cy - r*Math.cos(startangle);
			var x2 = cx + r*Math.sin(endangle);
			var y2 = cy - r*Math.cos(endangle);

			//这个标记表示角度大于半圆
			//此标记在绘制svg弧形组件的时候需要
			var big = 0;
			if (endangle - startangle > Math.PI) {
				big = 1;
			}

			//使用<svg:path>元素来描述锲
			//要注意的时,使用createElementNS()来创建该元素
			var path = document.createElementNS(svgns, 'path');
			
			//下面的字符串包含路径的详细信息
			var d = 'M ' + cx + ',' + cy + //从圆心开始
				' L ' + x1 + ',' + y1 +	   //画一条到(x1, y1)的线段
				' A ' + r + ',' + r +	   //在画一条半径为r的弧
				' 0 ' + big + ' 1 ' +	   //弧的详细信息
				x2 + ','  + y2 +		   //弧到(x2, y2)结束
				' Z';					   //当前路径到(cx, cy)结束

			path.setAttribute('d', d);				//设置路径
			path.setAttribute('fill', colors[i]);	//设置锲的颜色
			path.setAttribute('stroke', 'black');	//锲的外边框为黑色
			path.setAttribute('stroke-width', '2'); //两个单位宽
			chart.appendChild(path);				//将锲加入到饼状图中

			//当前锲的结束就是下一个锲的开始
			startangle = endangle;

			//绘制一些相应的小方块来表示图例
			var icon = document.createElementNS(svgns, 'rect');
			icon.setAttribute('x', lx);				//定位小方块
			icon.setAttribute('y', ly + 30*i);
			icon.setAttribute('width', 20);			//设置小方块的大小
			icon.setAttribute('height', 20);
			icon.setAttribute('fill', colors[i]);	//填充小方块的颜色和对应的锲的颜色相同
			icon.setAttribute('stroke', 'black');	//子边框颜色也相同
			icon.setAttribute('stroke-width', '2');
			chart.appendChild(icon);

			//在小方块的右边添加标签
			var label = document.createElementNS(svgns, 'text');
			label.setAttribute('x', lx + 30);
			label.setAttribute('y', ly + 30*i + 18);
			label.setAttribute('font-family', 'sans-serif');
			label.setAttribute('font-size', '16');
			label.appendChild(document.createTextNode(labels[i]));
			chart.appendChild(label);

		};
		return chart;
	}
	//调用饼状图方法
	$('body').append(pieChart([12, 23, 34, 45],640,400,200,200,
		150,['red', 'blue', 'yellow', 'green'],
		['North', 'South', 'East', 'West'],400,100));


	function clock() {
		var now = new Date();
		// var min = now.getMinutes();
		var min = now.getSeconds();
		var hour = (now.getHours()%12) + min/60;
		var minangle = min*6;
		var hourangle = hour*30;

		var minhand = document.getElementById('minuthand');
		var hourhand = document.getElementById('hourhand');

		minhand.setAttribute('transform', 'rotate(' + minangle + ',50,50)');
		hourhand.setAttribute('transform', 'rotate(' + hourangle + ',50,50)');
		setTimeout(clock, 1000);
		// setInterval(function(){
		// 	alert(111);
		// }, 2000);
	}

	clock();

	$('#btn').click(function() {
		console.log("it's not block");
	});

});