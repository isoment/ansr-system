<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EmployeeLeaseApplicationManage extends Component
{
    public $leaseApplication;

    /**
     *  Method to approve a lease application
     */
    public function approveLease()
    {
        if ($this->leaseApplication->isOpen()) {
            $this->leaseApplication->update([
                'status' => 'approved'
            ]);

            // Eventually create a new lease in leases table
        }
    }

    /**
     *  Method to deny a lease application
     */
    public function denyLease()
    {
        if ($this->leaseApplication->isOpen()) {
            $this->leaseApplication->update([
                'status' => 'denied'
            ]);
        }
    }

    /**
     *  Method to reopen a lease application
     */
    public function reopenLease()
    {
        if ($this->leaseApplication->reopenable()) {
            $this->leaseApplication->update([
                'status' => 'open'
            ]);
        }
    }

    private function decryptSSN()
    {
        return Crypt::decryptString($this->leaseApplication->SSN);
    }

    public function render()
    {
        return view('livewire.employee-lease-application-manage', [
            'ssn' => $this->decryptSSN(),
        ]);
    }
}
