<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TblGebruiker extends Model
{
    use HasFactory;

    protected $table = 'tbl_gebruiker'; // Specify the table name if necessary

    protected $fillable = ['AdresID', 'Naam', 'Achternaam', 'Wachtwoord', 'Telefoonnummer']; // Mass-assignable columns

    // Define the relationship with the TblAdres model
    public function adres()
    {
        return $this->belongsTo(TblAdres::class, 'AdresID'); // A user belongs to one address (Adres)
    }

    // You can also add mutators for password hashing
    public function setWachtwoordAttribute($value)
    {
        $this->attributes['Wachtwoord'] = bcrypt($value); // Hash password before saving
    }
}