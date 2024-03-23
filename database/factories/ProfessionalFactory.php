<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Professional;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional>
 */
class ProfessionalFactory extends Factory
{
    protected $model = Professional::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),      
            'specialty' => fake()->randomElement(['Orthopedics','Internal Medicine','Obstetrics and Gynecology','Dermatology','Pediatrics','Radiology','General Surgery','Ophthalmology'])      
        ];
    }
}
