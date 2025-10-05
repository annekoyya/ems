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
    Schema::table('terminations', function (Blueprint $table) {
        $table->boolean('final_pay_ack')->default(false);
    });
}

public function down(): void
{
    Schema::table('terminations', function (Blueprint $table) {
        $table->dropColumn('final_pay_ack');
    });
}

};
