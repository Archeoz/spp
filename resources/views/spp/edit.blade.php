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



