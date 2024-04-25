@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Pemesanan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesanan.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                <input type="date" class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                                    id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ old('tanggal_pemesanan') }}">
                                @error('tanggal_pemesanan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kendaraan_id">Kendaraan</label>
                                <select class="form-control @error('kendaraan_id') is-invalid @enderror" name="kendaraan_id">
                                    @foreach ($kendaraan as $kendaraanItem)
                                        <option value="{{ $kendaraanItem->id }}" {{ old('kendaraan_id') == $kendaraanItem->id ? 'selected' : '' }}>
                                            {{ $kendaraanItem->jenis_kendaraan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kendaraan_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="1">Diajukan</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
