<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\WorkDetails;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeWorkOrderManage extends Component
{
    use WithPagination;

    public $workOrder;
    
    public $assignment;
    public $startdate;
    public $tenantNotes;
    public $formDetails;

    protected $rules = [
        'assignment' => 'string|required',
        'startdate' => 'date',
        'tenantNotes' => 'required',
        'formDetails' => 'required',
    ];

    public function mount($workOrder)
    {
        $this->assignment = $workOrder->employee ? $workOrder->employee->employee_id_number : NULL;
        $this->startdate = $workOrder->start_date ? $this->mysqlToViewDateConversion($workOrder->start_date) : NULL;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Toggle complete
     */
    public function toggleEndDate()
    {
        if ($this->workOrder->end_date) {
            $this->workOrder->update(['end_date' => NULL]);
        } else {
            $this->workOrder->update(['end_date' => now()]);
        }
    }

    /**
     *  Edit work order
     */
    public function editWorkOrder()
    {
        $this->validate([
            'assignment' => 'string|required',
            'startdate' => 'date',
        ]);

        $this->workOrder->update([
            'employee_id' => Employee::where('employee_id_number', $this->assignment)
                ->first()->id,
            'start_date' => $this->startdate,
        ]);

        $this->workOrder = $this->workOrder->fresh();

        session()->flash('success', 'Work order updated');
    }

    /**
     *  Create work order detail
     */
    public function createWorkDetail()
    {
        $this->validate([
            'tenantNotes' => 'required',
            'formDetails' => 'required',
        ]);

        WorkDetails::create([
            'work_order_id' => $this->workOrder->id,
            'details' => $this->formDetails,
            'tenant_notes' => $this->tenantNotes,
        ]);
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

            'details' => $this->workOrder->workDetails()
                ->orderBy('created_at', 'desc')->paginate(5),

        ]);
    }
}
