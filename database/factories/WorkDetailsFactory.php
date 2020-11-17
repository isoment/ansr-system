<?php

namespace Database\Factories;

use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_order_id' => WorkOrder::all()->random()->id,
            'details' => $this->faker->sentence,
            'tenant_notes' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('-10 days', '-6days', null),
            'end_date' => $this->faker->dateTimeBetween('-5days', 'now', null),
        ];
    }
}
