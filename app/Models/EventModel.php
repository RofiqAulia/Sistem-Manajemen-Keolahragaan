<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventModel extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode_cabor' => 'required|exists:cabor,kode_cabor',
            'nama_event' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'harga_tiket' => 'required|numeric|min:0',
            'thumbnail' => 'sometimes|image|max:2048',
            'status' => 'sometimes|in:draft,upcoming,ongoing,completed,cancelled'
        ];
    }
}