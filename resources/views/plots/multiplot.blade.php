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
        console.log("Multiplot");
    

        var data = <?php echo json_encode($data); ?>;
        console.log(data);

        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: data['type'],
            data: {
                datasets: [
                    data[0]['datasets'][0], 
                    data[1]['datasets'][0]
                ],
                labels: data['labels'], //ejeX
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


    });
</script>
@endsection