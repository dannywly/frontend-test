angular.module('app', [])
	.controller('SettingsController1', settings)
	.controller('ctr2', ['$scope', Ctr2])
	.controller('ctr3', ['$scope', Ctr3])
	.filter('greet', function() {
		return function(name) {
			return 'hello, ' + name + ' !';
		}
	})
;

/**
 * use ng-controller="SettingsController1 as settings" key word 'as' to instead $scope
 * Using controller as makes it obvious which controller you are accessing in the template when multiple controllers apply to an element.
 * If you are writing your controllers as classes you have easier access to the properties and methods, which will appear on the scope, from inside the controller code.
 * Since there is always a . in the bindings, you don't have to worry about prototypal inheritance masking primitives.
 */
function settings() {
	this.name = 'danny';
	this.contacts = [
		{type: 'phone', value: '1233434'},
		{type: 'email', value: '12435645@qq.com'}
	];
}
settings.prototype.greet = function() {
	alert(this.name);
};

settings.prototype.addContact = function() {
	this.contacts.push({type: 'email', value: 'yourname@example.org'});
};

settings.prototype.removeContact = function(contactToRemove) {
	var index = this.contacts.indexOf(contactToRemove);
	this.contacts.splice(index, 1);
};

settings.prototype.clearContact = function(contact) {
	contact.type = 'phone';
	contact.value = '';
};

/**
 * use $scope to bind data on dom
 */
function Ctr2($scope) {
	$scope.a = 3;
	$scope.b = 5;
	$scope.c = $scope.a + $scope.b;
}

function Ctr3($scope) {
	
}