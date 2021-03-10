<?php

namespace App\Http\Livewire;

use App\Models\ServiceRequest;
use Livewire\Component;
use Livewire\WithPagination;

class TenantRequestIndex extends Component
{
    use WithPagination;

    public $open = true;

    protected $queryString = ['open'];

    public function render()
    {
        return view('livewire.tenant-request-index', [
            'requests' => ServiceRequest::where('tenant_id', auth()->user()->userable->id)
                                ->where('completed_date', $this->open ? '=' : '!=', null)
                                ->orderBy('created_at', 'desc')
                                ->paginate(9)
        ]);
    }
}
