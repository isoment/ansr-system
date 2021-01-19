<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
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

    public function render()
    {
        return view('livewire.employee-service-request-index', [

            'requests' => ServiceRequest::whereHas('tenant', function($query) {

                $query->where('issue', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('lease_id', 'like', '%'.$this->search.'%');

            })->with('tenant')->where('completed_date', $this->open ? '=' : '!=', null)
                ->orderBy('created_at', 'desc')->paginate(10),

        ]);
    }
}
