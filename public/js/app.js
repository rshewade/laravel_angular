var app = angular.module("app", ['ngSanitize','ui.router'])

app.run(function($rootScope, $location, $state, $http, AuthenticationService, FlashService, SessionService, CSRF_TOKEN){
	var routesNotRequireAuth = ['/login'];
	var cacheSession = function(data){
    	SessionService.set('authenticated', true);
    	SessionService.set('data', JSON.stringify(data));
    	$http.defaults.headers.common['X-CSRF-TOKEN'] = data['code'];
    	FlashService.clear();
  		};
	$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams){
    if(!_(routesNotRequireAuth).contains(toState.url) && !AuthenticationService.isLoggedIn()){
      event.preventDefault();
      var promise = $http.post('/getsession', {csrf_token: CSRF_TOKEN});
        promise.success(function(data){
            cacheSession(data);
            $state.go(toState);
          });
          promise.error(function(){
            $state.go('login'); 
            FlashService.show('Please login first...'); 
          });
      
    }
  });
  
});

  



