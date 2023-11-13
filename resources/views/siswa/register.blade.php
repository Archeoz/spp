@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Register Data Siswa</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Input Data Siswa</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('registersiswa') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Nisn :</label>
                                <input type="text" class="form-control" name="nisn">
                            </div>
                            <div class="col-4">
                                <label for="">Nis :</label>
                                <input type="text" class="form-control" name="nis">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Password :</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="col-4">
                                <label for="">Nama Siswa :</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Kelas :</label>
                                <select class="form-control form-control-select" name="kelas" id="">
                                    <option value="" disabled selected>== Pilih kelas ==</option>
                                    @foreach ($kelas as $kelas)
                                        <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="">Kompetensi :</label>
                                <select class="form-control form-control-select" name="kompetensi" id="">
                                    <option value="" disabled selected>== Pilih Kompetensi Keahlian ==</option>
                                    @foreach ($kompetensi as $kompetensi)
                                        <option value="{{ $kompetensi->id_kompetensi }}">{{ $kompetensi->kompetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Telp :</label>
                                <input type="number" class="form-control" name="telp">
                            </div>
                            <div class="col-4">
                                <label for="">Alamat :</label>
                                <input type="text" class="form-control" name="alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a class="btn btn-danger btn-block" href="{{ url('datasiswapage') }}">Batal</a>
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



