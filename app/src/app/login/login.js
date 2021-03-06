angular.module( 'gamaMobileApp.login', [
  'ui.router'
])

/**
 * Each section or module of the site can also have its own routes. AngularJS
 * will handle ensuring they are all available at run-time, but splitting it
 * this way makes each module more "self-contained".
 */
.config(function config( $stateProvider ) {
  $stateProvider.state( 'login', {
    url: '/login',
    views: {
      "main": {
        controller: 'LoginIndexController',
        templateUrl: 'login/view/login/form.tpl.html'
      }
    },
    data:{ pageTitle: 'Login', pageCaption:'Login', showBreadCrumb:false, showCart:false }
  });
});

