app.factory("AuthenticationService", function($http, $sanitize, SessionService, FlashService, CSRF_TOKEN ) {
  var cacheSession = function(data){
    SessionService.set('authenticated', true);
    SessionService.set('data', JSON.stringify(data));
    $http.defaults.headers.common['X-CSRF-TOKEN'] = data['code'];
    // $http.post('/access', {'role': 'UL1'}).success(function(mdata){
    //   // SessionService.set('menu', JSON.stringify(data));
    //   angular.extend(data, {'routes': mdata});
    //   SessionService.set('data', JSON.stringify(data));
    // });
    FlashService.clear();
  };
  var uncacheSession = function(){
    SessionService.unset('authenticated');
    SessionService.unset('data');
  };

  var loginerr = function(response){
    FlashService.show(response.flash);
  }

  var sanitizeCredentials = function(credentials){
    return{
      email: $sanitize(credentials.email),
      password: $sanitize(credentials.password),
      csrf_token: CSRF_TOKEN
    }
  }
  return {
    login: function(credentials) {
      var promise = $http.post('/auth/login', sanitizeCredentials(credentials));
      promise.success(function(data){
        cacheSession(data);
      });
      promise.error(loginerr);
      return promise;
    },
    logout: function() {
      var promise = $http.get('/auth/logout');
      promise.success(uncacheSession);
      promise.error(loginerr);
      return promise;
    },
    isLoggedIn: function(){
      return SessionService.get('authenticated');
      // var promise = $http.post('/getsession', {csrf_token: CSRF_TOKEN});
      // promise.success(function(){ return true});
      // promise.error(function(){return false});
    }
  };
});