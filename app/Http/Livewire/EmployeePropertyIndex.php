<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeePropertyIndex extends Component
{
    use WithPagination;

    

    public function render()
    {
        return view('livewire.employee-property-index', [
            'properties' => Property::paginate(10),
        ]);
    }
}
