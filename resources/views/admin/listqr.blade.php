@extends('layouts.sbadmin2')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Scan QR Security</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Database Hasil Scan QR</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>QR</th>
                                <th>Nama Tempat</th>
                                <th>Area</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($titikpoint as $listpoint)
                                <tr>
                                    <td style="text-align: center">{!! QrCode::size(90)->generate(route('checkAPI', $listpoint->kodeunik)); !!} <br> {{ $listpoint->kodeunik }}</td>
                                    <td>{{ $listpoint->nama_tempat }}</td>
                                    <td>{{ $listpoint->area }}</td>
                                    <td>{{ $listpoint->latitude }}</td>
                                    <td>{{ $listpoint->longitude }}</td>
                                    <td>
                                        
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteqrModal{{ $listpoint->kodeunik }}">Delete</a>
                                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editqrModal{{ $listpoint->kodeunik }}">Edit</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editqrModal{{ $listpoint->kodeunik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{ $listpoint->nama_tempat }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editform{{ $listpoint->kodeunik }}" action="{{ route('updatetitikpoint', $listpoint->kodeunik) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="kodeunik">Kode Unik</label>
                                                        <input type="text" class="form-control" id="kodeunik" name="kodeunik" value="{{ $listpoint->kodeunik }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_tempat">Nama Tempat</label>
                                                        <input type="text" class="form-control" id="nama_tempat" name="nama_tempat" value="{{ $listpoint->nama_tempat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="area">Area</label>
                                                        <input type="text" class="form-control" id="area" name="area" value="{{ $listpoint->area }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="latitude">Latitude</label>
                                                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $listpoint->latitude }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="longitude">Latitude</label>
                                                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $listpoint->longitude }}">
                                                    </div>
                                                    <div class="form-group">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="event.preventDefault();document.getElementById('editform{{ $listpoint->kodeunik }}').submit();" type="submit" class="btn btn-warning">Update</button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteqrModal{{ $listpoint->kodeunik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Apakah anda yakin ingin menghapus item ini?</div>
                                            <div class="modal-footer">
                                                <form action="{{ route('hapustitikpoint', $listpoint->kodeunik) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection