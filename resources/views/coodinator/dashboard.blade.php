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
        <div style="display: flex; justify-content: space-between;">
            <canvas id="statusChart" width="800" height="400"></canvas>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('statusChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($statusLabels) !!},
                    datasets: [
                        @foreach ($data as $status => $counts)
                            {
                                label: '{{ $status }}',
                                data: {!! json_encode($counts) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Màu nền của các cột
                                borderColor: 'rgba(54, 162, 235, 1)', // Màu đường viền của các cột
                                borderWidth: 1
                            },
                        @endforeach
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
@endsection
