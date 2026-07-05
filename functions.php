<?php
function fanclub_jadzi_setup() {
    register_nav_menus( array(
        'primary' => __( 'Menu glowne', 'fanclub-jadzi' ),
    ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'fanclub_jadzi_setup' );

// Pokazywane, dopoki w Wygladzie -> Menu nie przypiszesz wlasnego menu do
// lokalizacji "Menu glowne".
function fanclub_jadzi_fallback_menu() {
    echo '<ul>'
        . '<li><a href="#o-jadzi">O Jadzi</a></li>'
        . '<li><a href="#dolacz">Dolacz</a></li>'
        . '</ul>';
}

function fanclub_jadzi_enqueue_assets() {
    wp_enqueue_style( 'fanclub-jadzi-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script(
        'fanclub-jadzi-script',
        get_stylesheet_directory_uri() . '/script.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'fanclub_jadzi_enqueue_assets' );
