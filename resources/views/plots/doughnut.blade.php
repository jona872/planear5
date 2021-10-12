@extends('layouts.app')
@section('content')

<div style="width: 50%;height: 50%; margin: auto; ">
    <canvas id="myChart"></canvas>
</div>

@endsection


@section('footer-scripts')
<!-- @include('scripts.tmp') -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        console.log("Plot = doughnut");
        //fetch data
        var data = <?php echo json_encode($data); ?>;
        //console.log(data);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
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