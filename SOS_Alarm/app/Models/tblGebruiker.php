<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TblGebruiker extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_gebruiker';

    // Define mass-assignable fields
    protected $fillable = [
        'AdresID', 
        'Naam', 
        'Achternaam', 
        'Wachtwoord', 
        'Telefoonnummer'
    ];

    // Hide sensitive fields from API responses
    protected $hidden = [
        'Wachtwoord', 
        'remember_token',
    ];

    // Accessor to use 'Wachtwoord' as the password field for authentication
    public function getAuthPassword()
    {
        return $this->Wachtwoord;
    }

    // Define the relationship with TblAdres (a user belongs to one address)
    public function adres()
    {
        return $this->belongsTo(TblAdres::class, 'AdresID'); // Foreign key is AdresID
    }

    // Automatically hash passwords before saving to the database
    public function setWachtwoordAttribute($value)
    {
        $this->attributes['Wachtwoord'] = bcrypt($value);
    }
}