<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use App\Rules\LeaseExpiresWithinAWeek;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
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
    public $endDate;
    public $tenantSearch;
    public $selectedTenant;

    public $showTenantModal, $showExtendLeaseModal, $showExistingTenantModal;

    public function mount()
    {
        $this->endDate = $this->lease->endDateStringFormat();
    }

    protected function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
            'endDate' => ['required', 'date'],
            'selectedTenant' => [new LeaseExpiresWithinAWeek],
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
     *  Extend Lease
     */
    public function extendLease()
    {
        $this->validate([
            'endDate' => ['required', 'date'],
        ]);

        $this->lease->update([
            'end_date' => $this->endDate, 
        ]);

        $this->showExtendLeaseModal = false;

        session()->flash('success', 'Lease extended');
    }

    /**
     *  Select a tenant to add to the lease
     */
    public function selectTenant($tenant) 
    {
        $this->selectedTenant = $tenant;
    }

    /**
     *  Add Existing tenant to the lease
     */
    public function addExistingTenant()
    {
        if ($this->lease->leaseIsActive()) {

            $this->validate([
                'selectedTenant' => [new LeaseExpiresWithinAWeek],
            ]);

            $tenantToUpdate = Tenant::where('id', $this->selectedTenant['id'])
                ->first();

            $tenantToUpdate->update([
                'lease_id' => $this->lease->id,
            ]);

            $this->showExistingTenantModal = false;

            session()->flash('success', 'Tenant removed from previous lease and added to this lease');

        }
    }

    /**
     *  Create a new tenant and attach to this lease
     */
    public function createTenant()
    {
        if ($this->lease->leaseIsActive()) {

            $this->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => ['required', 'email'],
                'phone' => ['required', new PhoneNumber],
            ]);
    
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
    }

    public function render()
    {
        return view('livewire.employee-lease-show', [

            'tenantList' => Tenant::where(function($query) {
                $query->where('email', 'like', '%'.$this->tenantSearch.'%')
                    ->orWhere('last_name', 'like', '%'.$this->tenantSearch.'%');
            })->limit(4)->get(),

            'tenantsOnLease' => Tenant::where('lease_id', $this->lease->id)->paginate(3),

        ]);
    }
}
