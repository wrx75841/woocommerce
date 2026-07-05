<?php
function fanclub_jadzi_setup() {
    register_nav_menus( array(
        'primary' => __( 'Menu glowne', 'fanclub-jadzi' ),
    ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'fanclub_jadzi_setup' );

// Pokazywane, dopoki w Wygladzie -> Menu nie przypiszesz wlasnego menu do
// lokalizacji "Menu glowne".
function fanclub_jadzi_fallback_menu() {
    // Jesli strona "Galeria" (slug /galeria/) juz istnieje, linkujemy do
    // jej prawdziwego adresu. Jesli jeszcze nie zostala utworzona w
    // wp-admin, linkujemy do przewidywanego adresu /galeria/ - zadziala
    // sam, gdy tylko taka strona powstanie.
    $galeria_page = get_page_by_path( 'galeria' );
    $galeria_url  = $galeria_page ? get_permalink( $galeria_page ) : home_url( '/galeria/' );

    $sklep_page = get_page_by_path( 'sklep' );
    $sklep_url  = $sklep_page ? get_permalink( $sklep_page ) : home_url( '/sklep/' );

    // Sekcje #o-jadzi i #dolacz istnieja tylko na stronie glownej - z
    // innych stron (np. Galerii, Sklepu) link musi najpierw tam
    // zaprowadzic, inaczej kotwica nie ma czego znalezc.
    $home_url    = home_url( '/' );
    $o_jadzi_url = is_front_page() ? '#o-jadzi' : $home_url . '#o-jadzi';
    $dolacz_url  = is_front_page() ? '#dolacz' : $home_url . '#dolacz';

    echo '<ul>'
        . '<li><a href="' . esc_url( $o_jadzi_url ) . '">O Jadzi</a></li>'
        . '<li><a href="' . esc_url( $galeria_url ) . '">Galeria</a></li>'
        . '<li><a href="' . esc_url( $sklep_url ) . '">Sklep</a></li>'
        . '<li><a href="' . esc_url( $dolacz_url ) . '">Dolacz</a></li>'
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
