@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Data Kompetensi Keahlian</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Kompetensi Keahlian</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container bg-light-cyan">
                    <a href="{{ url('registerkompetensipage') }}"><i class="fas fa-project-diagram" style="font-size: 25px"><i class="fas fa-plus" style="font-size: 15px"></i> Tambah Kompetensi Keahlian</i></a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($kompetensi as $kompetensi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kompetensi->kompetensi_keahlian }}</td>
                                <td>
                                    <a href="{{ url('editkompetensipage/'.$kompetensi->id_kompetensi) }}" class="mr-2 text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="mr-2 text-danger" data-target="#hapus{{ $kompetensi->id_kompetensi }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapus{{ $kompetensi->id_kompetensi }}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="{{ url('hapuskompetensi/'.$kompetensi->id_kompetensi) }}" class="btn btn-danger" type="submit">Hapus</a>
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
