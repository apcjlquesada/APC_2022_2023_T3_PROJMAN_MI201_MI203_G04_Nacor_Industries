<div>
    {{-- Ticket Status History  --}}
    <div class="overflow-auto"
        style="border-radius: 4px; border: 3px solid #ffffff; position: absolute; background-color: rgba(255, 255, 255, 0.107); top: 10%; right: 1%; height: 89%; width: 21%; ">

        <!-- list content -->

        <div class="dropdown row" style="position: relative; margin: 4.5%;">
            <h3 class="col" style="margin: 1%; align-content:stretch;text-align:center"><strong>Ticket Status
                    Tracking</strong></h3>
        </div>
        <hr>
        @foreach ($status as $stat)
            <ul class="list">

                <li class="list-item"
                    style="margin:15px; {{ $stat == $last ? 'background-color: #ffaf7a; color: black' : '' }}">



                    <div class="list-item-content ">

                        <div class="list-item-title" style="padding-left: 20px;">
                            {{ $stat->sh_Status }}</div>
                        <div class="list-item-text" style="padding-left: 20px;">
                            {{ $stat->sh_datetime }}<br>
                            {{ 'Assigned To: ' . $stat->sh_AssignedTo }}
                        </div>
                        <div class="list-item-text" style="padding-left: 20px;">

                        </div>



                    </div>
                </li>
                <hr>
        @endforeach

        </ul>



    </div>
    {{-- End of Ticket Status History  --}}

    {{-- Update --}}
    <div style="text-align: left;border-radius: 4px; border: 1px solid #ffffff; position: absolute; background-color: rgba(255, 255, 255, 0.743); top: 10%; left: 57.1%; height: 89%; width: 20.5%; "
        class="updateDiv">
        <div class="m-3">
            @if ($user->u_role == 'Staff')
                <div style="position: absolute; bottom: 0%; right: 5%; bottom: 5%;margin-right: 200px;">
                    <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                        data-bs-target="#escalate">Escalate</button>
                </div>

                <div class="modal fade" id="escalate" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Ticket Escalation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Escalate Ticket#{{ $tickets->t_ID }} to the Administrator?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="{{ url('escalateTicket/' . $tickets->t_ID) }}"><button type="button"
                                        class="btn btn-primary">Confirm</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ url('updateTicket/' . $tickets->t_ID) }}">
                @csrf
                {{-- First --}}

                <div class="email-header"
                    style="background-color: #ffffff; border: 1px solid #ffffff; padding-top: 3%; margin-bottom:20%">
                    <h3 class="col" style="align-items: center; text-align:Center; "><strong>Update Ticket</strong>
                    </h3>
                </div>

                {{-- <div class="dropdown
                    row"
                    style="position: relative; text-align: center; margin:4.5%; margin-bottom:15%">

                </div> --}}
                <div class="row align-items-start" style="padding-left:10%;padding-right:10%; ">

                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Status:</h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" name="status" required
                        title="Always take note of changing the status whenever there is a need to in order to avoid misinterpretation in the client's side.">
                        @if ($tickets->t_status == 'NEW')
                            <option value='NEW'>New</option>
                            <option value='OPENED' selected>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'OPENED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING' selected>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'PENDING')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING' selected>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'ONGOING')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING' selected>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'RESOLVED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED' selected>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'CLOSED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED' selected>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'REOPENED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED' selected>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'REJECTED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED' selected>Rejected</option>
                            <option value='CANCELLED' disabled>Cancelled</option>
                        @elseif ($tickets->t_status == 'CANCELLED')
                            <option value='OPENED' disabled>Opened</option>
                            <option value='PENDING'>Resource Pending</option>
                            <option value='ONGOING'>Ongoing</option>
                            <option value='RESOLVED'>Resolved</option>
                            <option value='CLOSED'>Closed</option>
                            <option value='REOPENED'>Reopened</option>
                            <option value='REJECTED'>Rejected</option>
                            <option value='CANCELLED' selected disabled>Cancelled</option>
                        @else
                            @if ($user->u_role == 'Admin')
                                <option value='OPENED' disabled>Opened</option>
                                <option value='PENDING'>Resource Pending</option>
                                <option value='ONGOING'>Ongoing</option>
                                <option value='RESOLVED'>Resolved</option>
                                <option value='CLOSED'>Closed</option>
                                <option value='REOPENED'>Reopened</option>
                                <option value='REJECTED'>Rejected</option>
                                <option value='CANCELLED' disabled>Cancelled</option>
                                <option value='ESCALATED' selected>Escalated</option>
                            @else
                                <option value='OPENED' disabled>Opened</option>
                                <option value='PENDING' disabled>Resource Pending</option>
                                <option value='ONGOING' disabled>Ongoing</option>
                                <option value='RESOLVED' disabled>Resolved</option>
                                <option value='CLOSED' disabled>Closed</option>
                                <option value='REOPENED' disabled>Reopened</option>
                                <option value='REJECTED' disabled>Rejected</option>
                                <option value='CANCELLED' disabled>Cancelled</option>
                                <option value='ESCALATED' selected disabled>Escalated</option>
                            @endif

                        @endif

                    </select>

                </div>
                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Category:</h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" name="category"
                        title="Select appropriate category for the ticket for easier identifying the solution for the problem and assigning of ticket.">
                        @if ($tickets->t_category == 'INFRASTRUCTURE')
                            <option value="INFRASTRUCTURE" selected>Infrastructure</option>
                            <option value="SOFTWARE">Software</option>
                        @else
                            <option value="INFRASTRUCTURE">Infrastructure</option>
                            <option value="SOFTWARE" selected>Software</option>
                        @endif

                    </select>
                </div>

                {{-- Second --}}
                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">

                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Urgency:</h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" id="urgency"
                        name="urgency">
                        @if ($tickets->t_urgency == 1)
                            <option value="1" selected>Critical</option>
                            <option value="2">Urgent</option>
                            <option value="3">Normal</option>
                        @elseif($tickets->t_urgency == 2)
                            <option value="1">Critical</option>
                            <option value="2" selected>Urgent</option>
                            <option value="3">Normal</option>
                        @else
                            <option value="1">Critical</option>
                            <option value="2">Urgent</option>
                            <option value="3" selected>Normal</option>
                        @endif

                    </select>
                </div>

                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Impact:</h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" id="impact"
                        name="impact">
                        @if ($tickets->t_impact == 1)
                            <option value="1" selected>High</option>
                            <option value="2">Medium</option>
                            <option value="3">Low</option>
                        @elseif($tickets->t_impact == 2)
                            <option value="1">High</option>
                            <option value="2" selected>Medium</option>
                            <option value="3">Low</option>
                        @else
                            <option value="1">High</option>
                            <option value="2">Medium</option>
                            <option value="3" selected>Low</option>
                        @endif
                    </select>
                </div>

                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="exampleFormControlTextarea1" class="form-label ">
                        <h6 style="margin-bottom: -5px">Priority:</h6>
                    </label>

                    <input type="text" readonly value="{{ $tickets->t_priority }}" class="form-control mb-2"
                        id="priority" name="priority">
                </div>





                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Assign Group: </h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" id="assign_group">
                        <option selected="" value="All">All</option>
                        <option value="Infrastructure">Infrastructure</option>
                        <option value="Software">Software</option>

                    </select>
                    <br>
                </div>
                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <h6 style="margin-bottom: -5px">Assign To:</h6>
                    </label>
                    <select class="form-select mb-2" aria-label="Default select example" id="assign_to"
                        name="assign">
                        @if ($tickets->t_assignTo != 'Not Assigned')
                            <option selected="" disable="" value="{{ $tickets->t_assignedTo }}">
                                {{ $tickets->t_assignedTo }}</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->u_name }}" class="{{ $staff->u_division }}">
                                    {{ $staff->u_name }}</option>
                            @endforeach
                        @else
                            <option selected value="Not Assigned">Not Assigned</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->u_name }}" class="{{ $staff->u_division }}">
                                    {{ $staff->u_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>


                {{-- Fourth --}}
                <div class="row align-items-start" style="padding-left:10%;padding-right:10%">
                    <label for="message-text" class="col-form-label">
                        <h6 style="margin-bottom: -5px">Message:</h6>
                    </label>
                    <textarea class="form-control mb-2" rows="5" id="message-text" name="message"></textarea>
                </div>
                <div style="position: absolute; bottom: 0%; right: 5%; bottom: 5%;">
                    <button type="submit" class="btn btn-primary btn-lg ">Update Ticket</button>
                </div>
            </form>



        </div>

    </div>
    {{-- End of Update --}}
    <!-- ticket contents category -->

    <div class="ticketContent overflow-auto"
        style="text-align: left;border-radius: 4px; border: 1px solid #ffffff; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 6.5%; height: 89%; width: 50%; ">
        <div id="div1">
            <div class="" style="border: 1px solid #e3e3e3a3; border-radius: 5px; overflow: hidden;">
                <div class="email-header"
                    style="background-color: #22246C; border-bottom: 1px solid #5d7274; padding: 20px;">
                    <div class="sender" style="font-size: 18px;">
                        <span class="sender-name"
                            style="font-weight: bold; color: #fff; font-size:20px">{{ $client->u_name }}</span>
                        <span class="sender-email" style="color: #a99f9f;"> {{ $client->email }}</span>
                    </div>
                    <div class="subject row" style=" font-size: 22px; margin-top: 10px; color:#ffbb00">
                        <div class="col-9">
                            <strong>{!! nl2br(html_entity_decode($tickets->t_title)) !!}</strong>
                        </div>
                        <div class="col-3"
                            style="color: #fff;text-align:right; font-size:24px;color:#ffbb00; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif ">
                            <strong>
                                INC#{{ $tickets->t_ID }}</strong>
                        </div>
                    </div>
                </div>
                <div class="email-body" style="padding: 50px;">
                    <p>
                        {{ $tickets->t_description }}
                    </p>
                    @if ($tickets->t_image != '')
                        <label for="attachment"><strong>Attachment:</strong></label><br>
                        <a href="{{ url('ticketImages/' . $tickets->t_image) }}" download>{{ $tickets->t_image }}</a>
                    @else
                    @endif

                </div>



            </div>
            <div class="mb-3" style="margin:10px">
                <form method="POST" action="{{ url('saveResolution/' . $tickets->t_ID) }}">
                    @csrf
                    <label for="message-text" class="col-form-label"
                        style="font-size: 20px"><b>Resolution</b></label>
                    <textarea class="form-control" id="message-text" name="resolution" rows="17">{{ $tickets->t_resolution }}</textarea>
                    <p>**Note: Do not forget to update the ticket once you have saved the resolution. </p>
                    <button type="submit" class="btn btn-success btn-lg" style="margin-top:2.8%; margin-left: 80%"
                        id="Resolution">Save
                        Resolution</button>
                </form>
            </div>



        </div>
        {{-- @foreach ($status as $stat)
                <ul class="list">

                    <li class="list-item" style="margin:15px;">
                        <div class="list-item-content ">

                            <div class="list-item-title" style="padding-left: 20px;">
                                Status Updated!</div>
                            <div class="list-item-text" style="padding-left: 20px;">
                                {{ $stat->sh_message }}<br>
                            </div>
                            <div class="list-item-text" style="padding-left: 20px;">

                            </div>



                        </div>
                    </li>
                    <hr>
            @endforeach --}}

        </ul>


    </div>
</div>



</div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        if ('{{ $tickets->t_status }}' === 'CANCELLED' ||
            '{{ $tickets->t_status }}' === 'REJECTED' ||
            '{{ $tickets->t_status }}' === 'CLOSED') {
            $('.updateDiv').find('*').prop('disabled', true);
            $('#Resolution').prop('disabled', true);
        }
        if ('{{ $tickets->t_status }}' === 'ESCALATED' &&
            '{{ $user->u_role }}' === 'Staff') {
            $('.updateDiv').find('*').prop('disabled', true);
            $('#Resolution').prop('disabled', true);
        }
    });

    console.log($('.updateDiv').find('*'));
</script>

<script>
    const urgency = document.getElementById("urgency"),
        impact = document.getElementById("impact"),
        priority = document.getElementById("priority");
    urgency.addEventListener('change', updateInputValue);
    impact.addEventListener('change', updateInputValue);

    function updateInputValue() {
        const urge = urgency.value,
            imp = impact.value;
        if (urge == 1 && imp == 1) {
            priority.value = 1;
        } else if (urge == 1 && imp == 2) {
            priority.value = 2;

        } else if (urge == 1 && imp == 3) {
            priority.value = 2;

        } else if (urge == 2 && imp == 1) {
            priority.value = 1;

        } else if (urge == 2 && imp == 2) {
            priority.value = 2;

        } else if (urge == 2 && imp == 3) {
            priority.value = 3;

        } else if (urge == 3 && imp == 1) {
            priority.value = 2;

        } else if (urge == 3 && imp == 2) {
            priority.value = 2;

        } else if (urge == 3 && imp == 3) {
            priority.value = 3;

        } else {
            priority.value = 3;

        }

    }
</script>

<script>
    $('#assign_group').on('change', function() {
        var selectedGroup = $(this).val();
        console.log(selectedGroup);

        if (selectedGroup == "All") {
            $(".Infrastructure").show();
            $(".Software").show();
        } else if (selectedGroup == "Infrastructure") {
            $(".Infrastructure").show();
            $(".Software").hide();
        } else {
            $(".Infrastructure").hide();
            $(".Software").show();
        }


    });
</script>
<script>
    $(document).ready(function() {
        $('.show-div').click(function(e) {
            e.preventDefault();
            var divId = $(this).data("div");
            $('.show-div').each(function() {
                $('#' + $(this).data("div")).hide();
            });
            $('#' + divId).show();
        });
    });
</script>

<script>
    function showDiv(divId) {
        document.getElementById(divId).style.display = 'block';
    }
    window.onload = function() {
        // Get the fragment identifier from the URL
        var divId = window.location.hash.substr(1);
        // If a fragment identifier is present, show the corresponding div
        if (divId) {
            showDiv(divId);
        }
    }
</script>

<style>
    .list {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
    }

    .list-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        position: relative;
    }

    .list-item:before {
        content: "";
        width: 2px;
        height: 100%;
        background-color: blue;
        position: absolute;
        left: 6px;
        top: 0;
    }

    .list-item-circle {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: blue;
        margin-right: 10px;
    }

    .list-item-content {
        display: flex;
        flex-direction: column;
    }

    .list-item-title {
        font-weight: bold;
    }
</style>
