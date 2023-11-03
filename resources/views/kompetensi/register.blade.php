@extends('master')
@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Register Data Kompetensi Keahlian</h1>
                </div>
            </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="card o-hidden border-0 my-5">
            <div class="row justify-content-center mt-1">
                <h2 class="text-gray">Input Data Kompetensi Keahlian</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('registerkompetensi') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <label for="">Kompetensi Keahlian :</label>
                                <input type="text" class="form-control" name="kompetensi">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a class="btn btn-danger btn-block" href="{{ url('datakompetensipage') }}">Batal</a>
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



