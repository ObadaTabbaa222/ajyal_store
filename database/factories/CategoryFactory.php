<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2,true);
        return [
            'name' => $name,
            'uuid' => Str::uuid(),
            'slug' => Str::slug($name, '-'),
            'description' => $this->faker->paragraph(1),
            'image' => 'https://picsum.photos/200',
        ];
    }
}