<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\WorkDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
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
        'assignment' => 'string|required|exists:employees,employee_id_number',
        'startdate' => 'date|required',
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
            if ($this->workOrder->allDetailsCompleted() && 
                $this->workOrder->workDetails->isNotEmpty() && 
                $this->workOrder->start_date !== NULL) {

                    $this->workOrder->update(['end_date' => now()]);
                    
            } elseif ($this->workOrder->workDetails->isEmpty()) {
                session()->flash('error', 'You cannot complete this order until details are added');
            } elseif ($this->workOrder->start_date === NULL) {
                session()->flash('error', 'You cannot complete this order without a start date');
            } else {
                session()->flash('error', 'All details must be completed before completing this work order');
            }
        }
    }

    /**
     *  Edit work order
     */
    public function editWorkOrder()
    {
        if (Gate::allows('isAdministrativeOrManagement')) {

            if ($this->workOrder->getEmployeeIdsInRegion()->contains($this->assignment)) {

                $this->validate([
                    'assignment' => 'string|required|exists:employees,employee_id_number', 
                    'startdate' => 'date|required',
                ]);
        
                $this->workOrder->update([
                    'employee_id' => Employee::where('employee_id_number', $this->assignment)
                        ->first()->id,
                    'start_date' => $this->startdate,
                ]);
        
                $this->workOrder = $this->workOrder->fresh();
        
                session()->flash('success', 'Work order updated');

            } else {

                session()->flash('error', 'You can only assign a work order to an employee in the same region');

            }

        } else {

            $this->validate([
                'startdate' => 'date',
            ]);
    
            $this->workOrder->update([
                'start_date' => $this->startdate,
            ]);
    
            $this->workOrder = $this->workOrder->fresh();
    
            session()->flash('success', 'Work order updated');

        }
    }

    /**
     *  Create work order detail
     */
    public function createWorkDetail()
    {
        if ( ! $this->workOrder->end_date) {
            $this->validate([
                'tenantNotes' => 'required',
                'formDetails' => 'required',
            ]);
    
            WorkDetails::create([
                'work_order_id' => $this->workOrder->id,
                'details' => $this->formDetails,
                'tenant_notes' => $this->tenantNotes,
            ]);

            $this->workOrder = $this->workOrder->fresh();
        } else {
            session()->flash('error', 'You cannot create new details for a completed work order');
        }
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

            'employees' => $this->workOrder->employeesInRegion(),

            'details' => $this->workOrder->workDetails()
                ->orderBy('created_at', 'desc')->paginate(5),

        ]);
    }
}
