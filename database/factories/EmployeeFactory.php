<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Property;
use App\Models\Region;
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
            'region_id' => Region::all()->random()->id,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'role' => function() {
                $roles = ['Management', 'Maintenance', 'Administrative'];
                return array_rand(array_flip($roles), 1);
            },
            'employee_id_number' => $this->faker->unique()->numerify('#####'),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
        ];
    }
}
