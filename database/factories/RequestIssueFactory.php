<?php

namespace Database\Factories;

use App\Models\RequestIssue;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestIssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestIssue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_billable' => $this->faker->randomElement(['Billable', 'No Charge']),
            // 'bill_amount' => $this->faker->randomFloat(2, 20, 200),
            'bill_amount' => function($attributes) {
                if ($attributes['is_billable'] == 'Billable') {
                    return $this->faker->randomFloat(2, 20, 200);
                } else {
                    return 0;
                }
            },
            'note' => $this->faker->paragraph,
        ];
    }
}
