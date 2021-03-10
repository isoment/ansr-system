<?php

namespace App\Http\Livewire;

use App\Models\Lease;
use App\Models\LeaseApplication;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeaseApplicationIndex extends Component
{
    use WithPagination;

    public $search;
    public $status = "open";

    protected $queryString = ['search', 'status'];

    public function updating()
    {
        $this->resetPage();
    }

    public function getLeaseApplicationsByRole()
    {
        if (Gate::allows('isManagement')) {

            return LeaseApplication::whereHas('propertyListing.property.region', function($query) {

                $query->where('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('region_name', 'like', '%'.$this->search.'%')
                    ->orWhere('confirmation_number', 'like', '%'.$this->search.'%');

            })->where('status', $this->status)
                ->orderBy('created_at', 'desc')->paginate(10);

        } else {

            return LeaseApplication::whereHas('propertyListing.property.region', function($query) {

                $query->where('region_name', users_region());

            })->where(function($query) {

                $query->where('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('confirmation_number', 'like', '%'.$this->search.'%');

            })->where('status', $this->status)
                ->orderBy('created_at', 'desc')->paginate(10);

        }
    }

    public function render()
    {
        return view('livewire.employee-lease-application-index', [

            'leases' => $this->getLeaseApplicationsByRole(),
            
        ]);
    }
}
