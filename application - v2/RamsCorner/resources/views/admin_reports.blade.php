@include('header')
@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')

    @include('reports')
@endforeach
@include('footer')
