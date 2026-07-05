#!/bin/sh
# wp-init.sh
#
# Jednorazowa inicjalizacja srodowiska WordPress + WooCommerce.
# Uruchamiane jako ENTRYPOINT kontenera wp_cli przy KAZDYM starcie,
# ale wszystkie kroki sa idempotentne (bezpieczne do wielokrotnego
# uruchomienia) - jesli WP/WooCommerce sa juz zainstalowane, skrypt
# tylko to potwierdzi i zakonczy dzialanie.
set -e

WP_PATH=/var/www/html

echo "== [1/3] Czekam, az pliki WordPressa (wp-load.php) beda gotowe =="
until [ -f "$WP_PATH/wp-load.php" ]; do
  echo "   ...jeszcze nie ma wp-load.php, czekam 3s"
  sleep 3
done

echo "== [2/3] Instaluje WordPress (petla sama czeka na baze, jesli jeszcze nie zainstalowany) =="
# UWAGA: nie ma tu osobnego "czekania na baze" przed instalacja - i celowo.
# Proba nr 1: "wp db check" shelluje sie do zewnetrznego klienta
# mariadb-check, ktory z MySQL 8 (self-signed certyfikat TLS) domyslnie
# rzuca blad weryfikacji certyfikatu.
# Proba nr 2: "wp eval ... $wpdb->check_connection()" wymaga, zeby WordPress
# byl juz zainstalowany (tabele istnialy) - inaczej wp-cli i tak zwraca
# blad "site not installed", czyli klasyczny problem jajka i kury.
# Dlatego po prostu probujemy "wp core install" w petli: kazda nieudana
# proba (baza jeszcze nie odpowiada) konczy sie bledem, czekamy 3s i
# probujemy ponownie - az do skutku. To samo w sobie jest "czekaniem na
# baze", bez dodatkowego, zawodnego kroku.
if wp core is-installed --allow-root --path="$WP_PATH" 2>/dev/null; then
  echo "   WordPress juz zainstalowany - pomijam."
else
  # --url ustawiamy tylko jako wartosc startowa w bazie. Realny adres, pod
  # ktorym strona dziala (lokalnie i/lub przez tunel typu ngrok), jest
  # wyliczany dynamicznie przez WORDPRESS_CONFIG_EXTRA w docker-compose.yml
  # - patrz komentarz przy tej zmiennej.
  until wp core install \
    --allow-root \
    --path="$WP_PATH" \
    --url="${WP_URL:-http://localhost:8080}" \
    --title="${WP_TITLE:-Test Store}" \
    --admin_user="${WP_ADMIN_USER:-admin}" \
    --admin_password="${WP_ADMIN_PASSWORD:-admin123}" \
    --admin_email="${WP_ADMIN_EMAIL:-admin@example.com}" \
    --skip-email 2>/tmp/wp-install-error.log
  do
    echo "   ...baza/instalacja jeszcze niegotowa, czekam 3s"
    cat /tmp/wp-install-error.log
    sleep 3
  done
  echo "   WordPress zainstalowany."
fi

echo "== [3/4] Instaluje i aktywuje WooCommerce (jesli jeszcze nie) =="
if wp plugin is-installed woocommerce --allow-root --path="$WP_PATH" 2>/dev/null; then
  wp plugin is-active woocommerce --allow-root --path="$WP_PATH" 2>/dev/null \
    || wp plugin activate woocommerce --allow-root --path="$WP_PATH"
  echo "   WooCommerce juz obecny i aktywny - pomijam instalacje."
else
  wp plugin install woocommerce --activate --allow-root --path="$WP_PATH"
  echo "   WooCommerce zainstalowany i aktywowany."
fi

echo "== [4/4] Ustawiam 'ladne' permalinki i zapisuje regoly do .htaccess (wymagane przez WooCommerce REST API) =="
# UWAGA: zwykle "wp rewrite flush" wystarczy, ale z poziomu WP-CLI (PHP w
# trybie CLI, nie jako modul Apache) funkcja WordPressa got_mod_rewrite()
# zawsze zwraca false - bo sprawdza obecnosc mod_rewrite przez
# apache_get_modules(), ktora istnieje TYLKO gdy PHP dziala wewnatrz Apache.
# Efekt: "wp rewrite flush" cicho nie zapisuje regul do .htaccess, mimo ze
# mod_rewrite w kontenerze wordpress jest wlaczony i dziala. Dlatego regoly
# zapisujemy bezposrednio, z pominieciem tej blednej blokady.
wp rewrite structure '/%postname%/' --hard --allow-root --path="$WP_PATH" >/dev/null
wp eval '
require_once ABSPATH . "wp-admin/includes/misc.php";
global $wp_rewrite;
$rules = explode( "\n", $wp_rewrite->mod_rewrite_rules() );
insert_with_markers( ABSPATH . ".htaccess", "WordPress", $rules );
' --allow-root --path="$WP_PATH"
echo "   Permalinki i .htaccess ustawione."

echo ""
echo "== Gotowe! =="
echo "   Lokalnie:  ${WP_URL:-http://localhost:8080}/wp-admin"
echo "   Login:     ${WP_ADMIN_USER:-admin} / ${WP_ADMIN_PASSWORD:-admin123}"
echo "   (Adres publiczny, jesli uzywasz ngrok/cloudflared, wykrywa sie automatycznie)"
