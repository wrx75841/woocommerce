# Dockerfile dla kontenera wp_cli.
#
# Bazujemy na oficjalnym obrazie wordpress:cli (ma juz zainstalowane WP-CLI
# i PHP w odpowiedniej wersji). Doklejamy wlasny skrypt inicjalizujacy
# (wp-init.sh), zamiast trzymac cala logike instalacji WP+WooCommerce
# w jednej dlugiej linii "command" w docker-compose.yml - dzieki temu
# latwiej to czytac, debugowac i modyfikowac.
FROM wordpress:cli

# Obraz wordpress:cli domyslnie uruchamia sie jako user "www-data" - do
# skopiowania pliku i nadania uprawnien potrzebujemy chwilowo roota.
USER root

COPY wp-init.sh /usr/local/bin/wp-init.sh
RUN chmod +x /usr/local/bin/wp-init.sh

# Komendy wp-cli i tak wywolujemy z flaga --allow-root w wp-init.sh,
# bo katalog /var/www/html (wolumen wspoldzielony z kontenerem wordpress)
# nalezy do www-data z tamtego kontenera.
ENTRYPOINT ["/usr/local/bin/wp-init.sh"]
