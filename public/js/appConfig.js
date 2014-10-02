app.config(function($stateProvider, $urlRouterProvider){
  $urlRouterProvider.otherwise("/login");
  $stateProvider
    .state('login', {
      url:"/login",
      templateUrl: 'templates/login.html',
      controller: 'LoginController'
    })
    .state('home',{
      url:'/home',
      templateUrl: 'templates/home.html',
      controller: 'HomeController'
    })
    .state('users',{
      url:'/users',
      templateUrl: 'templates/users.html',
      controller: 'UsersController'
    })
    .state('users.add',{
      url:'/users/add',
      templateUrl: 'templates/add_edit_users.html',
      controller: 'UsersController'
    })
  ;
});

app.config(function($httpProvider){
  var logsOutUseron401 = function($location, $q, SessionService, FlashService){
    var success = function(response){
      return response;
    };
    var error = function(response){
      if (response.status === 401 ){
        SessionService.unset('authenticated');
        $location.path('/login');
        FlashService.show(response.data.flash);  
      } 
        return $q.reject(response);
    };

    return function(promise){
      return promise.then(success, error);
    };
  };
  $httpProvider.responseInterceptors.push(logsOutUseron401);
});

app.config(function($httpProvider, CSRF_TOKEN) {
  var user = JSON.parse(sessionStorage.getItem('data'));
  if (user != null){
    $httpProvider.defaults.headers.common['X-CSRF-TOKEN']  = user.code;  
  } else {
    $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = "";  
  }
  // $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = CSRF_TOKEN;  
});