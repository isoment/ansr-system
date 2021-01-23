<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Region;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeePropertyIndex extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    public function updatingSearch() 
    {
        $this->resetPage();
    }

    public function getPropertiesByRole()
    {
        if (Gate::allows('isManagement')) {

            return Property::whereHas('region', function($query) {

                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('city', 'like', '%'.$this->search.'%')
                    ->orWhere('region_name', 'like', '%'.$this->search.'%');

            })->with('region')->orderBy('created_at', 'desc')->paginate(10);

        } else {

            return Property::whereHas('region', function($query) {

                $currentEmployeeRegion = auth()->user()->userable->region->region_name;
                $query->where('region_name', $currentEmployeeRegion);

            })->where(function($query) {

                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('city', 'like', '%'.$this->search.'%');

            })->orderBy('created_at', 'desc')->paginate(10);

        }
    }

    public function render()
    {
        return view('livewire.employee-property-index', [

            'properties' => $this->getPropertiesByRole(),

        ]);
    }
}
