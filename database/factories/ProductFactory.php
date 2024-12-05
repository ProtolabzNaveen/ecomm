<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 5, 100),
            'sale_price' => $this->faker->randomFloat(2, 5, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::factory(), // Assuming categories are pre-defined, else you can create categories here
            'sku' => $this->faker->unique()->word,
            'status' => 'active',
            'is_featured' => $this->faker->boolean,
            'attributes' => json_encode(['color' => $this->faker->safeColorName, 'size' => $this->faker->word]),
            'rating' => $this->faker->randomFloat(2, 0, 5),
        ];
    }
}
