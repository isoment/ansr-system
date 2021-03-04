<?php

namespace App\Http\Livewire;

use App\Models\Lease;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeaseManage extends Component
{
    use WithPagination;

    public $search;
    public $showCreateModal = 'false';
    public $propertySearch;
    public $selectedProperty;
    public $unit;
    public $startDate;
    public $endDate;

    protected $rules = [
        'selectedProperty' => 'required',
        'unit' => 'required',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Set the selected property
     */
    public function setProperty($property)
    {
        $this->selectedProperty = $property;
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

    public function render()
    {
        return view('livewire.employee-lease-manage', [

            'leases' => Lease::whereHas('property', function($query) {
                    $query->where('street', 'like', '%'.$this->search.'%');
                    $query->orWhere('city', 'like', '%'.$this->search.'%');
                })->orWhere('id', 'like', '%'.$this->search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(9),

            'propertyResult' => Property::where('street', 'like', '%'.$this->propertySearch.'%')
                ->limit(4)->get(),

        ]);
    }
}
