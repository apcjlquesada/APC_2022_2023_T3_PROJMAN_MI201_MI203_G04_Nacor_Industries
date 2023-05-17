@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')

    @include('view_all_tickets')
@endforeach
@include('footer')
