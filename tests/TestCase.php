<?php

namespace Tests;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Common headers for requests.
     *
     * @var array
     */
    public array $header = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    /**
     * Create one or multiple users with optional custom data.
     *
     * @param array|null $data
     * @param int|null $count
     * @return User|Collection
     */
    public function createUser(?array $data = [], ?int $count = 1): User|Collection
    {
        $users = User::factory()->count($count)->create($data);
        return $count === 1 ? $users->first() : $users;
    }

    /**
     * Create a single product with optional custom data.
     *
     * @param array|null $data
     * @return Product
     */
    public function createProduct(?array $data = []): Product
    {
        return Product::factory()->create($data);
    }

    /**
     * Create one or multiple categories with optional custom data.
     *
     * @param array|null $data
     * @param int|null $count
     * @return Category|Collection
     */
    public function createCategory(?array $data = [], ?int $count = 1): Category|Collection
    {
        $categories = Category::factory()->count($count)->create($data);
        return $count === 1 ? $categories->first() : $categories;
    }

    /**
     * Create a single order with optional custom data.
     *
     * @param array|null $data
     * @return Order
     */
    public function createOrder(?array $data = []): Order
    {
        return Order::factory()->create($data);
    }
}
