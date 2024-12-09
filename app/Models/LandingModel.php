<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'id_event';
    protected $fillable = [
        'kode_cabor',
        'nama_event',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'kapasitas',
        'harga_tiket',
        'thumbnail',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function cabor()
    {
        return $this->belongsTo(Cabor::class, 'kode_cabor', 'kode_cabor');
    }

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class, 'id_event');
    }
}

class Cabor extends Model 
{
    protected $primaryKey = 'id_cabor';
    protected $fillable = ['kode_cabor', 'nama', 'deskripsi'];

    public function events()
    {
        return $this->hasMany(Event::class, 'kode_cabor', 'kode_cabor');
    }

    public function atlet()
    {
        return $this->hasMany(Atlet::class, 'kode_cabor', 'kode_cabor');
    }

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class, 'kode_cabor', 'kode_cabor');
    }
}

class Atlet extends Model
{
    protected $primaryKey = 'id_atlet';
    protected $fillable = [
        'kode_cabor',
        'nama',
        'umur',
        'alamat',
        'no_hp'
    ];

    public function cabor()
    {
        return $this->belongsTo(Cabor::class, 'kode_cabor', 'kode_cabor');
    }
}

class Pengurus extends Model
{
    protected $primaryKey = 'id_pengurus';
    protected $fillable = [
        'kode_cabor',
        'nama',
        'umur',
        'alamat',
        'no_hp'
    ];

    public function cabor()
    {
        return $this->belongsTo(Cabor::class, 'kode_cabor', 'kode_cabor');
    }
}

class News extends Model
{
    protected $primaryKey = 'id_news';
    protected $fillable = ['nama', 'deskripsi'];

    public function media()
    {
        return $this->hasMany(NewsMedia::class, 'id_news');
    }
}

class NewsMedia extends Model
{
    protected $primaryKey = 'id_news_media';
    protected $fillable = ['id_news', 'path'];

    public function news()
    {
        return $this->belongsTo(News::class, 'id_news');
    }
}

class TicketCategory extends Model
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

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function bookings()
    {
        return $this->hasMany(TicketBooking::class, 'id_category');
    }
}

class TicketBooking extends Model
{
    protected $primaryKey = 'id_booking';
    protected $fillable = [
        'id_user',
        'id_category',
        'booking_code',
        'quantity',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_proof',
        'payment_date'
    ];

    protected $casts = [
        'payment_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'id_category');
    }
}