<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{
    public function run(): void
    {
        // 3 akun dengan role berbeda untuk testing multi-role (soal 8: testing incognito 2 role)
        $admin = User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
            'role'  => 'admin',
        ]);

        $editor = User::factory()->create([
            'name'  => 'Editor',
            'email' => 'editor@example.com',
            'role'  => 'editor',
        ]);

        $plainUser = User::factory()->create([
            'name'  => 'User Biasa',
            'email' => 'user@example.com',
            'role'  => 'user',
        ]);

        // 10 user tambahan biasa
        $users = User::factory()->count(10)->create();

        // Semua user (termasuk admin, editor, user biasa) untuk dipakai sebagai
        // pemilik produk maupun pemilik order, supaya tiap akun testing
        // benar-benar punya data terkait.
        $allUsers = $users->push($admin)->push($editor)->push($plainUser);

        // 10 kategori (dari daftar tetap di CategoryFactory)
        $categories = Category::factory()->count(10)->create();

        // 15 tag
        $tags = Tag::factory()->count(15)->create();

        // 60 produk (lebih dari 50 sesuai requirement), owner acak dari semua user
        $products = Product::factory()
            ->count(60)
            ->make()
            ->each(function (Product $product) use ($categories, $allUsers, $tags) {
                $product->category_id = $categories->random()->id;
                $product->user_id = $allUsers->random()->id;
                $product->save();

                // tiap produk dapat 1-3 tag acak
                $product->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')
                );
            });

        // 20 order dengan 1-4 item tiap order, total dihitung dari item-nya
        Order::factory()
            ->count(20)
            ->make()
            ->each(function (Order $order) use ($products, $allUsers) {
                $order->user_id = $allUsers->random()->id;
                $order->save();

                $items = $products->random(rand(1, 4));
                $total = 0;

                foreach ($items as $product) {
                    $qty = rand(1, 3);
                    $price = $product->price;

                    OrderItem::factory()->create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'qty'        => $qty,
                        'price'      => $price,
                    ]);

                    $total += $qty * $price;
                }

                $order->update(['total' => $total]);
            });
    }
}