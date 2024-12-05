<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Order;

class OrderItemsFactory extends Factory
{
    protected $model = OrderItems::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'total_price' => function (array $attributes) {
                return $attributes['price'] * $attributes['quantity'];
            },
        ];
    }
}
