@include('header')
@section('title', 'Administrator')


@foreach ($admin as $user)
    @include('sweetalert::alert')
    <!-- header -->
    @include('sidebar_admin')
    @include('notifications')
@endforeach
@include('footer')
