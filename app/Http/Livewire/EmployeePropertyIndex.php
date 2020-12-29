<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeePropertyIndex extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employee-property-index', [

            'properties' => Property::whereHas('region', function($query) {

                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('city', 'like', '%'.$this->search.'%')
                    ->orWhere('region_name', 'like', '%'.$this->search.'%');

            })->with('region')->paginate(10),
            
        ]);
    }
}
