<div>

    <div class="overflow-auto"
        style="border-radius: 4px;
                        border: 1px solid #ffffff7c;
                        position: absolute;
                        background-color: rgb(255, 255, 255);
                        top: 10%;
                        height: 89%;
                        width: 93%;
                        left: 6.5%;">
        <form method="POST" enctype="multipart/form-data" action="{{ url('generate') }}">
            @csrf
            <div class="row p-4" style="background-color: #f7f7f7; border-bottom: 1px solid #ccc;">
                <div class="col">

                    {{-- date range selection --}}
                    <span>Filter by Date Range</span>
                    <select class="form-select" aria-label="Default select example" id="daterange" name="dateRange">
                        <option selected disabled value="">Choose Date Range...</option>
                        <option value="Day">Day</option>
                        <option value="Week">Week</option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                    </select>


                    {{-- days --}}
                    <div style="margin-top:20px;display:none" id="dayss">
                        <label for="date">Select Date:</label>
                        <input type="date" id="date" style="margin-left: 40px;height:40px" name="dayDate">
                    </div>

                    {{-- weeks --}}
                    <div class="row" id="weekss" style="margin-top:20px;display:none;">
                        <div class=col-4>
                            <label for="week" style="margin-top:10px">Select Week No.:</label>
                        </div>
                        <div class="col-5" style="margin-left:-30px">
                            <select class="form-select mt-1" aria-label="Default select example" name="weekDate">
                                <option selected disabled value="">Choose Week No. </option>
                                @for ($week = 1; $week < 53; $week++)
                                    <option value={{ $week }}>{{ $week }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-3" style="margin-left:-20px">
                            <select class="form-select mt-1" aria-label="Default select example" name="weekYearDate">
                                <option selected disabled value="">Choose Year... </option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- months --}}
                    <div class="row" id="monthss" style="margin-top:20px;display:none;">
                        <div class=col-4>
                            <label for="month" style="margin-top:10px">Select Month:</label>
                        </div>
                        <div class="col-5" style="margin-left:-30px">
                            <select class="form-select mt-1" aria-label="Default select example" name="monthDate">
                                <option selected disabled value="">Choose Month... </option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-3" style="margin-left:-20px">
                            <select class="form-select mt-1" aria-label="Default select example" name="monthYearDate">
                                <option selected disabled value="">Choose Year... </option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    {{-- years --}}
                    <div class="row" id="yearss" style="margin-top:20px;display:none;">

                        <div class=col-4>
                            <label for="year" style="margin-top:10px">
                                Select Year:</label>
                        </div>
                        <div class="col-5" style="margin-left:-30px">
                            <select class="form-select mt-1" aria-label="Default select example" name="yearDate">
                                <option selected disabled value="">Choose a Year </option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#daterange').on('change', function() {
                                if (this.value == 'Day') {
                                    $("#dayss").show();
                                    $("#weekss").hide();
                                    $("#monthss").hide();
                                    $("#yearss").hide();

                                } else if (this.value == 'Week') {
                                    $("#dayss").hide();
                                    $("#weekss").show();
                                    $("#monthss").hide();
                                    $("#yearss").hide();
                                } else if (this.value == 'Month') {
                                    $("#dayss").hide();
                                    $("#weekss").hide();
                                    $("#monthss").show();
                                    $("#yearss").hide();
                                } else {
                                    $("#dayss").hide();
                                    $("#weekss").hide();
                                    $("#monthss").hide();
                                    $("#yearss").show();
                                }
                            });
                        });
                    </script>

                </div>






                {{-- <div class="col">
                        <span>Filter by Status</span>
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="OPENED">Opened</option>
                            <option value="RESOLVED">Resolved</option>
                            <option value="CLOSED">Closed</option>
                            <option value="REJECTED">Rejected</option>
                            <option value="CANCELLED">Cancelled</option>
                        </select>
                    </div> --}}
                <div class="col">
                    <span>Filter by Priority</span>
                    <select class="form-select" aria-label="Default select example" name="priority">
                        <option selected value="All">All</option>
                        <option value="0">P0</option>
                        <option value="1">P1</option>
                        <option value="2">P2</option>
                        <option value="3">P3</option>
                    </select>
                </div>
                <div class="col">
                    <span>Filter by Staff Assigned</span>
                    <select class="form-select" aria-label="Default select example" name="assigned">
                        <option selected value="All">All</option>
                        <option value="Not Assigned">Not Assigned</option>
                        @foreach ($allStaff as $staff)
                            <option value="{{ $staff->u_name }}">{{ $staff->u_name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-1" style="margin-top:80px; margin-left: -150px">
                    <div>
                        <button type="submit" class="btn btn-info" id="generate"><i
                                class="bi bi-file-earmark-arrow-down-fill"></i>
                            Generate </a>
                    </div>
                </div>


            </div>

        </form>


        {{-- <div class="col" style="margin-top:10px; margin-left: 1700px">
            <div>
                <button type="submit" class="btn btn-info" id="generateSummary"><i
                        class="bi bi-file-earmark-arrow-down-fill"></i>
                    Generate Summary Report </a>
            </div>
        </div> --}}
        <div style="margin-top:10px; background-color:beige">
            <div>
                <h3 style="margin-left: 44%; color:black">REPORT PREVIEW</h3>
            </div>
        </div>
        <div class="report-preview" id="reportView" style="display:{{ $display }}">
            <div class="report-header"
                style=" background-color: #333; color: #fff; padding: 20px; text-align: center;">
                <h6>ASIA PACIFIC COLLEGE</h6>
                <h4>Information Technology Resource Office (ITRO)</h4>
            </div>
            <div class="report-content" style="background-color: #fff; padding: 20px;">
                <div class="report-section">
                    <h5>FILTERS</h5>
                    @if ($filters == null)
                        <p>No Filters</p>
                    @else
                        @if ($filters->dateRange == 'Day')
                            <h6>Date By : {{ $filters->dateRange }}</h6>
                            <h6>Specific Date : {{ $filters->dayDate }}</h6>
                            <h6>Priority: {{ $filters->priority }}</h6>
                            <h6>Staff Assigned: {{ $filters->assigned }}</h6>
                        @elseif($filters->dateRange == 'Week')
                            <h6>Date Range: {{ $filters->dateRange }}</h6>
                            <h6>Week No. {{ $filters->weekDate }} of Year {{ $filters->weekYearDate }}</h6>
                            <h6>Priority: {{ $filters->priority }}</h6>
                            <h6>Staff Assigned: {{ $filters->assigned }}</h6>
                        @elseif($filters->dateRange == 'Month')
                            <h6>Date Range: {{ $filters->dateRange }}</h6>
                            @if ($filters->monthDate == 1)
                                <h6>January of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 2)
                                <h6>February of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 3)
                                <h6>March of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 4)
                                <h6>April of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 5)
                                <h6>May of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 6)
                                <h6>June of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 7)
                                <h6>July of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 8)
                                <h6>August of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 9)
                                <h6>September of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 10)
                                <h6>October of Year {{ $filters->monthYearDate }}</h6>
                            @elseif ($filters->monthDate == 11)
                                <h6>November of Year {{ $filters->monthYearDate }}</h6>
                            @else
                                <h6>December of Year {{ $filters->monthYearDate }}</h6>
                            @endif

                            <h6>Priority: {{ $filters->priority }}</h6>
                            <h6>Staff Assigned: {{ $filters->assigned }}</h6>
                        @else
                            <h6>Date Range: {{ $filters->dateRange }}</h6>
                            <h6>Specific Year : {{ $filters->yearDate }}</h6>
                            <h6>Priority: {{ $filters->priority }}</h6>
                            <h6>Staff Assigned: {{ $filters->assigned }}</h6>
                        @endif
                    @endif
                    <h5>TOTAL RECORDS: {{ $records }}</h5>


                </div>
                <div class="report-section">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Incident #</th>
                                <th>Short Description</th>
                                <th>Sent Date</th>
                                <th>Opened Date</th>
                                <th>Assigned To</th>
                                <th>Current Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportData as $report)
                                <tr>
                                    <td>INC{{ $report->t_ID }}</td>
                                    <td>{{ $report->t_title }}</td>
                                    <td>{{ $report->t_datetime }}</td>
                                    <td>{{ $report->opened_date }}</td>
                                    <td>{{ $report->t_assignedTo }}</td>
                                    <td>{{ $report->t_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- <script>
                const button = document.getElementById('generate');
                const div = document.getElementById('reportView');


                button.addEventListener('click', () => {
                    div.style.display = 'block';

                });
            </script> --}}
        <style>
            .report-section h2 {
                margin-top: 0;
                margin-bottom: 20px;
            }

            thead th {
                background-color: #333;
                color: #fff;
                padding: 10px;
                text-align: center;
                border: 1px solid #fff;
            }

            tbody td {
                padding: 10px;
                border: 1px solid #ccc;
            }
        </style>

        <button class="btn btn-primary" id="downloadreport" style="margin-top:10px; margin-left:90%"> Download
            Report</button>
        <script>
            window.onload = function() {
                document.getElementById("downloadreport")
                    .addEventListener("click", () => {
                        const reportView = this.document.getElementById("reportView");
                        console.log(reportView);
                        console.log(window);
                        var opt = {
                            margin: 0.02,
                            filename: 'report.pdf',
                            fontSize: 14,
                            image: {
                                type: 'jpeg',
                                quality: 3
                            },
                            html2canvas: {
                                scale: 5
                            },
                            jsPDF: {
                                unit: 'in',
                                format: 'letter',
                                orientation: 'landscape'
                            }
                        };
                        html2pdf().from(reportView).set(opt).save();
                    })
            }
        </script>
        <script src="pdf.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    </div>
</div>
