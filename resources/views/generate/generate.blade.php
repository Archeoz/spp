@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Cetak Histori Pembayaran Spp</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Histori Pembayaran Spp</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container">
                    <a href="{{ url('cetak') }}" class="col-md-2 m-0 font-weight-bold text-primary">Print Laporan : <i class="fas fa-print"></i></a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Petugas</th>
                                <th>Siswa</th>
                                <th>Kelas / Kompetensi Keahlian</th>
                                <th>Spp Bulan,Tahun</th>
                                <th>Nominal</th>
                                <th>Total</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($generate as $generate)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $generate->nama_petugas }}</td>
                                <td>{{ $generate->nama_siswa }}</td>
                                <td>{{ $generate->nama_kelas }} {{ $generate->kompetensi_keahlian }}</td>
                                <td>{{ $generate->bulan }} {{ $generate->tahun }}</td>
                                <td>{{ $generate->nominal }}</td>
                                <td>{{ $generate->jumlah_bayar }}</td>
                                <td>{{ $generate->tgl_bayar }}</td>
                            </tr>
                            <div class="modal fade" id="hapus" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="" class="btn btn-danger" type="submit">Hapus</a>
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
