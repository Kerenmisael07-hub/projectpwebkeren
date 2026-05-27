# Sistem Rental Kendaraan

Folder ini berisi source code terpisah untuk aplikasi Laravel "Sistem Rental Kendaraan".

## Fitur utama
- Authentication login, register, logout, forgot password
- CRUD kendaraan, customer, dan rental
- Upload gambar kendaraan ke storage/public
- Invoice PDF dengan dompdf
- Export Excel laporan rental
- Dashboard statistik dan grafik
- Seeder kendaraan 10 data

## Catatan
Folder ini dipisahkan dari project lama agar tidak tercampur.

## Setup cepat
1. Pastikan Apache + MySQL XAMPP aktif.
2. Jalankan:
	- composer install
	- npm install
3. Konfigurasi env sudah disiapkan menggunakan MySQL:
	- DB_CONNECTION=mysql
	- DB_HOST=127.0.0.1
	- DB_PORT=3306
	- DB_DATABASE=sistem_rental_kendaraan
	- DB_USERNAME=root
	- DB_PASSWORD=
4. Jalankan inisialisasi:
	- php artisan key:generate --force
	- php artisan storage:link
	- php artisan migrate --force
	- php artisan db:seed --force
5. Jalankan aplikasi:
	- php artisan serve
	- npm run dev
