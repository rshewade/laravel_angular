'use strict';

app.controller('baseController', function($http, $scope, $location, SessionService, FlashService, CSRF_TOKEN){
	var cacheSession = function(data){
    	SessionService.set('authenticated', true);
    	SessionService.set('data', JSON.stringify(data));
    	$http.defaults.headers.common['X-CSRF-TOKEN'] = data['code'];
    	FlashService.clear();
  		};
	$scope.$watch(
		function(){
			return JSON.parse(SessionService.get('data'));},
		function(newval){$scope.user = newval;},true);
	$scope.test = function(){
		$http.post('/getsession', {csrf_token: CSRF_TOKEN}).success(function(data){
  		cacheSession(data);
  		$location.path('/home');
  		});

		// $scope.flas = CSRF_TOKEN;
	}
	
});
