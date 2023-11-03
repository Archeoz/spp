@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Edit Data Spp</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Edit Data Spp</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('editspp/'.$spp->id_spp) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Bulan & Tahun :</label>
                                <input type="month" class="form-control" name="bulan" value="{{ $bulanTahun }}">
                            </div>
                            <div class="col-4">
                                <label for="">Nominal :</label>
                                <input type="number" class="form-control" name="nominal" value="{{ $spp->nominal }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Kelas :</label>
                                <select class="form-control form-control-select" name="kelas" id="">
                                    <option value=""disabled selected>==Pilih Kelas</option>
                                    @foreach ($kelas as $kelas)
                                        <option @if ($kelas->id_kelas == $spp->id_kelas)selected
                                        @endif value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="">Kompetensi :</label>
                                <select class="form-control form-control-select" name="kompetensi" id="">
                                    <option value=""disabled selected>==Pilih Kompetensi</option>
                                    @foreach ($kompetensi as $kompetensi)
                                        <option @if ($kompetensi->id_kompetensi == $spp->id_kompetensi)selected
                                        @endif value="{{ $kompetensi->id_kompetensi }}">{{ $kompetensi->kompetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger" style="text-size: 14px">*Kosongkan jika tak ingin mengisi</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a class="btn btn-danger btn-block" href="{{ url('dataspppage') }}">Batal</a>
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



