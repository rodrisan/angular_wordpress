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

  .when('/category/:category', {
    templateUrl: bpLocalized.partials + 'main.html',
    controller: 'Category'
  })

  .otherwise({
    redirectTo: '/'
  });
}]);


// Main Controller
app.controller( 'Main', ['$scope', '$http', function($scope, $http) {

  $http.get('wp-json/taxonomies/category/terms').success(function(res){
    $scope.categories = res;
  });

  $http.get('wp-json/posts/').success(function(res){
    $scope.posts = res;
    $scope.pageTitle = 'Latest Posts:';
    //console.log(JSON.stringify(res));
    document.querySelector('title').innerHTML = 'Home | Angular + Wordpress';
  });
}]);

// Content Controller
app.controller('Content', ['$scope', '$http', '$routeParams', function( $scope, $http, $routeParams ){
  $http.get('wp-json/posts/?filter[name]=' + $routeParams.slug).success(function(res){
    $scope.post = res[0];
    document.querySelector('title').innerHTML = res[0].title + ' Angular + Wordpress';
  });
}]);

// Category Controller
app.controller('Category', ['$scope', '$http', '$routeParams', function( $scope, $http, $routeParams ){
  $http.get('wp-json/taxonomies/category/terms').success(function(res){
    $scope.categories = res;
    console.log(JSON.stringify(res));
  });

  $http.get('wp-json/taxonomies/category/terms' + $routeParams.category).success(function(res){
    $scope.current_category_id = $routeParams.category;
    $scope.pageTitle = 'Posts in ' + res.name + ':';
    document.querySelector('title').innerHTML = 'Category ' +  res.name + ' | AngularJs Demo Theme';

    $http.get('wp-json/posts/?filter[category_name]=' + res.name).success(function(res){
      $scope.posts = res;
    });
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
