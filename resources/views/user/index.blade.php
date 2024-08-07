@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ route('user.create') }}"><i class="fa-solid fa-plus"></i>   Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select name="kode_level" id="kode_level" class="form-control" required>
                            <option value="">Tampilkan Semua</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->kode_level }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataUser = $('#table_user').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ route('user.list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.kode_level = $('#kode_level').val();
                }
            },
            columns: [
                { data: "id_user", className: "text-center", orderable: false, searchable: false},
                {
                    data: "avatar",
                    className: "text-center",
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        return '<img src="' + (data === null ? 'assets/images/default-avatar.jpg' : data) +
                            '"class="rounded-circle object-fit-cover" style="width:50px; height: 50px;" />';
                    }
                },
                { data: "username", className: "", orderable: true, searchable: true },
                { data: "nama", className: "", orderable: true, searchable: true },
                { data: "email", className: "", orderable: true, searchable: true },
                { data: "kode_level", className: "", orderable: false, searchable: false },
                { data: "aksi", className: "", orderable: false, searchable: false }
            ]
        });

        $('#kode_level').on('change', function() {
            dataUser.ajax.reload();
        });
        
    });
</script>
@endpush
