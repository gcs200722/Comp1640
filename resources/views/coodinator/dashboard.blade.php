@extends('layout.main')
@section('2')
    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul>
                    <li><a href="#">Contribution</a>
                        <ul>
                            <li><a class="active" href="{{ route('contribution') }}">Pending</a></li>
                            <li><a href="{{ route('contribution.approve') }}">Approved Contribution</a></li>
                            <li><a href="{{ route('contribution.rejected') }}">Rejected Contribution</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="{{ route('coodinator.home') }}">Home</a></li>

                    <li class="active"><a href="{{ route('coodinator.dashboard') }}">Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <head>
        <title>Status Chart</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>
        <form method="POST" action="">
            @csrf

            <div class="form-group">
                <label for="month" style="color: rgb(251, 251, 251)">Month</label>
                <input style="color: black" type="month" name="month">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <canvas id="statusChart" width="800" height="400"></canvas>

        <script>
            var statusLabels = @json($statusLabels);
            var data = @json($data);

            var datasets = [];
            statusLabels.forEach(function(status) {
                datasets.push({
                    label: status,
                    data: data[status],
                    backgroundColor: getRandomColor(),
                    borderWidth: 1
                });
            });

            var ctx = document.getElementById('statusChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: statusLabels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        </script>
    </body>
@endsection
