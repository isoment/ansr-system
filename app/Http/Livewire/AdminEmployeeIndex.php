<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class AdminEmployeeIndex extends Component
{
    use WithPagination;
    use ColumnSortable;

    public $search;
    public $sortAscending = true;
    public $sortColumn;

    protected $queryString = ['search', 'sortAscending', 'sortColumn'];

    public function render()
    {
        return view('livewire.admin-employee-index', [
            'employees' => Employee::whereHas('region', function($query) {
                $query->where('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('employee_id_number', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })->with('region')->when($this->sortColumn, function($query) {
                    $query->orderBy($this->sortColumn, $this->sortAscending ? 'asc' : 'desc');
            })->paginate(10),
        ]);
    }
}
