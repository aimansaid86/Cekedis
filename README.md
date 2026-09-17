# Cekedis

Pasar barang second yang mesra pengguna — jual dan cari barang terpakai dari jiran ke jiran.

## Ciri-ciri

- Carian dan penapis kategori barang (dari pangkalan data sebenar)
- Kad senarai barang bergaya "tag harga"
- Halaman butiran barang dengan maklumat penjual & pautan WhatsApp sebenar
- Pendaftaran & log masuk pengguna
- Borang "Jual Barang" dengan muat naik gambar sebenar
- Reka bentuk responsif untuk mudah alih dan desktop

## Teknologi

Laravel 13 + Blade + MySQL. Tiada Tailwind/framework CSS luar — semua gaya (`public/css/app.css`) dibina khas untuk Cekedis.

## Menjalankan projek (Laragon)

1. Clone repo ini ke dalam `www` Laragon (contoh: `C:\laragon\www\cekedis`).
2. `composer install`
3. Salin `.env.example` ke `.env`, jana kunci aplikasi:
   ```
   php artisan key:generate
   ```
4. Cipta pangkalan data MySQL bernama `cekedis` (guna HeidiSQL/phpMyAdmin Laragon, atau `mysql -u root -e "CREATE DATABASE cekedis"`).
5. Jalankan migration & seeder (data kategori, pengguna demo, dan 12 barang contoh):
   ```
   php artisan migrate --seed
   php artisan storage:link
   ```
6. Buka Laragon → **Reload** (supaya auto virtual host kesan struktur Laravel) → layari `http://cekedis.test/`.
   - Alternatif semasa dev: `php artisan serve` lalu buka `http://127.0.0.1:8000`.

## Status

Backend sebenar sudah siap: data listing/kategori/pengguna tersimpan dalam MySQL, ada pendaftaran & log masuk, borang "Jual Barang" menyimpan rekod + gambar sebenar, dan butang hubungi penjual guna nombor WhatsApp sebenar pengguna.
