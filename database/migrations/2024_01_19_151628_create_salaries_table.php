<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Utilities\DayAndMonth;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->enum('month',DayAndMonth::valueArray());
            $table->string("year");
            $table->date('date_of_receive')->nullable();
            $table->double("basic_salary");
            $table->double('bonus');
            $table->double("allowances");
            $table->double('deduction')->default(0);
            $table->double('paid');
            $table->boolean("is_received");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
