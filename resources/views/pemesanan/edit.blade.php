@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Pemesanan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesanan.update', ['pemesanan' => $pemesanan->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                <input type="date" class="form-control @error('tanggal_pemesanan') is-invalid @enderror"
                                    id="tanggal_pemesanan" name="tanggal_pemesanan"
                                    value="{{ $pemesanan->tanggal_pemesanan }}">
                                @error('tanggal_pemesanan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kendaraan_id">Kendaraan</label>
                                <select class="form-control @error('kendaraan_id') is-invalid @enderror"
                                    name="kendaraan_id">
                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}" {{ $pemesanan->kendaraan_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->jenis_kendaraan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kendaraan_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" @readonly(true)>
                                    <option value="1" {{ $pemesanan->status == 1 ? 'selected' : '' }}>Diajukan</option>
                                    <option value="2" {{ $pemesanan->status == 2 ? 'selected' : '' }}>Disetujui</option>
                                    <option value="0" {{ $pemesanan->status == 0 ? 'selected' : '' }}>Ditolak</option>
                                </select>
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
