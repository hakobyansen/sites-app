<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteAddress>
 */
class SiteAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_id' => Site::factory(),
            'street' => fake()->streetAddress(),
            'state' => fake('en_US')->state(),
            'city' => fake('en_US')->city(),
            'zip' => fake('en_US')->postcode(),
            'country' => 'USA',
        ];
    }
}
