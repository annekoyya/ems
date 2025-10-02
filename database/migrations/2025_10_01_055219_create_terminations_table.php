<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('terminations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('last_working_day');
            $table->string('reason', 500);
            $table->boolean('documentation')->default(false);
            $table->boolean('exit_interview')->default(false);
            $table->boolean('clearance_form')->default(false);
            $table->boolean('final_pay_acknowledgment')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terminations');
    }
};
