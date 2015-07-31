var app = angular.module( 'gamaMobileApp', [
  'templates-app',
  'templates-common',
  'gamaMobileApp.pickup',
  'gamaMobileApp.login',
  'gamaMobileApp.customer',
  'gamaMobileApp.menu',
  'gamaMobileApp.order',
  'ui.router',
  'ui.bootstrap',
  'ngAnimate'
])

.constant('domain','http://dev.gama.com')

.config( function gamaMobileAppConfig ( $stateProvider, $urlRouterProvider ) {
  $urlRouterProvider.otherwise( '/pickup' );
})

 .run( function run ($rootScope, $state, $stateParams ) {
        $rootScope.cartItemsCount   = 0;   
        $rootScope.$state           = $state;
        $rootScope.$stateParams     = $stateParams;
        $rootScope.loginUser        = 'Guest';
        $rootScope.loginStatus      = false;
        $rootScope.showLogin        = true;
        $rootScope.showLogout       = false;
})


.controller( 'AppCtrl', function AppCtrl ( $scope, $location, $rootScope) {
  $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
       
    if ( angular.isDefined( toState.data.pageTitle ) ) {
        if($rootScope.parentCategory && toState.data.pageTitle==='SubMenu') {
            $scope.pageTitle = $rootScope.parentCategory;
        }
        else {
            $scope.pageTitle = toState.data.pageTitle;
        }
        $scope.pageTitle =  'Gama | ' + $scope.pageTitle  ;
    }
    if ( angular.isDefined( toState.data.pageCaption ) ) {
        if(sessionStorage.getItem('parentCategoryName') && toState.data.pageCaption==='SubMenu') {
            $scope.pageCaption = sessionStorage.getItem('parentCategoryName');
        }
        else {
            $scope.pageCaption = toState.data.pageCaption;
        }
    } 
    if ( angular.isDefined( toState.data.showBreadCrumb ) ) {
      $scope.showBreadCrumb =  toState.data.showBreadCrumb ;
    }
    
    if ( angular.isDefined( toState.data.breadCrumbLink ) ) {
      $scope.breadCrumbLink =  toState.data.breadCrumbLink ;
    }
    
    if ( angular.isDefined( toState.data.showCart ) ) {
      $scope.showCart =  toState.data.showCart ;
    }
       
  });
});

