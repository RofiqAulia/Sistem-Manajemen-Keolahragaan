<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaborModel extends Model
{
    use HasFactory;
    
    protected $table = 'cabor';

    protected $primaryKey = 'id_cabor';

    protected $fillable = [
        'id_cabor',
        'kode_cabor',
        'nama',
        'deskripsi',
    ];
    
}
