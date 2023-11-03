@extends('master')
@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Edit Data Kelas</h1>
            </div>
        </div>
        </div>
    </section>
</div>

<div class="container">
    <div class="card o-hidden border-0 my-5">
        <div class="row justify-content-center mt-1">
            <h2 class="text-gray">Edit Data Kelas</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('editkompetensi/'.$kompetensi->id_kompetensi) }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <label for="">Kompetensi keahlian :</label>
                            <input type="text" class="form-control" name="kompetensi" value="{{ $kompetensi->kompetensi_keahlian }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4">
                        <a class="btn btn-danger btn-block" href="{{ url('datakompetensipage') }}">Batal</a>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary btn-block" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
