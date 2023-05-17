@include('header')
@foreach ($client as $clients)
    @include('sidebar_client')

    <div class=""
        style=" border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%; padding: 3%;">

        <a href="{{ url()->previous() }}" class="btn bi bi-arrow-left" style="font-size:40px"></a>

        <div class="overflow-auto" style="position: relative; height: 88%;">
            <div class="card">
                <div class="card-header" style="background-color:rgb(0, 21, 126); color:white">
                    <h2 class="text-group-title"><i class="bi bi-list-check" style="font-size:40px"></i>
                        KBID#</strong>{{ $kb_info->kb_ID }}:
                        {{ $kb_info->kb_title }} </h5>

                </div>
                <div class="card-body">
                    <div class="text-group-content">
                        <h6 style="font-size: 24px"><strong>Category:</strong></h6>
                        <p style="font-size: 20px">{{ $kb_info->kb_category }}</p>
                        <p style="font-size: 24px"><strong>Content:</strong></p>
                        <p style="font-size: 20px">{!! nl2br(html_entity_decode($kb_info->kb_content)) !!}</p>
                        <p style="font-size: 24px"><strong>Resolution:</strong></p>
                        <p style="font-size: 20px">{!! nl2br(htmlspecialchars($kb_info->kb_resolution)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@include('footer')
