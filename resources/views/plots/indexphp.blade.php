@extends('layouts.app')
@section('content')

<div style="width: 50%;height: 50%; margin: auto; ">
    <canvas id="myChart"></canvas>
    <canvas id="myChart2"></canvas>
</div>
<a href="plots2" role="button" class="btn btn-primary btn-spinner btn-sm pull-right m-b-0">
    <i class="fa fa-plus"></i>&nbsp; GoNext
</a>

@endsection


@section('footer-scripts')
<!-- @include('scripts.tmp') -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        console.log("CARGADO2");
        // const data = [{
        //     x: 'Jan',
        //     net: 100,
        //     cogs: 50,
        //     gm: 50
        // }, {
        //     x: 'Feb',
        //     net: 120,
        //     cogs: 55,
        //     gm: 75
        // }];

        // const cfg = {
        //     type: 'bar',

        //     data: {
        //         labels: ['Jan', 'Feb'],
        //         datasets: [{
        //             label: 'Net sales',
        //             data: data,
        //             backgroundColor: ['red'],
        //             parsing: {
        //                 yAxisKey: 'net'
        //             }
        //         }, {
        //             label: 'Cost of goods sold',
        //             data: data,
        //             backgroundColor: ['green'],
        //             parsing: {
        //                 yAxisKey: 'cogs'
        //             }
        //         }, {
        //             label: 'Gross margin',
        //             data: data,
        //             backgroundColor: ['blue'],
        //             parsing: {
        //                 yAxisKey: 'gm'
        //             }
        //         }]
        //     },
        // };


        // const data = {
        //     labels: [
        //         'Red',
        //         'Blue',
        //         'Yellow'
        //     ],
        //     datasets: [{
        //         label: 'My First Dataset',
        //         data: [300, 50, 100],
        //         backgroundColor: [
        //             'rgb(255, 99, 132)',
        //             'rgb(54, 162, 235)',
        //             'rgb(255, 205, 86)'
        //         ],
        //         hoverOffset: 4
        //     }]
        // };
        // const cfg = {
        //     type: 'doughnut', //'pie'
        //     data: data,
        // };



        var data2 = <?php echo json_encode($data); ?>;

        var barCanvas = document.getElementById('myChart').getContext('2d');
        // var barChart = new Chart(barCanvas, cfg);

        // https://www.chartjs.org/docs/latest/charts/mixed.html
        var mixedChart = new Chart(barCanvas, {
            data: {
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [10, 20, 30, 40]
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: data2,
                }],
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo']
            },
            options: {
                scales: {
                    // y: {
                    //     min: 10,
                    //     max: 50
                    // },
                    // myScale: {
                    //     type: 'logarithmic',
                    //     position: 'right', // `axis` is determined by the position as `'y'`
                    // },
                    yAxes: [{
                        ticks: {
                            biginAtZero: false
                        }
                    }]
                }
            }
        });


        var barCanvas2 = document.getElementById('myChart2').getContext('2d');
        var barChart2 = new Chart(barCanvas2, {
            type: 'line',
            data: {
                // labels: ['Enero','Febrero','Marzo','Abril','Mayo'], //Esto tiene que coincidir con el backend si lo pongo 
                datasets: [{
                    label: 'Cantidad de Accidentes',
                    data: data2,
                    backgroundColor: ['red', 'orange', 'cyan', 'blue', 'green'],
                    borderColor: [
                        'rgba(0, 0, 0, 1)',
                        'rgba(0, 0, 0, 1)',
                        'rgba(0, 0, 0, 1)',
                        'rgba(0, 0, 0, 1)',
                        'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }],
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                biginAtZero: false
                            }
                        }]
                    }
                }
            }
        });

    });
</script>
@endsection