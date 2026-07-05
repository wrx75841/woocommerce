# WordPress + WooCommerce (Docker) — środowisko testowe

## 1. Pierwsze uruchomienie

```bash
cp .env.example .env      # opcjonalne - domyślne wartości działają bez tego
docker compose up -d
```

Poczekaj ~30-60 sekund, aż kontener `wpcli` zainstaluje WordPress i WooCommerce automatycznie
(healthcheck bazy + skrypt `wpcli/wp-init.sh` czekają aktywnie, więc zwykle jest to szybsze
i pewniejsze niż w poprzedniej wersji ze sztywnym `sleep 20`).

Postęp możesz podejrzeć:

```bash
docker compose logs -f wpcli
```

Jak zobaczysz `Gotowe!` — wszystko stoi.

## 2. Dostęp lokalny

- Sklep: http://localhost:8080
- Panel admina: http://localhost:8080/wp-admin
  - login: `admin`
  - hasło: `admin123`

(Port i dane logowania można zmienić w `.env` — patrz `.env.example`.)

## 3. Wystawienie na świat (np. żeby WooCommerce.com mógł się podłączyć)

WooCommerce.com wymaga publicznego adresu HTTPS, więc `localhost` nie wystarczy.

### Opcja A: wbudowany profil ngrok (najprostsze, przetrwa restart VM)

1. Uzupełnij `NGROK_AUTHTOKEN` w `.env` (token z https://dashboard.ngrok.com/get-started/your-authtoken).
2. Jeśli masz zarezerwowaną, stałą domenę na koncie ngrok, wpisz ją do `NGROK_DOMAIN` w `.env`
   (bez tego trzeba by usunąć linię `--url=${NGROK_DOMAIN}` z usługi `ngrok`
   w `docker-compose.yml`, a adres byłby losowy przy każdym starcie).
3. Uruchom **raz**:
   ```bash
   docker compose --profile public up -d
   ```
   To dodatkowo odpali kontener `wp_ngrok`, tunelujący ruch bezpośrednio do kontenera WordPress
   (bez przechodzenia przez port hosta).
4. Publiczny adres znajdziesz w logach: `docker compose logs -f ngrok` albo pod
   http://localhost:4040 (panel ngrok).

**Dlaczego wystarczy uruchomić to raz:** usługa `ngrok` ma ustawione `restart: unless-stopped`,
tak samo jak `wordpress` i `db`. Po utworzeniu kontenera Docker sam go odpali ponownie przy
starcie usługi Dockera (np. po restarcie VM) — nie trzeba za każdym razem powtarzać komendy
z `--profile public`. Żeby świadomie zatrzymać wszystko razem z ngrok, użyj
`docker compose --profile public down` (patrz sekcja 4).

> Jeśli wcześniej uruchamiałeś ngrok jako osobny proces bezpośrednio w systemie (`ngrok http ...`),
> zatrzymaj go (`pkill ngrok` albo Ctrl+C) przed odpaleniem wersji kontenerowej — obie instancje
> nie mogą jednocześnie trzymać tej samej domeny (błąd `ERR_NGROK_334`).

### Opcja B: ngrok zainstalowany lokalnie na hoście

```bash
ngrok http 8080
```

Działa tak samo jak Opcja A, tylko tunel prowadzi przez port hosta zamiast bezpośrednio
do kontenera.

### WAŻNE — czego już NIE trzeba robić

We wcześniejszej wersji tego środowiska trzeba było ręcznie nadpisywać `siteurl`/`home`
w bazie WordPressa po każdym restarcie ngrok (bo darmowy plan generuje nowy adres za każdym
razem), inaczej linki/zasoby wskazywały na `localhost` i strona/API nie działały poprawnie
pod publicznym adresem.

**To już nieaktualne.** `docker-compose.yml` wstrzykuje do `wp-config.php` kod
(`WORDPRESS_CONFIG_EXTRA`), który wykrywa adres z każdego żądania HTTP i ustawia
`WP_HOME`/`WP_SITEURL` dynamicznie. Dzięki temu ta sama instalacja działa poprawnie
jednocześnie pod `http://localhost:8080` i pod dowolnym publicznym adresem (ngrok,
cloudflared, itp.) — bez żadnej ręcznej interwencji.

### Uwaga: ekran ostrzegawczy ngrok (darmowy plan)

Przy pierwszym wejściu z nowej przeglądarki na adres `*.ngrok-free.app`/`*.ngrok-free.dev`
zobaczysz stronę ostrzegawczą ngrok ("You are about to visit...") — to normalne, kliknij
**Visit Site**, żeby przejść dalej. Dla żądań programistycznych (curl/API/fetch) można to
pominąć nagłówkiem `ngrok-skip-browser-warning: true`.

### Uwaga: maszyny wirtualne (VirtualBox itp.)

Jeśli Docker działa wewnątrz maszyny wirtualnej w trybie NAT, dostęp do
`http://localhost:8080` z przeglądarki na hoście (fizycznym systemie) wymaga dodania
reguły Port Forwarding w ustawieniach sieci VM (host port 8080 → guest port 8080).
Tunel ngrok/cloudflared tego nie wymaga — łączy się wychodząco z wnętrza maszyny.

## 4. Zatrzymanie / sprzątanie

```bash
docker compose down                          # zatrzymuje kontenery, dane zostają
docker compose --profile public down         # to samo, ale gasi też ngrok
docker compose down -v                       # usuwa też wolumeny (pełny reset)
```

Pełne, dogłębne czyszczenie (obrazy, wolumeny, ngrok, cache) — patrz `cleanup-env-full.sh`.

## 5. Alternatywa dla ngrok: Cloudflare Tunnel

```bash
cloudflared tunnel --url http://localhost:8080
```

Działa analogicznie — dostajesz publiczny HTTPS URL, a dynamiczne wykrywanie adresu
(opisane w sekcji 3) zadziała tak samo jak z ngrok.

## 6. Struktura projektu

```
docker-compose.yml    - definicja calego srodowiska (db, wordpress, wpcli, ngrok)
.env.example           - szablon konfiguracji (skopiuj do .env)
wpcli/Dockerfile        - obraz kontenera instalacyjnego (bazuje na wordpress:cli)
wpcli/wp-init.sh        - skrypt instalujacy WordPress + WooCommerce (idempotentny)
cleanup-env-full.sh     - pelne czyszczenie srodowiska
```
