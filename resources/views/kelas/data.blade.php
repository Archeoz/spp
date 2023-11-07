@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Data Kelas</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Kelas</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container bg-light-cyan">
                    <a href="{{ url('registerkelaspage') }}"><i class="fas fa-school" style="font-size: 25px"> <i class="fas fa-plus" style="font-size: 15px"></i> Tambah Kelas</i></a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($kelas as $kelas)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kelas->id_kelas }}</td>
                                <td>{{ $kelas->nama_kelas }}</td>
                                <td>
                                    <a href="{{ url('editkelaspage/'.$kelas->id_kelas) }}" class="mr-2 text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="mr-2 text-danger" data-target="#hapus{{ $kelas->id_kelas }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapus{{ $kelas->id_kelas }}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="{{ url('hapuskelas/'.$kelas->id_kelas) }}" class="btn btn-danger" type="submit">Hapus</a>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div>
@endsection
