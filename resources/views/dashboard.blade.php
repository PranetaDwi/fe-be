@extends('master')

@section('style')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 20px;
    }

    .main-container {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .chart-container {
        width: 48%;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 10px;
    }

    .chart {
        width: 100%;
        height: 400px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    button {
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 0 auto;
        margin-top: 20px;
        padding: 10px;
        background-color: #658354;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #b3cf99;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .chart-container {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

<div class="main-container">
    <h2>DASHBOARD KALKULATOR KOMISI</h2>

    <div class="container">
        <div class="chart-container">
            <div id="container-chart-one" class="chart"></div>
        </div>
        <div class="chart-container">
            <div id="container-chart-two" class="chart"></div>
        </div>
    </div>

    <button onclick="hitungKomisi()">HITUNG KOMISI</button>
</div>


@endsection

@section('script')

@if(session()->has('success'))
<script>
    Swal.fire({
        icon: "success",
        title: '{{ session()->pull("success") }}',
        showConfirmButton: false,
        timer: 2200
    });
</script>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function hitungKomisi() {
        window.location.href = "{{ route('create-form') }}";
    }

    $(document).ready(function() {
        $.ajax({
            url: "{{ route('get-data-chart') }}",
            method: "GET",
            success: function(response) {
                // chart pertama
                var chartData = response.chart_ones;

                var data = chartData.map(function(item) {
                    return {
                        x: item.employee_name,
                        value: item.count
                    };
                });

                var chart = anychart.column();

                chart.title('Chart marketing dengan job terbanyak');

                chart.animation(true);

                var series = chart.column(data);
                chart.yScale().ticks({
                    interval: 1
                });
                chart.yScale().minimum(0);

                chart.tooltip().positionMode('point');
                chart.interactivity().hoverMode('by-x');

                chart.xAxis().title('Nama Karyawan');
                chart.yAxis().title('Jumlah Job');
                series.color('#4b6063');
                series.normal().hatchFill("forward-diagonal", "#4B6063", 1, 15);
                series.hovered().hatchFill("forward-diagonal", "#4B6063", 1, 15);
                series.selected().hatchFill("forward-diagonal", "#4B6063", 1, 15);
                chart.container('container-chart-one');

                chart.xScroller(true);

                chart.draw();

                // chart kedua
                var chartDataKedua = response.chart_twos;

                var dataKedua = chartDataKedua.map(function(item) {
                    return {
                        x: item.month,
                        value: item.total_profit
                    };
                });

                var chartKedua = anychart.column();

                chartKedua.title('Chart Profit');

                chartKedua.animation(true);

                var series2 = chartKedua.column(dataKedua);
                chartKedua.yScale().minimum(0);

                chartKedua.tooltip().positionMode('point');
                chartKedua.interactivity().hoverMode('by-x');

                chartKedua.xAxis().title('Bulan');
                chartKedua.yAxis().title('Total Gross');

                series2.color('#4b6063');
                series2.normal().hatchFill("forward-diagonal", "#4B6063", 1, 15);
                series2.hovered().hatchFill("forward-diagonal", "#4B6063", 1, 15);
                series2.selected().hatchFill("forward-diagonal", "#4B6063", 1, 15);

                chartKedua.container('container-chart-two');

                chartKedua.xScroller(true);

                chartKedua.draw();
            },
            error: function(xhr, status, error) {
                console.error("Terjadi kesalahan:", error);
            }
        });
    });
</script>

@endsection
