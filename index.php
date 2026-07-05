<?php
/*
 * Samodzielny szablon (bez header.php/footer.php) - strona glowna sklepu
 * wedkarskiego: hero, kategorie, sekcja zaufania. Grafiki to wlasne,
 * samodzielne SVG (bez zewnetrznych obrazkow/serwisow).
 */
$shop_url = ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'shop' ) > 0 )
    ? get_permalink( wc_get_page_id( 'shop' ) )
    : '#';
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
<noscript><style>.category-card{opacity:1!important;transform:none!important;}</style></noscript>
</head>
<body <?php body_class(); ?>>

<div class="wrap">
    <nav class="site-nav">
        <div class="brand">
            <svg width="28" height="28" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="20" cy="24" rx="16" ry="9" style="fill:var(--accent)" />
                <polygon points="34,24 46,14 46,34" style="fill:var(--accent)" />
                <circle cx="12" cy="21" r="2" style="fill:var(--bg)" />
            </svg>
            Sklep Wedkarski
        </div>
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'items_wrap'     => '<ul>%3$s</ul>',
            'fallback_cb'    => 'sklep_wedkarski_fallback_menu',
        ) );
        ?>
    </nav>
</div>

<header class="hero">
    <div class="wrap">
    <div class="hero-grid">
        <div>
            <span class="badge">🎣 Sezon w pelni</span>
            <h1>Wszystko dla <em>wedkarza</em>, w jednym miejscu.</h1>
            <p>Wedki, kolowrotki, przynety i akcesoria wybrane przez ludzi, ktorzy
               sami spedzaja weekendy nad woda.</p>
            <div class="cta-row">
                <a class="btn btn-primary" href="<?php echo esc_url( $shop_url ); ?>">Zobacz oferte</a>
                <a class="btn btn-secondary" href="#dlaczego-my">Dlaczego my</a>
            </div>
        </div>
        <div class="hero-art">
            <svg viewBox="0 0 220 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="95" cy="60" rx="75" ry="38" style="fill:var(--accent)" />
                <polygon points="165,60 215,25 215,95" style="fill:var(--accent)" />
                <polygon points="90,25 110,25 100,5" style="fill:var(--accent-2)" />
                <circle cx="45" cy="50" r="7" style="fill:var(--bg)" />
                <circle cx="47" cy="50" r="3" style="fill:var(--accent-2)" />
                <path d="M20,72 Q40,92 70,86" stroke="var(--accent-2)" stroke-width="4" fill="none" stroke-linecap="round" />
                <path d="M0,110 Q30,95 60,110 T120,110 T180,110 T240,110" stroke="var(--border)" stroke-width="3" fill="none" />
            </svg>
        </div>
    </div>
    </div>
</header>

<div class="wrap" id="kategorie">
    <div class="section-heading">
        <h2>Kategorie</h2>
        <p>Zacznij od tego, czego akurat potrzebujesz.</p>
    </div>
    <div class="categories">

        <a class="category-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="40" height="40" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <line x1="6" y1="42" x2="40" y2="8" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />
                <path d="M40,8 Q44,20 36,28 Q30,34 34,40" stroke="var(--accent-2)" stroke-width="2" fill="none" />
            </svg>
            <h3>Wedki</h3>
            <p>Spinningowe, feederowe, muchowe.</p>
        </a>

        <a class="category-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="40" height="40" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="24" cy="24" r="16" fill="none" stroke="var(--accent)" stroke-width="3" />
                <circle cx="24" cy="24" r="5" style="fill:var(--accent-2)" />
                <line x1="24" y1="8" x2="24" y2="14" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />
                <line x1="24" y1="34" x2="24" y2="40" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />
                <line x1="8" y1="24" x2="14" y2="24" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />
                <line x1="34" y1="24" x2="40" y2="24" stroke="var(--accent)" stroke-width="3" stroke-linecap="round" />
            </svg>
            <h3>Kolowrotki</h3>
            <p>Od lekkich po surfcastingowe.</p>
        </a>

        <a class="category-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="40" height="40" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="22" cy="22" rx="14" ry="7" style="fill:var(--accent-2)" transform="rotate(-20 22 22)" />
                <circle cx="12" cy="16" r="2.5" style="fill:var(--bg-elevated)" />
                <path d="M30,28 Q34,36 28,40 Q24,42 26,38" stroke="var(--accent)" stroke-width="2.5" fill="none" stroke-linecap="round" />
            </svg>
            <h3>Przynety</h3>
            <p>Gumy, woblery, blachy, zywe.</p>
        </a>

        <a class="category-card" href="<?php echo esc_url( $shop_url ); ?>">
            <svg width="40" height="40" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="8" y="18" width="32" height="20" rx="3" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M16,18 V12 a4,4 0 0 1 4,-4 h8 a4,4 0 0 1 4,4 v6" fill="none" stroke="var(--accent)" stroke-width="3" />
                <line x1="8" y1="28" x2="40" y2="28" stroke="var(--accent-2)" stroke-width="2" />
            </svg>
            <h3>Akcesoria</h3>
            <p>Skrzynki, siatki, podbieraki.</p>
        </a>

    </div>
</div>

<div class="trust" id="dlaczego-my">
    <div class="wrap trust-grid">
        <div class="trust-item">
            <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="4" y="16" width="24" height="16" rx="2" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M28,22 h10 l6,6 v4 h-16 z" fill="none" stroke="var(--accent)" stroke-width="3" />
                <circle cx="14" cy="36" r="4" style="fill:var(--accent-2)" />
                <circle cx="36" cy="36" r="4" style="fill:var(--accent-2)" />
            </svg>
            <div>
                <h4>Szybka wysylka</h4>
                <p>Zamowienia zlozone do 14:00 wysylamy tego samego dnia.</p>
            </div>
        </div>
        <div class="trust-item">
            <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M24,4 L40,10 V22 C40,34 32,42 24,44 C16,42 8,34 8,22 V10 Z" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M16,24 L21,29 L32,17" fill="none" stroke="var(--accent-2)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div>
                <h4>Sprawdzona jakosc</h4>
                <p>Sprzet, ktory sami testujemy nad woda, zanim trafi do oferty.</p>
            </div>
        </div>
        <div class="trust-item">
            <svg width="32" height="32" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M6,10 h36 v22 h-22 l-8,8 v-8 h-6 z" fill="none" stroke="var(--accent)" stroke-width="3" stroke-linejoin="round" />
                <circle cx="16" cy="21" r="2" style="fill:var(--accent-2)" />
                <circle cx="24" cy="21" r="2" style="fill:var(--accent-2)" />
                <circle cx="32" cy="21" r="2" style="fill:var(--accent-2)" />
            </svg>
            <div>
                <h4>Doradztwo eksperckie</h4>
                <p>Napisz, jaka ryba i lowisko - podpowiemy dobor sprzetu.</p>
            </div>
        </div>
    </div>
</div>

<div class="wrap">
<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_title( '<h2>', '</h2>' );
        the_content();
    endwhile;
endif;
?>
</div>

<div class="status-strip">
    Wersja motywu: <strong><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></strong>
</div>

<footer class="site-footer">
    <div class="wrap">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Sklep Wedkarski
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
