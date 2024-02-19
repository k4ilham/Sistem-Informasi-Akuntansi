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

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dbsia2
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### Pembuatan Model dan Migrasi

Gunakan perintah berikut untuk membuat model dan migrasi untuk setiap entitas:

    ```
    php artisan make:model Barang -m
    php artisan make:model Supplier -m
    php artisan make:model Akun -m
    php artisan make:model Setting -m
    php artisan make:model Pemesanan -m
    php artisan make:model DetailPesan -m
    php artisan make:model Pembelian -m
    php artisan make:model DetailPembelian -m
    php artisan make:model Retur -m
    php artisan make:model DetailRetur -m
    php artisan make:model Jurnal -m
    
    php artisan make:model Pemesanan_tem 
    php artisan make:model Temp_pesan 
    php artisan make:model Beli
    php artisan make:model Laporan
    ```

    ```
    php artisan make:migration trigger_bersih_tempesan
    php artisan make:migration trigger_tambah
    ```

    ```
    php artisan migrate:refresh --seed
    ```

    ```
    CREATE VIEW `view_temp_pesan` AS SELECT `temp_pemesanan`.`kd_brg` AS 
    `kd_brg`, concat(`barang`.`nm_brg`,`barang`.`harga`) 
    AS `nm_brg`,`temp_pemesanan`.`qty_pesan` AS `qty_pesan`, `barang`.`harga`* 
    `temp_pemesanan`.`qty_pesan` AS `sub_total` FROM (`temp_pemesanan` join 
    `barang`) WHERE `temp_pemesanan`.`kd_brg` = `barang`.`kd_brg` ;
    ```

    ```
    CREATE VIEW `tampil_pemesanan` AS SELECT `detail_pesan`.`kd_brg` AS `kd_brg`, 
    `detail_pesan`.`no_pesan` AS `no_pesan`, `barang`.`nm_brg` AS `nm_brg`, 
    `detail_pesan`.`qty_pesan` AS `qty_pesan`, `detail_pesan`.`subtotal` AS `sub_total` 
    FROM (`barang` join `detail_pesan`) WHERE `detail_pesan`.`kd_brg` = 
    `barang`.`kd_brg` ;
    ```

    ```
    CREATE VIEW `tampil_pembelian` AS (select `barang`.`kd_brg` AS 
    `kd_brg`,`detail_pembelian`.`no_beli` AS `no_beli`,`barang`.`nm_brg` AS 
    `nm_brg`,`barang`.`harga` AS `harga`,`detail_pembelian`.`qty_beli` AS `qty_beli` from 
    (`barang` join `detail_pembelian`) where `barang`.`kd_brg` = 
    `detail_pembelian`.`kd_brg`) ;
    ```

    ```
    CREATE VIEW `lap_jurnal` AS SELECT `akun`.`nm_akun` AS `nm_akun`, 
    `jurnal`.`tgl_jurnal` AS `tgl`, sum(`jurnal`.`debet`) AS `debet`, sum(`jurnal`.`kredit`) AS 
    `kredit` FROM (`akun` join `jurnal`) WHERE `akun`.`no_akun` = `jurnal`.`no_akun` 
    GROUP BY `jurnal`.`no_jurnal` ;
    ```

    ```
    CREATE VIEW `lap_stok` AS (select `barang`.`kd_brg` AS `kd_brg`,`barang`.`nm_brg` 
    AS `nm_brg`,`barang`.`harga` AS `harga`,`barang`.`stok` AS 
    `stok`,sum(`detail_pembelian`.`qty_beli`) AS `beli`,sum(`detail_retur`.`qty_retur`) AS 
    `retur` from ((`barang` join `detail_retur`) join `detail_pembelian`) where 
    `barang`.`kd_brg` = `detail_retur`.`kd_brg` and `barang`.`kd_brg` = 
    `detail_pembelian`.`kd_brg` group by `barang`.`kd_brg`) ;
    ```











