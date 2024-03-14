<?php

namespace Database\Factories;

use App\Models\SiteAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['mini-market', 'supermarket', 'mega-market'];

        return [
            'name' => fake()->name,
            'type' => $types[rand(0, count($types)-1)],
        ];
    }
}
