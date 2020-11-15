<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => $this->faker->numberBetween(1, 25),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'department' => function() {
                $jobs = ['Leasing', 'Maintenance', 'Administrative'];
                return array_rand(array_flip($jobs), 1);
            },
            'employee_id_number' => $this->faker->unique()->numerify('#####'),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
        ];
    }
}
