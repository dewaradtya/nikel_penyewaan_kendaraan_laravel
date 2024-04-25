@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-3">
            <div class="col-lg-12">
                <form action="{{ route('aktivitas.delete') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-3">Hapus Aktivitas</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Aktivitas user</h6>
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
                                            User</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deskripsi
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tindakan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->causer->name }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->log_name }}</td>
                                            <td>{{ $activity->created_at }}</td>
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
