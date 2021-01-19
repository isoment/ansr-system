<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminTenantEdit extends Component
{
    public $tenant;
    public $firstName;
    public $lastName;
    public $phone;
    public $email;

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
        'email' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($tenant)
    {
        $this->firstName = $tenant->first_name;
        $this->lastName = $tenant->last_name;
        $this->email = $tenant->email;
        $this->phone = $tenant->phone;
    }

    /**
     *  Edit the tenant's information
     */
    public function editTenant()
    {
        $this->validate();

        $this->tenant->update([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);

        session()->flash('success', 'Tenant updated successfully');
    }

    public function render()
    {
        return view('livewire.admin-tenant-edit');
    }
}
