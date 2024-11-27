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
            <a href="{{ route('news.index') }}" class="btn btn-sm btn-primary mt-2"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>

        <div class="card-body">
            @empty($news)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban mr-2"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <form method="POST" action="{{ route('news.update', $news->id_news) }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Nama news</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $news->nama) }}" placeholder="Example" required>
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
                            <textarea rows="3" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi news" required>{{ old('deskripsi', $news->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @else
                                <small class="form-text text-muted">Deskripsi umum news, pastikan terisi. Maksimal panjang 255 karakter.</small>
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
            @endempty
        </div>
    </div>

    @if(!$media->isEmpty())
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Gambar news</h3>
            </div>
            <div class="card-body">
                <div class="row pb-3">
                    @foreach ($media as $item)
                        <div class="col-md-6 mb-4">
                            <div class="image border border-2 rounded">
                                <img src="{{ asset($item->path) }}" class="col-6 p-3 col-md-12" alt="Gambar {{ $news->nama }}"/>
                                <form class="d-inline-block" method="POST" action="{{ route('news_media.destroy', $item->id_news_media) }}">
                                    {{ csrf_field() }}
                                    {!! method_field('DELETE') !!}
                                    <button type="submit" class="btn btn-danger delete-image"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </form>
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
        .image {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image:before {
            content: '';
            opacity: 0;
            transition: opacity 0.5s ease;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .image:hover:before {
            opacity: 1;
        }

        .image img {
            position: absolute;
            display: block;
            width: 100%; 
            object-fit: contain;
            height: 400px;
            z-index: 1;
        }

        .image .btn {
            opacity: 0;
            transition: opacity 0.5s ease;
            position: relative;
            z-index: 3;
        }

        .image:hover .btn {
            opacity: 1;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
    </style>
@endpush

@push('js')
    <script>
        $('.delete-image').click(function(e){
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                $(e.target).closest('form').submit();
            }
        });
    </script>
@endpush
