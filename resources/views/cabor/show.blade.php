@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('cabor.index') }}" class="btn btn-primary">
                <i class="icon fas fa-arrow-left pr-2"></i>Kembali
            </a>
        </div>
    </div>
    <div class="card-body p-4">
        @empty($cabor)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm mt-4">
                <tr>
                    <th>ID Cabor</th>
                    <td>{{ $cabor->id_cabor }}</td>
                </tr>
                <tr>
                    <th>Kode Cabor</th>
                    <td>{{ $cabor->kode_cabor }}</td>
                </tr>
                <tr>
                    <th>Nama Cabor</th>
                    <td>{{ $cabor->nama }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $cabor->deskripsi }}</td>
                </tr>
            </table>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
