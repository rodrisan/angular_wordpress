<?php

function bp_scripts(){
  wp_enqueue_script(
    'angularjs',
    get_stylesheet_directory_uri()  . '/bower_components/angular/angular.min.js'
  );

  wp_enqueue_script(
    'angularjs-route',
    get_stylesheet_directory_uri()  . '/bower_components/angular-route/angular-route.min.js'
  );

  wp_enqueue_script(
    'bp-scripts',
    get_stylesheet_directory_uri() . '/js/scripts.js',
    array( 'angularjs', 'angularjs-route' )
  );

  wp_localize_script(
    'bp-scripts',
    'bpLocalized',
    array(
      'partials' => trailingslashit( get_template_directory_uri() ) . 'partials/'
    )
  );
}
add_action( 'wp_enqueue_scripts', 'bp_scripts' );

?>
