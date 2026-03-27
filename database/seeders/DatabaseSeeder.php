<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer les services
    $this->call(ServiceSeeder::class);
        // User::factory(10)->create();
        User::factory(10)->create([
        'role' => 'agent'
    ]);
         \App\Models\Document::factory(50)->create();

        // \App\Models\User::updateOrCreate([
        // 'name' => 'Super Admin',
        // 'email' => 'admin@archivo.com',
        // 'password' => Hash::make('password123'), // Change le mot de passe !
        // 'role' => 'admin',
        // 'service_id' => null,
        // ]);

    }
}
