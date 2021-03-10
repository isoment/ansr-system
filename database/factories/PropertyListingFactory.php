<?php

namespace Database\Factories;

use App\Models\ListingImage;
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
            'available' => TRUE,
            'description' => $this->faker->text(500),
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
     *  Choose a random image from samples
     */
    private function randomListingImage()
    {
        $listingImages = [
            '31rhy3rf8yr9feufd98ewqu.jpg',      
            '994c8dfa971578d3116a3a318cbfb84d.jpg',  
            'eijfe0fuf0e9u80942tu798efkjdspoifs.jpg',  
            'kjrewifjdsicdce98329h8ufjed.jpg',
            '3r3jurwefr9ewif9e.jpg',                 
            'd82y319r3yu0treodsajkvoidsjfids.jpg',   
            'fnjeohfihdoiscipjewq9fojeaf.jpg',         
            'ndiuvnheofheiufhewofuds.jpg',
            '3r3o8f0egwoifedosfoeefack.jpg ',        
            'dajsfd3u8ur32ufsakodsd.jpg',            
            'fnoiejfoeiwjdsoijvdsifjds.jpg',
            '3r78r89ewufdadsaid.jpg',              
            'dijfoiejfoieq83urwefwk.jpg',            
            'jf8ihjew8gf43h98t2jfidfds.jpeg',
            '963a56406945a2c1343664273e281c27.jpg', 
            'dmsijvneoiwfifhjfdsafdsf.jpg',          
            'jfeijfief908ue0984tu74298doksf.jpg',
        ];

        $index = array_rand($listingImages);

        return $listingImages[$index];
    }

    /**
     *  Set the unit number based on property type
     */
    public function configure()
    {
        return $this->afterCreating(function(PropertyListing $propertyListing) {

            // Determine if there is a unit entry based on property type
            if ($propertyListing->type === 'house') {

                $propertyListing->update([
                    'unit' => NULL
                ]);

            } else {

                $propertyListing->update([
                    'unit' => $this->faker->numberBetween(1, 900)
                ]);

            }

            // Create 5 images for each property listing
            for ($i = 0; $i < 5; $i++) {

                ListingImage::create([
                    'property_listing_id' => $propertyListing->id,
                    'image' => 'property-listing-seeder-img/' . $this->randomListingImage(),
                ]);

            }

        });
    }
}
