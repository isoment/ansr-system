<?php

namespace App\Http\Livewire;

use App\Models\WorkOrder;
use Livewire\Component;

class EmployeeAssignedWorkOrder extends Component
{
    public function render()
    {
        return view('livewire.employee-assigned-work-order', [

            'workOrders' => WorkOrder::where('employee_id', auth()->user()->userable->id)->get(),

        ]);
    }
}
