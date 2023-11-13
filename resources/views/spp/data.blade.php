@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Data Spp</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Spp</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container bg-light-cyan">
                    <a href="{{ url('registerspppage') }}"><i class="fas fa-file-invoice-dollar" style="font-size: 25px">  <i class="fas fa-plus" style="font-size: 15px"></i> Tambah Spp</i></a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Spp</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Nominal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($spp as $spp)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $spp->id_spp }}</td>
                                <td>{{ $spp->bulan }}</td>
                                <td>{{ $spp->tahun }}</td>
                                <td>{{ $spp->nominal }}</td>
                                <td>
                                    <a href="{{ url('editspppage/'.$spp->id_spp) }}" class="mr-2 text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="mr-2 text-danger" data-target="#hapus{{ $spp->id_spp }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapus{{ $spp->id_spp }}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="{{ url('hapusspp/'.$spp->id_spp) }}" class="btn btn-danger" type="submit">Hapus</a>
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
