@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ url('level/create') }}"><i class="fa-solid fa-plus"></i>  Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success"> {{ session('success') }} </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger"> {{ session('error') }} </div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Level</th>
                    <th>Nama Level</th>
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
    var dataLevel = $('#table_level').DataTable({
      serverSide: true,
      ajax: {
        "url": "{{ url('level/list') }}",
        "dataType": "json",
        "type": "POST"
      },
      columns: [
        {
          data: "id_level",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "kode_level",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "nama",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "aksi",
          className: "",
          orderable: false,
          searchable: false
        }
      ]
    });
  });
</script>
@endpush