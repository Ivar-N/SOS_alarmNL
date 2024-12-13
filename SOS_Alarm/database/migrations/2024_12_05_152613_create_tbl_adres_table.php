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
        Schema::create('tbl_adres', function (Blueprint $table) {
            $table->id('AdresID'); // Primary key
            $table->foreignId('StadID')
                  ->constrained('tbl_stads') // Ensure the table name matches tbl_stads
                  ->onDelete('cascade');
            $table->string('StraatNaam'); // Column for street name
            $table->string('HuisNummer'); // Column for house number
            $table->string('Postcode'); // Column for postal code
            $table->timestamps(); // Adds timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_adres');
    }
};
