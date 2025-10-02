<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('new_hires', function (Blueprint $table) {
        $table->id();
        $table->string('fullname');
        $table->string('department');
        $table->string('position');
        $table->date('date_submitted'); // Remove ->nullable() if it exists
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_hires');
    }
};
