<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use Livewire\Component;

class TenantRequestIndex extends Component
{
    public $open = true;
    public $sortAsc = true;

    public function sortDirection()
    {
        $this->sortAsc = ! $this->sortAsc;
    }

    public function render()
    {
        return view('livewire.tenant-request-index', [
            'requests' => ServiceRequest::where('tenant_id', auth()->user()->userable->id)
                                ->where('completed_date', $this->open ? '=' : '!=', null)
                                ->orderBy('created_at', $this->sortAsc ? 'asc' : 'desc')
                                ->get()
        ]);
    }
}
