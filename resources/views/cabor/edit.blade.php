@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">          
            <a class="btn btn-sm btn-default ml-1" href="{{ url('cabor') }}"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @empty($cabor)
        <div class="alert alert-danger alert-dismissible">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ url('cabor') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('/cabor/'.$cabor->id_cabor) }}" class="form-horizontal">
            @csrf
            {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Kode Cabor</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="kode_cabor" name="kode_cabor" value="{{ old('kode_cabor', $cabor->kode_cabor) }}" placeholder="EXMPL" required>
                    @error('kode_cabor')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text form-muted">Kode cabor harus unik dan terisi, minimal panjang 2 karakter, maksimal panjang 5 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nama Cabor</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $cabor->nama) }}" placeholder="Example" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text form-muted">Nama cabor terisi, maksimal panjang 100 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Deskripsi</label>
                <div class="col-10">
                    <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi cabor" required>{{ old('deskripsi', $cabor->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text form-muted">Deskripsi cabor harus terisi.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                    <a class="btn btn-sm btn-danger ml-1" href="{{ url('cabor') }}"><i class="fa-solid fa-xmark"></i>    Batal</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush