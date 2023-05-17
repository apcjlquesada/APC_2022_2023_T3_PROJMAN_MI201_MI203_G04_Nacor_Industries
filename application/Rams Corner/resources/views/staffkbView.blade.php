@include('header')
@foreach ($staff as $user)
    @include('sidebar_staff')
    @include('sweetalert::alert')
    <div class=""
        style=" border-radius: 4px; border: 1px solid #ffffff7c; position: absolute; background-color: rgb(255, 255, 255); top: 10%; left: 7%; height: 89%; width: 92%; padding: 1%;">
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







        <!-- Button trigger modal -->
        <div style="position: absolute; top: 93%; right: 2%;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                Update KB
            </button>
        </div>


        <!-- Modal -->
        <form method="post" encytpe="multipart/form-data" action="{{ url('/updateKB') }}"
            class="row g-3 needs-validation" novalidate>
            @csrf
            <input type="hidden" name="id" value="{{ $kb_info->kb_ID }}">
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Updating Knowledge Base </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="input-group mb-3">
                                <span class="input-group-text">KB Title</span>
                                <input value="{{ $kb_info->kb_title }}" class="form-control" id="title"
                                    name="title" rows="1" required type="text">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">KBID#</span>
                                <input value="{{ $kb_info->kb_ID }}" class="form-control" id="tixNum" name="tixNum"
                                    rows="1" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Category</span>
                                <select value="{{ $kb_info->kb_category }}" class="form-select "
                                    aria-label="Default select example" id="category" name="category" required>
                                    @if ($kb_info->kb_category == 'Infrastracture')
                                        <option value="Infrastructure" select>Infrastructure</option>
                                        <option value="Software">Software</option>
                                    @else
                                        <option value="Infrastructure">Infrastructure</option>
                                        <option value="Software" select>Software</option>
                                    @endif
                                </select>
                            </div>

                            <div class="mb-2">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Content</span>
                                    <textarea class="form-control" id="content" name="content" rows="5" required>{!! $kb_info->kb_content !!}</textarea>

                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Resolution</span>
                                <textarea class="form-control" id="resolution" name="resolution" rows="3" required>{!! $kb_info->kb_resolution !!}</textarea>
                            </div>
                            @if ($kb_info->kb_view == 1)
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="1"
                                            name="userview" aria-label="Checkbox for following text input" checked>
                                    </div>
                                    <input placeholder="Available for client view?" class="form-control"
                                        aria-label="Text input with checkbox" readonly="true">
                                </div>
                            @else
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="1"
                                            name="userview" aria-label="Checkbox for following text input">
                                    </div>
                                    <input placeholder="Available for client view?" class="form-control"
                                        aria-label="Text input with checkbox" readonly="true">
                                </div>
                            @endif


                            {{-- @if ($kb_info->kb_acctInfo == 1)
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="1"
                                            name="account_info" aria-label="Checkbox for following text input"
                                            checked>
                                    </div>
                                    <input placeholder="Include account information?" class="form-control"
                                        aria-label="Text input with checkbox" readonly="true">
                                </div>
                            @else
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="1"
                                            name="account_info" aria-label="Checkbox for following text input">
                                    </div>
                                    <input placeholder="Include account information?" class="form-control"
                                        aria-label="Text input with checkbox" readonly="true">
                                </div>
                            @endif --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update KB</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    </div>
@endforeach
@include('footer')
