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
        Schema::create('salary_formats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->double("basic_salary");
            $table->double('bonus');
            $table->double("meat_allowance");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_formats');
    }
};
