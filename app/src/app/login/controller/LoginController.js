/**
 * And of course we define a controller for our route.
 */
angular.module('gamaMobileApp.login')

.controller('LoginIndexController',
    function LoginIndexController($scope, $http, Auth, $location, $rootScope, domain) {
      $scope.showLoginForm = true;
      $scope.messages = [];

     
      $scope.emailRegx = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
      $scope.mobileRegx = /^[1-9][0-9]+$/;

      $scope.login = function() { 
        var isNum = /^\d+$/.test($scope.username);
        if(!$scope.username || !$scope.password) {
          $scope.messages = ['All fields are mandatory'];
          $scope.errors = true;
        } else if(isNum) {
          $scope.mobileValidate();
        } else {
          $scope.emailValidate();
        } 
      
        
        if($scope.messages.length === 0) {
          Auth.userAuthenticate($scope.username, $scope.password).success(function(data, status, headers, config){
            var  resHeader              = headers('Location').split('/');
            $scope.loginUser            = resHeader.pop();
            $rootScope.loginUser        = $scope.loginUser;
            $rootScope.loginStatus      = true;
            $rootScope.showLogin        = false;  
            $scope.errors               = false;  
            $rootScope.showLogout       = true;          
            $location.path('pickup');
            $scope.message              = ['Login Successful'];

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

      $scope.mobileValidate = function() {
        if(!$scope.mobileRegx.test($scope.username) || $scope.username.length != 10) {
          $scope.errors = true;
          $scope.messages = ['Please enter a valid Mobile Number'];
        } else {
            $scope.messages = [];
        }
      };

      $scope.emailValidate = function() {
        if(!$scope.emailRegx.test($scope.username)) {
          $scope.errors = true;
          $scope.messages = ['Please enter a valid email address'];
        } else {
            $scope.messages = [];
        }
      };

      $rootScope.logout = function() {
        Auth.clearCredentials().success(function(data, status, headers, config){
          //alert('Thank you'+$rootScope.loginUser.'for using Gama Gamma');
            $rootScope.loginUser        = 'Guest';
            $rootScope.loginStatus      = false;
            $rootScope.showLogin        = true;  
            $rootScope.showLogout       = false;   
            $location.path('pickup');       
          });
        
      };

      $scope.register = function() {
        $location.path('register');
      };

    });

