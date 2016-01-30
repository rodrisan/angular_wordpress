var app = angular.module('app', ['ngRoute', 'ngSanitize']);

// Configure the routes
app.config(['$routeProvider', '$locationProvider', function( $routeProvider, $locationProvider ){
  $locationProvider.html5Mode(true);

  $routeProvider
  .when('/', {
    templateUrl: bpLocalized.partials + 'main.html',
    controller: 'Main'
  })

  .when('/:slug', {
    templateUrl: bpLocalized.partials + 'content.html',
    controller: 'Content'
  })

  .when('/:ID', {
    templateUrl: bpLocalized.partials + 'content.html',
    controller: 'Content'
  })

  .otherwise({
    redirectTo: '/'
  });
}]);


// Main Controller
app.controller( 'Main', ['$scope', '$http', function($scope, $http) {
  $http.get('wp-json/posts/').success(function(res){
    $scope.posts = res;
  });
}]);

// Content Controller
app.controller('Content', ['$scope', '$http', '$routeParams', function( $scope, $http, $routeParams ){
  $http.get('wp-json/posts/?filter[name]=' + $routeParams.slug).success(function(res){
    $scope.post = res[0];
  });
}]);

// Search Form Directive
app.directive('searchForm', function(){
  return {
    restrict: 'EA',
    templateUrl: bpLocalized.partials + 'search-form.html',
    controller: function ( $scope, $http ) {
      $scope.filter = {
        s: ''
      }
      $scope.search = function() {
        $http.get( 'wp-json/posts/?filter[s]=' + $scope.filter.s ).success(function(res){
          $scope.posts = res;
        });
      }
    }
  };
});
