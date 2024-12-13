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
        Schema::create('tbl_lands', function (Blueprint $table) {
            $table->id('LandID'); // Primary key with consistent casing
            $table->string('LandNaam'); // Column for country name
            $table->timestamps(); // Adds timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lands');
    }
};