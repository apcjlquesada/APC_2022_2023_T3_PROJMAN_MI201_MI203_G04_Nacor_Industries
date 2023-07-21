<div>
    <div class="overflow-auto"
        style="border-radius: 4px; border: 1px solid #acb1677c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; height: 89%; width: 22%; left: 6.5%;">
        <!-- ticket list content -->
        @if ($tixCount != 0)
            <h5 style="text-align:center; margin-top:5%; opacity:80%"><i class="bi bi-inboxes-fill"
                    style="font-size: 30px; color:orange"></i><br>Tagged Tickets
            </h5>
            <div class="list-group">
                @foreach ($ticket as $info)
                    <a href="/getTicketData/{{ $info->t_ID }}" class="list-group-item ">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $info->u_name }}</h5>
                            <small class="text-muted">{{ $info->t_datetime }}</small>
                        </div>
                        <p class="mb-1">{{ $info->t_title }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <h5 style="text-align:center; margin-top:70%; opacity:50%"><i class="bi bi-inboxes"
                    style="font-size: 100px"></i><br>You haven't been
                <br>tagged to any tickets yet.
            </h5>
        @endif

    </div>
    <!-- ticket contents category -->
    <div class="ticketContent overflow-auto"
        style="display:{{ $display }};text-align: left; border-radius: 4px; border: 1px solid blue; position: absolute; background-color: rgb(255, 255, 255); top: 10%; right: 1%; height: 89%; width: 70%; "
        id="ticketInfo">
        @if ($tixCount != 0)


            <div id="div1" class="content">
                <div class="email-header"
                    style="background-color: #f7f7f7; border-bottom: 1px solid #ccc; padding: 20px;">
                    <div class="sender" style="font-size: 18px;">
                        <span class="sender-name" style="font-weight: bold;">{{ $sample->u_name }}</span>
                        <span class="sender-email" style="color: #ccc;">{{ $sample->email }}</span>
                    </div>
                    <div class="subject" style=" font-size: 24px; margin-top: 10px">
                        {{ $sample->t_title }}
                    </div>

                    <div class="subject" style=" font-size: 24px; margin-top: -2%; text-align:right">
                        INC#{{ $sample->t_ID }}
                    </div>

                </div>
                <div class="email-body" style="padding: 5%;">
                    <p class="" style="margin-bottom: 5%;">
                        {{ $sample->t_description }}
                    </p>
                </div>
                <div style="padding: 20px;">
                    @if ($sample->t_image != '')
                        <label for="attachment">Attachment:</label><br>
                        <a href="{{ url('ticketImages/' . $sample->t_image) }}" download>{{ $sample->t_image }}</a>
                    @endif

                </div>
                <div class="email-body" style="padding: 5%;">
                    <p class="" style="margin-bottom: 5%; font-size: 20px">
                        <em>Resolution:</em> {{ $sample->t_resolution }}
                    </p>
                </div>
            </div>
        @else
            <h4 style="text-align:center; margin-top:30%; opacity:50%">Ticket Content displayed here.</h4>
        @endif
    </div>

    <style>
        .content {
            padding: 10px;
            margin-top: 10px;
            background-color: #f0f0f0;
        }
    </style>
    /*
    <script>
        $(document).ready(function() {
            $('.link').click(function() {
                var target = $(this).data('target');
                $('.content').hide();
                $(target).show();
                return false;
            });
        });
    </script> */

</div>
