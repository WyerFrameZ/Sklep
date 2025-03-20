# Zdockeryzowana aplikacja sklepu

## Instrukcje uruchomienia

### Krok 1: Sklonuj repozytorium
```bash
# Upewnij się, że jesteś w odpowiednim katalogu
cd /var/www/siegh.pl
```

### Krok 2: Przygotuj pliki Dockera
```bash
# Skopiuj pliki z folderu docker-files do głównego katalogu
cp docker-files/Dockerfile .
cp docker-files/docker-compose.yml .
mkdir -p docker-entrypoint-initdb.d
cp docker-files/setup.sql docker-entrypoint-initdb.d/
```

### Krok 3: Uruchom kontenery Docker
```bash
# Uruchom kontenery w tle
docker-compose up -d
```

### Krok 4: Dostęp do aplikacji
- Aplikacja będzie dostępna pod adresem: http://localhost:95
- Dane logowania do przykładowego konta:
  - Login: test
  - Hasło: test123

### Krok 5: Zatrzymanie kontenerów
```bash
# Zatrzymaj kontenery gdy nie są potrzebne
docker-compose down
```

## Struktura projektu
- `public_html/` - pliki aplikacji PHP
- `docker-files/` - pliki konfiguracyjne Dockera
  - `Dockerfile` - konfiguracja kontenera PHP/Apache
  - `docker-compose.yml` - definicja usług (web + baza danych)
  - `setup.sql` - skrypt inicjalizujący bazę danych

## Informacje o bazach danych
- Baza danych MySQL dostępna jest na porcie 3307
- Nazwa bazy: sklep
- Użytkownik: root
- Hasło: ZSKZSKZSK 