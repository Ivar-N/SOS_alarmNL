<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblAdres extends Model
{
    use HasFactory;

    protected $table = 'tbl_adres'; // Specify the table name if necessary

    protected $fillable = ['StadID', 'straatnaam', 'huisnummer', 'postcode']; // Mass-assignable columns

    // Define the relationship with the TblStad model
    public function stad()
    {
        return $this->belongsTo(TblStad::class, 'StadID'); // An address belongs to a city (Stad)
    }
}

