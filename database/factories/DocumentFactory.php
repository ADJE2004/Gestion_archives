<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title' => $this->faker->sentence(3),
        'reference' => 'DOC-' . $this->faker->unique()->numberBetween(1000, 9999),
        'file_path' => 'uploads/document_test.pdf',
        // Liaison automatique :
        'service_id' => \App\Models\Service::all()->random()->id, 
        'user_id' => \App\Models\User::all()->random()->id,
        'year' => $this->faker->year(),
        'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
