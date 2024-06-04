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
        Schema::create('main_structs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('structName')->charset('utf8')->collation('utf8_unicode_ci');
            $table->integer('parentId')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_structs');
    }
};
