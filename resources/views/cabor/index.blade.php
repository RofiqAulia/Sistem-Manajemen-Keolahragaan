{{-- @extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ url('cabor/create') }}"><i class="fa-solid fa-plus"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success"> {{ session('success') }} </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger"> {{ session('error') }} </div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_cabor">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Cabor</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($cabor as $cabor)
                  <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td>{{ $cabor->nama }}</td> <!-- Menampilkan nama cabor -->
                      <td class="text-left">
                          <form action="{{ route('cabor.destroy', $cabor->id_cabor) }}" method="POST">
                              <a class="btn btn-info btn-sm" href="{{ route('cabor.show', $cabor->id_cabor) }}"><i class="fa-solid fa-circle-info"></i>    Detail</a>
                              <a class="btn btn-warning btn-sm" href="{{ route('cabor.edit', $cabor->id_cabor) }}"><i class="fas fa-pen-to-square mr-2"></i>   Edit</a>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?');"><i class="fa-solid fa-trash"></i>   Delete</button>
                          </form>
                      </td>
                  </tr>
                  @php
                  $i += 1;
                  @endphp
              @endforeach
          </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
  $(document).ready(function() {
    var dataCabor = $('#table_cabor').DataTable({
      serverSide: true,
      ajax: {
        "url": "{{ url('cabor.list') }}",
        "dataType": "json",
        "type": "POST"
      },
      columns: [
        {
          data: "id_cabor",
          className: "",
          orderable: true,
          searchable: true
        },
        {
          data: "kode_cabor",
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
          data: "deskripsi",
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
@endpush --}}

@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-success mt-1" href="{{ route('cabor.create') }}"><i class="fa-solid fa-plus"></i>Tambah</a>
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
        <table class="table table-bordered table-striped table-hover table-sm" id="table_cabor">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
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
        var datanews = $('#table_cabor').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ route('cabor.list') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "nama", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "", orderable: false, searchable: false }  
            ]
        });   
    });
</script>
@endpush

