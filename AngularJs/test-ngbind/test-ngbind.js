angular.module('app', ['ngSanitize'])
	.controller('ExampleController', ['$scope', function($scope) {
      $scope.name = 'Whirled';
    }])
	.controller('ctr1', function($scope) {
		$scope.salutation = 'Hello';
      	$scope.name = 'World';
	})
	.controller('ctr2', ['$scope', function($scope) {
	  $scope.myHTML =
	     'I am an <code>HTML</code>string with ' +
	     '<a href="#">links!</a> and other <em>stuff</em>';
	}])
    ;