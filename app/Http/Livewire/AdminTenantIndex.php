<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTenantIndex extends Component
{
    use WithPagination;

    public $search;
    public $sortAscending = true;
    public $sortColumn;

    protected $queryString = ['search', 'sortAscending', 'sortColumn'];

    /**
     *  Method to set column and sort order
     */
    public function sortBy($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortAscending = ! $this->sortAscending;
        } else {
            $this->sortAscending = true;
        }
        $this->sortColumn = $column;
    }

    public function upDatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin-tenant-index', [
            'tenants' => Tenant::where(function($query) {
                $query->where('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('lease_id', 'like', '%'.$this->search.'%');
            })->when($this->sortColumn, function($query) {
                $query->orderBy($this->sortColumn, $this->sortAscending ? 'asc' : 'desc');
            })->paginate(10),
        ]);
    }
}
