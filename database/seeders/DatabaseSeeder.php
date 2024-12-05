<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Create 10 users
    //    $users = User::factory(10)->create();
    //    $categories = Category::factory(10)->create();
       // Create 10 products
    //    $products = Product::factory(10)->create();

       // Create 5 orders and each with 3 order items
       $orders = Order::factory(5)->create()->each(function ($order) use ($products) {
           // Create 3 order items for each order
           OrderItem::factory(3)->create([
               'order_id' => $order->id,
               'product_id' => $products->random()->id, // Random product from the list
           ]);
       });
    }
}
