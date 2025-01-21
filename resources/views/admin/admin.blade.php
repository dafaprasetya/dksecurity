@extends('layouts.sbadmin2')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Data Scan QR Security</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Database Hasil Scan QR</h6>
                <div class="modal fade" id="cleanupqrmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Yakin?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Apakah anda yakin membersihkan data invalid yang sudah lebih dari 3 hari?</div>
                            <div class="modal-footer">
                                <form id='cleanup' action="{{ route('cleanupqrscan') }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger">Ya</button>
                                </form>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#cleanupqrmodal">Bersihkan data invalid > 3hari</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Point</th>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jarak(m)</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($security as $security)
                                <tr>
                                    <td>{{ $security->pointqr->nama_tempat }}({{ $security->pointqr->area }})</td>
                                    <td>{{ $security->waktu }}</td>
                                    <td>{{ $security->nama }}</td>
                                    <td>{{ $security->nik }}</td>
                                    <td style="color: {{ $security->jarak > 30 ? 'red' : '' }}">{{ $security->jarak }} meter</td>
                                    <td>{{ $security->keterangan }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn {{ $security->status == 'invalid' ? 'btn-danger' : 'btn-success'  }} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{ $security->status}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('ubahstatusscan',$security->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="{{ $security->status == 'invalid' ? 'valid' : 'invalid' }}">
                                                    <button type="submit" class="dropdown-item">{{ $security->status == 'invalid' ? 'valid' : 'invalid' }}</button>
                                                </form>
                                              {{-- <a onclick="" class="dropdown-item" href="#">{{ $security->status == 'invalid' ? 'valid' : 'invalid' }}</a> --}}
                                            </div>
                                          </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
