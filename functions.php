<?php
function test_deploy_theme_enqueue_styles() {
    wp_enqueue_style( 'test-deploy-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'test_deploy_theme_enqueue_styles' );
