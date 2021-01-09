<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeWorkOrderManage extends Component
{
    use WithPagination;

    public $workOrder;

    public $assignment;
    public $startdate;

    protected $rules = [
        'assignment' => 'string|required',
        'startdate' => 'date',
    ];

    public function mount($workOrder)
    {
        $this->assignment = $workOrder->employee ? $workOrder->employee->employee_id_number : NULL;
        $this->startdate = $this->mysqlToViewDateConversion($workOrder->start_date);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function toggleEndDate()
    {
        if ($this->workOrder->end_date) {
            $this->workOrder->update(['end_date' => NULL]);
        } else {
            $this->workOrder->update(['end_date' => now()]);
        }
    }

    public function newDetail()
    {
        dd('TEST');
    }

    public function submitForm()
    {
        $this->validate();

        $this->workOrder->update([
            'employee_id' => Employee::where('employee_id_number', $this->assignment)
                ->first()->id,
            'start_date' => $this->startdate,
        ]);

        $this->workOrder = $this->workOrder->fresh();
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

            'details' => $this->workOrder->workDetails()->paginate(5),

        ]);
    }
}
