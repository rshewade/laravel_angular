app.controller('UsersController', function($scope, $http){
			$scope.statuses = [{value: 1, text: 'Active'},{value: 0, text: 'Inactive'}]; 

			$http.post('/getusers').success(function(data){
				$scope.users = data;
			});	
		// }
		$scope.showStatus = function(user){
			var selected = [];
			if (user.Status){
				selected =  $filter('filter')($scope.statuses, {value: user.Status});
			}
			return selected.length ? selected[0].text : 'Not set';
		};
		$scope.sts_cng = function (user, cng) {
			user.Status = cng;
			$http.post('app/php/users.php/update', user).success(function(data){
				if (data['flag'] == "Error"){
					$scope.msg = data['msg'];
				} else {
					$scope.users = data;
				}
			});	
		};
		$scope.saveUser = function(index){
			$http.post('app/php/users.php/update',$scope.users[index]).success(function(data){
				$scope.users = data;
			});
		};
		$scope.addUser = function(){
			$scope.user.Auto_id = 0;
			$scope.user.Status = 1;
			$http.post('app/php/users.php/update',$scope.user).success(function(data){
				if (data['flag'] == "Error"){
					$scope.msg = data['msg'];
				} else {
					// $scope.users = data;
					$location.path('/users');
				}
			});	
		};
		$scope.addcancel = function(){
			$location.path('/users');
		};
		$scope.search = function(){
			$scope.searchStr = $scope.searchText;
		};
});