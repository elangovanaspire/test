/**
 * And of course we define a controller for our route.
 */
angular
    .module('gamaMobileApp.pickup')

    .controller(
        'PickUpIndexController',
        function PickUpIndexController($scope, $state, $http, domain, GamaServices, $location, $rootScope) {
                
        $scope.gamaPickUpDet = [];
                 
         if (sessionStorage.getItem('pickUpList')) {          
            $rootScope.pickUpList = JSON.parse(sessionStorage.getItem('pickUpList'));
            sessionStorage.removeItem('pickUpList');
         } else {
            $http.get(domain+'/shop/api/rest/locality/pickuppoint/1').success(
                function(data, status, headers, config) {
                    $rootScope.pickUpList = data;
                    sessionStorage.setItem('pickUpList', JSON.stringify(data));                 
            });
         }
          $scope.getPickupListDisplay = function() {
            return $scope.displayPickupList;
          };

          $scope.setPickupListDisplay = function(pickupListDisplay) {
            $scope.displayPickupList = pickupListDisplay;
          };

          $scope.selectFavouriteLocation = function(event) {
            $rootScope.pickupPointSelected = [];
            $scope.pickupPoint = event.target.innerHTML;
            
            $rootScope.pickUpList.forEach(function(pickupPointDetails){
                if(pickupPointDetails.name == $scope.pickupPoint.trim()){
                    $rootScope.pickupPointSelectedId = pickupPointDetails.id;
                 }
            });
            
            $rootScope.pickupPointSelected = $scope.pickupPoint;
            sessionStorage.setItem('selectedPickUpPointId', $rootScope.pickupPointSelectedId);
            
            $scope.date = new Date();
            var currentTime     = $scope.date.getTime();
            
            sessionStorage.removeItem('gamaSession');
            
            $scope.gamaPickUpDet.push({
                sessionId: currentTime ,
                usertype: 'Guest',
                selectedPickUpPointId: sessionStorage.getItem('selectedPickUpPointId')
            });

            sessionStorage.setItem('gamaSession', JSON.stringify($scope.gamaSession));            
              $state.go('menu', {'gamaSession': sessionStorage.getItem('gamaSession')});
          };

          $scope.requestNewPickupPoint = function() {
            if($scope.newPickupPointRequest) {
                $http.post(domain+'/shop/api/rest/locality/pickuppointrequest/', {
                      "name" : $scope.newPickupPointRequest.name,
                      "mobile_no" : $scope.newPickupPointRequest.mobile_no,
                      "city_id" : 1
                    })
                    .success(
                        function(data, status, headers, config) {
                          $scope.message = 'We have noted request. We \'ll inform you once we add the pickup point!!';
                          $scope.error = false;
                          $scope.info = false;
                        })
                    .error(
                        function() {
                          $scope.message = 'Unable to register your request. Please enter your Mobile Number';
                          $scope.error = true;
                          $scope.info = false;
                        });
                }
          };

});
