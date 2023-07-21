
    <div class="ticket-status mb-2" style="text-align: center; height: 240px">
        <!-- google chart -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        {{-- tickt by status --}}

        <script type="text/javascript">
            var news = {!! $new !!};
            var open = {!! $opened !!};
            var pend = {!! $pending !!};
            var ong = {!! $ongoing !!};
            var res = {!! $resolved !!};
            var clo = {!! $closed !!};
            var rej = {!! $rejected !!};
            var can = {!! $cancelled !!};


            console.log(news);
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {

                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Ticket Count'],
                    @foreach ($data as $row)
                        [{{ $row->total }}, '{{ $row->t_status }}'],
                    @endforeach

                ]);

                var options = {
                    title: 'TICKETS BY STATUS',

                    backgroundColor: 'transparent',
                    colors: ['#6CA9FF', '#d9eaf5', '#000182', '#F4F8FF'],
                    legend: {
                        position: 'right',
                        textStyle: {
                            color: 'black',
                            fontSize: 16
                        }
                    },
                    titleTextStyle: {
                        fontSize: 20,
                        textAlign: 'left',
                    },
                    width: 450,
                    height: 300,
                    // chartArea: {
                    //     left: 30,
                    //     top: 50,
                    //     right: 30,
                    //     bottom: 30
                    // }
                    vAxis: {
                        title: 'Ticket Count'
                    },
                    hAxis: {
                        title: 'Status'
                    },
                    seriesType: 'bars',
                    series: {
                        5: {
                            type: 'line'
                        }
                    }
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
        <div class="card mb-3 shadow" ">
            <div class="row g-0">
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
</div>
