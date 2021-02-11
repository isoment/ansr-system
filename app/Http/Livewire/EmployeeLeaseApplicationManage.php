<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class EmployeeLeaseApplicationManage extends Component
{
    public $leaseApplication;

    public function decryptSSN()
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
