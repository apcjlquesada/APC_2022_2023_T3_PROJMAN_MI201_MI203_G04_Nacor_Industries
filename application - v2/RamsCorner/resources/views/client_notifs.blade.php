@include('header')
@section('title', 'Administrator')


@foreach ($client as $user)
    @foreach ($client as $clients)
        @include('sweetalert::alert')
        <!-- header -->
        @include('sidebar_client')
        @include('notifications')
    @endforeach
@endforeach
@include('footer')
