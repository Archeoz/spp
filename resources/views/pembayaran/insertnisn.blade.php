@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Pembayaran Spp Siswa</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Input Nisn Siswa</h2>
            </div>
            <div class="card-body">
                @if (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'admin')
                <form action="{{ url('kirimnisn') }}" method="post">
                @elseif (Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level == 'petugas')
                <form action="{{ url('kirimnisnpetugas') }}" method="post">
                @endif
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-8">
                            <label for="">Nisn :</label>
                            <div class="row justify-content-center">
                                <select class="js-example-basic-single" style="width: 98%" name="nisn">
                                    <option value="" disabled selected>== Pilih Siswa ==</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa['nisn'] }}">{{ $siswa['nisn'] }}/{{ $siswa['nis'] }} | {{ $siswa['nama_siswa'] }} | {{ $siswa['nama_kelas'] }} {{ $siswa['kompetensi_keahlian'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a class="btn btn-danger btn-block" href="{{ url('dashboard') }}">Batal</a>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



