<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Rules\PhoneNumber;
use App\Rules\SSN;
use Livewire\Component;

class LeaseApplication extends Component
{
    // Step One: Property and Personal Info
    public $propertyId, $firstName, $lastName, $SSN, $birthDate, $phone, $email;

    // Step Two: License and emergency contact
    public $driversLicenseNumber, $driversLicenseState, $driversLicenseExp, $emergencyContact,
        $contactRelationship, $contactPhone, $contactEmail;

    // Step Three: Previous Residence
    public $currentAddress, $city, $state, $zip, $rental, $monthlyPayment, $yearsLivedAt, 
        $landlordName, $landlordPhone, $landlordEmail, $leaseEnd, $movingReason;

    // Step Four: Employer and Income
    public $currentEmployer, $employerEmail, $employerAddress, $employerPhone, $employmentDuration,
        $grossMonthlyIncome, $incomeOther, $grossIncomeOther, $grossIncomeTotal, $childSupport,
        $alimony, $carPayment;

    // Step Five: References
    public $refOneName, $refOneEmail, $refOnePhone, $refTwoName, $refTwoEmail, $refTwoPhone, $criminal,
        $eviction, $pets, $agreeTerms;

    public $step = 1;
    public $stepName;

    public function rules()
    {
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
            'birthDate' => ['required', 'date'],
            'SSN' => ['required', new SSN],
            'propertyId' => 'required',
        ];
    }

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function stepOneSubmit()
    {

    }

    public function applicationSubmit()
    {

    }

    public function render()
    {
        return view('livewire.lease-application', [

            'properties' => Property::get()->pluck('name'),

        ]);
    }
}
