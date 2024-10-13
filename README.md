<p align="center">
<img src="/api/placeholder/400/200" alt="Logo Flipbook">
</p>

<p align="center">
<a href="https://github.com/namaanda/proyek-flipbook/actions"><img src="https://github.com/namaanda/proyek-flipbook/workflows/tests/badge.svg" alt="Status Build"></a>
<a href="https://packagist.org/packages/namaanda/proyek-flipbook"><img src="https://img.shields.io/packagist/dt/namaanda/proyek-flipbook" alt="Total Unduhan"></a>
<a href="https://packagist.org/packages/namaanda/proyek-flipbook"><img src="https://img.shields.io/packagist/v/namaanda/proyek-flipbook" alt="Versi Stabil Terbaru"></a>
<a href="https://packagist.org/packages/namaanda/proyek-flipbook"><img src="https://img.shields.io/packagist/l/namaanda/proyek-flipbook" alt="Lisensi"></a>
</p>

## Tentang Website Flipbook

Website Flipbook adalah aplikasi web inovatif yang dibangun dengan Laravel 10, menghadirkan pesona buku flipbook fisik ke dalam dunia digital. Proyek kami memanfaatkan kekuatan dan keanggunan Laravel untuk menciptakan pengalaman membaca yang mendalam dengan mensimulasikan aksi membalik halaman, semua dalam browser web Anda.

<p align="center">
<img src="/api/placeholder/600/400" alt="Contoh Flipbook">
</p>

Fitur utama meliputi:

- Dukungan untuk berbagai format dokumen (PDF, EPUB, gambar)
- Antarmuka membaca yang dapat disesuaikan menggunakan komponen Laravel Blade
- Desain responsif untuk desktop dan perangkat mobile
- Kemampuan penandaan dan pencatatan terintegrasi menggunakan Laravel's Eloquent ORM
- Penanganan dan pemrosesan file yang efisien dengan abstraksi sistem file Laravel

## Memulai

Untuk memulai dengan proyek Website Flipbook, pastikan Anda memiliki PHP 8.1+, Composer, dan MariaDB (atau MySQL) terinstal, kemudian ikuti langkah-langkah berikut:

1. Klon repositori:
   ```
   git@github.com:PPL-FlipBook/Kompak.git
   ```
2. Masuk ke direktori proyek:
   ```
   cd proyek-flipbook
   ```
3. Instal dependensi menggunakan Composer:
   ```
   composer install
   ```
4. Salin file env contoh dan lakukan konfigurasi yang diperlukan di file .env:
   ```
   cp .env.example .env
   ```
   Pastikan untuk mengatur koneksi database Anda di file .env
5. Generate kunci aplikasi baru:
   ```
   php artisan key:generate
   ```
6. Jalankan migrasi database:
   ```
   php artisan migrate
   ```
7. Mulai server pengembangan lokal:
   ```
   php artisan serve
   ```

Anda sekarang dapat mengakses server di http://localhost:8000

## Persyaratan

- PHP 8.1 atau lebih tinggi
- Composer
- MariaDB 10.2+ atau MySQL 5.7+

## Dokumentasi

Untuk informasi detail tentang cara menggunakan dan menyesuaikan Website Flipbook, silakan merujuk ke [dokumentasi](https://github.com/namaanda/proyek-flipbook/wiki) kami.

## Fitur Spesifik Laravel

Proyek ini memanfaatkan sepenuhnya fitur-fitur Laravel 10, termasuk:

- Grup rute dan pengelompokan controller untuk desain API yang efisien
- Validasi form request untuk penanganan data yang kuat
- Laravel Sanctum untuk autentikasi API
- Job batching untuk memproses beberapa dokumen sekaligus

## Konfigurasi Database

Proyek ini dikonfigurasi untuk menggunakan MariaDB secara default, namun juga kompatibel dengan MySQL. Untuk mengubah konfigurasi database, edit file `.env` Anda:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
```

Pastikan untuk mengganti `nama_database_anda`, `username_anda`, dan `password_anda` dengan kredensial database Anda yang sebenarnya.

## Kontak

Jika Anda memiliki pertanyaan atau umpan balik, silakan buka isu di repositori ini atau hubungi pengelola di amosaleksiatoziliwu@email.com.
