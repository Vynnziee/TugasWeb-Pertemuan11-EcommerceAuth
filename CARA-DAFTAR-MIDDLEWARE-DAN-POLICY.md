# Cara mendaftarkan middleware & policy

## 1. Middleware `role`

Buka `bootstrap/app.php`, tambahkan alias di dalam `->withMiddleware()`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => \App\Http\Middleware\EnsureRole::class,
    ]);
})
```

## 2. Policy

Laravel 11+ biasanya auto-discover policy kalau penamaannya konsisten
(`Product` → `ProductPolicy`, `Post` → `PostPolicy`). Kalau ternyata
tidak otomatis terdeteksi, daftarkan manual di `app/Providers/AppServiceProvider.php`:

```php
use App\Models\Post;
use App\Models\Product;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;

public function boot(): void
{
    Gate::policy(Post::class, PostPolicy::class);
    Gate::policy(Product::class, ProductPolicy::class);
}
```

## 3. Contoh pakai di controller

```php
public function edit(Product $product)
{
    $this->authorize('update', $product);
    return view('products.edit', compact('product'));
}
```

## 4. Contoh pakai di Blade

```blade
@can('update', $product)
    <a href="{{ route('products.edit', $product) }}">Edit</a>
@endcan
```
