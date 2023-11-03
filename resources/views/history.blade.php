@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Histori Pembayaran Spp</h1>
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
                            @foreach ($histori as $histori)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $histori->nama_petugas }}</td>
                                <td>{{ $histori->nama_siswa }}</td>
                                <td>{{ $histori->nama_kelas }} {{ $histori->kompetensi_keahlian }}</td>
                                <td>{{ $histori->bulan }} {{ $histori->tahun }}</td>
                                <td>{{ $histori->nominal }}</td>
                                <td>{{ $histori->jumlah_bayar }}</td>
                                <td>{{ $histori->tgl_bayar }}</td>
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
