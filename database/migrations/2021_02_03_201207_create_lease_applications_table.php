<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaseApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_applications', function (Blueprint $table) {
            $table->id();

            // Property
            $table->unsignedBigInteger('property_id');

            // Personal Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('SSN');
            $table->date('birth_date');
            $table->string('phone_number');
            $table->string('email');

            // Drivers License
            $table->string('drivers_license_number');
            $table->string('drives_license_state');
            $table->date('drives_license_exp');

            // Emergency Contact
            $table->string('emergency_contact');
            $table->string('contact_relationship');
            $table->string('contact_phone');
            $table->string('contact_email')->nullable();

            // Previous Residence
            $table->string('current_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->decimal('monthly_payment');
            $table->string('living_duration');
            $table->string('landlord_name')->nullable();
            $table->string('landlord_phone_number')->nullable();
            $table->string('landlord_email')->nullable();
            $table->date('lease_end')->nullable();
            $table->text('moving_reason');

            // Employer
            $table->string('current_employer');
            $table->string('employer_email')->nullable();
            $table->string('employer_address');
            $table->string('employer_phone');
            $table->string('employment_duration');
            $table->decimal('gross_monthly_income');

            // Income Monthly
            $table->text('income_other');
            $table->decimal('gross_income_other');
            $table->decimal('child_support');
            $table->decimal('alimony');
            $table->decimal('car_payment');

            // References & Pets
            $table->string('ref_one_name');
            $table->string('ref_one_email')->nullable();
            $table->string('ref_one_phone');
            $table->string('ref_two_name');
            $table->string('ref_two_email')->nullable();
            $table->string('ref_two_phone');
            $table->text('pets');

            // Misc
            $table->text('eviction');
            $table->text('criminal');
            $table->boolean('agree_terms');
            $table->string('signature');
            $table->string('signature_date');
            $table->string('confirmation_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_applications');
    }
}
