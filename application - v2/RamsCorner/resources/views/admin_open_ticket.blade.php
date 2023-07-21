@include('header')
@section('title', 'All Tickets')

@include('sweetalert::alert')
@foreach ($admin as $user)
    @include('sidebar_admin')

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

    setTimeout(refreshPage, 1000); // Refresh after 5 seconds
</script>
@include('footer')
