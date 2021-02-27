<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeServiceRequestIndex extends Component
{
    use WithPagination;

    public $open = true;
    public $search;

    protected $queryString = ['search', 'open'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     *  Method to return an eloquent collection of Service Requests.
     *  If the user is a manager it will return all requests, else
     *  only from the region the logged in user belongs to.
     * 
     *  @return Collection
     */
    public function getRequestsByRole()
    {
        if (Gate::allows('isManagement')) {

            return ServiceRequest::whereHas('tenant', function($query) {

                $query->where('issue', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('lease_id', 'like', '%'.$this->search.'%');

            })->with('tenant')->where('completed_date', $this->open ? '=' : '!=', null)
                ->orderBy('created_at', 'desc')->paginate(10);

        } else {

            return ServiceRequest::whereHas('tenant.lease.property.region', function($query) {

                $currentEmployeeRegion = auth()->user()->userable->region->region_name;
                $query->where('region_name', $currentEmployeeRegion);

            })->whereHas('tenant', function($query) {

                $query->where('issue', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('lease_id', 'like', '%'.$this->search.'%');

            })->with('tenant')->where('completed_date', $this->open ? '=' : '!=', null)
                ->orderBy('created_at', 'desc')->paginate(10);

        }
    }

    public function render()
    {
        return view('livewire.employee-service-request-index', [

            'requests' => $this->getRequestsByRole(),
            
        ]);
    }
}
