<?php

namespace App\Http\Livewire;

use App\Models\Lease;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeaseManage extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        return view('livewire.employee-lease-manage', [

            'leases' => Lease::whereHas('property', function($query) {
                    $query->where('street', 'like', '%'.$this->search.'%');
                    $query->orWhere('city', 'like', '%'.$this->search.'%');
                })->orWhere('id', 'like', '%'.$this->search.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(9),

        ]);
    }
}
