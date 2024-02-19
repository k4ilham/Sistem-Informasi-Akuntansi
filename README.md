## Pertemuan 1

1. Buat proyek Laravel menggunakan perintah berikut:
    ```
    composer create-project --prefer-dist laravel/laravel ProjectSIA2
    ```

2. Tambahkan paket dompdf untuk Laravel dengan perintah:
    ```
    composer require barryvdh/laravel-dompdf
    ```

3. Pasang paket Sweet Alert menggunakan Composer:
    ```
    composer require realrashid/sweet-alert
    ```

## Pertemuan 2

### Konfigurasi Database

Nama Database: `dbsia2`

Ubah file `.env` dengan konfigurasi berikut:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbsia2
DB_USERNAME=root
DB_PASSWORD=


### Pembuatan Model dan Migrasi

Gunakan perintah berikut untuk membuat model dan migrasi untuk setiap entitas:

```bash
php artisan make:model Barang -m
php artisan make:model Supplier -m
php artisan make:model Akun -m
php artisan make:model Setting -m
php artisan make:model Pemesanan -m
php artisan make:model DetailPesan -m
php artisan make:model Pemesanan_tem -m
php artisan make:model Temp_pesan -m
php artisan make:model Pembelian -m
php artisan make:model DetailPembelian -m
php artisan make:model Beli -m
php artisan make:model Retur -m
php artisan make:model DetailRetur -m
php artisan make:model Jurnal -m
php artisan make:model Laporan -m







