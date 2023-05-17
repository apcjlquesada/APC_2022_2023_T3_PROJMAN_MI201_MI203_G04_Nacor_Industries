@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')

    @include('open_ticket')
@endforeach
@include('footer')
