<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsMediaModel extends Model
{
    protected $table = 'news_media';

    protected $primaryKey = 'id_news_media';

    protected $fillable = [
        'id_news',
        'path',
    ];

    public function NewsModel(): BelongsTo
    {
        return $this->belongsTo(NewsModel::class, 'id_news', 'id_news');
    }
}
