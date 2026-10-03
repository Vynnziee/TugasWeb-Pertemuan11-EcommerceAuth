# TugasWeb-P11-EcommerceAuth

Tugas Rutin 11 - Database E-Commerce (7 tabel) + Auth Multi-Role Laravel.

## Cara install

Buat project dulu:
```bash
composer create-project laravel/laravel TugasWeb-P11-EcommerceAuth
cd TugasWeb-P11-EcommerceAuth
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

Buat database:
```bash
mysql -u root -e "CREATE DATABASE ecommerce_p11;"
```

Edit `.env`: DB_DATABASE=ecommerce_p11, DB_USERNAME=root, DB_PASSWORD= (kosong)

Salin file dari repo ini ke project (migrations, factories, seeder, model, middleware, policy sesuai nama foldernya masing-masing). Untuk `User.php` jangan ditimpa, cukup tempel isi `User-RELATIONS-TO-ADD.php` ke dalam class-nya. Tempel juga `ecommerce-routes-to-add.php` ke bawah `routes/web.php`, dan daftarkan `EcommerceSeeder` di `DatabaseSeeder.php`.

Lalu:
```bash
php artisan migrate --seed
php artisan serve
```

## Akun testing

| Role | Email | Password |
|---|---|---|
| admin | admin@example.com | password |
| editor | editor@example.com | password |
| user | user@example.com | password |

## Fitur

7 tabel e-commerce dengan foreign key (categories, products, orders, order_items, tags, product_tag, + role di users), model dengan relasi dan scope, seeder 60 produk, Breeze buat login, middleware role buat multi-role, PostPolicy/ProductPolicy buat otorisasi, dan proteksi route admin.

Testing: login user biasa buka `/admin/dashboard` harus 403, login admin (pakai incognito) buka halaman sama harus berhasil. Bukti ada di folder screenshots, termasuk 5 query Tinker (lihat TINKER-QUERIES.md).