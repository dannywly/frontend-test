var arr = [{name:'danny',sex:'male'},1,3]
//alert(location.search);
console.log(document.getElementsByTagName('script'));
console.log(getJSONP.cb0);
console.log(this);
for (var i = 0; i < getJSONP.length; i++) {
	var cbnum = 'cb' + i;
	console.log(cbnum);
	if (getJSONP.hasOwnProperty(cbnum)) {
		getJSONP[cbnum](arr);
	}
}