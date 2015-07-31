angular.module( 'gamaMobileApp.order', [
  'ui.router'
])

/**
 * Each section or module of the site can also have its own routes. AngularJS
 * will handle ensuring they are all available at run-time, but splitting it
 * this way makes each module more "self-contained".
 */
.config(function config( $stateProvider ) {
  $stateProvider.state( 'order', {
    url: '/order', 
    views: {
      "main": {
        controller: 'OrderController',
        templateUrl: 'order/view/orderconfirmation.tpl.html'
      }
    },
    params: {orderId: null},
    data:{ pageTitle: 'OrderConfirmation', pageCaption:'OrderConfirmation', showBreadCrumb:false,  showCart:false }
  });
});

