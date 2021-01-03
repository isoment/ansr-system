<?php

namespace App\Http\Livewire;

use App\Models\RequestCategory;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeRequestCategory extends Component
{
    use WithPagination;

    public $name;

    protected $rules = [
        'name' => 'required|max:30',
    ];

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        RequestCategory::create([
            'name' => $this->name,
        ]);

        $this->name = '';

        session()->flash('success', 'New category added');
    }

    public function deleteCategory($id) 
    {
        $currentCategory = RequestCategory::find($id);

        if (! $currentCategory->requestsAssociated()) {

            $currentCategory->delete();

        }
    }

    public function render()
    {
        return view('livewire.employee-request-category', [
            'requestCategories' => RequestCategory::orderBy('created_at', 'desc')
                ->paginate(4),
        ]);
    }
}
