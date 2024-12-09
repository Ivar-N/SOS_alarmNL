<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblDevice extends Model
{
    use HasFactory;

    protected $table = 'tbl_device'; // Table name

    // Mass-assignable attributes
    protected $fillable = [
        'GebruikerID',
        'AlarmCode',
        'Longitude',
        'Latitude',
        'MapsLink',
        'TelefoonnummerDevice',
        'Batterijpercentage',
    ];

    // Define the relationship with TblGebruiker
    public function gebruiker()
    {
        return $this->belongsTo(TblGebruiker::class, 'GebruikerID');
    }
}

