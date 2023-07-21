@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('tags')
@endforeach
@include('footer')
