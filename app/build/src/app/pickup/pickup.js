angular.module( 'gamaMobileApp.pickup', [
  'ui.router'
])

/**
 * Each section or module of the site can also have its own routes. AngularJS
 * will handle ensuring they are all available at run-time, but splitting it
 * this way makes each module more "self-contained".
 */
.config(function config( $stateProvider ) {
  $stateProvider.state( 'pickup', {
    url: '/pickup', 
    views: {
      "main": {
        controller: 'PickUpIndexController',
        templateUrl: 'pickup/view/index/form.tpl.html'
      }
    },
    params: {gamaSession: null},
    data:{ pageTitle: 'PickupPoint', pageCaption:'PickupPoints & Timings', showBreadCrumb:true, breadCrumbLink:'menu', showCart:false }
  });
});

