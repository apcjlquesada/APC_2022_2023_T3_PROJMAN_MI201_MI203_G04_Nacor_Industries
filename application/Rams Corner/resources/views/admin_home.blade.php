@include('header')
@section('title', 'Administrator')


@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('sidebar_admin')


    @include('dashboard')
@endforeach
@include('footer')
