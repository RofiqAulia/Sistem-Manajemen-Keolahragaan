@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ route('atlet.create') }}"><i class="fa-solid fa-plus"></i>Tambah</a>
        </div>
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                <div><i class="fas fa-check mr-2"></i> {{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger"> 
                <div><i class="fas fa-exclamation mr-2"></i> {{ session('error') }}</div>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                <div><i class="fas fa-info mr-2"></i> {{ session('warning') }}</div>
            </div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_atlet">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>No. Handphone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var datanews = $('#table_atlet').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('atlet.list') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "nama", className: "", orderable: true, searchable: true },
                { data: "umur", className: "", orderable: true, searchable: true },
                { data: "alamat", className: "", orderable: true, searchable: true },
                { data: "no_hp", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "", orderable: false, searchable: false }  
            ]
        });   
    });
</script>
@endpush
