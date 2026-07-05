<?php
/*
 * Samodzielny szablon (bez header.php/footer.php - to jedyny plik
 * szablonu w tym testowym motywie), z prawdziwa strona zamiast golego
 * napisu - do wizualnej weryfikacji, ze wdrozenie z Git faktycznie
 * podmienia pliki na serwerze.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
<noscript><style>.feature-card{opacity:1!important;transform:none!important;}</style></noscript>
</head>
<body <?php body_class(); ?>>

<div class="wrap">
    <nav class="site-nav">
        <div class="brand">Test<span>Deploy</span></div>
        <ul>
            <li><a href="#features">Funkcje</a></li>
            <li><a href="#status">Status</a></li>
        </ul>
    </nav>
</div>

<header class="hero">
    <div class="wrap">
        <span class="badge">🚀 Motyw dziala</span>
        <h1>Git push. <em>Automatyczny deploy.</em><br>Gotowe.</h1>
        <p>Ten motyw sluzy do weryfikacji, ze zmiany wypchniete do repozytorium
           GitHub trafiaja na serwer bez recznej ingerencji.</p>
        <div class="cta-row">
            <a class="btn btn-primary" href="https://github.com/wrx75841/woocommerce" target="_blank" rel="noopener">Zobacz repo</a>
            <a class="btn btn-secondary" href="#status">Sprawdz status</a>
        </div>
    </div>
</header>

<div class="wrap" id="features">
    <div class="features">
        <div class="feature-card">
            <div class="icon"></div>
            <h3>Git jako zrodlo prawdy</h3>
            <p>Kazda zmiana w kodzie motywu zaczyna sie od commita, nie od
               recznej edycji plikow na serwerze.</p>
        </div>
        <div class="feature-card">
            <div class="icon"></div>
            <h3>Webhook przy pushu</h3>
            <p>GitHub powiadamia wtyczke deployujaca natychmiast po pushu do
               brancha main.</p>
        </div>
        <div class="feature-card">
            <div class="icon"></div>
            <h3>Zero przestojow</h3>
            <p>Pliki motywu podmieniane sa automatycznie, bez recznego
               logowania sie na serwer.</p>
        </div>
    </div>
</div>

<div class="status-strip" id="status">
    Wersja motywu: <strong><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></strong>
    &middot; Jesli widzisz te strone po pushu - deploy zadzialal.
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

<footer class="site-footer">
    <div class="wrap">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Test Deploy Theme
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
