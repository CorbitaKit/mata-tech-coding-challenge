<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PizzaType>
 */
class PizzaTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'category' => fake()->word(),
            'slug' => strtolower(fake()->word() . '-' . fake()->randomLetter()),
        ];
    }

    public function withIngredients(int $count = 5): static
    {
        return $this->hasAttached(
            Ingredient::factory()->count($count),
            [],
            'ingredients'
        );
    }
}
