<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'region_id' => Region::all()->random()->id,
            'name' => $this->faker->sentence(3),
            'street' => function() {
                return $this->faker->buildingNumber . ' ' . $this->faker->streetName 
                    . ' ' . $this->randomSuffix();
            },
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zipcode' => $this->faker->numberBetween(10000, 90000),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
        ];
    }

    /**
     *  Choose random street suffix
     */
    private function randomSuffix()
    {
        $array = array('St', 'Ln', 'Way', 'Rd', 'Blvd', 'Ave');
        $index = array_rand($array);
        return $array[$index];
    }
}
