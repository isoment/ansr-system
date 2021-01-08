<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Livewire\Component;

class EmployeeWorkOrderManage extends Component
{
    public $workOrder;

    public $assignment;
    public $startdate;
    public $enddate;

    protected $rules = [
        'assignment' => 'string|required',
        'startdate' => 'date',
        'enddate' => 'date',
    ];

    public function mount($workOrder)
    {
        $this->assignment = $workOrder->employee->employee_id_number;
        $this->startdate = $this->mysqlToViewDateConversion($workOrder->start_date);
        $this->enddate = $this->mysqlToViewDateConversion($workOrder->end_date);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm($workOrderId)
    {
        $this->validate();

        $workOrder = WorkOrder::find($workOrderId);
    }

    /**
     *  Method to format the date from the database into a format for the form
     */
    private function mysqlToViewDateConversion($date) 
    {
        return Carbon::parse($date)->toDateString();
    }

    public function render()
    {
        return view('livewire.employee-work-order-manage', [

            'employees' => Employee::orderBy('last_name', 'asc')->get(),

        ]);
    }
}
