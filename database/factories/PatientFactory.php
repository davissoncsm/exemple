<?php

namespace Database\Factories;

use App\Entities\PatientEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientFactory extends Factory
{
    protected $model = PatientEntity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'cpf' => $this->faker->unique()->numberBetween(11111111111,99999999999),
            'cns' =>  $this->faker->unique()->numberBetween(111111111111111,999999999999999),
            'mother_name' => $this->faker->unique()->name(),
            'birthdate' => $this->faker->dateTimeBetween(startDate: '-30 years', endDate: 'now'),
            'photo' => '/teste.jpg',
        ];
    }
}
