@include('header')
@section('title', 'Open Ticket')

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('open_ticket')
@endforeach
@include('footer')
