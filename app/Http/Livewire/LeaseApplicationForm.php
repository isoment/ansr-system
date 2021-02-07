<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\LeaseApplication;
use App\Rules\Currency;
use App\Rules\PhoneNumber;
use App\Rules\SSN;
use Livewire\Component;

class LeaseApplicationForm extends Component
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
        $grossMonthlyIncome, $incomeOther, $grossIncomeOther, $childSupport,
        $alimony, $carPayment;

    // Step Five: References
    public $refOneName, $refOneEmail, $refOnePhone, $refTwoName, $refTwoEmail, $refTwoPhone, $pets;

    // Final
    public $eviction, $agreeTerms = false, $criminal, $signature, $dateSigned;

    public $step = 4;
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
            'leaseEnd' => ['required', 'date'],
            'landlordName' => 'required',
            'landlordPhone' => ['required', new PhoneNumber],
            'landlordEmail' => 'email',

            'currentEmployer' => 'required',
            'employerEmail' => 'email',
            'employerAddress' => 'required',
            'employerPhone' => ['required', new PhoneNumber],
            'employmentDuration' => 'required',
            'grossMonthlyIncome' => ['required', new Currency],
            'incomeOther' => 'required',
            'grossIncomeOther' => ['required', new Currency],
            'childSupport' => ['required', new Currency],
            'alimony' => ['required', new Currency],
            'carPayment' => ['required', new Currency],

            'refOneName' => 'required',
            'refOneEmail' => ['required', 'email'],
            'refOnePhone' => ['required', new PhoneNumber],
            'refTwoName' => 'required',
            'refTwoEmail' => ['required', 'email'],
            'refTwoPhone' => ['required', new PhoneNumber],
            'pets' => 'required',

            'criminal' => 'required',
            'eviction' => 'required',
            'agreeTerms' => 'required',
            'signature' => 'required',
            'dateSigned' => ['required', 'date'],

        ]);
    }

    public function stepOneSubmit()
    {
        $this->validate([
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
        $this->validate([
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

            $this->validate([
                'currentAddress' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => ['required', 'digits:5'],
                'livingDuration' => 'required',
                'monthlyPayment' => ['required', new Currency],
                'movingReason' => 'required',
                'leaseEnd' => ['required', 'date'],
                'landlordName' => 'required',
                'landlordPhone' => ['required', new PhoneNumber],
                'landlordEmail' => 'email',
            ]);

        } else {

            $this->validate([
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

    public function stepFourSubmit()
    {
        $this->validate([
            'currentEmployer' => 'required',
            'employerEmail' => 'email',
            'employerAddress' => 'required',
            'employerPhone' => ['required', new PhoneNumber],
            'employmentDuration' => 'required',
            'grossMonthlyIncome' => ['required', new Currency],
            'incomeOther' => 'required',
            'grossIncomeOther' => ['required', new Currency],
            'childSupport' => ['required', new Currency],
            'alimony' => ['required', new Currency],
            'carPayment' => ['required', new Currency],
        ]);

        $this->step = 5;
    }

    public function stepFiveSubmit()
    {
        $this->validate([
            'refOneName' => 'required',
            'refOneEmail' => ['required', 'email'],
            'refOnePhone' => ['required', new PhoneNumber],
            'refTwoName' => 'required',
            'refTwoEmail' => ['required', 'email'],
            'refTwoPhone' => ['required', new PhoneNumber],
            'pets' => 'required',
        ]);

        $this->step = 6;
    }

    public function stepFinal()
    {
        $this->validate([
            'criminal' => 'required',
            'eviction' => 'required',
            'agreeTerms' => 'required',
            'signature' => 'required',
            'dateSigned' => ['required', 'date'],
        ]);

        LeaseApplication::create([

        ]);
    }

    public function back($step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.lease-application-form', [

            'properties' => Property::get()->pluck('name'),

        ]);
    }
}
