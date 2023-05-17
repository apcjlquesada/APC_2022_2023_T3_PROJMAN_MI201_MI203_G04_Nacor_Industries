@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($client as $clients)
    @foreach ($client as $user)
        @include('sidebar_admin')
        @include('users_open_ticket')

        @include('cancel_ticket')
    @endforeach
@endforeach
@include('footer')
