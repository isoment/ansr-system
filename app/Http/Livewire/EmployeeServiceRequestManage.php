<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeServiceRequestManage extends Component
{
    public $request;

    public function toggleComplete()
    {
        
    }

    public function render()
    {
        return view('livewire.employee-service-request-manage');
    }
}
