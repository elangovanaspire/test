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
                'SubMenuController',
                function SubMenuController($scope, domain, GamaServices, $http, $state, $stateParams, $location, $rootScope, $modal) {

                    $scope.byDefault = '';
                    $scope.qty = [];
                    $scope.applyRemainingCombo = [];
                    $scope.remainingComboItem = [];
                    $scope.comboCount = [];
                    $scope.selectedItems = [];
                    $scope.cartQty = [];
                    $scope.orderQty = [];
                    $scope.maxProductQty = 5;
                    $scope.maxAddOnProductQty = 5;
                    $scope.showLoader = false;
                    $scope.cartItems = [];
                    $scope.deliveryAddressData = [];
                    $scope.cartItemsCount = 0;
                    $scope.isCartItemExist = false;
                    $scope.alcartaEditFlag = false;
                    $scope.showPickuppoint = false;
                    $scope.showBYOVOffer = false;
                    $scope.addExtraCharge = false;
                    $scope.byovPrice = 0;
                    $scope.byovStatus = true;
                    /**
                     * Get sub category using below rest api
                     * @param {string} selectedDay
                     * @param {int} parentCategoryId
                     * @param {string} parentCategoryName
                     * @returns {Subcategory with products details}
                     */

                    $scope.gamaCategoryDet      = JSON.parse(sessionStorage.getItem('gamaCategoryDet'));
                    
                    //$scope.selectedDay          =  sessionStorage.getItem('selectedDay');
                    $scope.parentCategoryId     =  sessionStorage.getItem('pickuppointCategoryId');
                    $rootScope.parentCategory   =  sessionStorage.getItem('parentCategoryName');
                    

                    GamaServices.subCategories(sessionStorage.getItem('selectedPickUpPointId'), sessionStorage.getItem('pickuppointCategoryId')).success(
                            function (data) {
                             //   $scope.parentCategory = $scope.parentCategoryName;
                             //   $rootScope.parentCategory = $scope.parentCategoryName;
                                $scope.subMenuItems = data;
                                $scope.menuItems = $scope.subMenuItems[0];
                                $scope.byDefault = $scope.menuItems[1];

                                $scope.isopen = ($scope.byDefault === $scope.menuItems[1]);
                                $scope.$watch('isopen', function (newvalue, oldvalue, $scope) {
                                    $scope.isopen = newvalue;
                                });
                              //  $state.go('menu.submenu');
                            }).error(function () {
                        alert("error");
                    });
                    //};
                    
                    if($stateParams.comboEditFlag === true) {
                        console.log("===========");
                       var cartItem = JSON.parse(sessionStorage.getItem('gamaCartItems'));
                        console.log(cartItem);
                  //   $scope.alcartaEdit = function (cartItem, qty, cartQty, cpIndex) {
                        $scope.alcartaEditFlag = true;
                        $scope.showme = cartItem.productId;
                        $scope.pcId = cartItem.productCategoryId;
                        $scope.selectedItems = cartItem.productComboSelectedItems;
                        $scope.qty[cartItem.productCategoryIndex][cartItem.productIndex] = $scope.cartQty[cpIndex];
                        $scope.getComboList(cartItem.productId, $scope.qty, cartItem.productCategoryIndex, cartItem.productIndex);
                        $scope.comboGroup = $scope.makeCombo();
                        //$scope.alcartaEditFlag = false;

                        if (Math.floor($scope.selectedItems.length / $scope.comboSize) >= $scope.qty[cartItem.productCategoryIndex][cartItem.productIndex]) {
                            $scope.isDisabled = true;
                        }
                        console.log("edit process");
                        //$state.go('menu.submenu');
                        }
                    //};
                    

                    /**
                     * Get combo Items based on the combo product id
                     * @param {int} productId 
                     * @param {string} input
                     * @param {int} cIndex
                     * @param {int} pIndex
                     * @returns {Combo product attributes}
                     */
                    $scope.getComboList = function (productId, input, cIndex, pIndex) {
                        if (input[cIndex][pIndex] > 0) {
                            $scope.showLoader = true;
                            if ($scope.alcartaEditFlag === false) {
                                $scope.selectedItems = [];
                            }

                            GamaServices.comboList(productId).success(
                                    function (data) {
                                        $scope.comboDetails = data;
                                        $scope.comboItems = $scope.comboDetails[0];
                                        $scope.comboSize = $scope.comboItems.bundleItems.length;
                                        $scope.showme = productId;

                                        $scope.showLoader = false;
                                        if ($scope.comboGroup === undefined) {
                                            $scope.comboGroup = [];
                                            $scope.isDisabled = false;
                                        }

                                        $scope.comboList = [];
                                        $scope.comboalert = '';
                                        $scope.addonCount = '';
                                    }).error(function () {
                                alert("error");
                            });
                        }
                    };

                    /**
                     * Close the combo items
                     * @param {string} input
                     * @param {int} cIndex
                     * @param {int} pIndex
                     * @returns {boolean & reset the product quantity count}
                     */

                    /*
                     * Gathering the selected items to make dynamic combo
                     * @param {int} selected
                     * @param {array} comboItems
                     * @param {int} productId
                     * @param {int} cIndex
                     * @param {int} pIndex
                     * @returns {MenuController.$scope.comboGroup|type.comboGroup}
                     */
                    $scope.hideComboList = function (input, cIndex, pIndex) {
                        $scope.showme = false;
                        input[cIndex][pIndex] = 0;
                    };

                    $scope.comboItemsSelected = function (selected, comboItems, productId, cIndex, pIndex, comboKey) {
                        if (selected !== '') {
                            if ($scope.alcartaEditKey !== undefined) {
                                var arrVal = '';
                                comboItems.forEach(function (comboItem) {
                                    if (comboItem.itemId == selected) {
                                        arrVal = Math.round(comboItem.itemQuantity) + ' ' + comboItem.itemName + '~' + comboItem.itemId;
                                        $scope.comboGroup[$scope.alcartaEditKey][comboKey] = arrVal;
                                    }
                                });

                                var comboIndex = 0;
                                for (var i = 0; i < $scope.selectedItems.length; i += $scope.comboSize) {
                                    if (comboIndex == $scope.alcartaEditKey) {
                                        $scope.selectedItems[i + comboKey] = arrVal;
                                        break;
                                    }
                                    comboIndex++;
                                }

                            } else {
                                $scope.comboalert = '';
                                $scope.currentComboItemIds = [];
                                angular.forEach(comboItems, function (value, key) {
                                    $scope.currentComboItemIds.push(value.itemId);
                                    if (selected === value.itemId) {
                                        var arrVal = Math.round(value.itemQuantity) + ' ' + value.itemName + '~' + value.itemId;
                                        // selectedItems.push(value.itemId + ': '+ value.itemQuantity + value.itemName);
                                        //  selectedItems.push(value.itemId);
                                        $scope.selectedItems.push(arrVal);
                                    }
                                }, $scope.selectedItems);

                                $scope.comboGroup = $scope.makeCombo($scope.comboSize);
                                //  $scope.qty[cIndex][pIndex]  = $scope.comboGroup.length;

                                if (Math.floor($scope.selectedItems.length / $scope.comboSize) >= $scope.qty[cIndex][pIndex]) {
                                    $scope.isDisabled = true;
                                }
                                return $scope.comboGroup;
                            }
                        }
                    };

                    /* 
                     * To edit the combo items in cart
                     * @param {array} cartItem
                     * @param {int} qty
                     * @param {int} cartQty
                     * @param {int} cpIndex
                     * @returns {undefined}
                     */

                   

                    /* Make Combo based on the comobo groups count
                     * 
                     * @returns {MenuController.$scope.comboGroup|Array|type.comboGroup}
                     */

                    $scope.makeCombo = function () {
                        var comboIndex = 0;
                        $scope.comboGroup = [];
                        $scope.currentCombo = [];
                        for (var i = 0; i < $scope.selectedItems.length; i += $scope.comboSize) {
                            $scope.currentCombo[comboIndex] = $scope.selectedItems.slice(i, i + $scope.comboSize);
                            $scope.lastElement = $scope.selectedItems.slice(-1);
                            comboIndex++;
                        }
                        $scope.comboCheck();
                        $scope.isItemExist();


                        for (var j = 0; j < $scope.selectedItems.length; j += $scope.comboSize) {
                            $scope.comboGroup.push($scope.selectedItems.slice(j, j + $scope.comboSize));
                        }
                        return $scope.comboGroup;
                    };

                    /* Check and remove the same items exist in the same combo
                     * 
                     * @returns {type.isItemExist.checkArray|$scope.currentCombo|angular-scenario_L9412.isItemExist.checkArray}
                     * 
                     */
                    $scope.isItemExist = function () {
                        var checkArray = $scope.currentCombo[$scope.currentCombo.length - 1];
                        if (checkArray.length > 1) {
                            for (var i = 0; i < checkArray.length - 1; i++) {
                                if (angular.equals(checkArray[i], String($scope.lastElement))) {
                                    checkArray.pop();
                                    $scope.selectedItems.pop();
                                }
                            }
                        }
                        return checkArray;
                    };

                    $scope.comboCheck = function () {
                        var checkArray = $scope.currentCombo[$scope.currentCombo.length - 1];
                        $scope.selectedCurrentComboItemIds = [];
                        angular.forEach(checkArray, function (value, key) {
                            var productId = value.split('~');
                            $scope.selectedCurrentComboItemIds.push(productId[1]);
                        });
                        var currentItemId = String($scope.lastElement).split('~');
                        if ($scope.selectedCurrentComboItemIds.length > 1) {
                            for (var i = 0; i < $scope.selectedCurrentComboItemIds.length - 1; i++) {
                                for (var j = 0; j < $scope.currentComboItemIds.length; j++) {
                                    if (currentItemId[1] !== $scope.selectedCurrentComboItemIds[i] && $scope.currentComboItemIds[j] === $scope.selectedCurrentComboItemIds[i]) {
                                        $scope.selectedItems.pop();
                                    }
                                }
                            }
                        }
                    };

                    /* To compare combo groups having same set of items
                     * 
                     * @returns {Boolean}
                     */
                    $scope.comboCompare = function () {
                        if ($scope.comboGroup.length > 1) {
                            for (var j = 1; j < $scope.comboGroup.length; j++) {
                                for (var k = 0; k < j; k++) {
                                    if (angular.equals($scope.comboGroup[k].sort(), $scope.comboGroup[j].sort())) {
                                        $scope.comboalert = "Already combo " + (k + 1) + " having same combinantion, try to make another set of combo";
                                        return false;
                                    } else {
                                        $scope.comboalert = '';
                                    }
                                }
                            }
                        }
                    };

                    /* 
                     * Remove the combo group rearrange the rest of the combos
                     * @param {int} index
                     * @param {int} pIndex
                     * @param {int} cIndex
                     * @param {string} input
                     * @returns {MenuController.$scope.comboGroup|Array|type.comboGroup}
                     * 
                     */
                    $scope.arrangeCombo = function (index, pIndex, cIndex, input) {
                        $scope.comboalert = '';
                        angular.forEach($scope.comboGroup, function (value, key) {
                            if (index === 0) {
                                if (key === index) {
                                    $scope.comboGroup.splice(index, 1);
                                    $scope.selectedItems.splice(index, $scope.comboSize);
                                }
                            } else if (index > 0) {
                                if (key === index) {
                                    $scope.comboGroup.splice(index, 1);
                                    $scope.selectedItems.splice((index * $scope.comboSize), $scope.comboSize);
                                }
                            }
                        }, $scope.comboGroup);

                        //  $scope.qty[cIndex][pIndex]  = $scope.comboGroup.length;
                        $scope.isDisabled = false;
                        $scope.comboList.pop();

                        return $scope.comboGroup;
                    };

                    /*
                     * To decrease the product quantity
                     * @param {string} input
                     * @param {int} cIndex
                     * @param {int} pIndex
                     * @returns int 
                     */
                    $scope.productQtyMinus = function (input, cIndex, pIndex) {
                        $scope.resetcomboEdit();
                        if (input[cIndex][pIndex] > 0) {
                            if ($scope.comboGroup && $scope.comboGroup.length >= input[cIndex][pIndex]) {
                                $scope.comboGroup.pop();
                                var spliceLength = $scope.selectedItems.length % $scope.comboSize;
                                if (spliceLength === 0) {
                                    $scope.selectedItems.splice(-$scope.comboSize, $scope.comboSize);
                                } else {
                                    $scope.selectedItems.splice(-spliceLength, spliceLength);
                                }
                                $scope.isDisabled = true;
                            }

                            input[cIndex][pIndex] = input[cIndex][pIndex] - 1;

                            if (input[cIndex][pIndex] === 0) {
                                $scope.hideComboList(input, cIndex, pIndex);
                            }
                        }
                    };

                    /*
                     * To increase the product quantity
                     * @param {string} input
                     * @param {int} cIndex
                     * @param {int} pIndex
                     * @returns int 
                     */
                    $scope.productQtyPlus = function (input, cIndex, pIndex) {
                        $scope.resetcomboEdit();
                        if (input[cIndex][pIndex] < $scope.maxProductQty) {
                            input[cIndex][pIndex] = input[cIndex][pIndex] + 1;
                        }
                        if (($scope.selectedItems.length / $scope.comboSize) <= $scope.qty[cIndex][pIndex]) {
                            $scope.isDisabled = false;
                        }
                    };

                    /* Add to cart form validation
                     * 
                     * @returns {undefined}
                     */
                    $scope.addToCart = function (productType, productId, qty, productDetails, applyRemainingCombo, remainingComboItem, cIndex, pIndex) {
                        $scope.resetcomboEdit();
                        $scope.comboalert = '';
                        $scope.productId = productId;
                        // Removing Duplicate Items

                       
                        angular.forEach($scope.cartItems, function (cartItem, cartItemKey) {
                            if (cartItem['productId'] == $scope.productId) {
                                $scope.isCartItemExist = true;
                                cartItem['productQuantity'] += qty;
                            }
                        });

                        if (productType != 'bundle' && qty > 0 && $scope.isCartItemExist === false) {
                            $scope.cartItems.push({
                                'productId': productId,
                                'productType': productType,
                                'productName': productDetails['name'],
                                'productPrice': productDetails['price'],
                                'productQuantity': qty,
                                'productDetails': productDetails,
                                'productCategoryIndex': cIndex,
                                'productCategoryId': sessionStorage.getItem('pickuppointCategoryId'),
                                'productCategoryName': sessionStorage.getItem('parentCategoryName'),
                            });

                        } else if (productType == 'bundle' && qty > 0 && $scope.isCartItemExist === false) {
                            if ($scope.comboGroup.length > 0) {
                                $scope.cartItems.push({
                                    'productId': productId,
                                    'productType': productType,
                                    'productName': productDetails['name'],
                                    'productPrice': productDetails['price'],
                                    'productQuantity': qty,
                                    'productDetails': productDetails,
                                    'productAddonDetails': $scope.addonSelected,
                                    'productComboGroupItems': $scope.comboGroup,
                                    'productComboGroupLength': $scope.comboGroup.length,
                                    'productRemainingCombo': applyRemainingCombo,
                                    'productRemainingComboItem': remainingComboItem,
                                    'productComboSelectedItems': $scope.selectedItems,
                                    'productCategoryIndex': cIndex,
                                    'productIndex': pIndex,
                                    'productCategoryId':   sessionStorage.getItem('pickuppointCategoryId'),
                                    'productCategoryName': sessionStorage.getItem('parentCategoryName'),
                                    
                                });
                            } else {
                                $scope.comboalert = "Please make atleast one combo";
                                return false;
                            }
                        }

                        $scope.isCartItemExist = false;
                        $scope.makeCart();

                    };

                    $scope.makeCart = function () {
                        $scope.cartItemsCount = 0;
                        angular.forEach($scope.cartItems, function (cartItem, cartItemKey) {
                            if (cartItem['productAddonDetails']) {
                                angular.forEach(cartItem['productAddonDetails'], function (addonItem, addonItemKey) {
                                    $scope.cartItemsCount += addonItem['addonProductQuantity'];
                                });
                            }
                            if (cartItem['productRemainingCombo'] === true) {
                                if (cartItem['productComboGroupLength'] < cartItem['productQuantity']) {
                                    var remainComboLength = cartItem['productQuantity'] - cartItem['productComboGroupLength'];
                                }
                            }
                            $scope.cartItemsCount = cartItemKey + 1;
                        });

                        $rootScope.cartItemsCount = $scope.cartItemsCount;

                        //GamaServices.cartItems();
                        console.log($scope.cartItems);
                        
                        sessionStorage.setItem('cartItems',JSON.stringify($scope.cartItems));

                    };


                    $scope.comboEdit = function (groupItem, gkey) {
                        $scope.isDisabled = false;
                        $scope.alcartaEditKey = gkey;
                    };

                    $scope.resetcomboEdit = function () {
                        delete $scope.alcartaEditKey;
                    };

                    /*
                     * To remove an item/items from the cart
                     * @param {int} cpIndex
                     * @returns {undefined}
                     */

                   /* $scope.removeFromCart = function (cpIndex) {
                        angular.forEach($scope.cartItems, function (cartItem, cartItemKey) {
                            if (cpIndex === cartItemKey) {
                                $scope.cartItems.splice(cpIndex, 1);
                                $rootScope.cartItemsCount--;

                            }
                        });
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

                    */


                    /*
                     * Addon popup modal
                     * 
                     * @returns {undefined}
                     */
                    $scope.open = function () {
                        var modalInstance = $modal.open({
                            templateUrl: 'menu/view/menu/addon.tpl.html',
                            controller: ModalInstanceCtrl,
                            scope: $scope,
                            overlay: true,
                            resolve: {
                                addonItems: function () {
                                    return $scope.comboItems.addonGroupItems;
                                }
                            }
                        });

                        modalInstance.result.then(function (selectedItems) {
                            $scope.addonCount = selectedItems.length;
                            $scope.addonSelected = selectedItems;
                        }, function () {
                            //$log.info('Modal dismissed at: ' + new Date());
                        });


                    };


                    $scope.orderSummary = function () {
                        $state.go('menu.order');
                    };

                    $scope.addMore = function () {
                        $state.go('menu');
                    };

                    $scope.editPickupoint = function () {
                        $scope.showPickuppoint = true;
                    };

                    $scope.showDate = function () {
                        $scope.day = [];
                        if ($scope.selectedDay === 0) {
                            $scope.day = 'Today';
                        } else {
                            $scope.day = 'Tomorrow';
                        }
                        angular.forEach($scope.dayWiseMenus, function (dayList) {
                            angular.forEach(dayList, function (days) {
                                if ($scope.day === days['day']) {
                                    $scope.currentDate = days['date'];
                                }
                            });
                        });
                        return $scope.currentDate;
                    };

                    $scope.byov = function () {
                        $scope.byovPrice = $scope.subTotal * 5 / 100;
                        return $scope.byovPrice;
                    };

                    $scope.changePickuppoint = function (pickup) {
                        $rootScope.pickupPointSelected = pickup;
                        $scope.showPickuppoint = false;
                    };

                    $scope.getSubTotal = function () {
                        $scope.subTotal = 0;
                        angular.forEach($scope.cartItems, function (cartItem, cartItemKey) {
                            $scope.subTotal = $scope.subTotal + cartItem['productPrice'] *
                                    cartItem['productQuantity'];

                        });

                        angular.forEach($scope.addonSelected, function (addonItem, addonKey) {
                            $scope.subTotal = $scope.subTotal + parseInt(addonItem['addonProductPrice']) *
                                    addonItem['addonProductQuantity'];
                        });

                        return $scope.subTotal;
                    };

                    $scope.byovCalculate = function (showBYOVOffer) {
                        $scope.byovStatus = showBYOVOffer;

                    };

                    $scope.getTotal = function () {
                        $scope.total = $scope.subTotal + 20;
                        if ($scope.byovStatus === true) {
                            $scope.total -= $scope.byovPrice;
                        }
                        if ($scope.addExtraCharge) {
                            $scope.total += 20;
                        }
                        return $scope.total;
                    };

                    $scope.deliveryAddressPopUp = function () {
                        var addressModalInstance = $modal.open({
                            templateUrl: 'menu/view/menu/address.tpl.html',
                            controller: DeliveryModalInstanceCtrl,
                            scope: $scope,
                            overlay: true
                        });

                        addressModalInstance.result.then(function () {
                            $scope.addExtraCharge = true;
                        });

                    };


                    $scope.doorDelivery = function () {
                        $scope.deliveryAddressData.length = 0;
                        $scope.addExtraCharge = false;
                    };

                    $scope.userAccountPopup = function () {
                        if (!$rootScope.loginStatus) {
                            var loginModalInstance = $modal.open({
                                templateUrl: 'menu/view/menu/user-account.tpl.html',
                                controller: UserAccountController,
                                scope: $scope,
                                overlay: true
                            });
                        }
                    };


                });

var DeliveryModalInstanceCtrl = function ($scope, $modalInstance) {

    $scope.deliveryAddress = function (address1, address2, phone) {
        $scope.deliveryAddressData.push({
            'address1': address1,
            'address2': address2,
            'phone': phone
        });

        $modalInstance.close($scope.deliveryAddressData);

    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
};
/*
 * 
 * @param {type} $scope
 * @param {type} $modalInstance
 * @param {type} addonItems
 * @returns {undefined}
 */
var ModalInstanceCtrl = function ($scope, $modalInstance, addonItems) {

    $scope.addonItems = addonItems;
    $scope.addonQuantity = [];
    $scope.addonItemRadio = [];
    $scope.addonPrice = [];
    $scope.addOnSelected = [];
    /* $scope.selected = {
     item: $scope.items[0]
     };*/


    $scope.ok = function () {
        $modalInstance.close($scope.selected.item);
    };

    /* selected addon items to combo product
     * 
     * @returns {array}
     */
    $scope.addToCombo = function () {
        angular.forEach($scope.addonItemRadio, function (addonGroup, addonGroupkey) {
     
            angular.forEach(addonGroup, function (addonItemId, addonItemKey) {
                if (addonItemId > 0 && $scope.addonQuantity[addonGroupkey][addonItemKey] > 0) {
                    addonItem = $scope.getAddonItem(addonItemId);
                    addonItemName = addonItemId.addonItemName;
                    $scope.addOnSelected.push(
                            {
                                'addonProductName': addonItemName,
                                'addonProductId': addonItemId,
                                'addonProductQuantity': $scope.addonQuantity[addonGroupkey][addonItemKey],
                                'addonProductPrice': $scope.addonPrice[addonGroupkey][addonItemKey],
                            });
                }
            });
        });
        $modalInstance.close($scope.addOnSelected);
    };


    $scope.getAddonItem = function (addonId) {
        addOnItem = $scope.comboItems.addonGroupItems;

        for (var key in addOnItem) {
            for (var addonItem in addOnItem[key].upSellProductGroupItems) {
                if (addOnItem[key].upSellProductGroupItems[addonItem].addonItemPrice == addonId) {
                    return addOnItem[key].upSellProductGroupItems[addonItem];
                }
            }
        }
    };


    /* Reset the rest of the addon quantity to zero
     * 
     * @param {array} addonItem
     * @param {string} input
     * @param {int} groupKey
     * @param {int} groupItemKey
     * @returns {undefined}
     */

    $scope.resetAddOnCount = function (addonItem, input, groupKey, groupItemKey) {
        angular.forEach(addonItem, function (value, key) {
            if (groupItemKey !== key) {
                $scope.addonQuantity[groupKey][key] = 0;
                $scope.addonItemRadio[groupKey][key] = 0;
            }
        });
        $scope.addonQuantity[groupKey][groupItemKey] = 1;
    };



    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    /*
     * To increase the addon product quantity
     * @param {string} input
     * @param {int} cIndex
     * @param {int} pIndex
     * @returns int 
     */
    $scope.addOnQtyMinus = function (addonItem, input, cIndex, pIndex) {
        if (input[cIndex][pIndex] > 0) {
            input[cIndex][pIndex] = input[cIndex][pIndex] - 1;
        }
        angular.forEach(addonItem, function (value, key) {
            if (pIndex !== key) {
                $scope.addonQuantity[cIndex][key] = 0;
            }
        });
    };

    /*
     * To decrease the addon product quantity
     * @param {string} input
     * @param {int} cIndex
     * @param {int} pIndex
     * @returns int 
     */

    $scope.addOnQtyPlus = function (addonItem, input, cIndex, pIndex) {

        if (input[cIndex][pIndex] < $scope.maxAddOnProductQty) {
            input[cIndex][pIndex] = input[cIndex][pIndex] + 1;
        }
        angular.forEach(addonItem, function (value, key) {
            if (pIndex !== key) {
                $scope.addonQuantity[cIndex][key] = 0;
            }
        });

    };

};

var UserAccountController = function ($scope, $modalInstance, $http, Auth, $location, $rootScope, domain) {
    //$scope.showLoginForm = true;
    $scope.showRegisterForm = true;
    $scope.errorMessages = [];
    $scope.emailRegx = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
    $scope.mobileRegx = /^[1-9][0-9]+$/;

    $scope.login = function (username, password) {
        $scope.username = username;
        $scope.password = password;
        var isNum = /^\d+$/.test($scope.username);
        if (!$scope.username || !$scope.password) {
            $scope.errorMessages = ['* All fields are mandatory'];
            $scope.errors = true;
        } else if (isNum) {
            $scope.mobileValidate($scope.username);
        } else {
            $scope.emailValidate($scope.username);
        }

        if ($scope.errorMessages.length === 0) {

            Auth.userAuthenticate($scope.username, $scope.password).success(function (data, status, headers, config) {
                var resHeader = headers('Location').split('/');
                $scope.loginUser = resHeader.pop();
                $rootScope.loginUser = $scope.loginUser;
                $rootScope.showLogin = false;
                $rootScope.showLogout = true;
                // $rootScope.loginStatus      = true;
                $scope.errors = false;
                $scope.message = ['Login Successful'];
                $modalInstance.close();
            }).error(function (data, status, headers, config) {
                $scope.errors = true;
                $scope.info = false;
                var messages = [];
                angular.forEach(data.messages.error, function (error, key) {
                    if (error.code != 500) {
                        this.push(error.message);
                    }
                }, messages);
                $scope.errorMessages = messages;
            });
        }

    };

    $scope.mobileValidate = function (username) {
        $scope.username = username;
        if (!$scope.mobileRegx.test($scope.username) || $scope.username.length != 10) {
            $scope.errors = true;
            $scope.errorMessages = ['Please enter a valid Mobile Number'];
        } else {
            $scope.errorMessages = [];
        }
    };

    $scope.emailValidate = function (username) {
        $scope.username = username;
        if (!$scope.emailRegx.test($scope.username)) {
            $scope.errors = true;
            $scope.errorMessages = ['Please enter a valid email address'];
        } else {
            $scope.errorMessages = [];
        }
    };


    $scope.register = function (user) {
        $scope.user = user;
        if ($scope.user === undefined) {
            $scope.errorMessages = ['* All fields are mandatotary'];
            $scope.errors = true;
        } else if (!$scope.emailRegx.test($scope.user['email'])) {
            $scope.errors = true;
            $scope.errorMessages = ['Please enter a valid email address'];
        } else if (!$scope.mobileRegx.test($scope.user['mobile']) || $scope.user['mobile'].length != 10) {
            $scope.errors = true;
            $scope.errorMessages = ['Please enter a valid Mobile Number'];
        } else if ($scope.user['password'].length < 8) {
            $scope.errorMessages = ['Password should have atleast 8 characters'];
            $scope.errors = true;
        } else if ($scope.user['password'] != $scope.user['confirmation']) {
            $scope.errorMessages = ['Passwords should match each other'];
            $scope.errors = true;
        } else {

            $http.post(domain + '/shop/api/rest/customer', $scope.user)
                    .success(function (data, status, headers, config) {
                        $scope.showRegisterForm = false;
                        $scope.errors = false;
                        $scope.info = false;
                        $scope.errorMessages = [];
                        $scope.successMessage = true;
                    }).error(function (data, status, headers, config) {
                $scope.errors = true;
                $scope.info = false;
                var messages = [];
                angular.forEach(data.messages.error, function (error, key) {
                    if (error.code != 500) {
                        this.push(error.message);
                    }
                }, messages);
                $scope.errorMessages = messages;
            });
        }
    };

    $scope.guestUser = function () {
        $location.path('menu/cart');
        $modalInstance.dismiss('cancel');
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };


    $rootScope.logout = function () {
        Auth.clearCredentials().success(function (data, status, headers, config) {
            //alert('Thank you'+$rootScope.loginUser.'for using Gama Gamma');
            $rootScope.loginUser = 'Guest';
            $rootScope.loginStatus = false;
            $rootScope.showLogin = true;
            $rootScope.showLogout = false;
            $location.path('pickup');
        });

    };
};






 