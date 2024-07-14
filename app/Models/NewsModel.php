<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsModel extends Model
{
    protected $table = 'news';

    protected $primaryKey = 'id_news';

    protected $fillable = [
        'id_news',
        'nama',
        'deskripsi',
    ];

    public function NewsMediaModel(): BelongsTo
    {
        return $this->belongsTo(NewsMediaModel::class, 'id_news_media', 'id_news_media');
    }
}
