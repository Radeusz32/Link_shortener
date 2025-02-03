# LinkShortener

## Cele Projektu
Projekt ma na celu tworzenie skróconych, unikalnych linków URL w oparciu o link bazowy.
Przykład działania:
youtube.pl -> ye21.pl

## Technologie
- **JavaScript**
- **PHP**
- **Laravel**
- **Vue.js**

## Opis Projektu
1. **Dodawanie Książek i Recenzji**
   - Po utworzeniu linku jest on automatycznie aktualizowany na liście linków na podstawie zawartości bazy danych.
   - 
2. **Baza Danych**
   - Wszystkie dodane linki są na bieżąco zapisywane w bazie danych.


## Jak Uruchomić Projekt?
1. **Sklonuj repozytorium**:
   ```sh
   git clone https://github.com/Link_shortener.git
   cd virtual-library

2. **Zainstaluj zależności backendowe**:
   ```sh
   composer install
3. **Zainstaluj zależności frontendowe**:
   ```sh
   npm install
4. **Skonfiguruj bazę danych w pliku .env**
5. **Uruchom migracje**:
   ```sh
   php artisan migrate
6. **Uruchom serwer backendu**:
   ```sh
   php artisan serve
7. **Uruchom serwer frontendu**:
   ```sh
   npm run dev
 

