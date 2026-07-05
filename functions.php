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
    // Adres endpointu AJAX dla dynamicznej ciekawostki o psach - przekazany
    // do JS, zeby nie hardkodowac admin-ajax.php po stronie klienta.
    wp_localize_script( 'fanclub-jadzi-script', 'fanclubJadzi', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'fanclub_jadzi_enqueue_assets' );

// Serwerowy proxy do zewnetrznego API z ciekawostkami o psach (dogapi.dog).
// Pobieramy po stronie PHP (wp_remote_get), a nie bezposrednio z JS w
// przegladarce, zeby uniknac ewentualnych problemow z CORS i nie
// eksponowac bezposrednio zewnetrznego adresu klientowi.
function fanclub_jadzi_ajax_dog_fact() {
    $response = wp_remote_get( 'https://dogapi.dog/api/v2/facts', array( 'timeout' => 6 ) );

    if ( is_wp_error( $response ) ) {
        wp_send_json_error( array( 'message' => 'Blad polaczenia z API.' ) );
    }

    $body = json_decode( wp_remote_retrieve_body( $response ), true );
    $fact = $body['data'][0]['attributes']['body'] ?? '';

    if ( ! $fact ) {
        wp_send_json_error( array( 'message' => 'API nie zwrocilo ciekawostki.' ) );
    }

    wp_send_json_success( array( 'fact' => $fact ) );
}
add_action( 'wp_ajax_fanclub_jadzi_dog_fact', 'fanclub_jadzi_ajax_dog_fact' );
add_action( 'wp_ajax_nopriv_fanclub_jadzi_dog_fact', 'fanclub_jadzi_ajax_dog_fact' );
