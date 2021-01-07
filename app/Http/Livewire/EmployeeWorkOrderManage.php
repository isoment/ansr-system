<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeWorkOrderManage extends Component
{
    public $workOrder;

    public function render()
    {
        return view('livewire.employee-work-order-manage');
    }
}
