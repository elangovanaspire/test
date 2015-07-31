/**
 * And of course we define a controller for our route.
 */
angular.module('gamaMobileApp.customer')

.controller(
    'RegisterController',
    function RegisterController($scope, $http, Auth, domain) {
      $scope.showRegisterForm = true;
      $scope.linktologin = false;
      $scope.messages = [];
      $scope.emailRegx = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
      $scope.mobileRegx = /^[1-9][0-9]+$/;
      $scope.register = function() {

        if($scope.user === undefined) {
        $scope.messages = ['* All fields are mandatotary'];
          $scope.errors = true;
        } else if(!$scope.emailRegx.test($scope.user['email'])) {
          $scope.errors = true;
          $scope.messages = ['Please enter a valid email address'];
        } else if(!$scope.mobileRegx.test($scope.user['mobile']) || $scope.user['mobile'].length != 10) {
            $scope.errors = true;
            $scope.messages = ['Please enter a valid Mobile Number'];
        } else if($scope.user['password'].length <8) {
            $scope.messages = ['Password should have atleast 8 characters'];
            $scope.errors = true;
        } else if($scope.user['password'] != $scope.user['confirmation']) {
            $scope.messages = ['Passwords should match each other'];
            $scope.errors = true;
        }  else {
    
          $http.post(domain+'/shop/api/rest/customer', $scope.user)
            .success(function(data, status, headers, config) {
              $scope.showRegisterForm = false;
              $scope.errors = false;
              $scope.info = false;
              $scope.messages = [];
              $scope.linktologin = true;
            }).error(function(data, status, headers, config) {
              $scope.errors = true;
              $scope.info = false;
              var messages = [];
              angular.forEach(data.messages.error, function(error, key) {
                if (error.code != 500) {
                  this.push(error.message);
                }
              }, messages);
              $scope.messages = messages;
            });
        } 
      };
    });
