{{-- @extends('layouts.template')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    <div><i class="fas fa-check mr-2"></i> {{ session('success') }}</div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger"> 
    <div><i class="fas fa-exclamation mr-2"></i> {{ session('error') }}</div>
</div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-default ml-1" href="{{ route('user.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @empty($user)
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            <hr>
            Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ route('user.destroy-avatar', $user->id_user) }}" class="form-horizontal">
            @csrf
            {!! method_field('PUT') !!}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Avatar</label>
                <div class="col-10">
                    <div class="col-2">
                        <div>
                            <img id="preview" class="rounded-circle border"  src="{{ $user->avatar ? asset($user->avatar) : asset('assets/images/default-avatar.jpg')}}" alt="Avatar {{Auth::user()->username}}" style="width:9.375rem; height: 9.375rem" />
                            @if($user->avatar)
                                <span class="position-absolute bottom-0 end-0 rounded-circle translate-middle-x">
                                    <button type="submit" class="rounded-circle btn bg-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?');" style="font-size: 1.2rem" ><i class="fas fa-trash-can"></i></button>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="POST" action="{{ route('user.update', $user->id_user) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {!! method_field('PUT') !!}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <input type="file" id="news_media" name="news_media" class="form-control"/>
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
                            <option value="{{ $item->kode }}" @if($item->kode == $user->kode_level) selected @endif>
                                {{ $item->kode }} - {{ $item->nama }}    
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
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{ old('email', $user->email) }}" required>
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
                    <input type="text" class="form-control" id="username" name="username" placeholder="example" value="{{ old('username', $user->username) }}" required>
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
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="John Doe" value="{{ old('nama', $user->nama) }}" required>
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
                    <input type="password" class="form-control" id="password" placeholder="exa*****" name="password">
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Minimal panjang password 8 karakter. Abaikan (jangan diisi) jika tidak ingin mengganti password user.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                    <a class="btn btn-sm btn-danger ml-1" href="{{ route('user.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Batal</a>
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
<script>
    news_media.onchange = evt => {
        const [file] = news_media.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        } else {
            preview.src = "{{ asset($user->avatar) }}"
        }
    }
</script>
@endpush --}}

@extends('layouts.template')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    <div><i class="fas fa-check mr-2"></i> {{ session('success') }}</div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger"> 
    <div><i class="fas fa-exclamation mr-2"></i> {{ session('error') }}</div>
</div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-default ml-1" href="{{ route('user.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @empty($user)
        <div class="alert alert-danger">
            <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
            <hr>
            Data yang Anda cari tidak ditemukan.
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ route('user.destroy-avatar', $user->id_user) }}" class="form-horizontal">
            @csrf
            {!! method_field('PUT') !!}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Avatar</label>
                <div class="col-10">
                    <div class="col-2">
                        <div>
                            <img id="preview" class="rounded-circle border" src="{{ $user->avatar ? asset($user->avatar) : asset('assets/images/default-avatar.jpg')}}" alt="Avatar {{ (Auth::user())->username }}" style="width:9.375rem; height: 9.375rem" />
                            @if($user->username)
                                <span class="position-absolute bottom-0 end-0 rounded-circle translate-middle-x">
                                    <button type="submit" class="rounded-circle btn bg-danger" onclick="return confirm('Apakah Anda yakin menghapus data ini?');" style="font-size: 1.2rem" ><i class="fas fa-trash-can"></i></button>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form method="POST" action="{{ route('user.update', $user->id_user) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {!! method_field('PUT') !!}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <input type="file" id="news_media" name="news_media" class="form-control"/>
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
                            <option value="{{ $item->kode }}" @if($item->kode == $user->kode_level) selected @endif>
                                {{ $item->kode }} - {{ $item->nama }}    
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
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{ old('email', $user->email) }}" required>
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
                    <input type="text" class="form-control" id="username" name="username" placeholder="example" value="{{ old('username', $user->username) }}" required>
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
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="John Doe" value="{{ old('nama', $user->nama) }}" required>
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
                    <input type="password" class="form-control" id="password" placeholder="exa*****" name="password">
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @else
                        <small class="form-text text-muted">Minimal panjang password 8 karakter. Abaikan (jangan diisi) jika tidak ingin mengganti password user.</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label"></label>
                <div class="col-10">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-check"></i>  Simpan</button>
                    <a class="btn btn-sm btn-danger ml-1" href="{{ route('user.index') }}"><i class="fas fa-arrow-left mr-2"></i>  Batal</a>
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
<script>
    news_media.onchange = evt => {
        const [file] = news_media.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        } else {
            preview.src = "{{ $user->avatar ? asset($user->avatar) : asset('assets/images/default-avatar.jpg') }}"
        }
    }
</script>
@endpush
