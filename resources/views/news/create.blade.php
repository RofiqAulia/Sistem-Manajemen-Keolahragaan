@extends('layouts.template')

@section('content')
    @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="fas fa-info mr-2"></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary ml-1" href="{{ route('news.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('news.index') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nama news</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Example" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan nama news terisi dan unik. Maksimal panjang 30 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Deskripsi</label>
                <div class="col-10">
                    <textarea rows="3" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi news" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Deskripsi umum news, pastikan terisi. Maksimal panjang 1000 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Gambar news</label>
                <div class="col-10">
                    <input type="file" name="media[]" class="form-control" id="formFileMultiple" multiple/>
                    @error('media')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Maksimal 5 Gambar. Tiap file harus berukuran < 3 MB, berkekstensi PNG, JPG, dan JPEG.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }             
</style>
@endpush

@push('js')
@endpush
