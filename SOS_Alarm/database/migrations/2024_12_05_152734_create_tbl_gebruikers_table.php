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
        Schema::create('tbl_gebruikers', function (Blueprint $table) {
            $table->id('GebruikerID'); // Primary key
            $table->foreignId('AdresID')
                  ->constrained('tbl_adres') // Ensure the table name matches tbl_adres
                  ->onDelete('cascade');
            $table->string('Naam'); // User's first name
            $table->string('Achternaam'); // User's last name
            $table->string('Email'); // User's email
            $table->string('Wachtwoord'); // User's password
            $table->string('Telefoonnummer'); // User's phone number
            $table->timestamps(); // Adds timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_gebruiker');
    }
};
