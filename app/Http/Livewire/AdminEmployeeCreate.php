<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Region;
use Livewire\Component;

class AdminEmployeeCreate extends Component
{
    public $firstName;
    public $lastName;
    public $phone;
    public $email;
    public $region;
    public $role;
    public $employeeId;

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:employees',
        'region' => 'required',
        'role' => 'required',
        'employeeId' => 'required|unique:employees,employee_id_number',
    ];

    public function mount()
    {
        $this->region = auth()->user()->userable->region->region_name;
        $this->role = 'Administrative';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createEmployee()
    {
        $this->validate();

        Employee::create([
            'region_id' => Region::where('region_name', $this->region)->first()->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'role' => $this->role,
            'phone' => $this->phone,
            'email' => $this->email,
            'employee_id_number' => $this->employeeId,
        ]);

        session()->flash('success', 'Employee created successfully');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->firstName = '';
        $this->lastName = '';
        $this->phone = '';
        $this->email = '';
        $this->region = '';
        $this->role = '';
        $this->employeeId = '';
    }

    public function render()
    {
        return view('livewire.admin-employee-create', [
            'regions' => Region::pluck('region_name'),
        ]);
    }
}
