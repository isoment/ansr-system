<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeServiceRequestHistory extends Component
{
    use WithPagination;
    use PropertySelectable;

    public $propertySearch;
    public $selectedProperty;
    public $unitSearch;

    public function updating()
    {
        $this->resetPage();
    }

    /**
     *  Method to return service requests
     *  @return collection
     */
    public function getServiceRequests()
    {
        return ServiceRequest::whereHas('lease.property', function($query) {

            $query->when($this->selectedProperty, function($query) {
                $query->where('id', $this->selectedProperty['id']);
            });

        })->whereHas('lease', function($query) {

            $query->where('unit', 'like', '%'.$this->unitSearch.'%');

        })->with('lease.property')->paginate(6);
    }

    /**
     *  Method to return property list
     *  @return collection
     */
    public function getPropertyList()
    {
        if (Gate::allows('isManagement')) {

            return Property::where(function($query) {

                $query->where('street', 'like', '%'.$this->propertySearch.'%')
                    ->orWhere('city', 'like', '%'.$this->propertySearch.'%')
                    ->orWhere('zipcode', 'like', '%'.$this->propertySearch.'%');
    
            })->limit(8)->get();

        } else {

            return Property::whereHas('region', function($query) {

                $query->where('region_name', users_region());

            })->where(function($query) {

                $query->where('street', 'like', '%'.$this->propertySearch.'%')
                    ->orWhere('city', 'like', '%'.$this->propertySearch.'%')
                    ->orWhere('zipcode', 'like', '%'.$this->propertySearch.'%');

            })->limit(8)->get();

        }
    }

    public function render()
    {
        return view('livewire.employee-service-request-history', [

            'properties' => $this->getPropertyList(),

            'serviceRequests' => $this->getServiceRequests(),

        ]);
    }
}
