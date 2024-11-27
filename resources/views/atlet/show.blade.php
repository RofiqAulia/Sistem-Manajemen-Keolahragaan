@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
        <a href="{{ route('news.index') }}" class="btn btn-primary">
                <i class="icon fas fa-arrow-left pr-2"></i>Kembali
            </a>
        </div>
    </div>
    <div class="card-body p-4">
        @empty($news)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm mt-4">
                <tr>
                    <th>ID news</th>
                    <td>{{ $news->id_news}}</td>
                </tr>
                <tr>
                    <th>Nama news</th>
                    <td>{{ $news->nama }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $news->deskripsi }}</td>
                </tr>
            </table>
        @endempty
    </div>
</div>

@if(!$media->isEmpty())
    <div class="card card-outline card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Gambar news</h3>
        </div>
        <div class="card-body">
            <div class="row pb-3">
                @foreach ($media as $item)
                    <div class="col-md-6 mb-4">
                        <div class="image border border-2 rounded">
                            <img src="{{ asset($item->path) }}" class="col-6 p-3 col-md-12" alt="Gambar {{ $news->nama }}"/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection

@push('css')
<style>
    .image img {
        width: 100%; 
        object-fit: contain;
        height: 400px;
    }
</style>
@endpush

@push('js')
@endpush
