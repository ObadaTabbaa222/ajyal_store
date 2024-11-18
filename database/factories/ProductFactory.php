<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $name = $this->faker->words(5,true);
        return [
            'name' => $name,
            'uuid' => Str::uuid(),
            'slug' => Str::slug($name, '-'),
            'description' => $this->faker->paragraph(1),
            'image' => 'https://picsum.photos/seed/picsum/200/300',
            'price' => $this->faker->randomFloat(1,1,999),
            'compare_price' => $this->faker->randomFloat(1, 1, 999),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
            'featured' => rand(0, 1),
        ];
    }
}
