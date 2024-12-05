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
            $table->id('GebruikerID'); // Primary key with custom name 'GebruikerID'
            $table->foreignId('AdresID') // Foreign key to tbl_adres table
                  ->constrained('tbl_adres') // Ensures the foreign key points to tbl_adres
                  ->onDelete('cascade'); // Deletes users if the corresponding address is deleted
            $table->string('Naam'); // User's first name
            $table->string('Achternaam'); // User's last name
            $table->string('Wachtwoord'); // User's password (make sure to hash it)
            $table->string('Telefoonnummer'); // User's phone number
            $table->timestamps(); // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_gebruikers');
    }
};
