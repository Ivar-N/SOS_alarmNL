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
            $table->id('StadID'); // Primary key with custom name 'StadID'
            $table->foreignId('LandID')  // Foreign key to tbl_land table
                  ->constrained('tbl_land')  // Ensures the foreign key points to tbl_land
                  ->onDelete('cascade');  // Deletes cities if the corresponding country is deleted
            $table->string('StadNaam'); // Column for city name
            $table->timestamps(); // To add 'created_at' and 'updated_at' timestamps
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
