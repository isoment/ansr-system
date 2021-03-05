<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeLeaseShow extends Component
{
    public $lease;

    public function render()
    {
        return view('livewire.employee-lease-show', [

            'tenantsOnLease' => $this->lease->tenants,
            
        ]);
    }
}
