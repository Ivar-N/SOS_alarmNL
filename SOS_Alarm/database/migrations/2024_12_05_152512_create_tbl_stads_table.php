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
        Schema::create('tbl_stads', function (Blueprint $table) {
            $table->id('StadID'); // Primary key
            $table->foreignId('LandID')
                  ->constrained('tbl_lands', 'LandID') // Ensure the table name matches tbl_lands
                  ->onDelete('cascade');
            $table->string('StadNaam'); // Column for city name
            $table->timestamps(); // Adds timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_stads');
    }
};
