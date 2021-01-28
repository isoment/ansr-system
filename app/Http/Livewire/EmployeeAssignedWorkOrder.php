<?php

namespace App\Http\Livewire;

use App\Models\WorkOrder;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeAssignedWorkOrder extends Component
{
    use WithPagination;

    public $open = true;
    public $startDateAsc = true;

    public function toggleComplete()
    {
        $this->open = ! $this->open;
    }

    public function toggleSortStart()
    {
        $this->startDateAsc = ! $this->startDateAsc;
    }

    public function render()
    {
        return view('livewire.employee-assigned-work-order', [

            'workOrders' => WorkOrder::where('employee_id', auth()->user()->userable->id)
                ->where('end_date', $this->open ? '=' : '!=', null)
                ->orderBy('start_date', $this->startDateAsc ? 'asc' : 'desc')
                ->paginate(9),

        ]);
    }
}
