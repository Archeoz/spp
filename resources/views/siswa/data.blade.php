@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Data Siswa</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container-fluid">
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
              <h2 class="card-title">Data Seluruh Siswa</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container bg-light-cyan">
                    <a href="{{ url('registersiswapage') }}"><i class="fas fa-user-graduate" style="font-size: 25px"><i class="fas fa-plus" style="font-size: 15px"></i> Tambah Siswa</i></a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nisn</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        @php
                            $no = 1;
                        @endphp
                        <tbody>
                            @foreach ($siswa as $siswa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $siswa->nisn }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ $siswa->nama_kelas }}</td>
                                <td>{{ $siswa->kompetensi_keahlian }}</td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->telp }}</td>
                                <td>
                                    <a href="{{ url('editsiswapage/'.$siswa->nisn) }}" class="mr-2 text-warning"><i class="fas fa-edit"></i></a>
                                    <a href="" class="mr-2 text-danger" data-target="#hapus{{ $siswa->id }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapus{{ $siswa->id }}" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h3>Yakin Ingin Hapus?</h3>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <a href="{{ url('hapussiswa/'.$siswa->id) }}" class="btn btn-danger" type="submit">Hapus</a>
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
