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
        $table->id()->autoIncrement();
        $table->integer('idEmployee')->nullable();
        $table->integer('idworkingStructure')->nullable();
        $table->integer('postId')->nullable();
        $table->text('workPhoneNumber')->nullable();
        $table->text('internalPhoneNumber')->nullable();
        $table->text('workplaceAddress')->nullable();

        $table->timestamps();
        $table->softDeletes();

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
