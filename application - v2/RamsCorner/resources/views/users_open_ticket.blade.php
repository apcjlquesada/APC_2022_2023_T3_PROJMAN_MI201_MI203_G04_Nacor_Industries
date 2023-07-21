<div>
    {{-- Ticket Status History  --}}
    <div class="overflow-auto"
        style="border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; right: 1%; height: 89%; width: 25%; ">

        <!-- list content -->

        <div class="dropdown row" style="position: relative; margin: 4.5%;">
            <h3 class="col" style="margin: 1%; align-content:stretch;"><strong>Ticket Status History
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
                            {{ 'Assigned To: ' . $stat->sh_AssignedTo }}<br>
                            {{ $stat->sh_message }}
                        </div>
                        <div class="list-item-text" style="padding-left: 20px;">

                        </div>



                    </div>
                </li>
                <hr>
        @endforeach

        </ul>


    </div>
    @if (
        $tickets->t_status == 'RESOLVED' ||
            $tickets->t_status == 'CANCELLED' ||
            $tickets->t_status == 'REJECTED' ||
            $tickets->t_status == 'REOPENED')
    @else
        <div class="position-absolute bottom-0 end-0 me-5 mb-5">
            <a type="button" class="btn btn-danger btn-lg" style="padding- left : 5%; font-size: 20px;width:300px"
                data-bs-toggle="modal" data-bs-target="#TicketCancel" id="cancel"><i class="bi bi-x-octagon-fill"
                    style="font-size: 20px; padding-top:20%; padding-right: 10px"></i>
                CANCEL MY TICKET</a>
        </div>
    @endif

    @include('reopen')
    @if ($tickets->t_status == 'CLOSED')
        <div class="position-absolute bottom-0 end-0 me-5 mb-5">
            <a type="button" class="btn btn-danger btn-lg" style="padding- left : 5%; font-size: 20px;width:300px"
                data-bs-toggle="modal" data-bs-target="#TicketSubmition"><i class="bi bi-envelope-open-fill"
                    style="font-size: 20px; padding-top:20%; padding-right: 10px"></i>
                REOPEN </a>
        </div>
    @else
    @endif


    {{-- End of Ticket Status History  --}}

    <!-- ticket contents category -->

    <div class="ticketContent overflow-auto"
        style="text-align: left;border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 6.5%; height: 89%; width: 65%; ">
        <div id="div1">
            <div class="" style="border: 1px solid #ccc; border-radius: 5px; overflow: hidden;">
                <div class="email-header"
                    style="background-color: #f7f7f7; border-bottom: 1px solid #ccc; padding: 20px;">
                    <div class="sender" style="font-size: 18px;">
                        <span class="sender-name" style="font-weight: bold;">From: {{ $userinfo->u_name }}</span>
                        <span class="sender-email" style="color: #a99f9f;"> {{ $userinfo->email }}</span>
                    </div>
                   
                    <div class="subject row" style=" font-size: 24px; margin-top: 10px;">
                        <div class="col-9">
                            {{ $tickets->t_title }}
                        </div>
                        <div class="col-3"
                            style="text-align:right;color: #000000; font-size:30px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                            INC#{{ $tickets->t_ID }}</div>
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
                        {{-- <label for="attachment"><strong>No Attachment Included</strong></label><br> --}}
                    @endif

                </div>

            </div>
            <div class="mb-3" style="margin:10px">
                <label for="message-text" class="col-form-label" style="font-size: 20px"><b>Resolution</b></label>
                <textarea class="form-control" id="message-text" name="resolution" readonly>{{ $tickets->t_resolution }}</textarea>

            </div>


        </div>


        </ul>


    </div>
</div>






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
