<?php

namespace App\Http\Livewire;

use App\Models\Region;
use App\Rules\Uppercase;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeRegion extends Component
{
    use WithPagination;

    public $name;
    public $abbreviation;

    protected $rules = [
        'name' => 'required',
        'abbreviation' => 'required|alpha|min:3|max:3',
    ];

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        Region::create([
            'region_name' => $this->name,
            'slug' => $this->abbreviation,
        ]);

        $this->formReset();

        session()->flash('success', 'Region successfully added');
    }

    private function formReset()
    {
        $this->name = '';
        $this->abbreviation = '';
    }

    public function render()
    {
        return view('livewire.employee-region', [

            'regions' => Region::orderBy('created_at', 'desc')->paginate(4),

        ]);
    }
}
