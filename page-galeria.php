<?php
/*
Template Name: Galeria
 *
 * Osobna strona z galeria zdjec (nie na stronie glownej). Dziala
 * automatycznie dla strony WordPressa o adresie /galeria/ (konwencja
 * page-{slug}.php), a dodatkowo mozna ja recznie wybrac w Atrybutach
 * strony jako szablon "Galeria" (naglowek Template Name powyzej).
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo( 'name' ); ?> — Galeria</title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="wrap">
    <nav class="site-nav">
        <div class="brand">
            <svg width="26" height="26" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="24" cy="30" rx="12" ry="9" style="fill:var(--accent)" />
                <ellipse cx="12" cy="16" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="22" cy="10" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="34" cy="12" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="40" cy="20" rx="5" ry="6" style="fill:var(--accent)" />
            </svg>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:inherit;">Fanclub Jadzi</a>
        </div>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => 'fanclub_jadzi_fallback_menu',
        ) );
        ?>
    </nav>
</div>

<div class="wrap">
    <div class="section-heading">
        <h2>Galeria</h2>
        <p>Bo prawdziwe beagle sa jeszcze slodsze niz rysunki.</p>
    </div>
    <div class="gallery">
        <img src="https://images.pexels.com/photos/5283623/pexels-photo-5283623.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Beagle lezacy w trawie" loading="lazy" />
        <img src="https://images.pexels.com/photos/38010/pexels-photo-38010.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Zblizenie na nos beagla" loading="lazy" />
        <img src="https://images.pexels.com/photos/13031400/pexels-photo-13031400.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Beagle na spacerze" loading="lazy" />
        <img src="https://images.pexels.com/photos/8593220/pexels-photo-8593220.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Dwa beagle odpoczywajace razem" loading="lazy" />
    </div>
    <p class="photo-credit">Zdjecia: <a href="https://www.pexels.com" target="_blank" rel="noopener">Pexels</a></p>
</div>

<footer class="site-footer">
    <div class="wrap">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Fanclub Jadzi 🐾
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
