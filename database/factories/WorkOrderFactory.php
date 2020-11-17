<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\ServiceRequest;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_request_id' => ServiceRequest::all()->random()->id,
            'employee_id' => Employee::all()->random()->id,
            'start_date' => $this->faker->dateTimeBetween('-10 days', '-6days', null),
            'end_date' => $this->faker->dateTimeBetween('-5days', 'now', null),
        ];
    }
}
