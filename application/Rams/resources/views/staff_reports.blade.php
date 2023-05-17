@include('header')
@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('reports')
@endforeach
@include('footer')
