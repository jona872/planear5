@extends('layouts.app')

@section('content')

<div style="width: 90%;height: 100%; margin: auto; ">
    <canvas id="myChart"></canvas>
    <!-- <canvas id="myChart2"></canvas> -->
</div>
<!-- <a href="plots2" role="button" class="btn btn-primary btn-spinner btn-sm">
    <i class="fa fa-plus"></i>&nbsp; generar PDF
</a>
<a href="plots2" role="button" class="btn btn-primary btn-spinner btn-sm">
    <i class="fa fa-plus"></i>&nbsp; Enviar
</a> -->
@endsection

@section('footer')

<a class="btn btn-danger" href="{{ route('plots.index') }}">
    <i class="fa fa-arrow-left"></i> &nbsp; Volver</a>

@endsection


@section('footer-scripts')
<!-- @include('scripts.tmp') -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        console.log("CARGADO2");




        var data2 = <?php echo json_encode($datasets);  ?>;

        var barCanvas = document.getElementById('myChart').getContext('2d');
        // var barChart = new Chart(barCanvas, cfg);

        // https://www.chartjs.org/docs/latest/charts/mixed.html
        var delayed;
        var mixedChart = new Chart(barCanvas, {
            data: data2,

            options: {
                animation: {
                    // y: { //DROP
                    //     easing: 'easeInOutElastic',
                    //     from: (ctx) => {
                    //         if (ctx.type === 'data') {
                    //             if (ctx.mode === 'default' && !ctx.dropped) {
                    //                 ctx.dropped = true;
                    //                 return 0;
                    //             }
                    //         }
                    //     }
                    // },

                    onComplete: () => {//DELAY
                        delayed = true;
                    },
                    delay: (context) => {
                        let delay = 0;
                        if (context.type === 'data' && context.mode === 'default' && !delayed) {
                            delay = context.dataIndex * 300 + context.datasetIndex * 100;
                        }
                        return delay;
                    },
                },
                scales: {
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



    });
</script>
@endsection