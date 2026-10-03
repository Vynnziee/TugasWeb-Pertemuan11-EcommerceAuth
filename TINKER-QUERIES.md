# 5 Query Tinker untuk Dokumentasi

Jalankan `php artisan tinker`, lalu ketik satu per satu. **Screenshot tiap
hasilnya** dan tempel ke README atau laporan (sesuai requirement soal 4).

```php
// 1. Hitung total produk
>>> Product::count()

// 2. Produk beserta kategorinya (relasi belongsTo)
>>> Product::with('category')->first()

// 3. Jumlah order milik user pertama (relasi hasMany)
>>> User::first()->orders->count()

// 4. Total harga semua item per order (agregasi relasi)
>>> Order::withSum('items as total_items', 'price')->first()

// 5. Produk aktif dalam kategori tertentu (pakai scope custom)
>>> Product::active()->inCategory('Elektronik')->get()
```

Kalau nama kategori "Elektronik" tidak ada di hasil seeder-mu (karena
`CategoryFactory` mengambil 10 nama acak dari 10 pilihan), cek dulu nama
kategori yang benar-benar ada:

```php
>>> Category::pluck('name')
```

lalu ganti query nomor 5 dengan nama kategori yang muncul di situ.
