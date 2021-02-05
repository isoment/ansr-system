<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Rules\Currency;
use App\Rules\PhoneNumber;
use App\Rules\SSN;
use Livewire\Component;

class LeaseApplication extends Component
{
    // Step One: Property and Personal Info
    public $propertyId, $firstName, $lastName, $ssn, $birthDate, $phone, $email;

    // Step Two: License and emergency contact
    public $driversLicenseNumber, $driversLicenseState, $driversLicenseExp, $emergencyContact,
        $contactRelationship, $contactPhone, $contactEmail;

    // Step Three: Previous Residence
    public $currentAddress, $city, $state, $zip, $monthlyPayment, $livingDuration, 
        $landlordName, $landlordPhone, $landlordEmail, $leaseEnd, $movingReason, $rental = false;

    // Step Four: Employer and Income
    public $currentEmployer, $employerEmail, $employerAddress, $employerPhone, $employmentDuration,
        $grossMonthlyIncome, $incomeOther, $grossIncomeOther, $grossIncomeTotal, $childSupport,
        $alimony, $carPayment;

    // Step Five: References
    public $refOneName, $refOneEmail, $refOnePhone, $refTwoName, $refTwoEmail, $refTwoPhone, $criminal,
        $eviction, $pets, $agreeTerms;

    public $step = 3;
    public $stepName;

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
            'birthDate' => ['required', 'date'],
            'ssn' => ['required', new SSN],
            'propertyId' => 'required',

            'driversLicenseNumber' => 'required',
            'driversLicenseState' => 'required',
            'driversLicenseExp' => ['required', 'date'],
            'emergencyContact' => 'required',
            'contactRelationship' => 'required',
            'contactPhone' => ['required', new PhoneNumber],
            'contactEmail' => ['required', 'email'],

            'currentAddress' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => ['required', 'digits:5'],
            'livingDuration' => 'required',
            'monthlyPayment' => ['required', new Currency],
            'movingReason' => 'required',
            'leaseEnd' => 'date',
            'landlordPhone' => new PhoneNumber,
            'landlordEmail' => 'email',
        ]);
    }

    public function stepOneSubmit()
    {
        $validatedData = $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
            'birthDate' => ['required', 'date'],
            'ssn' => ['required', new SSN],
            'propertyId' => 'required',
        ]);

        $this->step = 2;
    }

    public function stepTwoSubmit()
    {
        $validatedData = $this->validate([
            'driversLicenseNumber' => 'required',
            'driversLicenseState' => 'required',
            'driversLicenseExp' => ['required', 'date'],
            'emergencyContact' => 'required',
            'contactRelationship' => 'required',
            'contactPhone' => ['required', new PhoneNumber],
            'contactEmail' => ['required', 'email'],
        ]);

        $this->step = 3;
    }

    public function stepThreeSubmit()
    {
        if ($this->rental) {

            $validatedData = $this->validate([
                'currentAddress' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => ['required', 'digits:5'],
                'livingDuration' => 'required',
                'monthlyPayment' => ['required', new Currency],
                'movingReason' => 'required',
                'leaseEnd' => 'date',
                'landlordPhone' => new PhoneNumber,
                'landlordEmail' => 'email',
            ]);

        } else {

            $validatedData = $this->validate([
                'currentAddress' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => ['required', 'digits:5'],
                'livingDuration' => 'required',
                'monthlyPayment' => ['required', new Currency],
                'movingReason' => 'required',
            ]);

        }

        $this->step = 4;
    }

    public function back($step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.lease-application', [

            'properties' => Property::get()->pluck('name'),

        ]);
    }
}
