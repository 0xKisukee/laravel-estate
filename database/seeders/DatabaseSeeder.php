<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'role' => 'owner',
            'first_name' => 'Aymane',
            'last_name' => 'Ait Ben Ali',
            'phone' => '+33609427694',
            'iban' => 'fakeIBAN1',
            'bic' => 'fakeBIC1',
            'email' => 'aymane@aitbenali.com',
        ]);

        User::factory()->create([
            'role' => 'tenant',
            'first_name' => 'Lucas',
            'last_name' => 'Decrock',
            'phone' => '+33612345678',
            'iban' => 'fakeIBAN2',
            'bic' => 'fakeBIC2',
            'email' => 'lucas@decrock.com',
        ]);

        Property::factory()->create([
            'type' => 'apartment',
            'rent' => 614,
            'city' => 'Valenciennes',
            'address' => '16 rue Capron',
            'owner_id' => 1,
            'tenant_id' => 2,
        ]);

        Payment::factory()->create([
            'amount' => 614,
            'due_date' => '2025-04-30',
            'paid_date' => null,
            'property_id' => 1,
            'owner_id' => 1,
            'tenant_id' => 2,
        ]);

        Ticket::factory()->create([
            'type' => 'repair',
            'description' => 'Can you repair the door please?',
            'status' => 'open',
            'property_id' => 1,
            'owner_id' => 1,
            'tenant_id' => 2,
        ]);

        Message::factory()->create([
            'ticket_id' => 1,
            'user_id' => 2,
            'content' => 'Bonjour, comment allez-vous ?',
            'is_system' => false,
        ]);
    }
}
