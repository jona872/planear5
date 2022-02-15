@extends('layouts.app')
@section('content')

<div style="width: 50%;height: 50%; margin: auto; ">
    <canvas id="myChart"></canvas>
</div>

@endsection

@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        
        // const labels = ["enero"];
        // const data = {
        //     labels: labels,
        //     datasets: [{
        //         label: 'My First Dataset',
        //         data: [65, 59, 80, 81, 56, 55, 40],
        //         fill: false,
        //         borderColor: 'rgb(75, 192, 192)',
        //         tension: 0.1
        //     }]
        // };
        // const config = {
        //     type: 'line',
        //     data: data,
        // };

        console.log("Plot = Line");
        //fetch data
        var data = <?php echo json_encode($data); ?>;
        //console.log(data);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
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