<?php

namespace Database\Factories;

use App\Models\Lease;
use App\Models\RequestCategory;
use App\Models\RequestIssue;
use App\Models\ServiceRequest;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::all()->random()->id,
            'lease_id' => 0,
            'category_id' => RequestCategory::all()->random()->id,
            'issue' => $this->faker->sentence(3, true),
            'description' => $this->faker->text(300),
            'tenant_charges' => $this->faker->randomFloat(2, 20, 200),
            'assigned_date' => $this->faker->dateTimeBetween('-15 days', '-5 days', null),
            'completed_date' => $this->faker->dateTimeBetween('-4 days', 'now', null),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(ServiceRequest $serviceRequest) {
            
            $serviceRequest->update([
                'lease_id' => $serviceRequest->tenant->lease->id,
            ]);

        });
    }
}
