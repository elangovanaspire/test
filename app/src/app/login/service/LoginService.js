angular.module('gamaMobileApp.login')
  .factory('BasicAuth', ['$http','domain',
    function ($http, domain) {
      //factory to authenticate the user by using base64 encode and store in cookie
      return {
        //to logout from the application
        clearCredentials: function () {
          var logoutUser = $http.get(domain+'/shop/api/rest/customer/logout');
          logoutUser.success(function (data, status, headers, config) { 
            if (status === 200) {
              $http.defaults.headers.common.Authorization = '';  
            }

          });
          return logoutUser;  

        },
        userAuthenticate: function (username, password) {
          var promiseUSer = $http.post(domain+"/shop/api/rest/customer/login", {
            "user_name":username, "password":password
          });
          promiseUSer.success(function (data, status, headers, config) { 
            if (status === 200) {
            var  resHeader              = headers('Location').split('/');
            var  userName               = resHeader.pop();
            var  sessionID              = resHeader.pop();
            $http.defaults.headers.common.Authorization = sessionID;             
            }
          });
          return promiseUSer;
        },
        getUserDetails: function(authenticationURL) {
          
        }
      };
    }
  ])
  .factory('Auth', ['BasicAuth',
    function (BasicAuth) {
      //factory to authenticate the user
      return {
        userAuthenticate: function (username, password) {
          return BasicAuth.userAuthenticate(username, password);
        },
        clearCredentials: function () {
          return BasicAuth.clearCredentials();
        }
      };
    }
  ]);