<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use App\Models\Tenant;
use App\Models\WorkOrder;
use Livewire\Component;

class EmployeeServiceRequestManage extends Component
{
    public $request;

    public function toggleComplete()
    {
        if ($this->request->completed_date) {
            $this->request->update(['completed_date' => NULL]);
        } else {
            $this->request->update(['completed_date' => now()]);
        }
    }

    public function newWorkOrder()
    {
        WorkOrder::create([
            'service_request_id' => $this->request->id,
        ]);
    }

    public function deleteWorkOrder($id)
    {
        $workOrder = WorkOrder::find($id);

        $workOrder->delete();
    }

    public function render()
    {
        return view('livewire.employee-service-request-manage', [

            'workOrders' => WorkOrder::where('service_request_id', $this->request->id)->get(),

        ]);
    }
}
