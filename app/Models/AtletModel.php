<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AtletModel extends Model
{
    // use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'atlet';

    protected $primaryKey = 'id_atlet';

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'no_hp',
        'kode_cabor',
    ];

    public function cabor() : BelongsTo
    {
        return $this->belongsTo(CaborModel::class, 'kode_cabor', 'kode_cabor');
    }
}
