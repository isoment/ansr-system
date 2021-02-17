<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyListing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => Property::all()->random()->id,
            'unit' => NULL,
            'type' => $this->randomBuildingType(),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'sqft' => $this->faker->numberBetween(750, 3500),
            'rent' => $this->faker->numberBetween(800, 3500),
        ];
    }

    /**
     *  Choose random property type
     */
    private function randomBuildingType()
    {
        $array = array('apartment', 'house', 'townhouse');
        $index = array_rand($array);
        return $array[$index];
    }

    /**
     *  Set the unit number based on property type
     */
    public function configure()
    {
        return $this->afterCreating(function(PropertyListing $propertyListing) {

            if ($propertyListing->type == 'house') {
                $propertyListing->update([
                    'unit' => NULL
                ]);
            } else {
                $propertyListing->update([
                    'unit' => $this->faker->numberBetween(1, 900)
                ]);
            }

        });
    }
}
