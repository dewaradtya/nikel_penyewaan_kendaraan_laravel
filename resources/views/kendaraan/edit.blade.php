@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Kendaraan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis kendaraan</label>
                                <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan"
                                    placeholder="Masukkan jenis kendaraan" value="{{ $kendaraan->jenis_kendaraan }}">
                            </div>
                            <div class="form-group">
                                <label for="plat_nomor">Plat Nomor</label>
                                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor"
                                    placeholder="Masukkan Plat Nomor" value="{{ $kendaraan->plat_nomor }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ $kendaraan->status == '1' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="0" {{ $kendaraan->status == '0' ? 'selected' : '' }}>Tidak Tersedia
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
