@extends('layouts.sbadmin2')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buat Titik Point</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('buattitikpointpost') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kodeunik">Kode Unik</label>
                        <input type="text" class="form-control" name="kodeunik" id="kodeunik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Titik Point</label>
                        <input type="text" class="form-control" name="nama_tempat" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="area">Area</label>
                        <input type="text" class="form-control" name="area" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Latitude </label>
                        <input type="text" class="form-control" name="latitude" id="nama" >
                    </div>
                    <div class="form-group">
                        <label for="nama">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="nama" >
                    </div>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection