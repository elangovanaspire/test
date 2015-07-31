/**
 * Menu Controller @ Elango
 */
app = angular.module('gamaMobileApp.menu')
.filter('split', function () {
    return function (input, splitChar, splitIndex) {
        return input.split(splitChar)[splitIndex];
    };
})
.controller(
'CartController',
function CartController($scope, domain, GamaServices, $http, $state, $stateParams, $location, $rootScope, $modal) {

    $scope.cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
    console.log($scope.cartItems);
    $scope.removeFromCart = function (cpIndex) {
        angular.forEach($scope.cartItems, function (cartItem, cartItemKey) {
            if (cpIndex === cartItemKey) {
                $scope.cartItems.splice(cpIndex, 1);
                $rootScope.cartItemsCount--;

            }
        });
        sessionStorage.setItem('cartItems',JSON.stringify($scope.cartItems));
    };

    $scope.cartQtyPlus = function (cpIndex, cartItem) {
        if ($scope.cartQty[cpIndex] < $scope.maxProductQty) {
            $scope.cartQty[cpIndex] = $scope.cartQty[cpIndex] + 1;
            //$rootScope.cartItemsCount++;
            cartItem.productQuantity++;
        }

    };

    $scope.cartQtyMinus = function (pIndex, cartItem) {
        if ($scope.cartQty[pIndex] > 1) {
            $scope.cartQty[pIndex] = $scope.cartQty[pIndex] - 1;
            //$rootScope.cartItemsCount--; 
            cartItem.productQuantity--;
        }
    };
    
     $scope.alcartaEdit = function (cartItem, qty, cartQty, cpIndex) {
        $scope.alcartaEditFlag = true;
        $scope.showme = cartItem.productId;
        $scope.pcId = cartItem.productCategoryId;
        $scope.selectedItems = cartItem.productComboSelectedItems;
         $state.go('menu.submenu');
        $scope.qty[cartItem.productCategoryIndex][cartItem.productIndex] = cartQty[cpIndex];
        $scope.getComboList(cartItem.productId, qty, cartItem.productCategoryIndex, cartItem.productIndex);
        $scope.comboGroup = $scope.makeCombo();
        //$scope.alcartaEditFlag = false;

        if (Math.floor($scope.selectedItems.length / $scope.comboSize) >= qty[cartItem.productCategoryIndex][cartItem.productIndex]) {
            $scope.isDisabled = true;
        }
        $state.go('menu.submenu');

    };
    
     $scope.cartEdit = function (cartItem, qty, cartQty, cpIndex) {
        sessionStorage.setItem('comboEditFlag', true); 
        sessionStorage.setItem('pickuppointCategoryId', cartItem.productCategoryId); 
        sessionStorage.setItem('gamaCartItems',JSON.stringify(cartItem)); 
     
        console.log(cpIndex);
        
        $scope.showme = cartItem.productId;
        $scope.pcId = cartItem.productCategoryId;
        $scope.selectedItems = cartItem.productComboSelectedItems;
        
        $scope.qty[cartItem.productCategoryIndex][cartItem.productIndex] = cartQty[cpIndex];
        $scope.getComboList(cartItem.productId, qty, cartItem.productCategoryIndex, cartItem.productIndex);
        $scope.comboGroup = $scope.makeCombo();
        //$scope.alcartaEditFlag = false;

        if (Math.floor($scope.selectedItems.length / $scope.comboSize) >= qty[cartItem.productCategoryIndex][cartItem.productIndex]) {
            $scope.isDisabled = true;
        }
       // $state.go('menu.submenu');
        $state.go('menu.submenu',{gamaCartItems:sessionStorage.setItem('gamaCartItems',JSON.stringify(cartItem)), comboEditFlag: true});

    };
    
    


});
