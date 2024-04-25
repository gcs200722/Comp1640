@extends('admin.site.layout')
@section('1')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div
        style="background-color: #ffffff; width: 1600px; height: 1000px; padding: 100px; margin-top: 50px; margin-left: auto; margin-right: auto; display: flex; justify-content: space-between;">
        <canvas id="roleChart" width="600" height="600"></canvas>
        <canvas id="rolePieChart" width="400" height="400"></canvas>
    </div>

    <script defer>
        var roleCounts = @json($roleCounts); // Convert PHP array to JavaScript object

        var roleNames = roleCounts.map(function(item) {
            return item.role;
        });

        var roleCountsData = roleCounts.map(function(item) {
            return item.count;
        });

        var ctx = document.getElementById('roleChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: roleNames,
                datasets: [{
                    label: 'Number of Users',
                    data: roleCountsData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Background color of bars
                    borderColor: 'rgba(54, 162, 235, 1)', // Border color of bars
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

        var ctxPie = document.getElementById('rolePieChart').getContext('2d');
        var myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: roleNames,
                datasets: [{
                    label: 'Percentage',
                    data: roleCountsData.map(function(count) {
                        var total = roleCountsData.reduce((a, b) => a + b, 0);
                        return (count / total * 100).toFixed(2);
                    }),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', // Red
                        'rgba(54, 162, 235, 0.5)', // Blue
                        'rgba(255, 206, 86, 0.5)', // Yellow
                        'rgba(75, 192, 192, 0.5)', // Green
                        'rgba(153, 102, 255, 0.5)', // Purple
                        'rgba(255, 159, 64, 0.5)' // Orange
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
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce((previousValue, currentValue) => previousValue +
                                currentValue);
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return percentage + "%";
                        }
                    }
                }
            }
        });
    </script>
@endsection
