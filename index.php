<?php
/*
 * Minimalny, samodzielny szablon (bez header.php/footer.php - to jedyny
 * plik szablonu w tym testowym motywie).
 *
 * Jesli widzisz ponizszy napis na stronie - wdrozenie z Git dzialalo.
 * Zmien napis, zrob "git push" i sprawdz, czy zmiana pojawila sie na
 * serwerze po zadzialaniu webhooka.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<p>DEPLOY TEST v1 - jesli to widzisz, wdrozenie zadzialalo.</p>

<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_title( '<h2>', '</h2>' );
        the_content();
    endwhile;
endif;

wp_footer();
?>
</body>
</html>
