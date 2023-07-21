@include('header')



@foreach ($client as $clients)
    @include('sidebar_client')
    @include('sweetalert::alert')

    <div class="overflow-auto"
        style="
      /* text-align: center; */
      border-radius: 4px;
      border: 1px solid #acb1677c;
      position: absolute;
      background-color: rgb(255, 255, 255);
      top: 10%;
      left: 7%;
      height: 89%;
      width: 92%;
      padding: 2%;
    ">


        <main>
            <div class="welcome-message mb-4">
                <h1>RAMs Corner: An Intuitive Ticketing System.</h1>
                <p>Here, you can find answers to some frequent problems and check the status of your ticket.
                </p>
            </div>

            <div class="card">
                <div class="card-header" style="border: 1px solid #22246C; background-color:#22246C; color:white">
                    <h2>Good Day, {{ $clients->u_name }}</h2>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        {{-- <blockquote class="blockquote mb-0">
                            <div class="ticket-status mb-2" style="text-align: center; height: 240px">
                                {{-- <h2>Check your ticket status</h2>
                            <form>
                                <label for="ticket-number" style="display: block; margin-bottom: 0.5rem;">Enter your
                                    ticket number or email address:</label>
                                <input id="search-input" type="search" name="searchKB"
                                    placeholder="Search Ticket Status"
                                    style=" flex: 1; padding: 12px 20px;  margin: 8px 0; box-sizing: border-box;  border: 2px solid #ccc;  border-radius: 4px; width: 30%;">
                                <button type="submit" value="Search"
                                    style=" width: auto;  padding: 10px 18px;  background-color: #4CAF50; color: white; margin: 8px 0; border: none;  border-radius: 4px; cursor: pointer;"><i
                                        class="bi bi-search"></i> Search</button>
                            </form>
                            <div class="status-message">
                                <!-- Status message will be displayed here based on user input -->
                            </div>
                        </div> --}}
                        {{-- @include('client_dashboard') --}}


                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Status');
                                data.addColumn('number', 'Ticket Count');

                                data.addRows([
                                    @foreach ($data as $statusCount)
                                        ['{{ $statusCount->t_status }}', {{ $statusCount->count }}],
                                    @endforeach
                                ]);

                                var options = {
                                    title: 'My Tickets',
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

                                    hAxis: {
                                        title: 'Status'
                                    },
                                    vAxis: {
                                        title: 'Ticket Count'
                                    },
                                    seriesType: 'bars',
                                    series: {
                                        1: {
                                            type: 'line'
                                        }
                                    }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>


                        <div id="chart_div"></div>




                </div>
                <div class="card-footer text-muted">
                    <nav class="navbar navbar-expand-md navbar-light bg-light justify-content-center">

                        <p style="font-size:25px; color:#22246C">Guide on how you can navigate through RAMs
                            CORNER (Click each card to see full
                            description.)</p>
                        {{-- <ul class="navbar-nav" style=" margin: 0 auto;">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/clientViewTickets') }}"
                                    style="margin-right: 250px; color:#22246C"><i class="bi bi-briefcase-fill"></i>
                                    Request
                                    Something</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/user_KB') }}"
                                    style="margin-right: 250px ;color:#22246C"><i class="bi bi-book-fill"></i>
                                    Knowledge Base</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color:#22246C"><i
                                        class="bi bi-info-circle-fill"></i>
                                    About RAMS
                                    Corner</a>
                            </li>

                        </ul> --}}
                    </nav>
                </div>
            </div>



            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Launch demo modal
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div> -->


            <div class="row">
                <div class="col-md-6">
                    <div class="placeholder-div card" type="button" data-bs-toggle="modal"
                        data-bs-target="#creationModal" style="border-left: 10px solid #ffaa00 ">

                        <h3>Ticket Creation</h3>
                        <p>Provide a clear and concise description of the issue, include any relevant information or
                            attachments, and select the appropriate category or department for the ticket.</p>
                    </div>
                    <div class="modal fade" id="creationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ticket Creation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{ url('images/create.png') }}" alt="your-image-alt"
                                            class="img-fluid">
                                    </div>
                                    <p>1. <strong>CC</strong> – You can tag someone related to your own ticket
                                        (e.g.,
                                        professor, student, APC staff etc.)
                                    </p>
                                    <p>2. <strong>Category</strong> – You can choose if the ticket is related to
                                        infrastructure or software technical concern (e.g., (1) “classroom projector
                                        does
                                        not work” is subjected to Infrastructure category (2) “Office 365 needs
                                        reactivation” is subjected to software category) It will provide better
                                        categorization for the ITRO Staff to sort sent tickets according to the ITRO
                                        staff
                                        specific field of work for the most accurate solution to the tickets.
                                    </p>

                                    <p>3. <strong>Title</strong> – this is where you will put the short description
                                        regarding your ticket.</p>
                                    <p>4. <strong>Ticket Description</strong> – you can give a long description of
                                        what
                                        the ticket is about and all the details you need to include, to further
                                        elaborate the ticket.</p>
                                    <p>5. <strong>Upload file</strong> – you can attach an image or any file that
                                        will
                                        provide further details and information regarding your ticket.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="placeholder-div card" type="button" data-bs-toggle="modal"
                        data-bs-target="#ticketsModal" style="border-left: 10px solid #ffaa00 ">
                        <h3>My Tickets</h3>
                        <p>On the Tickets Page, you can view and manage your support tickets, including their
                            status,
                            priority, and any comments or updates from the support team.</p>
                    </div>
                    <div class="modal fade" id="ticketsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tickets Page</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{ url('images/view.png') }}" alt="your-image-alt" class="img-fluid">
                                    </div>
                                    <p>1. <strong>Home</strong> – this will lead to the home page of Ram’s Corner:
                                        IT
                                        ticketing system.</p>
                                    <p>2. <strong>Notification</strong> – this will help you track if your ticket has
                                        been updated.
                                    </p>
                                    <p>3. <strong>My tickets</strong> – if you want to see your ticket history sent,
                                        you
                                        will click this button and it will display all the tickets that you sent.
                                    </p>
                                    <p>4. <strong>Knowledge base</strong> – This library contains the steps and
                                        guides
                                        of previous problems/issues resolved that have been recorded to give you an
                                        option whether you want to troubleshoot on your own.</p>
                                    <p>5. <strong>Tags</strong> – this is where you can see all the tickets that are
                                        tagged to you or copied to you.</p>
                                    <p>6. <strong>Help</strong> – this navigation allows you to see a full description
                                        on how you can navigate the RAMs Corner</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="placeholder-div card" type="button" data-bs-toggle="modal" data-bs-target="#kbModal"
                        style="border-left: 10px solid #ffaa00 ">
                        <h3>Knowledge Base</h3>
                        <p>We might have already fixed your problem! try to visit our Knowledge Base in which we
                            call KB
                            and search your inquiry</p>
                    </div>
                    <div class="modal fade" id="kbModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Knowledge Base</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{ url('images/kb.png') }}" alt="your-image-alt" class="img-fluid">
                                    </div>
                                    <p>1. <strong>Search</strong> – This allows you to search and browse for an
                                        existing
                                        resolved ticket.</p>
                                    <p>2. <strong>All</strong> – this button displays all the existing resolved
                                        tickets
                                        in the library </p>
                                    <p>3. <strong>Infrastructure</strong> – this button allows you to filter the KB
                                        content for hardware related problem/issues that already has solutions.</p>
                                    <p>4. <strong>Software</strong> - this button allows you to filter the KB
                                        content
                                        for software related problem/issues that already has solutions.</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="placeholder-div card" type="button" data-bs-toggle="modal"
                        data-bs-target="#statusModal" style="border-left: 10px solid #ffaa00 ">
                        <h3>Status Levels</h3>
                        <p>Status levels indicate the current state of a support ticket, such as " open" for a new or
                            unresolved issue, "pending" for awaiting action or information, and "closed" for a resolved
                            or completed ticket.</p>
                    </div>
                    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status Levels</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="text-center">
                  <img src="mytickets.png" alt="your-image-alt" class="img-fluid">
                </div> -->
                                    <p>1. <strong>New</strong> - Tickets that are recently sent and waiting for it
                                        to be
                                        opened by the ITRO staff or admin himself.</p>
                                    <p>2. <strong>Opened</strong>- The ticket is now being reviewed. The ITRO
                                        staff
                                        or
                                        admin is checking if the ticket is relatively part of their scope of work,
                                        which
                                        if so, shall be provided with corresponding solution.The ticket is investigated
                                        by the ITRO staff or
                                        admin, and the ticket details is modief (such as the ticket's impact/urgency,
                                        and assigning the ticket)
                                    </p>
                                    <p>3. <strong>Resource Pending</strong>- The ticket is now being reviewed if there
                                        are any more specific or necessary information needed from the client.</p>
                                    <p>4. <strong>Ongoing</strong>- The ticket is now being worked on. The ITRO
                                        staff or
                                        admin is now looking for the best solution to resolve your ticket.</p>
                                    <p>5. <strong>Resolved</strong>- The ticket is now resolved. the ITRO staff or
                                        admin
                                        successfully provided a solution on the sent ticket.</p>
                                    <p>6. <strong>Closed</strong>- the ticket is confirmed by the client to be already
                                        resolved and can now closed by the ITRO Staff or admin
                                        after
                                        providing solution to the ticket. </p>
                                    <p>7. <strong>Reopened</strong>- ticket is subjected for reopening if the
                                        problem/issues still persist or reoccurred after providing solution to the
                                        said
                                        ticket.</p>
                                    <p>8. <strong>Rejected</strong>- tickets are rejected once ITRO staff or admin
                                        determined ticket sent was inappropriately created or considered as
                                        nonsensical
                                        with regards to the technical services that ITRO office provide (e.g.,
                                        students
                                        deliberately created tickets for trolling purposes) or basically
                                        problems/issues
                                        that does not encompasses the ITRO scope of work.</p>
                                    <p>9. <strong>Cancelled</strong>- the client have pulled out his/her ticket.</p>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="placeholder-div card" type="button" data-bs-toggle="modal"
                        data-bs-target="#urgencyModal" style="border-left: 10px solid #ffaa00 ">
                        <h3>Urgency & Impact Level</h3>
                        <p>Urgency and impact levels assess how quickly a response is needed and the extent of the
                            issue's effects, helping to prioritize and escalate tickets accordingly.</p>
                    </div>
                    <div class="modal fade" id="urgencyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Urgency Level</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="{{ url('images/ui.png') }}" alt="your-image-alt" class="img-fluid">
                                    </div>
                                    <p><strong>Critical</strong> - this urgency level would require the highest
                                        priority
                                        among all tickets. Typically addressed within 4-6 hours but no longer than
                                        24
                                        hours. </p>
                                    <p><strong>Urgent</strong> - this urgency level would require fair amount of
                                        time to
                                        be addressed among all tickets. Typically addressed within 24 hours but no
                                        longer than 72 hours.</p>
                                    <p><strong>Normal</strong>- this urgency level would require the least
                                        prioritization among all tickets to be addressed. typically addressed within
                                        3-7
                                        business days at this urgency level. </p>
                                    <hr>
                                    <h3>Impact Level</h3>

                                    <p><strong>High</strong> - A high impact level is determined considering a large
                                        volume of the population is affected. (e.g., classes are delayed because of
                                        computer laboratory has no electricity and needed to relocate into another
                                        computer laboratory) immediate response is needed in this kind of situation.
                                    </p>
                                    <p><strong>Medium</strong>- A medium impact sits somewhere between the middle of
                                        a
                                        high impact and low impact level, having a minimal problem/issue that
                                        affects an
                                        individual or an organization. (e.g., some students cannot access the
                                        enrollment
                                        portal wire transfer for BDO bank users thus causing them delay for
                                        enrollment
                                        for 1-2 days but would not resort to late enrollment)</p>
                                    <p><strong>Low</strong>- A low impact level is determined considering an
                                        Indvidual
                                        person is affected and does not affect a large volume of people within the
                                        organization not causing delay and disruption in any form. (e.g., isolated
                                        case
                                        of a student having his/her office 365 account needs relicensing) it does
                                        not
                                        disrupt another individual of large amount of people. </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="placeholder-div card" type="button" data-bs-toggle="modal"
                        data-bs-target="#priorityModal" style="border-left: 10px solid #ffaa00 ">
                        <h3>Priority Levels</h3>
                        <p>Priority levels indicate the level of urgency or importance of a support ticket, used to
                            determine response times and allocate resources accordingly.</p>
                    </div>
                    <div class="modal fade" id="priorityModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Priority Level</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <div class="text-center">
                            <img src="impactLevel.png" alt="your-image-alt" class="img-fluid">
                            </div> -->
                                    <p><strong>P0</strong> – Escalated Tickets. These are the tickets that cannot be
                                        addressed by the Staff alone and needs the resolution of the Administrator
                                        himself (as the highest in the hierarchy of ITRO Officers). </p>
                                    <p><strong>P1</strong> - have the highest priority levels among all the tickets
                                        Determined by the impact level and urgency.</p>
                                    <p><strong>P2</strong> – have somewhere between low or high priority levels
                                        Determined by impact level and urgency.</p>
                                    <p><strong>P3</strong> - have the lowest priority levels Determined by impact
                                        level
                                        and urgency.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>


            <style>
                .placeholder-div {
                    height: 40%;
                }

                .navbar .nav-link {
                    font-size: 18px;
                }

                .placeholder-div {
                    border: 1px solid #ccc;
                    padding: 10px;
                    margin: 2%;
                }

                .navbar-nav {
                    margin: 0 auto;
                }

                h1 {
                    font-size: 30px;
                }

                h2 {
                    font-size: 25px;
                }

                h3 {
                    font-size: 20px;

                }
            </style>


        </main>


    </div>
    <!-- placeholder end -->
    <div class="footer"
        style="position: fixed; bottom: 0; width: 100%; height: 30px; background-color: #e3ad43; color: #fff; display: flex; align-items: center; justify-content: center;">
        <p style="margin: 0; text-align: center;">Copyright © 2023 Asia Pacific College | Nacor Industries. All rights
            reserved.</p>
    </div>
@endforeach
@include('footer')
