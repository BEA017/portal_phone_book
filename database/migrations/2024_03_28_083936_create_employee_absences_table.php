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
        Schema::create('employee_absences', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('idPerson');
            $table->date('dateStartAbsence')->nullable();
            $table->date('dateEndAbsence')->nullable();
            $table->integer('absenceType')->nullable();
            $table->text('absenceInfo')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_absences');
    }
};
