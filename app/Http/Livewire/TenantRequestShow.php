<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TenantRequestShow extends Component
{
    public $serviceRequest;

    public function render()
    {
        return view('livewire.tenant-request-show', [

            'workOrders' => $this->serviceRequest->workOrders,

        ]);
    }
}
