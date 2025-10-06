<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->foreignId('new_hire_id')->nullable()->constrained()->onDelete('set null');

        // Personal Info
        $table->string('first_name');
        $table->string('last_name');
        $table->string('middle_name')->nullable();
        $table->string('name_extension')->nullable();
        $table->date('date_of_birth');

        // Contact
        $table->string('home_address')->nullable();
        $table->string('emergency_contact_name')->nullable();
        $table->string('email')->unique();
        $table->string('emergency_contact_number')->nullable();
        $table->string('phone_number')->nullable();
        $table->string('relationship')->nullable();

        // Financial
        $table->string('tin')->nullable();
        $table->string('sss_number')->nullable();
        $table->string('pagibig_number')->nullable();
        $table->string('bank_name')->nullable();
        $table->string('account_name')->nullable();
        $table->string('account_number')->nullable();

        // Job
        $table->date('start_date');
        $table->string('department');
        $table->string('job_category')->nullable();
        $table->string('employment_type')->nullable();
        $table->string('reporting_manager')->nullable();

        $table->timestamps();
    
        $table->string('department')->nullable();
        $table->string('status')->default('active');
        $table->date('termination_date')->nullable();
        $table->date('last_working_day')->nullable();
        $table->text('termination_reason')->nullable();
        $table->string('required_paperwork')->nullable();

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

