@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-3">
            <div class="col-lg-12">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('pemesanan.create') }}" class="btn btn-warning">Tambah Pemesanan</a>
                @endif
                <a href="{{ route('export') }}" class="btn btn-success">Export Excel</a>
                <a href="{{ route('export.all') }}" class="btn btn-info">Export All Data</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    Import Excel
                </button>
            </div>
        </div>

        <div class="modal" id="importModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Import Excel</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload file</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Pemesanan</h6>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-light" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="ni ni-check-bold mr-2"></i>
                                <span>{{ session('success') }}</span>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            #</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis Kendaraan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Pemesanan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemesanan as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->kendaraan->jenis_kendaraan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->tanggal_pemesanan)->format('j F Y') }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    Diajukan
                                                @elseif($row->status == 0)
                                                    Disetujui
                                                @elseif($row->status == 2)
                                                    Ditolak
                                                @endif
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Tombol Setujui dan Tolak hanya untuk Approver --}}
                                                @if (auth()->user()->role === 'approver')
                                                    <form action="{{ route('pemesanan.approve', $row->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <button type="submit" name="status" value="2"
                                                            class="btn btn-danger">Tolak</button>
                                                        <button type="submit" name="status" value="0"
                                                            class="btn btn-success">Setujui</button>
                                                    </form>
                                                    {{-- Tombol Edit dan Delete hanya untuk Admin --}}
                                                @elseif(auth()->user()->role === 'admin')
                                                    <a href="{{ route('pemesanan.edit', $row->id) }}"
                                                        class="btn btn-info">Edit</a>
                                                    <form action="{{ route('pemesanan.destroy', $row->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger mx-2">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
