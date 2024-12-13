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
            $table->id('adresID'); // Primaire sleutel
            $table->unsignedBigInteger('stadID'); // Buitenlandse sleutel naar tblStad
            $table->string('straatnaam'); // Straatnaam
            $table->string('huisnummer'); // Huisnummer
            $table->string('postcode'); // Postcode
            $table->timestamps();

            // Buitenlandse sleutelrelatie met tblStad
            $table->foreign('stadID')->references('stadID')->on('tbl_stad')->onDelete('cascade');
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
