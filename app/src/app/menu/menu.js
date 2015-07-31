angular.module( 'gamaMobileApp.menu', [
  'ui.router'
])

/**
 * Each section or module of the site can also have its own routes. AngularJS
 * will handle ensuring they are all available at run-time, but splitting it
 * this way makes each module more "self-contained".
 */
.config(function config( $stateProvider ) {
   
  $stateProvider
    .state( 'menu', {
      url: '/menu',
      views: {
        "main": {
          controller: 'MenuController',
          templateUrl: 'menu/view/menu/menu.tpl.html', 
        }
      },
      params: {gamaPickUpDet: null},
      data:{ pageTitle: 'Menu', pageCaption:'Menus', showBreadCrumb:false, showCart:false }
    })
      .state( 'menu.submenu', {
      url: '/submenu',
      views: {
        "content": {
          templateUrl: 'menu/view/menu/submenu.tpl.html',
           controller: 'SubMenuController',
         /* controller: function ($scope, $stateParams) {          
            console.log($stateParams);
            }*/
         }         
      },
      params: {gamaCategoryDet: null, gamaPickUpDet: null, gamaCartItems: null, comboEditFlag: null},
      data:{ pageTitle: 'SubMenu', pageCaption:'SubMenu', showBreadCrumb:true, breadCrumbLink:'menu', showCart:true }
    })
    .state( 'menu.cart', {
      url: '/cart',
      views: {
        "content": {
          controller: 'CartController',
          templateUrl: 'menu/view/menu/cart.tpl.html',
        }
      },
       
       data:{ pageTitle: 'Cart', pageCaption:'Cart', showBreadCrumb:true, breadCrumbLink:'menu/submenu', showCart:true }
    })
    .state('menu.ordersummary', {
      url: '/ordersummary',
      views: {
        "content": {
          templateUrl: 'menu/view/menu/ordersummary.tpl.html'
        }
      },
       data:{ pageTitle: 'Order Summary', pageCaption:'Order Summary', showBreadCrumb:true, breadCrumbLink:'menu/cart', showCart:true}
    });
  
});

