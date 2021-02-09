<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\LeaseApplication;
use App\Rules\Currency;
use App\Rules\PhoneNumber;
use App\Rules\SSN;
use Illuminate\Support\Facades\Crypt;
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

    public $step = 1;

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

        $confirmationNumber = $this->generateConfirmation();

        LeaseApplication::create([
            'property_id' => Property::where('name', $this->propertyId)->first()->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'SSN' => $this->encryptSSN($this->ssn),
            'birth_date' => $this->birthDate,
            'phone_number' => $this->phone,
            'email' => $this->email,
            'drivers_license_number' => $this->driversLicenseNumber,
            'drives_license_state' => $this->driversLicenseState,
            'drives_license_exp' => $this->driversLicenseExp,
            'emergency_contact' => $this->emergencyContact,
            'contact_relationship' => $this->contactRelationship,
            'contact_phone' => $this->contactPhone,
            'contact_email' => $this->contactEmail,
            'current_address' => $this->currentAddress,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'monthly_payment' => $this->monthlyPayment,
            'living_duration' => $this->livingDuration,
            'landlord_name' => $this->landlordName,
            'landlord_phone_number' => $this->landlordPhone,
            'landlord_email' => $this->landlordEmail,
            'lease_end' => $this->leaseEnd,
            'moving_reason' => $this->movingReason,
            'current_employer' => $this->currentEmployer,
            'employer_email' => $this->employerEmail,
            'employer_address' => $this->employerAddress,
            'employer_phone' => $this->employerPhone,
            'employment_duration' => $this->employmentDuration,
            'gross_monthly_income' => $this->grossMonthlyIncome,
            'income_other' => $this->incomeOther,
            'gross_income_other' => $this->grossMonthlyIncome,
            'child_support' => $this->childSupport,
            'alimony' => $this->alimony,
            'car_payment' => $this->carPayment,
            'ref_one_name' => $this->refOneName,
            'ref_one_email' => $this->refOneEmail,
            'ref_one_phone' => $this->refOnePhone,
            'ref_two_name' => $this->refTwoName,
            'ref_two_email' => $this->refTwoEmail,
            'ref_two_phone' => $this->refTwoPhone,
            'pets' => $this->pets,
            'eviction' => $this->eviction,
            'criminal' => $this->criminal,
            'agree_terms' => $this->agreeTerms,
            'signature' => $this->signature,
            'signature_date' => $this->dateSigned,
            'confirmation_number' => $confirmationNumber,
            'status' => 'open',
        ]);

        session()->flash('confirmation_number', $confirmationNumber);

        return redirect()->to(route('lease-application-confirmation'));
    }

    /**
     *  Method to return to previous step
     */
    public function back($step)
    {
        $this->step = $step;
    }

    /**
     *  Method to generate a confirmation number
     */
    private function generateConfirmation()
    {
        return $this->firstName[0] . $this->lastName[0] . time() . rand(1000, 9999);
    }

    /**
     *  Method to encrypt SSN
     */
    private function encryptSSN($string)
    {
        return Crypt::encryptString($string);
    }

    public function render()
    {
        return view('livewire.lease-application-form', [

            'properties' => Property::get()->pluck('name'),

        ]);
    }
}
