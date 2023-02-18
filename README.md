## Tentang Repositori Ini

Lyz shop merupakan toko online untuk menjuual produk digital seperti akun game, akun sosial media, akun Netflix dan produk lainnya yang dapat dikirim dalam bentuk digital (text-based). Dibuat menggunakan Laravel 8, dan [Classimax template](https://github.com/themefisher/classimax) untuk front-end. Untuk saat ini belum siap untuk production dikarenakan beberapa essentials belum ada.

## Fitur
- **Admin**
    - Mengelola transaksi
    - Mengelola produk (CRUD)
    - Mengelola kategori produk (CRUD)
    - Mengelola promo (dapat diatur untuk *x* kali penggunaan atau kadaluwarsa menurut tanggal) (CRUD)
    - Mengelola blog post (CRUD)
    - Mengelola blog kategori (CRUD)
    - User order lookup
- **User**
    - Membeli produk
    - Memberi ulasan pembelian (rating dan komentar)
    - Komplain pembelian
- **Lainnya**
    - Login menggunakan akun Google
    - Terintegrasi mindtrans payment gateway
    
## Instalasi
1. Git clone repository ini
2. Jalankan `composer install`
3. Jalankan `cp .env.example .env`
4. Sesuaikan variabel berikut (baca paling bawah untuk tau bagimana cara mendapatkannya)
```
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_CLIENT_REDIRECT=http://localhost:8000/auth/google/callback

MIDTRANS_SERVERKEY=
MIDTRANS_CLIENTKEY=
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=false
MIDTRANS_IS_3DS=false
```
5. Jalankan `php artisan key:generate`
6. Jalankan `php artisan migrate` atau import sql yang sudah saya sediakan agar semua tabel sudah terisi (kecuali tabel users)
7. Jalankan `php artisan serve`

## How-to
1. Cara untuk mendapatkan `GOOGLE_CLIENT_ID` dan `GOOGLE_CLIENT_SECRET` saya tidak akan menjelaskan secara panjang lebar, silakan [baca disini](https://santrikoding.com/tutorial-login-dengan-google-github-di-laravel-9-menggunakan-socialite-7-login-register-dengan-google). Jangan lupa redirect URIs harus sama dengan `GOOGLE_CLIENT_REDIRECT` pada .env
2. Cara untuk mendapatkan `MIDTRANS_SERVERKEY` dan `MIDTRANS_CLIENTKEY`
    - Silakan [daftar midtrans](https://midtrans.com/id)
    - Lengkapi hal hal yang diperlukan
    - Pilih environment `sandbox`
    - Pilih **SETTINGS** kemudian **ACCESS KEYS**