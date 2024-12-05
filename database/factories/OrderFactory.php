<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            // Foreign key to user (customer)
            'user_id' => User::factory(), // You can set it to null if needed, by using $this->faker->randomElement([null, User::factory()])

            // Order information
            'order_number' => $this->faker->unique()->numerify('ORD#####'), // Example order number: ORD123456
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled', 'shipped']),

            // Shipping details
            'shipping_address' => $this->faker->address(),
            'shipping_city' => $this->faker->city(),
            'shipping_state' => $this->faker->state(),
            'shipping_zip' => $this->faker->postcode(),
            'shipping_country' => $this->faker->country(),
            'shipping_method' => $this->faker->randomElement(['standard', 'express']),
            'shipping_cost' => $this->faker->randomFloat(2, 5, 20), // Shipping cost between $5.00 and $20.00

            // Order totals
            'total_amount' => $this->faker->randomFloat(2, 50, 500), // Total order amount between $50.00 and $500.00
            'discount' => $this->faker->randomFloat(2, 0, 50), // Discount applied to the order
            'tax' => $this->faker->randomFloat(2, 5, 30), // Tax applied

            // Optional tracking details
            'tracking_number' => $this->faker->optional()->word(), // Random tracking number
            'carrier' => $this->faker->optional()->company(), // Carrier name like FedEx, UPS, etc.
            'ordered_at' => $this->faker->dateTimeThisYear(), // Random order date
            'shipped_at' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'), // Random shipping date
            'delivered_at' => $this->faker->optional()->dateTimeBetween('shipped_at', 'now'), // Random delivery date after shipping

            // Timestamps
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
