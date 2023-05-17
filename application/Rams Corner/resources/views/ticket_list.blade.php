@include('header')



@foreach ($client as $clients)
    @include('sidebar_client')
    @include('sweetalert::alert')
    <div>
        <div class="overflow-auto"
            style="text-align: center; border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; height: 89%; width: 18.5%; left: 6.5%;">
            <!-- list content -->


            @if ($tixCount == 0)
                <h5 style="padding: 50px;">No tickets yet.</h5>
            @elseif($tixCount > 0)
                @foreach ($ticket as $tickets)
                    <div class="list-group">
                        <a href="#" style="user-select: none;"
                            class="list-group-item list-group-item-action show-div">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    {{ $clients->u_name }}</h5>
                                <small class="text-muted">3 days ago</small>
                            </div>
                            <p class="mb-1"><b>{{ $tickets->t_title }}</b></p>


                        </a>


                    </div>
                @endforeach
            @endif

        </div>

        {{-- <!-- ticket contents category -->
        {{-- <div class="ticketContent overflow-auto"
            style="text-align: left; border-radius: 4px; border: 1px solid #acb1677c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; right: 1%; height: 89%; width: 73.5%; "> --}}


        <!-- ticket create button -->

        <div class="position-absolute bottom-0 end-0 me-4 mb-3">
            <a type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal"
                data-bs-target="#TicketSubmition">Create a
                Ticket</a>
        </div>
        @include('create_ticket') --}}
    </div>
    </div>
@endforeach
@include('footer')
