<?php
/*
Template Name: Sklep
 *
 * Osobna strona "Sklep dla zwierzat" (nie na stronie glownej). Dziala
 * automatycznie dla strony WordPressa o adresie /sklep/ (konwencja
 * page-{slug}.php), a dodatkowo mozna ja recznie wybrac w Atrybutach
 * strony jako szablon "Sklep" (naglowek Template Name powyzej).
 */
$shop_url = ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'shop' ) > 0 )
    ? get_permalink( wc_get_page_id( 'shop' ) )
    : '#';
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo( 'name' ); ?> — Sklep dla zwierzat</title>
<?php wp_head(); ?>
<noscript><style>.fact-card{opacity:1!important;transform:none!important;}</style></noscript>
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

<header class="hero">
    <div class="wrap">
    <div class="section-heading">
        <span class="badge">🛍️ Poleca Jadzia</span>
        <h2>Sklep dla zwierzat</h2>
        <p>Rzeczy, ktore Jadzia osobiscie przetestowala i zatwierdzila (glownie zebami).</p>
    </div>
    </div>
</header>

<div class="wrap">
    <div class="facts">

        <a class="fact-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="24" cy="24" r="16" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M10,16 Q24,24 10,32" stroke="var(--accent-2)" stroke-width="2" fill="none" />
                <path d="M38,16 Q24,24 38,32" stroke="var(--accent-2)" stroke-width="2" fill="none" />
            </svg>
            <h3>Zabawki</h3>
            <p>Piszczace pilki, liny, gryzaki.</p>
        </a>

        <a class="fact-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M12,20 a6,6 0 1,1 8,8 L30,36 a6,6 0 1,1 8,8 a6,6 0 1,1 -8,-8 L20,28 a6,6 0 1,1 -8,-8 a6,6 0 1,1 8,-8 z" fill="none" stroke="var(--accent)" stroke-width="3" stroke-linejoin="round" />
            </svg>
            <h3>Przysmaki</h3>
            <p>Kruche, chrupiace, znikaja w 3 sekundy.</p>
        </a>

        <a class="fact-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="6" y="24" width="36" height="14" rx="6" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M10,24 V18 a6,6 0 0 1 12,0 v6" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M26,24 V18 a6,6 0 0 1 12,0 v6" fill="none" stroke="var(--accent)" stroke-width="3" />
            </svg>
            <h3>Legowiska</h3>
            <p>Miekkie, cieple, idealne na 18 godzin spania.</p>
        </a>

        <a class="fact-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="24" cy="24" r="17" fill="none" stroke="var(--accent)" stroke-width="4" />
                <circle cx="24" cy="7" r="3.5" style="fill:var(--accent-2)" />
            </svg>
            <h3>Obroze i smycze</h3>
            <p>Wygodne, kolorowe, na kazda okazje.</p>
        </a>

    </div>
</div>

<footer class="site-footer">
    <div class="wrap">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Fanclub Jadzi 🐾
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
