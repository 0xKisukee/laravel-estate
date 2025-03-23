<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // This creates an upcoming payment
    public function definition(): array
    {
        $property = Property::all()->random();

        return [
            'amount' => random_int(0, 950),
            'due_date' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'paid_date' => null,
            'property_id' => $property->id,
            'owner_id' => $property->owner->id,
            'tenant_id' => $property->tenant->id,
        ];
    }

    // This creates a paid payment
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'paid_date' => fake()->dateTimeBetween('-1 months', 'today')->format('Y-m-d'),
        ]);
    }

    // This creates a due payment
    public function due(): static
    {
        return $this->state(fn (array $attributes) => [
            'due_date' => fake()->dateTimeBetween('-2 months', '-1 month')->format('Y-m-d'),
        ]);
    }
}
