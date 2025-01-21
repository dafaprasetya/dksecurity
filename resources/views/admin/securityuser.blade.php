@extends('layouts.sbadmin2')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Scan QR Security</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Database Hasil Scan QR</h6>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createusersecModal">Buat User Baru</button>
                <div class="modal fade" id="createusersecModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Security</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createform" action="{{ route('buatsecurityuser') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <input type="text" class="form-control" id="area" name="area" value="">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button onclick="event.preventDefault();document.getElementById('createform').submit();" type="submit" class="btn btn-primary">Buat</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Area</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usersec as $usersec)
                                <tr>
                                    <td>{{ $usersec->nik }}</td>
                                    <td>{{ $usersec->nama }}</td>
                                    <td>{{ $usersec->area }}</td>
                                    <td>

                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteqrModal{{ $usersec->nik }}">Delete</a>
                                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editqrModal{{ $usersec->nik }}">Edit</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editqrModal{{ $usersec->nik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit {{ $usersec->nama }}</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editform{{ $usersec->nik }}" action="{{ route('updatesecurityuser', $usersec->nik) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nik">NIK</label>
                                                        <input type="text" class="form-control" id="nik" name="nik" value="{{ $usersec->nik }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $usersec->nama }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="area">Area</label>
                                                        <input type="text" class="form-control" id="area" name="area" value="{{ $usersec->area }}">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="event.preventDefault();document.getElementById('editform{{ $usersec->nik }}').submit();" type="submit" class="btn btn-warning">Update</button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteqrModal{{ $usersec->nik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                <form action="{{ route('hapustitikpoint', $usersec->nik) }}" method="POST" style="display:inline;">
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
