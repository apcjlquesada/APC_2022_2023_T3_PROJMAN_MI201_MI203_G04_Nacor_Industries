@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')
    @include('view_all_tickets')
@endforeach
@include('footer')
