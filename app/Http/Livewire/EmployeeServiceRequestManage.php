<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use App\Models\Tenant;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeServiceRequestManage extends Component
{
    use WithPagination;

    public $request;
    public $currentWorkOrderId;

    /**
     *  Toggle Complete
     */
    public function toggleComplete()
    {
        if ($this->request->completed_date) {
            $this->request->update(['completed_date' => NULL]);
        } else {
            $this->request->update(['completed_date' => now()]);
        }
    }

    /**
     *  Set the current work order id
     */
    public function getWorkOrderDetails($workOrderID)
    {
        $this->currentWorkOrderId = $workOrderID;
    }

    /**
     *  Create new work order
     */
    public function newWorkOrder()
    {
        WorkOrder::create([
            'service_request_id' => $this->request->id,
        ]);
    }

    /**
     *  Delete work order
     */
    public function deleteWorkOrder($id)
    {
        $workOrder = WorkOrder::find($id);

        if (! $workOrder->hasWorkDetails()) {
            $workOrder->delete();
        }
    }

    public function render()
    {
        return view('livewire.employee-service-request-manage', [

            'workOrders' => WorkOrder::where('service_request_id', $this->request->id)->get(),

            'workOrderDetails' => WorkDetails::where('work_order_id', $this->currentWorkOrderId)
                ->paginate(5),

        ]);
    }
}
