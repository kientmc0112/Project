@extends('client.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card-body">
            <h4><i id="year" class="btn text-success fa fa-retweet text-center" style="font-size: 35px"></i>Thống kê theo năm</h4>
            <canvas id="bar-chart-grouped" width="100%" height="40"></canvas>
        </div>
    </div>

    <input type="hidden" id="chartData" value="{{ json_encode($data) }}">
    <script type="text/javascript">
        var data = $("#chartData").val();
        course = JSON.parse(data);
        var key = [];
        var data = [];
        for (x in course) {
            key.push(x);
            data.push(course[x]);
        }

        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        var ctx = document.getElementById("bar-chart-grouped");
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: key,
                datasets: [{
                    label: "Courses",
                    lineTension: 0.3,
                    backgroundColor: "#34eb74",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: data,
                }],
            },
            options: {
                'onClick' : function (evt, item) {
                    var year = item[0]['_model'].label;
                    var labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    if (year > 12) {
                        $.ajax({
                            type: 'POST',
                            url: 'chart/courseByMonth',
                            data: {
                                year: year,
                                status: 0,
                            },
                            success: function (response) {
                                chart.data.datasets[0].data = response.data;
                                chart.data.labels = labels;
                                chart.options.title.text = 'Thống kê khóa học trong năm ' + year;
                                chart.update();
                                $("#year").on('click', function () {
                                    $.ajax({
                                        type: 'POST',
                                        url: '/chart/courseByMonth',
                                        data: {
                                            status: 1,
                                        },
                                        success: function (response) {
                                            var key = [];
                                            var data = [];
                                            for (x in response.data) {
                                                key.push(x);
                                                data.push(response.data[x]);
                                            }
                                            chart.data.datasets[0].data = data;
                                            chart.data.labels = key;
                                            chart.options.title.text = 'Thống kê khóa học theo năm';
                                            chart.update();
                                        },
                                        error: function(e) {
                                           alert("Error! Please refresh");
                                        },
                                    });
                                });
                            },
                            error: function(e) {
                               alert("Error! Please refresh");
                            },
                        });
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        },
                    }],
                },
                title: {
                    display: true,
                    fontSize: '20',
                    text: 'Thống kê khóa học theo năm',
                }
            }
        });
    </script>
@endsection
