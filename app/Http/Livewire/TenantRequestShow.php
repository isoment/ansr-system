<?php

namespace App\Http\Livewire;

use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Livewire\Component;

class TenantRequestShow extends Component
{
    public $serviceRequest;
    public $selectedWorkOrder;

    public function selectWorkOrder($workOrderId)
    {
        $this->selectedWorkOrder = $workOrderId;
    }

    public function workDetailCount($operator)
    {
        return WorkDetails::whereHas('workOrder.serviceRequest', function($query) {
                $query->where('id', $this->serviceRequest->id);
            })->where('end_date', $operator, null)->count();
    }

    public function render()
    {
        return view('livewire.tenant-request-show', [

            'workOrders' => $this->serviceRequest->workOrders,

            'currentWorkOrder' => WorkOrder::where('id', $this->selectedWorkOrder)
                ->first(),

            'workDetails' => WorkDetails::where('work_order_id', $this->selectedWorkOrder)
                ->orderBy('created_at')->get(),

            'workDetailsOpen' => $this->workDetailCount('='),

            'workDetailsClosed' => $this->workDetailCount('!='),
        ]);
    }
}
