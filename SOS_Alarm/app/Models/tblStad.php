<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblStad extends Model
{
    use HasFactory;

    protected $table = 'tbl_stad'; // Tabelnaam

    protected $primaryKey = 'stadID'; // Primaire sleutel

    protected $fillable = [
        'landID',
        'stadNaam',
    ];

    // Relatie met tblLand
    public function land()
    {
        return $this->belongsTo(tblLand::class, 'landID', 'landID');
    }

    // Relatie met tblAdres
    public function adressen()
    {
        return $this->hasMany(tblAdres::class, 'stadID', 'stadID');
    }
}
