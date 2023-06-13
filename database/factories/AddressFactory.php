<?php

namespace Database\Factories;

use App\Entities\AddressEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    protected $model = AddressEntity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->unique()->numberBetween(1,50),
            'street' => $this->faker->streetName(),
            'number' =>  $this->faker->buildingNumber(),
            'neighborhood' => $this->faker->city(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'cep' => $this->faker->postcode(),

        ];
    }
}
