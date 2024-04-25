@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Dashboard</h6>
                    </div>
                    <div class="card-body">
                        <div id="grafik"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        // Data grafik dari controller
        var dataGrafik = {!! $dataGrafik !!}; // Remove json_encode

        // Membuat grafik menggunakan Highcharts
        Highcharts.chart('grafik', {
            chart: {
                type: 'area',
                backgroundColor: 'rgba(0, 0, 0, 0)'
            },
            title: {
                text: 'Grafik Pemakaian Kendaraan'
            },
            xAxis: {
                categories: dataGrafik.jenis,
                title: {
                    text: 'Jenis Kendaraan'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            series: [{
                name: 'Jumlah',
                data: dataGrafik.jumlah,
                color: 'orange'
            }]
        });
    </script>
@endsection
