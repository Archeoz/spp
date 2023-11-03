@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Register Data Petugas</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Input Data Petugas</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('registerpetugas') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Username :</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="col-4">
                                <label for="">Password :</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <label for="">Nama Petugas :</label>
                                <input type="text" class="form-control" name="nama_petugas">
                            </div>
                            <div class="col-4">
                                <label for="">Level :</label>
                                <select class="form-control form-control-select" name="level" id="">
                                    <option value="" disabled selected>== Pilih Role ==</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a class="btn btn-danger btn-block" href="{{ url('datapetugaspage') }}">Batal</a>
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



