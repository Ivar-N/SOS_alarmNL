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
        Schema::create('tbl_devices', function (Blueprint $table) {
            $table->id('DeviceID'); // Primary key with custom name 'DeviceID'
            $table->foreignId('GebruikerID') // Foreign key to tbl_gebruiker table
                  ->constrained('tbl_gebruiker') // Ensures the foreign key points to tbl_gebruiker
                  ->onDelete('cascade'); // Deletes devices if the corresponding user is deleted
            $table->string('AlarmCode'); // Column for alarm code
            $table->decimal('longitude', 10, 7); // Column for longitude (with precision for coordinates)
            $table->decimal('latitude', 10, 7); // Column for latitude (with precision for coordinates)
            $table->string('mapslink'); // Column for the maps link
            $table->string('TelefoonnummerDevice'); // Column for device phone number
            $table->integer('Batterijpercentage'); // Column for battery percentage
            $table->timestamps(); // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_devices');
    }
};
