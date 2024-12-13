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
            $table->id('DeviceID'); // Primary key
            $table->foreignId('GebruikerID')
                  ->constrained('tbl_gebruikers', 'GebruikerID') // Ensure the table name matches tbl_gebruikers
                  ->onDelete('cascade');
            $table->string('AlarmCode'); // Alarm code
            $table->decimal('Longitude', 10, 7); // Longitude
            $table->decimal('Latitude', 10, 7); // Latitude
            $table->string('MapsLink'); // Maps link
            $table->string('TelefoonnummerDevice'); // Device phone number
            $table->integer('BatterijPercentage'); // Battery percentage
            $table->timestamps(); // Adds timestamps
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
