angular.module( 'gamaMobileApp.customer', [
  'ui.router'
])

/**
 * Each section or module of the site can also have its own routes. AngularJS
 * will handle ensuring they are all available at run-time, but splitting it
 * this way makes each module more "self-contained".
 */
.config(function config( $stateProvider ) {
  $stateProvider.state( 'register', {
    url: '/register',
    views: {
      "main": {
        controller: 'RegisterController',
        templateUrl: 'customer/view/register/form.tpl.html'
      }
    },
    data:{ pageTitle: 'Login', pageCaption:'Registration',showBreadCrumb:false, showCart:false }
  });
});

