<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
        ['name' => 'Ressources Humaines'],
        ['name' => 'Comptabilité et Finance'],
        ['name' => 'Logistique'],
        ['name' => 'Informatique'],
        ['name' => 'Direction Générale'],
    ];
    foreach ($services as $service) {
            Service::create($service);
        }
    }
}
