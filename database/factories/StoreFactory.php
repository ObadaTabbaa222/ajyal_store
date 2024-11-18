<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
            'description' => $this->faker->paragraph(1),
            'logo' => $this->faker->imageUrl(300,300),
            'cover' => $this->faker->imageUrl(800,600),
        ];
    }
}
