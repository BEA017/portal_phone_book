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
        Schema::create('people', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('personName')->charset('utf8')->collation('utf8_unicode_ci');;
            $table->date('dateOfBirth')->nullable();
            $table->text('personalPhoneNumber')->nullable();
            $table->text('personalEmail')->nullable();
            $table->text('personalAddress')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
