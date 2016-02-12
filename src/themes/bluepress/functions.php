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
    'angularjs-sanitize',
    get_stylesheet_directory_uri()  . '/bower_components/angular-sanitize/angular-sanitize.min.js'
  );

  wp_enqueue_script(
    'bp-scripts',
    get_stylesheet_directory_uri() . '/js/scripts.js',
    array( 'angularjs', 'angularjs-route', 'angularjs-sanitize' )
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


 /**
   * Register a book post type, with REST API support
   *
   * Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
   */
  add_action( 'init', 'my_book_cpt' );
  function my_book_cpt() {
    $labels = array(
        'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'rest_base'          => 'books-api',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'book', $args );
}

 /**
   * Register a genre post type, with REST API support
   *
   * Based on example at: https://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  add_action( 'init', 'my_book_taxonomy', 30 );
  function my_book_taxonomy() {

    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
        'show_in_rest'       => true,
        'rest_base'          => 'genre',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'genre', array( 'book' ), $args );

  }

?>
