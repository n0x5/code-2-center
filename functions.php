<?php

function code2center_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Widget Area', 'code2center' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'code2center' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'code2center_widgets_init' );


function register_my_menus() {
  register_nav_menus(
    array('header-menu' => __( 'Main Menu 1', 'code2center' ) )
  );
}

add_action( 'init', 'register_my_menus' );

$markup = array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'post-thumbnails', );
add_theme_support( 'html5', $markup );	

add_filter( 'use_default_gallery_style', '__return_false' );

function code2center_scripts() {
wp_enqueue_style( 'code2center-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'code2center_scripts' );

add_theme_support( 'title-tag' );

add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'aside' ) );

