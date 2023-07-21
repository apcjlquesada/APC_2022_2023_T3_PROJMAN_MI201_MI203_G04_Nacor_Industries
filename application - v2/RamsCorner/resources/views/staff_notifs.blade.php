@include('header')
@section('title', 'Administrator')


@foreach ($staff as $user)
    @foreach ($staff as $staffs)
        @include('sweetalert::alert')
        <!-- header -->
        @include('sidebar_staff')
        @include('notifications')
    @endforeach
@endforeach
@include('footer')
