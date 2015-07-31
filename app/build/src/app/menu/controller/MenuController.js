/**
 * Menu Controller @ Elango
 */
app = angular.module('gamaMobileApp.menu')
.filter('split', function() {
        return function(input, splitChar, splitIndex) {
            return input.split(splitChar)[splitIndex];
        };
 })
.controller(
    'MenuController',    
    function MenuController($scope, domain, GamaServices, $http , $state , $stateParams, $location, $rootScope, $modal) {
   
        $scope.dayWiseMenus = [];
        $scope.date = new Date();
        if(sessionStorage.getItem('pickUpPointCategories') && sessionStorage.getItem('selectedPickUpPointId') === sessionStorage.getItem('existingPickupPointId')) {
             $scope.dayWiseMenus = JSON.parse(sessionStorage.getItem('pickUpPointCategories'));
        } else {
            GamaServices.categories(sessionStorage.getItem('selectedPickUpPointId')).success(
               function(data, status, headers, config) {
                    $scope.dayWiseMenus = data;
                    sessionStorage.setItem('existingPickupPointId', sessionStorage.getItem('selectedPickUpPointId'));
                    sessionStorage.setItem('pickUpPointCategories', JSON.stringify(data));
            });
        }

        $scope.isTimesUp = function(isToday, endTime) {
            
            $scope.date = new Date();
            
            var year            = $scope.date.getFullYear();
            var month           = $scope.date.getMonth();
            var day             = $scope.date.getDate();
            var endTimeSplit    = endTime.split(':');           
            var min             = endTimeSplit.pop();
            var hour            = endTimeSplit.pop();            
          
            var reserv          = new Date(year, month, day, hour, min);
            var catTime         = reserv.getTime();
            
            var currentTime     = $scope.date.getTime();
           
            if (isToday === 'Today' && currentTime > catTime) {
                return  "obsolete"; 
            } 
            return "";
        };
        
        $scope.byDefault            = '';
        $scope.qty                  = [];
        $scope.applyRemainingCombo  = [];
        $scope.remainingComboItem   = [];
        $scope.comboCount           = [];
        $scope.selectedItems        = [];
        $scope.cartQty              = [];
        $scope.orderQty             = [];
        $scope.maxProductQty        = 5;
        $scope.maxAddOnProductQty   = 5;
        $scope.showLoader           = false;
        $scope.cartItems            = [];
        $scope.deliveryAddressData  = [];
        $scope.cartItemsCount       = 0;
        $scope.subCategory          = $stateParams.id;
        $scope.isCartItemExist      = false;
        $scope.alcartaEditFlag      = false;
        $scope.showPickuppoint      = false;
        $scope.showBYOVOffer        = false;
        $scope.addExtraCharge       = false;
        $scope.byovPrice            = 0;
        $scope.byovStatus           = true;    
        /**
         * Get sub category using below rest api
         * @param {string} selectedDay
         * @param {int} parentCategoryId
         * @param {string} parentCategoryName
         * @returns {Subcategory with products details}
         */


        $scope.getSubCategory = function(selectedDay, parentCategoryId, parentCategoryName) {
              $scope.gamaCategory = [];
              $scope.gamaCategory.push({
                selectedPickupPoint : sessionStorage.getItem('selectedPickUpPointId'),
                selectedDay         : selectedDay,
                parentCategoryId    : parentCategoryId,
                parentCategoryName  : parentCategoryName,         
            });
            
            sessionStorage.setItem('gamaCategoryDet', JSON.stringify($scope.gamaCategory));         
            sessionStorage.setItem('pickuppointCategoryId', parentCategoryId);         
            sessionStorage.setItem('selectedDay', selectedDay);         
            sessionStorage.setItem('parentCategoryName', parentCategoryName);         
                       
            $state.go('menu.submenu', {
                pickuppointid: sessionStorage.getItem('selectedPickUpPointId'), 
                catid : parentCategoryId               
            });
            
           
        };
    });     
        