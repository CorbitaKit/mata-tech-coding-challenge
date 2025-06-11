<?php

namespace Tests\Feature\v1\PizzaType;

use App\Models\PizzaType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PizzaTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->actingAs($user);
    }

    public function test_creating_pizza_type(): void
    {

        $pizzaType = $this->generatePizzaTypeData();

        $response = $this->postJson(route('api.v1.pizza-types.store'), $pizzaType)
        ->assertStatus(201);

        $response->assertJsonStructure([
            'message',
            'data',
        ])->assertJsonFragment([
            'message' => 'Pizza Type Created',
        ]);

        $this->assertDatabaseHas('pizza_types', [
            'slug' => $pizzaType['slug']
        ]);

        $this->assertDatabaseCount('ingredient_pizza_types', count(explode(',', $pizzaType['ingredients'])));

    }

    public function test_pizza_type_slug_already_added(): void
    {
        $newPizzaType = PizzaType::factory()->create();

        $pizzaType = $this->generatePizzaTypeData();

        $pizzaType['slug'] = $newPizzaType->slug;

        $response = $this->postJson(route('api.v1.pizza-types.store'), $pizzaType)
        ->assertStatus(422);

        $response->assertJsonFragment([
            'message' => 'The slug has already been taken.'
        ]);
    }


    public function test_pizza_type_name_is_required(): void
    {
        $pizzaType = $this->generatePizzaTypeData();

        $pizzaType['name'] = null;
        $response = $this->postJson(route('api.v1.pizza-types.store'), $pizzaType)
        ->assertStatus(422);

        $response->assertJsonValidationErrorFor('name');

    }

    public function test_updating_pizza_type(): void
    {
        $newPizzaType = PizzaType::factory()->withIngredients(rand(1,10))->create()->load('ingredients');
        $pizzaType = $this->generatePizzaTypeData();

        $response = $this->patchJson(route('api.v1.pizza-types.update', $newPizzaType->id), $pizzaType)
        ->assertStatus(200);

        $response->assertJsonFragment([
            'message' => 'Pizza Type Updated'
        ]);

        $this->assertDatabaseHas('pizza_types',[
            'id' => $newPizzaType->id,
            'name' => $pizzaType['name'],
            'slug' => $pizzaType['slug']
        ]);

        $ingredientCount = count(explode(',', $pizzaType['ingredients']));

        $this->assertDatabaseCount('ingredient_pizza_types', $ingredientCount);
    }

    public function test_deleting_pizza_type(): void
    {

        $newPizzaType = PizzaType::factory()->withIngredients(rand(1, 10))->create()->load('ingredients');

        $this->deleteJson(route('api.v1.pizza-types.destroy', $newPizzaType->id))
        ->assertStatus(200)
        ->assertJsonFragment([
            'message' => 'Pizza Type Deleted'
        ]);

        $this->assertDatabaseMissing('pizza_types', [
            'id' => $newPizzaType->id
        ]);

        foreach ($newPizzaType->ingredients as $ingredient) {
            $this->assertDatabaseMissing('ingredient_pizza_types', [
                'pizza_type_id' => $newPizzaType->id,
                'ingredient_id' => $ingredient->id,
            ]);
        }

    }


    private function generatePizzaTypeData(): array
    {
        $ingredients = '';
        for ($i = 1; $i <= rand(1,10); $i ++) {
            $ingredients .= fake()->word() .', ';
        }

        $ingredients = rtrim($ingredients, ", \t\n\r\0\x0B");

        return [
            'name' => fake()->word(),
            'slug' => strtolower(fake()->word() . '-' . fake()->randomLetter()),
            'category' => fake()->word(),
            'ingredients' => $ingredients
        ];
    }




}
