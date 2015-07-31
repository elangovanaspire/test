/**
 * And of course we define a controller for our route.
 */
angular
    .module('gamaMobileApp.order')

    .controller(
        'OrderController',
        function OrderController($scope, $state, $http, domain, $stateParams, $location, $rootScope) {
                
        $scope.orderDetails = [];
                 
         if (sessionStorage.getItem('orderConfirmation')) {          
            $scope.orderDetails = JSON.parse(sessionStorage.getItem('orderConfirmation'));
            sessionStorage.removeItem('orderConfirmation');
         } else {            
           // $http.get(domain+'/shop/api/rest/order/'+ $stateParams.orderId).success(
            $http.get(domain+'/shop/api/rest/orders/1').success(
                function(data, status, headers, config) {
                    $scope.orderDetails = data;
                    sessionStorage.setItem('orderConfirmation', JSON.stringify(data));                 
            });
         }  
});
