<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class LevelModel extends Model
{
    use HasFactory;

    protected $table = "level";

    protected $primaryKey = "id_level";
    
    protected $fillable = [
        'nama',
        'kode_level',
    ];
    
    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }
}
