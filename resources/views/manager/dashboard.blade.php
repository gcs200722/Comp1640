@extends('layout.main')
@section('2')
    <div class="wrapper row2" style="margin-top: 20px;">
        <div class="rounded">
            <nav id="mainav" class="clear">
                <ul class="clear">
                    <li><a class="active" href="{{ route('manager.contribution') }}">Contribution</a></li>
                    <li class="active"><a href="{{ route('manager.home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('manager.dashboard') }}">Dashboard</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <head>
        <title>Contribution Chart</title>
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
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;color:aliceblue">
                <canvas id="contributionChart" width="400" height="400"></canvas>
            </div>
            <div style="flex: 1;">
                <canvas id="pieChart" width="400" height="400"></canvas>
            </div>
        </div>

        <script>
            var facultyNames = @json($facultyNames);
            var contributionCounts = @json($contributionCounts);

            var ctx1 = document.getElementById('contributionChart').getContext('2d');
            var myChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: facultyNames,
                    datasets: [{
                        label: 'Number of Contributions',
                        data: contributionCounts,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
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

            var percentageByFaculty = @json($percentageByFaculty);

            var ctx2 = document.getElementById('pieChart').getContext('2d');
            var myPieChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: facultyNames,
                    datasets: [{
                        data: percentageByFaculty.map(f => f.percentage),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false, // To prevent resizing
                }
            });
        </script>
    </body>
@endsection
