<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PropertyFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'house',
            'rent' => random_int(150, 950),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'owner_id' => User::where('role', 'owner')->inRandomOrder()->first()?->id,
            'tenant_id' => User::where('role', 'tenant')->inRandomOrder()->first()?->id,
        ];
    }
}
