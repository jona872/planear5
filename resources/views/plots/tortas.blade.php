@extends('layouts.app')
@section('content')

<div style="width: 50%;height: 50%; margin: 0 auto; ">
    <canvas id="myChart"></canvas>
</div>

@endsection


@section('footer-scripts')
<!-- @include('scripts.tmp') -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        console.log("plot factores");

        const data = {
            labels: ['Grupo 1', 'Grupo 2', 'Grupo 3'], //ejeX
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: [
                    // 'rgb(255, 99, 132)',
                    // 'rgb(54, 162, 235)',
                    // 'rgb(255, 205, 86)'
                    'rgb(255, 127, 127)',
                    'rgb(127, 255, 127)',
                    'rgb(127, 127, 255)'
                ],
                hoverOffset: 2
            }]
        };
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
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







    });
</script>
@endsection