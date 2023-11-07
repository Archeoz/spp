@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>tagihan Pembayaran Spp</h1>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container">
        <!-- /.card -->
        <div class="card">
            <div class="row">
                @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user())
                    <div class="col-6">
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
                                            <div class="modal fade" id="hapus">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h3>Yakin Ingin Hapus?</h3>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="" class="btn btn-danger"
                                                                type="submit">Hapus</a>
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
                    <div class="col-6">
                        <div class="card-header">
                            <h2 class="card-title">Data Seluruh Tagihan Pembayaran Spp</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                                <form action="{{ url('kirimsesihistorisiswa') }}" method="get">                                    
                                @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                <form action="{{ url('kirimsesihistorisiswapetugas') }}" method="get">
                                @endif
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="">Pilih Siswa :</label>
                                                <div class="row justify-content-center">
                                                    <select class="js-example-basic-single" style="width: 100%"
                                                        name="nisn" onchange="this.form.submit()">
                                                        <option value="" disabled selected>== Pilih Siswa ==</option>
                                                        @foreach ($siswas as $siswa)
                                                            <option value="{{ $siswa['nisn'] }}">
                                                                {{ $siswa['nisn'] }}/{{ $siswa['nis'] }} |
                                                                {{ $siswa['nama_siswa'] }} | {{ $siswa['nama_kelas'] }}
                                                                {{ $siswa['kompetensi_keahlian'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-5 ml-0.8">
                                                @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                                                <a href="{{ url('hapussesihistorisiswa') }}"><i class="text-danger fas fa-trash" style="font-size: 21px"> Hapus Pilihan</i></a>
                                                @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                                <a href="{{ url('hapussesihistorisiswapetugas') }}"><i class="text-danger fas fa-trash" style="font-size: 21px"> Hapus Pilihan</i></a>
                                                @endif          
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nisn / Nis</th>
                                            <th>Nama Siswa</th>
                                            <th>Spp Bulan,Tahun</th>
                                            <th>Kelas / Kompetensi Keahlian</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @if (session()->has('historisiswa'))
                                            @foreach (session('historisiswa') as $tagihan)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $tagihan['nisn'] }} / {{ $tagihan['nis'] }}</td>
                                                    <td>{{ $tagihan['nama_siswa'] }}</td>
                                                    <td>{{ $tagihan['bulan'] }} {{ $tagihan['tahun'] }}</td>
                                                    <td>{{ $tagihan['nama_kelas'] }} {{ $tagihan['kompetensi_keahlian'] }}
                                                    </td>
                                                    <td>{{ $tagihan['nominal'] }}</td>
                                                </tr>
                                                <div class="modal fade" id="hapus">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h3>Yakin Ingin Hapus?</h3>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close</button>
                                                                <a href="" class="btn btn-danger"
                                                                    type="submit">Hapus</a>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            @endforeach
                                        @endif
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                @elseif (Auth::guard('siswa')->check() && Auth::guard('siswa')->user())
                    <div class="col-6">
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
                                            <div class="modal fade" id="hapus">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h3>Yakin Ingin Hapus?</h3>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="" class="btn btn-danger"
                                                                type="submit">Hapus</a>
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
                    <div class="col-6">
                        <div class="card-header">
                            <h2 class="card-title">Data Seluruh Tagihan Pembayaran Spp</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Spp Bulan,Tahun</th>
                                            <th>Kelas / Kompetensi Keahlian</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($tagihan as $tagihan)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $tagihan['bulan'] }} {{ $tagihan['tahun'] }}</td>
                                                <td>{{ $tagihan['nama_kelas'] }} {{ $tagihan['kompetensi_keahlian'] }}
                                                </td>
                                                <td>{{ $tagihan['nominal'] }}</td>
                                            </tr>
                                            <div class="modal fade" id="hapus">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h3>Yakin Ingin Hapus?</h3>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="" class="btn btn-danger"
                                                                type="submit">Hapus</a>
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
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>

    <!-- Modal hapus bisa ditempatkan di luar kolom atau sesuai kebutuhan -->
    <div class="modal fade" id="hapus">
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
@endsection
