<?php
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
