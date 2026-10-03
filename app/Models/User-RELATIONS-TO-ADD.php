<?php
// Tempel method-method ini ke dalam class User yang sudah ada
// di app/Models/User.php (JANGAN timpa seluruh file, karena
// User.php bawaan Laravel berisi trait HasFactory, Notifiable, dll
// yang wajib tetap ada).

public function products()
{
    return $this->hasMany(\App\Models\Product::class);
}

public function orders()
{
    return $this->hasMany(\App\Models\Order::class);
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isEditor(): bool
{
    return $this->role === 'editor';
}
