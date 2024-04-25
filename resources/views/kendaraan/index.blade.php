@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{ route('kendaraan.create') }}" class="btn btn-success">Tambah Kendaraan</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Kendaraan</h6>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plat
                                            Nomor</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Pembuatan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kendaraan as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->jenis_kendaraan }}</td>
                                            <td>{{ $row->plat_nomor }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    Tersedia
                                                @else
                                                    Tidak Tersedia
                                                @endif
                                            </td>
                                            <td>{{ $row->created_at->format('j F Y') }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('kendaraan.edit', $row->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('kendaraan.destroy', $row->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')">Hapus</button>
                                                </form>
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
