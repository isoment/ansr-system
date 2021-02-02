<?php

namespace App\Http\Livewire;

use App\Models\WorkDetails;
use App\Models\WorkOrder;
use App\Rules\Currency;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeServiceRequestManage extends Component
{
    use WithPagination;

    public $request;
    public $currentWorkOrderId;
    public $tenantCharges;

    public function rules()
    {
        return [
            'tenantCharges' => [new Currency],
        ];
    }

    protected $rules = [
        'tenantCharges' => 'regex:/^[0-9]+(\.[0-9]{1,2})?$/',
    ];

    public function mount($request) 
    {
        $this->tenantCharges = $request->tenant_charges ? $request->tenant_charges : NULL;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Toggle Complete
     */
    public function toggleComplete()
    {
        if (Gate::allows('isAdministrativeOrManagement')) {

            if ($this->request->completed_date) {
                $this->request->update(['completed_date' => NULL]);
            } else {
                if ($this->request->allWorkOrdersComplete()) {
                    $this->request->update(['completed_date' => now()]);
                } else {
                    session()->flash('error', 'All work orders must be completed to close this service request');
                }
            }
            
        }
    }

    /**
     *  Edit tenant charges
     */
    public function editTenantCharges()
    {
        if (Gate::allows('isAdministrativeOrManagement')) {

            $this->validate();

            $this->request->update([
                'tenant_charges' => $this->tenantCharges,
            ]);
    
            session()->flash('success', 'Tenant charges updated');

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
        if (Gate::allows('isAdministrativeOrManagement')) {

            if ( ! $this->request->completed_date) {

                WorkOrder::create([
                    'service_request_id' => $this->request->id,
                ]);
                $this->request = $this->request->fresh();
                
            } else {
                session()->flash('error', 'You cannot add a new work order to a closed request');
            }

        }
    }

    /**
     *  Delete work order
     */
    public function deleteWorkOrder($id)
    {
        if (Gate::allows('isAdministrativeOrManagement')) {

            $workOrder = WorkOrder::find($id);

            if (! $workOrder->hasWorkDetails()) {
                $workOrder->delete();
            }

            $this->request = $this->request->fresh();

        }
    }

    public function render()
    {
        return view('livewire.employee-service-request-manage', [

            'workOrders' => $this->request->workOrders,

            'workOrderDetails' => WorkDetails::where('work_order_id', $this->currentWorkOrderId)
                ->paginate(5),

        ]);
    }
}
