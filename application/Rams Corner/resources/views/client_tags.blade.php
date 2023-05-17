@include('header')

@include('sweetalert::alert')
@foreach ($client as $clients)
    @include('sidebar_client')
    @include('tags')
@endforeach
@include('footer')
