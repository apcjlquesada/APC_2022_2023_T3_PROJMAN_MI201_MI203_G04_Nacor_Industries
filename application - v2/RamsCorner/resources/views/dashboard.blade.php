<!-- placeholder -->
<div class="overflow-auto"
    style="text-align: center; border-radius: 4px; position: absolute;  top: 5%; left: 5%; height: 93%; width: 95%; padding:2%;">


    <div style="  display: flex; justify-content: space-between;">
        <div class="card text-center shadow" style="width: 9%; ">
            <div class="card-body" style="border-top:5px solid blue">
                <h5 class="card-title">TOTAL TICKETS </h5>
                <h1 class="card-text"><b>{{ $all }}</b></h1>
            </div>
        </div>

        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #0033ffc3">
                <h5 class="card-title">
                    NEW<br><br></h5>
                <h1 class="card-text"><b>{{ $new }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #0033ff81">
                <h5 class="card-title">OPENED <br><br></h5>
                <h1 class="card-text"><b>{{ $opened }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #15ff007e">
                <h5 class="card-title">ONGOING <br><br></h5>
                <h1 class="card-text"><b>{{ $ongoing }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #15ff007c">
                <h5 class="card-title">RESOURCE PENDING</h5>
                <h1 class="card-text"><b>{{ $pending }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #00ff08">
                <h5 class="card-title">RESOLVED<br><br></h5>
                <h1 class="card-text"><b>{{ $resolved }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #ff2f2f7f">
                <h5 class="card-title">CANCELLED<br><br></h5>
                <h1 class="card-text"><b>{{ $cancelled }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #ff0000bd">
                <h5 class="card-title">REJECTED<br><br></h5>
                <h1 class="card-text"><b>{{ $rejected }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #ff0000">
                <h5 class="card-title" style="color: red">ESCALATED<br><br></h5>
                <h1 class="card-text" style="color: rgba(255, 0, 0, 0.848)"><b>{{ $escalated }}</b></h1>
            </div>
        </div>
        <div class="card text-center shadow" style="width: 9%;">
            <div class="card-body" style="border-top:5px solid #ff0000">
                <h5 class="card-title" style="color: rgb(163, 0, 0)">OVERDUE<br><br></h5>
                <h1 class="card-text" style="color: rgb(144, 0, 0)"><b>{{ $overdue }}</b></h1>
            </div>
        </div>
    </div>

    <div>
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
                        ['{{ $row->t_status }}', {{ $row->total }}],
                    @endforeach

                ]);

                var options = {
                    title: 'TICKETS BY STATUS',

                    backgroundColor: 'transparent',
                    colors: ['#dfc006', '#74aaca', '#b1bde9', '#616b73', '#cb84d4', '#d3b6e9', '#c4c3a6',
                        '#e4ddcd'
                    ],
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
                    chartArea: {
                        left: 30,
                        top: 50,
                        right: 30,
                        bottom: 30
                    }
                    // vAxis: {
                    //     title: 'Ticket Count'
                    // },
                    // hAxis: {
                    //     title: 'Status'
                    // },
                    // seriesType: 'bars',
                    // series: {
                    //     5: {
                    //         type: 'line'
                    //     }
                    // }
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        {{-- ticket by assignment --}}

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {

                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Ticket Count'],
                    @foreach ($assign as $row)
                        ['{{ $row->t_assignedTo }}', {{ $row->total }}],
                    @endforeach

                ]);

                var options = {
                    title: 'TICKETS BY ASSIGNED STAFF',
                    is3d: true,
                    backgroundColor: 'transparent',
                    colors: ['#dfc006', '#74aaca', '#b1bde9', '#616b73', '#cb84d4', '#d3b6e9', '#c4c3a6',
                        '#e4ddcd'
                    ],
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
                    chartArea: {
                        left: 30,
                        top: 50,
                        right: 30,
                        bottom: 30
                    }

                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_assigned'));
                chart.draw(data, options);
            }
        </script>

        {{-- ticket by priority --}}

        <script type="text/javascript">
            var news = {!! $new !!};
            var open = {!! $opened !!};
            var pend = {!! $pending !!};
            var ong = {!! $ongoing !!};
            var res = {!! $resolved !!};
            var clo = {!! $closed !!};
            var rej = {!! $rejected !!};
            var can = {!! $cancelled !!};



            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {

                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Ticket Count'],
                    @foreach ($priority as $row)
                        ['P{{ $row->t_priority }}', {{ $row->total }}],
                    @endforeach

                ]);

                var options = {
                    title: 'TICKETS BY PRIORITY',
                    is3d: true,
                    backgroundColor: 'transparent',
                    colors: ['red', 'orange', 'yellow', 'green'],
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
                    chartArea: {
                        left: 30,
                        top: 50,
                        right: 30,
                        bottom: 30
                    }

                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_priority'));
                chart.draw(data, options);
            }
        </script>
        {{-- daily --}}
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table, instantiates the chart, passes in the data and draws it.
            function drawChart() {
                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('date', 'Date');
                data.addColumn('number', 'Tickets');

                console.log(data);
                // Add the data rows to the table.
                @foreach ($tickets as $ticket)
                    var dateArray = '{{ $ticket->date }}'.split('-');
                    var year = parseInt(dateArray[0]);
                    var month = parseInt(dateArray[1]) - 1; // Note that JavaScript months are zero-indexed
                    var day = parseInt(dateArray[2]);
                    var date = new Date(year, month, day);
                    data.addRow([date, {{ $ticket->number }}]);
                @endforeach

                // Set chart options.
                var options = {
                    title: 'Tickets Received Daily',
                    height: 305,
                    width: 1200,
                    hAxis: {
                        title: 'Date'
                    },
                    vAxis: {
                        title: 'Number of Tickets',
                        format: '0'
                    },
                    legend: {
                        position: 'none'
                    },
                    series: {
                        0: {
                            type: 'bars'
                        }
                    }
                };

                // Instantiate and draw the chart, passing in the data and options.
                var chart = new google.visualization.LineChart(document.getElementById('daily'));
                chart.draw(data, options);
            }
        </script>


        {{-- Weekly --}}
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();



                data.addColumn('string', 'Week');
                data.addColumn('number', 'Number of Tickets');


                @foreach ($weekly as $ticket)
                    data.addRow(['Week {{ $ticket->week }}', {{ $ticket->number }}]);
                @endforeach



                var options = {
                    title: 'Tickets Received Weekly',
                    height: 305,
                    width: 1200,
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Week'
                    },
                    vAxis: {
                        title: 'Number of Tickets',
                        format: '0'
                    },
                    series: {
                        0: {
                            type: 'bars'
                        }
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('weekly'));
                chart.draw(data, options);
            }
        </script>

        {{-- monthly --}}
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawMonthlyChart);

            function drawMonthlyChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Tickets');

                data.addRows([
                    @foreach ($monthly as $ticket)
                        ['{{ $ticket->month }}', {{ $ticket->total }}],
                    @endforeach
                ]);

                var options = {
                    title: 'Tickets Received Monthly',
                    height: 305,
                    width: 1200,
                    curveType: 'function',
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Month'
                    },
                    vAxis: {
                        title: 'Number of Tickets',

                    },
                    series: {
                        0: {
                            type: 'bars'
                        }
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('monthly'));
                chart.draw(data, options);
            }
        </script>

        {{-- yearly --}}
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawYearlyChart);

            function drawYearlyChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Tickets');

                data.addRows([
                    @foreach ($yearly as $ticket)
                        ['{{ $ticket->year }}', {{ $ticket->total }}],
                    @endforeach
                ]);

                var options = {
                    title: 'Tickets Received Yearly',
                    height: 305,
                    width: 1200,
                    curveType: 'function',
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Year'
                    },
                    vAxis: {
                        title: 'Number of Tickets',

                    },
                    series: {
                        0: {
                            type: 'bars'
                        }
                    },


                };

                var chart = new google.visualization.LineChart(document.getElementById('yearly'));
                chart.draw(data, options);
            }
        </script>






        <div class="mt-4" style="display: flex; justify-content: space-between;">
            <div class="card mb-3 shadow" style="max-width: 500px;">
                <div class="row g-0">
                    <div id="chart_div"></div>
                </div>
            </div>

            <div class="card mb-3 shadow" style="max-width: 500px;">
                <div class="row g-0">
                    <div id="chart_assigned"></div>

                </div>
            </div>

            <div class="card mb-3 shadow" style="max-width: 500px;">
                <div class="row g-0">
                    <div id="chart_priority"></div>

                </div>
            </div>

            <div class="card mb-2 shadow" style="width: 250px;padding:5px; height: 310px">
                <div class="card text-center shadow" style="height:148px">
                    <div class="card-body">
                        <h5 class="card-title" style="color: rgba(248, 198, 0, 0.875)">MOST REPORTED ISSUE<br></h5>
                        <h2 class="card-text" style="color: #b99400">
                            <b>INC#{{ $mostViewTix }}</b>
                        </h2>
                    </div>
                </div>
                <div class="card text-center shadow" style="height:150px;margin-top:7px">
                    <div class="card-body">
                        <h5 class="card-title" style="color: rgb(255, 132, 0)"># OF VIEWS<br><br></h5>
                        <h1 class="card-text" style="color: rgb(255, 132, 0)"><b>{{ $views }}</b></h1>
                    </div>
                </div>

            </div>

            <div class="card mb-2 shadow" style="width: 250px;padding:5px; height:310px">
                <div class="card text-center shadow" style="height:150px">
                    <div class="card-body">
                        <h5 class="card-title" style="color: rgba(248, 198, 0, 0.875)">MOST VIEWED KB<br><br></h5>
                        <h2 class="card-text" style="color: rgb(185, 148, 0)">
                            <b>KBID#{{ $mostViewKB }}</b>
                        </h2>
                    </div>
                </div>
                <div class="card text-center shadow" style="height:150px;margin-top:7px">
                    <div class="card-body">
                        <h5 class="card-title" style="color: rgb(255, 132, 0)"># OF VIEWS<br><br></h5>
                        <h1 class="card-text" style="color: rgb(255, 132, 0)"><b>{{ $watch }}</b></h1>
                    </div>
                </div>


            </div>

        </div>





        <div class="card text-center shadow" style="width: 65%;">
            <div class="card-body">

                <div class="row" style="width:1200px; background-color:white; margin-left: 0%">
                    <div class="col-12 col-xl-8" style="margin-left: -100px; margin-top: 1%; ">
                        <h3>TICKET SUMMARY BY DATE RANGE</h3>
                    </div>
                    <div class="col-12 col-xl-4" style="margin-left: 10px; margin-top: 1%">
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="showChart('daily')"><i
                                class="bi bi-calendar-event-fill"></i>
                            Daily</button>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="showChart('weekly')"><i
                                class="bi bi-calendar-range"></i>
                            Weekly</button>
                        <button type="button" class="btn btn-outline-warning btn-sm"
                            onclick="showChart('monthly')()"><i class="bi bi-calendar-month-fill"></i>
                            Monthly</button>
                        <button type="button" class="btn btn-outline-info btn-sm" onclick="showChart('yearly')()"><i
                                class="bi bi-calendar-fill"></i>
                            Yearly</button>
                    </div>


                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <div class="row g-0">
                                <div id="daily" class="mydivclass "></div>
                                <div id="weekly" class="mydivclass  d-none"></div>
                                <div id="monthly" class="mydivclass d-none"></div>
                                <div id="yearly" class="mydivclass d-none"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="card mb-2 shadow" style="width: 150px;padding:5px;margin-top:-20.5%; margin-left:65.5%">
            <div class="card text-center shadow" style="height:187.5px">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgba(0, 105, 198, 0.724)">ACTIVE
                        CLIENTS<br><br>
                    </h5>
                    <h1 class="card-text" style="color: rgba(0, 105, 198, 0.724)">
                        <b><i class="bi bi-person-fill"></i>{{ $userCount }}</b>
                    </h1>
                </div>
            </div>
            <div class="card text-center shadow" style="height:187.5px;margin-top:7px">
                <div class="card-body">
                    <h5 class="card-title" style="color: rgb(0, 76, 255)">ACTIVE <br>STAFF<br><br></h5>
                    <h1 class="card-text" style="color: rgb(0, 76, 255)"><i
                            class="bi bi-person-fill"></i><b>{{ $staffCount }}</b>
                    </h1>
                </div>
            </div>
        </div>

        <div class="card mb-2 shadow" style="max-width: 500px;margin-top: -20.8%;margin-left:74%">
            <div id="donut-chart"></div>
        </div>

        {{-- <div class="position-absolute bottom-4 end-0 me-4 mb-3" style="margin-top:-19%">
            <a href="{{ url('generateReport') }}" type="button" class="btn btn-primary btn-lg"
                title="View Full Reports">
                <i class="bi bi-clipboard-data-fill" style="font-size: 50px; "></i>
                <h6>VEW<br>FULL<br>REPORTS</h6>
            </a>
        </div>

        <div style="position: absolute bottom-0 end-0 me-4 mb-3">

            <div class="d-grid gap-2 d-md-block">
                @include('create_ticket')
            </div>
        </div> --}}


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <!-- Define the chart container -->

        <!-- Create the chart script -->
        @push('scripts')
        @endpush
        <script type="text/javascript">
            // Load the Google Charts API library
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback function to create the chart when the API is loaded
            google.charts.setOnLoadCallback(createDonutChart);

            function createDonutChart() {
                // Define the chart data
                var data = new google.visualization.DataTable();
                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Count'],
                    @foreach ($ticketData['statusCounts'] as $status => $count)
                        ['{{ ucfirst($status) }}', {{ $count }}],
                    @endforeach
                ]);

                // Define the chart options
                var options = {
                    title: 'MY ASSIGNED TICKETS',
                    is3d: true,
                    backgroundColor: 'transparent',
                    colors: ['orange', 'yellow', 'green', 'red'],
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
                    height: 390,
                    width: 550,

                    pieHole: 0.4,
                    pieSliceText: 'value',
                    slices: {
                        3: {
                            color: '#cccccc'
                        },
                    },

                };

                // Create the chart object and draw it in the container
                var chart = new google.visualization.PieChart(document.getElementById('donut-chart'));
                chart.draw(data, options);


            }
        </script>


        <script>
            function showChart(divChart) {
                $('#daily,#weekly,#monthly,#yearly').addClass('d-none');
                $('#' + divChart).removeClass('d-none');
            }
        </script>

    </div>

</div> <!-- placeholder end -->
