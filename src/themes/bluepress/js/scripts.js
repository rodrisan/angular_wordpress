angular.module('app', ['ngRoute'])
.config( function( $routeProvider, $locationProvider ){
  $locationProvider.html5Mode(true);

  $routeProvider
  .when('/', {
    templateUrl: bpLocalized.partials + 'main.html',
    controller: 'Main'
  })
  .when('/:ID', {
    templateUrl: bpLocalized.partials + 'content.html',
    controller: 'Content'
  });

})
.controller( 'Main', function( $scope, $http, $routeParams ) {
  $http.get('wp-json/posts/').success(function(res){
    console.log(res);
    $scope.posts = res;
  });
})
.controller('Content', function( $scope, $http, $routeParams ){
  $http.get('wp-json/posts/' + $routeParams.ID).success(function(res){
    $scope.post = res;
  });
});
