@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-default ml-1" href="{{ route('user.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Avatar</label>
                <div class="col-10">
                    <img id="preview" class="rounded-circle border" src="{{ asset('assets/images/default-avatar.jpg') }}" alt="Avatar" style="width:150px; height: 150px">
                    <input type="file" id="news_media" name="news_media" class="form-control mt-3">
                    @error('news_media')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text form-muted">File harus berukuran <= 2 MB, berkekstensi PNG, JPG, JPEG.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Level</label>
                <div class="col-10">
                    <select class="form-control" id="kode_level" name="kode_level" required>
                        <option value="">- Pilih Level -</option>
                        @foreach ($level as $item)
                            <option value="{{ $item->kode_level }}" {{ old('kode_level') == $item->kode_level ? 'selected' : '' }}>
                                {{ $item->kode_level }} - {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kode_level')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan level user terisi.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Email</label>
                <div class="col-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan email user unik dan terisi.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Username</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="example" value="{{ old('username') }}" required>
                    @error('username')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan username unik dan terisi.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nama</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="John Doe" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Pastikan nama user terisi.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Password</label>
                <div class="col-10">
                    <input type="password" class="form-control" id="password" placeholder="exa*****" name="password" required>
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Password user harus diisi, minimal panjang password 8 karakter.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                    <a class="btn btn-sm btn-danger ml-1" href="{{ route('user.index') }}"><i class="fa-solid fa-xmark"></i>   Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    news_media.onchange = evt => {
        const [file] = news_media.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        } else {
            preview.src = "{{ asset('assets/images/default-avatar.jpg') }}"
        }
    }
</script>
@endpush
