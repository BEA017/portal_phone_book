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
        Schema::create('employee_accountings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('idPerson');
            $table->date('dateStartAccounting')->nullable();
            $table->date('dateEndAccounting')->nullable();
            $table->text('accountingInfo')->charset('utf8')->collation('utf8_unicode_ci')->nullable();;

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_accountings');
    }
};
