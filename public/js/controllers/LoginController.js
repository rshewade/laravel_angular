app.controller("LoginController", function($scope, $location, $state, AuthenticationService, SessionService) {
  $scope.credentials = { email: "", password: ""};
  SessionService.unset('authenticated');
  SessionService.unset('data');
  $scope.login = function() {
    AuthenticationService.login($scope.credentials).success(function(){
      $location.path('/home');
    });
  }
});