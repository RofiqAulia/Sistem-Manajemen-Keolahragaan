<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategoryModel extends Model
{
    protected $primaryKey = 'id_category';
    protected $fillable = [
        'id_event',
        'nama_kategori',
        'harga',
        'jumlah_tiket',
        'sisa_tiket',
        'status',
        'max_tickets_per_user'
    ];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function bookings()
    {
        return $this->hasMany(TicketBooking::class, 'id_category');
    }
}
