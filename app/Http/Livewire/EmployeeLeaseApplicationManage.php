<?php

namespace App\Http\Livewire;

use App\Models\Lease;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EmployeeLeaseApplicationManage extends Component
{
    public $leaseApplication;
    public $leaseStatus;
    public $startDate;
    public $endDate;
    public $toggleModal = false;

    protected $rules = [
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ];

    public function mount()
    {
        $this->leaseStatus = $this->leaseApplication->status;
    }

    /**
     *  When the select element is changed update the application status
     */
    public function updatedLeaseStatus($value)
    {
        if ($this->leaseApplication->lease) {
            session()->flash('error', 'You cannot change the status after creating a lease');
            return;
        }

        if (in_array($value, ['open', 'approved', 'denied'])) {
            $this->leaseApplication->update([
                'status' => $value,
            ]);
        }
    }

    /**
     *  Create a new lease
     */
    public function newLease()
    {
        if ($this->leaseApplication->lease) {
            session()->flash('error', 'A lease has already been created');
            return;
        }

        $this->validate();

        $newLease = Lease::create([
            'property_id' => $this->leaseApplication->propertyListing->property->id,
            'unit' => $this->leaseApplication->propertyListing->unit,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->leaseApplication->update([
            'lease_id' => $newLease->id,
        ]);

        $this->leaseApplication->propertyListing->update([
            'available' => false,
        ]);

        $this->toggleModal = false;

        session()->flash('success', 'Lease created successfully');

        return redirect()->to(route('employee.lease-application-manage', $this->leaseApplication->id));
    }

    /**
     *  Decrypt SSN
     */
    private function decryptSSN()
    {
        return Crypt::decryptString($this->leaseApplication->SSN);
    }

    public function render()
    {
        return view('livewire.employee-lease-application-manage', [

            'ssn' => $this->decryptSSN(),

            'associatedLease' => $this->leaseApplication->lease,

        ]);
    }
}
