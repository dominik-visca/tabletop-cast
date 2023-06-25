<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::factory()->create([
            'name' => 'Eigentümer'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Bearbeiter'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Leser'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Spieler'
        ]);
    }
}
