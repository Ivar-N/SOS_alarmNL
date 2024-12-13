<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblLand extends Model
{
    /** @use HasFactory<\Database\Factories\TblLandFactory> */
    use HasFactory;

    // Tabelnaam (optioneel als de tabel niet 'tbl_lands' heet)
    protected $table = 'tbl_land';

    // Vulbare velden
    protected $fillable = ['landnaam'];
    
    // Primaire sleutel (optioneel als deze niet 'id' heet)
    protected $primaryKey = 'landid';

    public function stad()
    {
        return $this->hasMany(tblStad::class, 'landID', 'landID');
    }
}
