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