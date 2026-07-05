#!/usr/bin/env python3
"""
Prosty test połączenia z WooCommerce REST API.
Sprawdza czy klucze działają i wypisuje kilka pierwszych produktów.

Wartości domyślne wczytywane są automatycznie z pliku .env w tym samym
katalogu (te same zmienne, co w docker-compose.yml):
    WOOCOMMERCE_CONSUMER_KEY, WOOCOMMERCE_CONSUMER_SECRET,
    NGROK_DOMAIN (jesli ustawiony, uzywany jako adres publiczny), WP_PORT.

Mozna je nadpisac recznie, np. zeby wymusic adres lokalny zamiast ngrok:
    WC_URL="http://localhost:8080" python3 deploy-test.py

Uzycie:
    python3 deploy-test.py
"""

import os
import sys
import requests

SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))


def load_env_file(path):
    """Wczytuje proste pary KEY=VALUE z pliku .env, nie nadpisujac zmiennych
    juz ustawionych w srodowisku (np. recznym eksportem przed uruchomieniem)."""
    if not os.path.isfile(path):
        return
    with open(path, encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith("#") or "=" not in line:
                continue
            key, _, value = line.partition("=")
            os.environ.setdefault(key.strip(), value.strip())


load_env_file(os.path.join(SCRIPT_DIR, ".env"))

CONSUMER_KEY = os.environ.get("WOOCOMMERCE_CONSUMER_KEY")
CONSUMER_SECRET = os.environ.get("WOOCOMMERCE_CONSUMER_SECRET")

if not CONSUMER_KEY or not CONSUMER_SECRET:
    print("BŁĄD: brak WOOCOMMERCE_CONSUMER_KEY / WOOCOMMERCE_CONSUMER_SECRET w .env")
    sys.exit(1)

# Domyslnie: jesli w .env jest NGROK_DOMAIN, testujemy przez publiczny tunel;
# w przeciwnym razie lokalnie pod WP_PORT (tak jak w docker-compose.yml).
if os.environ.get("NGROK_DOMAIN"):
    _default_url = f"https://{os.environ['NGROK_DOMAIN']}"
else:
    _default_url = f"http://localhost:{os.environ.get('WP_PORT', '8080')}"

WC_URL = os.environ.get("WC_URL", _default_url).rstrip("/")

# Naglowek na wypadek gdyby adres szedl przez ngrok (darmowy plan blokuje inaczej requesty programistyczne)
HEADERS = {
    "ngrok-skip-browser-warning": "true",
}


def main():
    url = f"{WC_URL}/wp-json/wc/v3/products"
    params = {
        "consumer_key": CONSUMER_KEY,
        "consumer_secret": CONSUMER_SECRET,
        "per_page": 5,
    }

    print(f"-> Łączę się z: {url}")

    try:
        resp = requests.get(url, params=params, headers=HEADERS, timeout=15)
    except requests.exceptions.RequestException as e:
        print(f"BŁĄD połączenia: {e}")
        sys.exit(1)

    print(f"-> Status HTTP: {resp.status_code}")

    if resp.status_code != 200:
        print("BŁĄD: odpowiedź serwera:")
        print(resp.text[:1000])
        sys.exit(1)

    products = resp.json()
    print(f"\nOK — połączenie działa. Znaleziono {len(products)} produkt(ów) (max 5 pokazanych):\n")

    if not products:
        print("  (sklep jest pusty — to normalne przy świeżej instalacji)")
    else:
        for p in products:
            print(f"  - [{p.get('sku') or 'brak SKU'}] {p.get('name')} — {p.get('price')} PLN (id={p.get('id')})")


if __name__ == "__main__":
    main()
