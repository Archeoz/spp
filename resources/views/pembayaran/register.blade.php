@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Input Register Pembayaran</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Data Siswa :</label>
                    </div>
                </div>
                <div class="row">
                    <label class="mt-2s ml-3 mr-1" for="">Nisn / Nis : </label>
                    <h5 class="mr-1" style="font-size: 18px">{{ $siswa->nisn }} / {{ $siswa->nis }}</h5>
                    <div class="col-12"></div>
                    <label class="mt-1s ml-3 mr-1" for="">Nama : </label>
                    <h5 class="mr-1" style="font-size: 18px">{{ $siswa->nama_siswa }}</h5>
                    <div class="col-12"></div>
                    <label class="mt-1s ml-3 mr-1" for="">Kelas / Kompetensi Keahlian : </label>
                    <h5 class="mr-1" style="font-size: 18px">{{ $siswa->nama_kelas }} {{ $siswa->kompetensi_keahlian }}
                    </h5>
                </div>
                <hr style="border-top: 2px solid #000;">
                <div class="row">
                    <div class="col-3 mb-2">
                        @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                            <form action="{{ url('ambilspp') }}" method="get">
                            @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                <form action="{{ url('ambilspppetugas') }}" method="get">
                        @endif
                        {{-- <form action="{{ url('ambilspp') }}" method="get"> --}}
                        @csrf
                        <label for="">Spp :</label>
                        <select class="js-example-basic form-control" name="spp" id=""
                            onchange="this.form.submit()">
                            <option value="" disabled selected>== Pilih Spp ==</option>
                            @foreach ($spp as $sppItem)
                                <option value="{{ $sppItem['id_spp'] }}">
                                    {{ $sppItem['bulan'] }} | {{ $sppItem['tahun'] }}
                                    | {{ $sppItem['nominal'] }}</option>
                            @endforeach
                        </select>
                        </form>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-4 mt-2s">
                        @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                            <a href="{{ url('hapussemua') }}" class="text-danger font-weight-bold"><i class="fas fa-trash"
                                    style="font-size: 20px; "> Hapus Semua</i></a>
                        @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                            <a href="{{ url('hapussemuapetugas') }}" class="text-danger font-weight-bold"><i
                                    class="fas fa-trash" style="font-size: 20px; font-color: red;"> Hapus Semua</i></a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Nominal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            @php
                                $no = 1;
                                $total = 0;
                            @endphp
                            <tbody>
                                @if (session()->has('pilihanspp'))
                                    @foreach (session('pilihanspp') as $spp)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $spp['bulan'] }}</td>
                                            <td>{{ $spp['tahun'] }}</td>
                                            <td>{{ $spp['nominal'] }}</td>
                                            @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                                                <td><a href="{{ url('hapussesi/' . $spp['id_spp']) }}"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                                <td><a href="{{ url('hapussesipetugas/' . $spp['id_spp']) }}"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            @endif
                                        </tr>
                                        @php
                                            $total = $total + $spp['nominal'];
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="3">Total :</td>
                                        <td>{{ $total }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-12">
                        @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                            <form action="{{ url('kirimspp') }}" method="post">
                            @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                <form action="{{ url('kirimspppetugas') }}" method="post">
                        @endif
                        @csrf
                        <input type="hidden" value="{{ $total }}" name="total">
                        <input type="hidden" value="{{ $siswa->nisn }}" name="nisn">
                        <div class="col-12">
                            <div class="row justify-content-center mt-3">
                                <div class="col-6">
                                    @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                                        <a class="btn btn-danger btn-block" href="{{ url('batalpembayaran') }}">Batal</a>
                                    @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                                        <a class="btn btn-danger btn-block"
                                            href="{{ url('batalpembayaranpetugas') }}">Batal</a>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
