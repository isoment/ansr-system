<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use Livewire\Component;
use Livewire\WithPagination;

class TenantRequestIndex extends Component
{
    use WithPagination;

    public $open = true;
    public $sortAsc = false;

    public function sortDirection()
    {
        $this->sortAsc = ! $this->sortAsc;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tenant-request-index', [
            'requests' => ServiceRequest::where('tenant_id', auth()->user()->userable->id)
                                ->where('completed_date', $this->open ? '=' : '!=', null)
                                ->orderBy('created_at', $this->sortAsc ? 'asc' : 'desc')
                                ->paginate(5)
        ]);
    }
}
