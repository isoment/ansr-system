<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeePropertyListingIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Propertyable;
use Tests\TestCase;
use Tests\TestHelpable;
use Tests\Userable;

class EmployeePropertyListingIndexTest extends TestCase
{
    use RefreshDatabase, Userable, Propertyable, TestHelpable;

    /**
     *  @test
     * 
     *  The role permissions for employee property listing index work
     */
    public function the_role_permissions_for_employee_property_listing_index_work()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $maintenance = $this->createEmployee('Maintenance');

        $this->actingAs($tenant);

        $this->get(route('employee.property-listing-index'))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.property-listing-index'))
            ->assertStatus(200);

        $this->actingAs($maintenance);

        $this->get(route('employee.property-listing-index'))
            ->assertForbidden();
    }

    /**
     *  @test
     *  
     *  Managers can see all property listings
     */
    public function managers_can_see_all_property_listings()
    {
        $manager = $this->createEmployee('Management');

        $propertyOne = $this->createProperty();

        $propertyTwo = $this->createProperty();

        $propertyOneListings = $this->createPropertyListings($propertyOne->id, 3);

        $propertyTwoListings = $this->createPropertyListings($propertyTwo->id, 3);

        $this->actingAs($manager);

        Livewire::test(EmployeePropertyListingIndex::class)
            ->assertSee(
                $this->stringLimitOrNot($propertyOneListings[1]->property->street, 20)
            )
            ->assertSee(
                $this->stringLimitOrNot($propertyTwoListings[0]->property->street, 20)
            )
            ->assertSee($propertyOneListings[1]->unit)
            ->assertSee($propertyTwoListings[2]->unit);
    }

    /**
     *  @test
     *  
     *  Administrative can only see listings in their region
     */
    public function admins_can_only_see_listings_in_their_region()
    {
        $propertyOne = $this->createProperty();

        $propertyTwo = $this->createProperty();

        $propertyOneListings = $this->createPropertyListings($propertyOne->id, 3);

        $propertyTwoListings = $this->createPropertyListings($propertyTwo->id, 3);

        $admin = $this->createEmployeeSpecifyRegion('Administrative', $propertyOne->region);

        $this->actingAs($admin);

        Livewire::test(EmployeePropertyListingIndex::class)
            ->assertSee(
                $this->stringLimitOrNot($propertyOneListings[1]->property->street, 20)
            )
            ->assertDontSee(
                $this->stringLimitOrNot($propertyTwoListings[0]->property->street, 20)
            )
            ->assertSee($propertyOneListings[1]->unit)
            ->assertDontSee($propertyTwoListings[2]->unit);
    }
}
