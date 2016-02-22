'use strict';

/* Services */

var phonecatServices = angular.module('phonecatServices', ['ngResource']);

phonecatServices.factory('Phone', ['$resource',
	  function($resource){
	  	//$resource(url, [paramDefaults], [actions], options);
	  	console.log($resource);
	    return $resource('phones/:phoneId.json', {}, {
	      query: {method:'GET', params:{phoneId:'phones'}, isArray:true}
	    });
	  }
  ]);
