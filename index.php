<?php
/*
 * Samodzielny szablon (bez header.php/footer.php) - strona glowna
 * Fanclubu Jadzi. Grafiki to wlasne, samodzielne SVG (bez zewnetrznych
 * obrazkow/serwisow).
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo( 'name' ); ?></title>
<?php wp_head(); ?>
<noscript><style>.fact-card{opacity:1!important;transform:none!important;}</style></noscript>
</head>
<body <?php body_class(); ?>>

<div class="sniff-strip" aria-hidden="true">
    <svg viewBox="0 0 230 120" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="100" cy="75" rx="55" ry="26" style="fill:var(--accent)" />
        <line x1="70" y1="95" x2="65" y2="115" stroke="var(--accent)" stroke-width="8" stroke-linecap="round" />
        <line x1="90" y1="98" x2="88" y2="118" stroke="var(--accent)" stroke-width="8" stroke-linecap="round" />
        <line x1="130" y1="98" x2="132" y2="118" stroke="var(--accent)" stroke-width="8" stroke-linecap="round" />
        <line x1="150" y1="95" x2="155" y2="115" stroke="var(--accent)" stroke-width="8" stroke-linecap="round" />
        <g class="beagle-tail">
            <path d="M50,65 Q30,50 38,30" stroke="var(--accent)" stroke-width="8" fill="none" stroke-linecap="round" />
        </g>
        <g class="beagle-head">
            <ellipse cx="155" cy="68" rx="13" ry="24" style="fill:var(--accent)" transform="rotate(20 155 68)" />
            <circle cx="168" cy="55" r="26" style="fill:#f2dcb8" />
            <circle cx="176" cy="48" r="3" style="fill:#2a1a10" />
            <ellipse cx="192" cy="62" rx="15" ry="10" style="fill:#fff8ec" transform="rotate(20 192 62)" />
            <circle cx="203" cy="66" r="4.5" style="fill:#2a1a10" />
            <g class="sniff-line">
                <path d="M210,58 Q216,52 212,46" stroke="var(--accent-2)" stroke-width="2" fill="none" stroke-linecap="round" />
            </g>
            <g class="sniff-line">
                <path d="M214,64 Q222,60 220,52" stroke="var(--accent-2)" stroke-width="2" fill="none" stroke-linecap="round" />
            </g>
            <g class="sniff-line">
                <path d="M208,68 Q214,74 210,80" stroke="var(--accent-2)" stroke-width="2" fill="none" stroke-linecap="round" />
            </g>
        </g>
    </svg>
</div>

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
            Fanclub Jadzi
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
    <div class="hero-grid">
        <div>
            <span class="badge">🐾 Oficjalny fanklub</span>
            <h1>Witaj w fanklubie <em>Jadzi</em>!</h1>
            <p>Beagla, ktora rzadzi kanapa, kradnie skarpetki i kocha
               kazdego, kto ma przy sobie przekaske.</p>
            <div class="cta-row">
                <a class="btn btn-primary" href="#dolacz">Dolacz do fanklubu</a>
                <a class="btn btn-secondary" href="#o-jadzi">Poznaj Jadzie</a>
            </div>
        </div>
        <div class="hero-art">
            <svg viewBox="0 0 240 220" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="55" cy="115" rx="35" ry="55" style="fill:var(--accent)" transform="rotate(-15 55 115)" />
                <ellipse cx="185" cy="115" rx="35" ry="55" style="fill:var(--accent)" transform="rotate(15 185 115)" />
                <ellipse cx="120" cy="112" rx="68" ry="62" style="fill:#f2dcb8" />
                <path d="M60,80 Q120,40 180,80 Q170,55 120,50 Q70,55 60,80 Z" style="fill:var(--accent)" />
                <ellipse cx="90" cy="108" rx="16" ry="13" style="fill:#a5652a" />
                <ellipse cx="150" cy="108" rx="16" ry="13" style="fill:#a5652a" />
                <circle cx="93" cy="107" r="8" style="fill:#2a1a10" />
                <circle cx="147" cy="107" r="8" style="fill:#2a1a10" />
                <circle cx="90" cy="104" r="2" style="fill:#fff" />
                <circle cx="144" cy="104" r="2" style="fill:#fff" />
                <ellipse cx="120" cy="142" rx="32" ry="24" style="fill:#fff8ec" />
                <ellipse cx="120" cy="130" rx="10" ry="7" style="fill:#2a1a10" />
                <path d="M100,152 Q120,166 140,152" stroke="#2a1a10" stroke-width="3" fill="none" stroke-linecap="round" />
                <ellipse cx="120" cy="166" rx="8" ry="14" style="fill:var(--accent-2)" />
            </svg>
        </div>
    </div>
    </div>
</header>

<div class="wrap">
    <div class="fact-of-the-day">
        <span class="fact-of-the-day-label">🐾 Ciekawostka o psach</span>
        <p id="dog-fact">Ladowanie ciekawostki...</p>
        <button type="button" id="dog-fact-refresh" class="btn btn-secondary">Losuj kolejna</button>
    </div>
</div>

<div class="wrap" id="o-jadzi">
    <div class="section-heading">
        <h2>O Jadzi</h2>
        <p>Kilka twardych faktow, ktorych nie da sie podwazyc.</p>
    </div>
    <div class="facts">

        <div class="fact-card">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="6" y="10" width="36" height="32" rx="4" fill="none" stroke="var(--accent)" stroke-width="3" />
                <line x1="6" y1="20" x2="42" y2="20" stroke="var(--accent)" stroke-width="3" />
                <line x1="15" y1="6" x2="15" y2="14" stroke="var(--accent-2)" stroke-width="3" stroke-linecap="round" />
                <line x1="33" y1="6" x2="33" y2="14" stroke="var(--accent-2)" stroke-width="3" stroke-linecap="round" />
            </svg>
            <h3>Wiek</h3>
            <p>3 lata (psio-dorosla, duchem szczeniak)</p>
        </div>

        <div class="fact-card">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="24" cy="30" rx="12" ry="9" style="fill:var(--accent)" />
                <ellipse cx="12" cy="16" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="22" cy="10" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="34" cy="12" rx="5" ry="6" style="fill:var(--accent)" />
                <ellipse cx="40" cy="20" rx="5" ry="6" style="fill:var(--accent)" />
            </svg>
            <h3>Rasa</h3>
            <p>Beagle, 100% nosa, 0% skruchy</p>
        </div>

        <div class="fact-card">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="24" cy="24" r="16" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M10,16 Q24,24 10,32" stroke="var(--accent-2)" stroke-width="2" fill="none" />
                <path d="M38,16 Q24,24 38,32" stroke="var(--accent-2)" stroke-width="2" fill="none" />
            </svg>
            <h3>Ulubiona zabawka</h3>
            <p>Piszcząca piłka (jedna konkretna, zawsze ta sama)</p>
        </div>

        <div class="fact-card">
            <svg width="36" height="36" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <polygon points="26,4 12,26 22,26 18,44 38,20 26,20" style="fill:var(--accent-2)" />
            </svg>
            <h3>Supermoc</h3>
            <p>Wyczuwa otwieranie lodowki z dwoch pieter</p>
        </div>

    </div>
</div>

<div class="love">
    <div class="wrap love-grid">
        <div class="love-item">
            <svg width="30" height="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M24,42 C10,32 4,22 4,14 C4,7 9,3 15,3 C19,3 22,5 24,9 C26,5 29,3 33,3 C39,3 44,7 44,14 C44,22 38,32 24,42 Z" style="fill:var(--accent-2)" />
            </svg>
            <div>
                <h4>Zawsze wesola</h4>
                <p>Ogon w gorze od momentu otwarcia oczu do zgaszenia swiatla.</p>
            </div>
        </div>
        <div class="love-item">
            <svg width="30" height="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <ellipse cx="24" cy="30" rx="20" ry="10" fill="none" stroke="var(--accent)" stroke-width="3" />
                <path d="M8,30 Q8,40 24,40 Q40,40 40,30" fill="none" stroke="var(--accent)" stroke-width="3" />
            </svg>
            <div>
                <h4>Milosc do jedzenia</h4>
                <p>Miska pusta od trzech godzin? Dla niej to katastrofa humanitarna.</p>
            </div>
        </div>
        <div class="love-item">
            <svg width="30" height="30" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M34,6 C24,6 16,14 16,24 C16,34 24,42 34,42 C37,42 40,41 42,40 C36,37 32,31 32,24 C32,17 36,11 42,8 C40,7 37,6 34,6 Z" style="fill:var(--accent)" />
            </svg>
            <div>
                <h4>Ekspertka od drzemek</h4>
                <p>Potrafi spac w pozycjach, ktore lamia prawa fizyki.</p>
            </div>
        </div>
    </div>
</div>

<div class="join" id="dolacz">
    <div class="wrap">
        <h2>Dolacz do fanklubu</h2>
        <p>Zero skladek, zero spotkan. Wystarczy kochac Jadzie tak jak my.</p>
        <a class="btn btn-primary" href="#o-jadzi">Jestem fanem/fanka</a>
    </div>
</div>

<div class="status-strip">
    Wersja motywu: <strong><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></strong>
</div>

<footer class="site-footer">
    <div class="wrap">
        &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — Fanclub Jadzi 🐾
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
