<?php

namespace App\Http\Livewire;

use App\Models\Lease;
use App\Models\Property;
use App\Rules\DuplicateLease;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeaseManage extends Component
{
    use WithPagination;
    use PropertySelectable;

    public $search;
    public $showCreateModal = false;
    public $propertySearch;
    public $selectedProperty;
    public $unit;
    public $startDate;
    public $endDate;

    protected function rules() {
        return [
            'selectedProperty' => 'required',
            'unit' => ['required', new DuplicateLease($this->selectedProperty)],
            'startDate' => ['required','date'],
            'endDate' => ['required', 'date'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Create a new lease
     */
    public function createLease()
    {
        $this->validate();

        Lease::create([
            'property_id' => $this->selectedProperty['id'],
            'unit' => $this->unit,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->showCreateModal = false;

        session()->flash('success', 'Lease created successfully');
    }

    /**
     *  Method to get the lease by user role
     */
    public function getLeaseByRole() 
    {
        if (Gate::allows('isManagement')) {

            return Lease::whereHas('property', function($query) {

                $query->where('street', 'like', '%'.$this->search.'%')
                    ->orWhere('city', 'like', '%'.$this->search.'%'); 

            })->orWhere('id', 'like', '%'.$this->search.'%')
                ->orderBy('id', 'desc')
                ->paginate(9);

        } else {

            return Lease::whereHas('property.region', function($query) {

                $query->where('region_name', users_region());

            })->where(function($query) {

                $query->whereHas('property', function($query) {

                    $query->where('street', 'like', '%'.$this->search.'%')
                        ->orWhere('city', 'like', '%'.$this->search.'%'); 

                })->orWhere('id', 'like', '%'.$this->search.'%');

            })->orderBy('id', 'desc')
                ->paginate(9);

        }
    }

    /**
     *  Method to get properties by user role
     */
    public function getPropertyByRole()
    {
        if (Gate::allows('isManagement')) {

            return Property::where('street', 'like', '%'.$this->propertySearch.'%')
                ->limit(4)->get();

        } else {

            return Property::whereHas('region', function($query) {

                $query->where('region_name', users_region());
                
            })->where('street', 'like', '%'.$this->propertySearch.'%')
                ->limit(4)->get();

        }
    }

    public function render()
    {
        return view('livewire.employee-lease-manage', [

            'leases' => $this->getLeaseByRole(),

            'propertyResult' => $this->getPropertyByRole(),

        ]);
    }
}
