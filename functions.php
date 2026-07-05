<?php
function sklep_wedkarski_setup() {
    register_nav_menus( array(
        'primary' => __( 'Menu glowne', 'sklep-wedkarski' ),
    ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'sklep_wedkarski_setup' );

// Pokazywane, dopoki w Wygladzie -> Menu nie przypiszesz wlasnego menu do
// lokalizacji "Menu glowne".
function sklep_wedkarski_fallback_menu() {
    echo '<ul>'
        . '<li><a href="#kategorie">Kategorie</a></li>'
        . '<li><a href="#dlaczego-my">Dlaczego my</a></li>'
        . '</ul>';
}

function sklep_wedkarski_enqueue_assets() {
    wp_enqueue_style( 'sklep-wedkarski-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script(
        'sklep-wedkarski-script',
        get_stylesheet_directory_uri() . '/script.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'sklep_wedkarski_enqueue_assets' );
