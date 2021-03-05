<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use App\Rules\PhoneNumber;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeLeaseShow extends Component
{
    use WithPagination;

    public $lease;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public $showTenantModal;

    protected function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
        ];
    }

    /**
     *  Realtime validation
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Create a new tenant and attach them to this lease
     */
    public function createTenant()
    {
        $this->validate();

        Tenant::create([
            'lease_id' => $this->lease->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->showTenantModal = false;

        session()->flash('success', 'Tenant created and attached to lease');
    }

    public function render()
    {
        return view('livewire.employee-lease-show', [

            'tenantsOnLease' => Tenant::where('lease_id', $this->lease->id)->paginate(3),

        ]);
    }
}
