angular.module('gamaMobileApp.menu')
  .factory('GamaServices',['$http', 'domain', '$rootScope',
    function ($http, domain , $rootScope) {
      return {
        categories: function (pickupPointSelectedId) {
         return $http({
            //url: domain+'/shop/api/rest/categories',
            //url: domain+'/shop/api/rest/locality/pickuppointcategories/' + $rootScope.pickupPointSelectedId,
             url: domain+'/shop/api/rest/locality/pickuppointcategories/' + pickupPointSelectedId,
          //  url: domain+'/shop/api/rest/orders',
         //   url: domain+'/shop/api/rest/orders/1',
            method: 'GET'
        });
      },
        subCategories: function (pickupPointSelectedId, parentCategoryId) {
        return $http({
           //url: domain+'/shop/api/rest/subcategories/'+parentCategoryId,
           url: domain+'/shop/api/rest/locality/pickuppointcategories/' + pickupPointSelectedId + "/" + parentCategoryId,
           method: 'GET'
        });
      },
        comboList: function (productId) {
          return $http({
             url: domain+'/shop/api/rest/productattribute/'+productId,
             method: 'GET'
          });
        }
    };
}]);
