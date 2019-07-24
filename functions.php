<?php

function immobiliare_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  
    wp_enqueue_script('jquery', "https://code.jquery.com/jquery-3.3.1.slim.min.js", [], false, true );
    wp_enqueue_script('popper.js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", [], false, true );
    wp_enqueue_script('bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", [], false, true );

}

// On attache la fonction immobiliare 'wp_enqueue_scripts'
add_action( 'wp_enqueue_scripts', 'immobiliare_enqueue_styles' );


function register_my_menu() {
    register_nav_menu('main-menu', 'Menu principal');
}

add_action( 'init', 'register_my_menu' );

// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Image à la une.
add_theme_support( 'post-thumbnails' );