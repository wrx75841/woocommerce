#!/bin/bash
set -e

# ==========================================================
# cleanup-env-full.sh
# Pełne, dogłębne czyszczenie środowiska testowego WP+WooCommerce:
# - kontenery, wolumeny, sieci Dockera
# - obrazy Dockera pobrane na potrzeby tego projektu
# - nieużywane zasoby Dockera (dangling images, build cache)
# - proces ngrok + jego logi i konfiguracja
# Po tym skrypcie nie powinno zostać nic związane z tym projektem.
# ==========================================================

cd "$(dirname "$0")"

echo "=== 1. Zatrzymuję i usuwam kontenery, wolumeny, sieci (z tego projektu) ==="
docker compose down -v --remove-orphans

echo "=== 2. Usuwam obrazy Dockera użyte w projekcie ==="
docker image rm -f wordpress:latest mysql:8.0 wordpress:cli wp-woo-wpcli:local ngrok/ngrok:latest 2>/dev/null || echo "Niektóre obrazy już nie istniały."

echo "=== 3. Sprzątam osierocone/nieużywane zasoby Dockera (dangling images, build cache) ==="
docker system prune -f

echo "=== 4. Zatrzymuję ngrok (jeśli działa) ==="
pkill ngrok 2>/dev/null && echo "ngrok zatrzymany." || echo "ngrok nie był uruchomiony."

echo "=== 5. Usuwam logi i lokalne pliki wygenerowane w projekcie ==="
rm -f ngrok.log

echo "=== 6. Usuwam konfigurację/token ngrok z systemu ==="
read -p "Usunąć też konfigurację ngrok (authtoken, ~/.config/ngrok)? (t/n): " ANSWER
if [[ "$ANSWER" == "t" || "$ANSWER" == "T" ]]; then
    rm -rf "$HOME/.config/ngrok" "$HOME/.ngrok2" 2>/dev/null
    echo "Konfiguracja ngrok usunięta. Trzeba będzie ponownie dodać authtoken przy kolejnym użyciu."
else
    echo "Zostawiam konfigurację ngrok."
fi

echo ""
echo "=== 7. Weryfikacja - sprawdź czy coś zostało ==="
echo "--- Kontenery: ---"
docker ps -a --filter "name=wp_"
echo "--- Wolumeny: ---"
docker volume ls | grep -E "wp-woo|wp_data|db_data" || echo "brak"
echo "--- Sieci: ---"
docker network ls | grep wpnet || echo "brak"
echo "--- Proces ngrok: ---"
pgrep -a ngrok || echo "brak"

echo ""
echo "=== Sprzątanie zakończone. Środowisko wyczyszczone bez śladu. ==="
