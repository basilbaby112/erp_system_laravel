<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'date_of_birth' => fake()->date($format="Y-m-d",$max = 'now'),
                'status' => rand(1,0)
            
        ];
    }
}
