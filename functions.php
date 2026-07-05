<?php
function test_deploy_theme_setup() {
    register_nav_menus( array(
        'primary' => __( 'Menu glowne', 'test-deploy-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'test_deploy_theme_setup' );

// Pokazywane, dopoki w Wygladzie -> Menu nie przypiszesz wlasnego menu do
// lokalizacji "Menu glowne" - wtedy wp_nav_menu() automatycznie przelacza
// sie na to przypisane menu.
function test_deploy_theme_fallback_menu() {
    echo '<ul><li><a href="#features">Funkcje</a></li><li><a href="#status">Status</a></li></ul>';
}

function test_deploy_theme_enqueue_styles() {
    wp_enqueue_style( 'test-deploy-theme-style', get_stylesheet_uri() );
    wp_enqueue_script(
        'test-deploy-theme-script',
        get_stylesheet_directory_uri() . '/script.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'test_deploy_theme_enqueue_styles' );
