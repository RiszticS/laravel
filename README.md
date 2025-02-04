# Laravel 11 Beadandó

Ez a projekt egy Laravel 11 alapú webalkalmazás, amely karaktereket, helyszíneket és mérkőzéseket kezel egy SQLite adatbázis segítségével.

## Telepítés

### Szükséges követelmények
- PHP 8.1 vagy újabb
- Composer
- Laravel 11
- SQLite adatbázis

### Projekt klónozása és beállítása

1. **Repository klónozása**
```bash
git clone <repository-url>
cd <projekt-mappa>
```

2. **Függőségek telepítése**
```bash
composer install
```

3. **.env fájl beállítása**
Másold le az `.env.example` fájlt és nevezd át `.env`-re, majd módosítsd az adatbázis beállításokat:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

4. **Adatbázis inicializálása**
```bash
touch database/database.sqlite
php artisan migrate --seed
```

5. **Kulcsgenerálás és szerver indítása**
```bash
php artisan key:generate
php artisan serve
```

Az alkalmazás most már elérhető a `http://127.0.0.1:8000` címen.

## Funkcionalitás

### Karakterek (Characters)
- Létrehozás, módosítás, törlés
- Lista megjelenítés

![Karakterek](readme/chacters.png)

### Helyszínek (Locations)
- Helyszínek kezelése
- Karakterek hozzárendelése helyszínekhez

### Mérkőzések (Matches)
- Mérkőzések létrehozása karakterek között
- Mérkőzés eredmények tárolása

## Használt technológiák
- Laravel 11
- SQLite
- Blade Template Engine
- Tailwind CSS (opcionális)

## Parancsok fejlesztéshez

**Tesztelés futtatása:**
```bash
php artisan test
```

**Adatbázis frissítése:**
```bash
php artisan migrate:refresh --seed
```

