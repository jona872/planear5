@extends('layouts.app')
@section('content')

<div style="width: 70%;height: 70%; margin: 0 auto; ">
    <canvas id="myChart"></canvas>
    <canvas id="myChart2"></canvas>
</div>

@endsection


@section('footer-scripts')
<!-- @include('scripts.tmp') -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        console.log("plot factores");


        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'DataSet Patogenos 2020', // Titulo del Dataset (Herramienta)
                    data: [12, 19, 3],
                    backgroundColor: 'rgba(0, 0, 255, 1)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 1,
                    order: 2
                }, {
                    label: 'DataSet Patogenos 2021', // Titulo del Dataset (Herramienta)
                    data: [10, 5, 7],
                    backgroundColor: 'rgba(255, 0, 0, 1)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1,
                    // this dataset is drawn on top
                    order: 1
                }],
                labels: ['Grupo 1', 'Grupo 2', 'Grupo 3'], //ejeX
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Censo Patogenos Virales'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // var mixedChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         datasets: [{
        //             label: 'Bar Dataset',
        //             data: [10, 20, 30, 40],
        //             // this dataset is drawn below
        //             order: 2
        //         }, {
        //             label: 'Line Dataset',
        //             data: [10, 10, 10, 10],
        //             type: 'line',
        //             // this dataset is drawn on top
        //             order: 1
        //         }],
        //         labels: ['January', 'February', 'March', 'April']
        //     },
        //     options: options
        // });




    });
</script>
@endsection