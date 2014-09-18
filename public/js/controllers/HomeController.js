app.controller("HomeController", function($scope, $location, AuthenticationService, $http) {
  $scope.title = "Awesome Home";
  $scope.message = "Mouse Over these images to see a directive at work!";
  $scope.test = function(){
  	$http.get('/accesscode').success(function(data){
  		$scope.TestArea = data;
  	});
  };
  $scope.logout = function() {
    AuthenticationService.logout().success(function(){
      $location.path('/login');
    });
  };
});