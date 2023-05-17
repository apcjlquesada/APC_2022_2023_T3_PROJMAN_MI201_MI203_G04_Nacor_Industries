@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($client as $clients)
    @include('sidebar_client')

    @include('users_open_ticket')

    @include('cancel_ticket')
@endforeach
@include('footer')
