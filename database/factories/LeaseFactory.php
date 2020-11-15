<?php

namespace Database\Factories;

use App\Models\Lease;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lease::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'propery_id' => $this->faker->numberBetween(1, 25),
            'building' => $this->faker->numberBetween(1, 5),
            'unit' => $this->faker->unique()->numberBetween(100, 999),
            'start_date' => $this->faker->dateTimeBetween('-1 years', 'now', null),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 years', null),
        ];
    }
}
