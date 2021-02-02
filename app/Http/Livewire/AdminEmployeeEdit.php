<?php

namespace App\Http\Livewire;

use App\Models\Region;
use Livewire\Component;

class AdminEmployeeEdit extends Component
{
    public $employee;
    public $firstName;
    public $lastName;
    public $phone;
    public $email;
    public $region;
    public $role;

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'region' => 'required',
        'role' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($employee)
    {
        $this->firstName = $employee->first_name;
        $this->lastName = $employee->last_name;
        $this->phone = $employee->phone;
        $this->email = $employee->email;
        $this->role = $employee->role;
        $this->region = Region::find($employee->region_id)->region_name;
    }

    public function editEmployee()
    {
        $this->validate();

        $this->employee->update([
            'region_id' => Region::where('region_name', $this->region)->first()->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'role' => $this->role,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Employee updated successfully');
    }

    public function render()
    {
        return view('livewire.admin-employee-edit', [
            'regions' => Region::pluck('region_name'),
        ]);
    }
}
