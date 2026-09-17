<?php
/**
 * DemoModule5 functions and definitions
 */

function demomodule5_setup() {
    // Add default title tag support
    add_theme_support( 'title-tag' );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 220, 150, true );

    // Register navigation menu
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'demomodule5' ),
    ) );
}
add_action( 'after_setup_theme', 'demomodule5_setup' );

function demomodule5_scripts() {
    wp_enqueue_style( 'demomodule5-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'demomodule5_scripts' );

// Custom excerpt length and read more suffix
function demomodule5_excerpt_length( $length ) {
    return 28;
}
add_filter( 'excerpt_length', 'demomodule5_excerpt_length' );

function demomodule5_excerpt_more( $more ) {
    return ' [...]';
}
add_filter( 'excerpt_more', 'demomodule5_excerpt_more' );
