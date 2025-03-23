<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $property = Property::all()->random();

        return [
            'type' => 'other',
            'description' => 'Please repair the toilets.',
            'status' => 'open',
            'property_id' => $property->id,
            'owner_id' => $property->owner->id,
            'tenant_id' => $property->tenant->id,
        ];
    }
}
