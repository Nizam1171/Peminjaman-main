## Setup Laravel dengan Docker

### 1. Masuk ke folder backend
```bash
cd ~/Peminjaman-main/backend
```

### 2. Buat file environment
```bash
cp .env.example .env
nano .env
```
Sesuaikan konfigurasi database di `.env` dengan pengaturan pada `docker-compose.yml`.

### 3. Jalankan Docker
```bash
cd ~/Peminjaman-main
docker compose up -d
```

### 4. Install dependensi Composer
```bash
docker compose run --rm app-laravel composer install
```

### 5. Periksa file autoload Composer
```bash
ls -la backend/vendor/autoload.php
docker compose run --rm app-laravel ls -la /var/www/vendor/autoload.php
```

### 6. Periksa versi Laravel
```bash
docker compose run --rm app-laravel php artisan --version
```

### 7. Buat application key
Pastikan file `.env` sudah tersedia.
```bash
docker compose run --rm app-laravel php artisan key:generate
```

### 8. Bangun ulang container Laravel
```bash
docker compose up -d --build --force-recreate app-laravel
```

### 9. Periksa status dan log
```bash
docker compose ps -a
docker compose logs --tail=50 app-laravel
```

### 10. Akses aplikasi
- **Laravel:** http://localhost:8000
- **phpMyAdmin:** http://localhost:8081
