@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Kelas Spp</h1>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Data Seluruh Kelas Spp</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container bg-light-cyan">
                    <a href="" data-toggle="modal" data-target="#insert"><i class="fas fa-user-graduate"
                            style="font-size: 25px"><i class="fas fa-plus" style="font-size: 15px"></i> Tambah Kelas
                            Spp</i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas / Kompetensi</th>
                                <th>Spp Bulan / Tahun</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($kelasspp as $kelasspp)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kelasspp->nama_kelas }}
                                        {{ $kelasspp->kompetensi_keahlian }}
                                    </td>
                                    <td>{{ $kelasspp->bulan }} {{ $kelasspp->tahun }}</td>
                                    <td>
                                        <a href="" class="mr-2 text-danger"
                                            data-target="#hapus{{ $kelasspp->id_kelasspp }}" data-toggle="modal"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapus{{ $kelasspp->id_kelasspp }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3>Yakin Ingin Hapus?</h3>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('hapuskelasspp/' . $kelasspp->id_kelasspp) }}"
                                                    class="btn btn-danger" type="submit">Hapus</a>
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
            <!-- /.modal  -->
            <div class="modal fade" id="insert">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Insert Kelas Spp</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('addkelasspp') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <label for="">Kelas :</label>
                                            <select class="form-control form-control-select" name="kelas" id="">
                                                <option value="" disabled selected>== Pilih kelas ==</option>
                                                @foreach ($kelas as $kelas)
                                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="">Kompetensi :</label>
                                            <select class="form-control form-control-select" name="kompetensi"
                                                id="">
                                                <option value="" disabled selected>== Pilih Kompetensi Keahlian ==
                                                </option>
                                                @foreach ($kompetensi as $kompetensi)
                                                    <option value="{{ $kompetensi->id_kompetensi }}">
                                                        {{ $kompetensi->kompetensi_keahlian }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <small class="mt-1" style="color: red">*Opsional</small> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-12">
                                            <label for="">Spp :</label>
                                            <select class="js-example-basic-multiple form-control form-control-select"
                                                style="width: 100%" multiple="multiple" name="spp[]" id="spp">
                                                <option value="" disabled selected>== Pilih Spp ==</option>
                                                @foreach ($spp as $spp)
                                                    <option value="{{ $spp->id_spp }}">{{ $spp->bulan }} |
                                                        {{ $spp->tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
