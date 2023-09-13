@if ($notifs == null)
    <p>No new notifications</p>
@else
    <div class="overflow-auto"
        style="border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; right: 1%; height: 89%; width: 92%; ">

        <!-- list content -->
        <div class="dropdown row" style="position: relative; ">
            <h3 class="col" style=" align-content:stretch;">
                <strong>Notification</strong>
            </h3>
        </div>
        <hr>

        @foreach ($notifs as $notify)
            @if ($notify->read_at == null)
                <ul class="list" style="background-color: #cbecff; padding:0.5%">
                    <div class="list-item-content">
                        @if ($user->u_role == 'Admin' || $user->u_role == 'Staff')
                            <a href="openTicketByNotif/{{ $notify->nID }}" style="color:black; text-decoration:none">
                                <li class="list-group-item active">
                                    <div class=row>
                                        <div class="col-6">
                                            @if (str_contains($notify->n_message, 'new'))
                                                <i class="bi  bi-ticket-perforated" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'assign'))
                                                <i class="bi bi-person-plus" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'message'))
                                                <i class="bi bi-chat-dots" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'update'))
                                                <i class="bi bi-pencil-square" style="font-size:20px"></i>
                                            @endif



                                            {{ $notify->n_message }}
                                        </div>
                                        <div class="col-3">
                                            Ticket ID: INC{{ $notify->ticket_id }}
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            {{ $notify->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li>
                            </a>
                        @else
                            <a href="clientOpenTicketByNotif/{{ $notify->nID }}"
                                style="color:black;text-decoration:none">
                                <li class="list-group-item
                                active">
                                    <div class=row>
                                        <div class="col-6">
                                            @if (str_contains($notify->n_message, 'new'))
                                                <i class="bi  bi-ticket-perforated" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'assign'))
                                                <i class="bi bi-person-plus" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'message'))
                                                <i class="bi bi-chat-dots" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'update'))
                                                <i class="bi bi-pencil-square" style="font-size:20px"></i>
                                            @endif



                                            {{ $notify->n_message }}
                                        </div>
                                        <div class="col-3">
                                            Ticket ID: INC{{ $notify->ticket_id }}
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            {{ $notify->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li>
                            </a>
                        @endif
                    </div>
                </ul>
            @else
                <ul class="list" style="background-color: #ffffff;">
                    <div class="list-item-content">
                        @if ($user->u_role == 'Admin' || $user->u_role == 'Staff')
                            <a href="openTicketByNotif/{{ $notify->nID }}" style="color:black; text-decoration:none">
                                <li class="list-group-item active">
                                    <div class=row>
                                        <div class="col-6">
                                            @if (str_contains($notify->n_message, 'new'))
                                                <i class="bi  bi-ticket-perforated" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'assign'))
                                                <i class="bi bi-person-plus" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'message'))
                                                <i class="bi bi-chat-dots" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'update'))
                                                <i class="bi bi-pencil-square" style="font-size:20px"></i>
                                            @endif



                                            {{ $notify->n_message }}
                                        </div>
                                        <div class="col-3">
                                            Ticket ID: INC{{ $notify->ticket_id }}
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            {{ $notify->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li>
                            </a>
                        @else
                            <a href="clientOpenTicketByNotif/{{ $notify->nID }}"
                                style="color:black;text-decoration:none">
                                <li class="list-group-item
                                active">
                                    <div class=row>
                                        <div class="col-6">
                                            @if (str_contains($notify->n_message, 'new'))
                                                <i class="bi  bi-ticket-perforated" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'assign'))
                                                <i class="bi bi-person-plus" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'message'))
                                                <i class="bi bi-chat-dots" style="font-size:20px"></i>
                                            @elseif(str_contains($notify->n_message, 'update'))
                                                <i class="bi bi-pencil-square" style="font-size:20px"></i>
                                            @endif



                                            {{ $notify->n_message }}
                                        </div>
                                        <div class="col-3">
                                            Ticket ID: INC{{ $notify->ticket_id }}
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            {{ $notify->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li>
                            </a>
                        @endif
                    </div>
                </ul>
            @endif

            <hr>
        @endforeach




    </div>

@endif
