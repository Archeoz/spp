@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Edit Data Siswa</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Edit Data Siswa</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('editsiswa/'.$siswa->nisn) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Nisn :</label>
                                <input type="text" class="form-control" name="nisn" value="{{ $siswa->nisn }}">
                            </div>
                            <div class="col-4">
                                <label for="">Nis :</label>
                                <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Password :</label>
                                <input type="password" class="form-control" name="password">
                                <p class="text-red" style="text-size: 14px;">*Jangan diisi jika tak ingin di ganti</p>
                            </div>
                            <div class="col-4">
                                <label for="">Nama Siswa :</label>
                                <input type="text" class="form-control" name="nama" value="{{ $siswa->nama_siswa }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Kelas :</label>
                                <select class="form-control form-control-select" name="kelas" id="">
                                    @foreach ($kelas as $kelas)
                                        <option @if ($kelas->id_kelas == $siswa->id_kelas)selected
                                        @endif value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="">Kompetensi :</label>
                                <select class="form-control form-control-select" name="kompetensi" id="">
                                    @foreach ($kompetensi as $kompetensi)
                                        <option @if ($kompetensi->id_kompetensi == $siswa->id_kompetensi)selected
                                        @endif value="{{ $kompetensi->id_kompetensi }}">{{ $kompetensi->kompetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Telp :</label>
                                <input type="number" class="form-control" name="telp" value="{{ $siswa->telp }}">
                            </div>
                            <div class="col-4">
                                <label for="">Alamat :</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $siswa->alamat }}">
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



