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
            <a class="btn btn-sm btn-primary ml-1" href="{{ url('atlet') }}"><i class="fas fa-arrow-left mr-2"></i>  Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('atlet') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Kode cabor</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="kode_cabor" name="kode_cabor" value="{{ old('kode_cabor') }}" placeholder="Masukkan kode cabor yang sesuai" required>
                    @error('kode_cabor')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan kode cabor terisi dan unik. Maksimal panjang 30 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nama Atlet</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap anda" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan nama news terisi dan unik. Maksimal panjang 30 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Umur</label>
                <div class="col-10">
                    <textarea rows="3" class="form-control" id="umur" name="umur" placeholder="Masukkan umur anda saat ini" required>{{ old('umur') }}</textarea>
                    @error('umur')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">umur, pastikan terisi. Maksimal panjang 2 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Alamat</label>
                <div class="col-10">
                    <textarea rows="3" class="form-control" id="alamat" name="alamat" placeholder="Masukkan domisili anda" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">alamat , pastikan terisi. Maksimal panjang 100 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">No. Handphone</label>
                <div class="col-10">
                    <textarea rows="3" class="form-control" id="no_hp" name="no_hp" placeholder="no_hp news" required>{{ old('no_hp') }}</textarea>
                    @error('no_hp')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">No. handphone, pastikan terisi. Maksimal panjang 13 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                    <a class="btn btn-sm btn-danger ml-1" href="{{ url('atlet') }}"><i class="fa-solid fa-xmark"></i>  Batal</a>
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
