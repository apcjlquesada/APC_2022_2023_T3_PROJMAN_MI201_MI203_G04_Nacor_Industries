@include('header')
@section('title', 'Open Ticket')

@include('sweetalert::alert')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('open_ticket')
@endforeach
<script type="text/javascript">
    function refreshPage() {
        // check if page has already been refreshed
        if (!sessionStorage.getItem('refreshed')) {
            sessionStorage.setItem('refreshed', 'true');
            location.reload();
        }
    }

    setTimeout(refreshPage, 500); // Refresh after 5 seconds
</script>
@include('footer')
