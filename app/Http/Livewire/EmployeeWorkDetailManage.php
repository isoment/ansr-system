<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class EmployeeWorkDetailManage extends Component
{
    public $workDetail;

    public $details;
    public $tenantNotes;
    public $startdate;

    protected $rules = [
        'details' => 'required',
        'tenantNotes' => 'required',
        'startdate' => 'date',
    ];

    public function mount($workDetail)
    {
        $this->details = $workDetail->details;
        $this->tenantNotes = $workDetail->tenant_notes;
        $this->startdate = $workDetail->start_date ? $this->mysqlToViewDateConversion($workDetail->start_date) : NULL;
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
        if ($this->workDetail->end_date) {
            $this->workDetail->update(['end_date' => NULL]);
        } else {
            $this->workDetail->update(['end_date' => now()]);
        }
    }

    /**
     *  Edit work detail
     */
    public function editWorkDetail()
    {
        $this->validate([
            'details' => 'required',
            'tenantNotes' => 'required',
            'startdate' => 'date',
        ]);

        $this->workDetail->update([
            'details' => $this->details,
            'tenant_notes' => $this->tenantNotes,
            'start_date' => $this->startdate,
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
        return view('livewire.employee-work-detail-manage');
    }
}
