@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Data Petugas</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Petugas</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container bg-light-cyan">
                        <a href="{{ url('registerpetugaspage') }}"><i class="fas fa-user-tie" style="font-size: 25px"><i class="fas fa-plus" style="font-size: 15px"></i> Tambah Petugas</i></a>
                    </div>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Petugas</th>
                                <th>Level</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($petugas as $petugas)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $petugas->username }}</td>
                                <td>{{ $petugas->nama_petugas }}</td>
                                <td>{{ $petugas->level }}</td>
                                <td>
                                    <a href="{{ url('editpetugaspage/'.$petugas->id) }}" class="mr-2 text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="mr-2 text-danger" data-target="#hapus{{ $petugas->id }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapus{{ $petugas->id }}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="{{ url('hapuspetugas/'.$petugas->id) }}" class="btn btn-danger" type="submit">Hapus</a>
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
